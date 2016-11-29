<?php
namespace IMSGlobal\LTI\Test\HTTP;

use IMSGlobal\LTI\HTTP\CurlClient;
use IMSGlobal\LTI\HTTP\StreamClient;
use IMSGlobal\LTI\HTTP\Client as HttpClient;
use IMSGlobal\LTI\HTTPMessage;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Runs the CurlClient and StreamClient through the same test cases.
 * 
 * @covers \IMSGlobal\LTI\HTTP\CurlClient
 * @covers \IMSGlobal\LTI\HTTP\StreamClient
 */
class ClientTest extends TestCase
{
    /** @var TestServer */
    public $server;
    
    protected function setUp()
    {
        parent::setUp();
        $this->server = new TestServer();
        $this->server->start();
        if (!$this->server->isRunning()) {
            $this->markTestSkipped('Test server is not running.');
        }
    }

    protected function tearDown()
    {
        parent::tearDown();
        $this->server->stop();
    }
    
    public function provideClient()
    {
        return [[new CurlClient], [new StreamClient]];
    }

    /**
     * @param HttpClient $client
     * @dataProvider provideClient
     */
    public function testCanSendPostMessage(HttpClient $client)
    {
        $url = $this->server->getUrl(200, TestServer::RETURN_INPUT);
        $message = new HTTPMessage($url, 'POST', 'hello');
        $client->send($message);
        
        $this->assertTrue($message->ok);
        $this->assertEquals('hello', $message->response);
    }

    /**
     * @param HttpClient $client
     * @dataProvider provideClient
     */
    public function testCanSendUncommonMethods(HttpClient $client)
    {
        $url = $this->server->getUrl(200, TestServer::RETURN_INPUT);
        $message = new HTTPMessage($url, 'PATCH', 'hello');
        $client->send($message);

        $this->assertTrue($message->ok);
        $this->assertEquals('hello', $message->response);
    }

    /**
     * @param HttpClient $client
     * @dataProvider provideClient
     */
    public function testCanSendMessageWithHeaders(HttpClient $client)
    {
        $url = $this->server->getUrl(200, TestServer::RETURN_HEADER, 'Test');
        $message = new HTTPMessage($url, 'POST', null, 'Test: foo');
        $client->send($message);

        $this->assertTrue($message->ok);
        $this->assertEquals('foo', $message->response);
    }

    /**
     * @param HttpClient $client
     * @dataProvider provideClient
     */
    public function testCanHandleError(HttpClient $client)
    {
        $url = $this->server->getUrl(404);
        $message = new HTTPMessage($url, 'GET');
        $client->send($message);

        $this->assertFalse($message->ok);
        $this->assertEquals(404, $message->status);
    }

    public function testCanHandleResponsesWithRepeatedHeaderBlock()
    {
        $url = $this->server->getUrl(200, TestServer::RETURN_VALUE, "HTTP/1.1 200 OK\n\nsuccess");
        $message = new HTTPMessage($url, 'GET');
        $client = new CurlClient();
        $client->send($message);

        $this->assertTrue($message->ok);
        $this->assertEquals('success', $message->response);
    }
}
