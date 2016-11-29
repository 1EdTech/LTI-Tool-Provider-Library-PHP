<?php
namespace IMSGlobal\LTI\Test;

use IMSGlobal\LTI\HTTP\Client;
use IMSGlobal\LTI\HTTP\CurlClient;
use IMSGlobal\LTI\HTTPMessage;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * @covers \IMSGlobal\LTI\HTTPMessage
 */
class HTTPMessageTest extends TestCase
{
    public function testCanProvideAClientForSendingMessage()
    {
        $client = $this->createMock(Client::class);
        HTTPMessage::setHttpClient($client);
        
        $this->assertInstanceOf(Client::class, HTTPMessage::getHttpClient());
    }

    public function testUsesCurlClientIfCurlIsAvailable()
    {
        $client = HTTPMessage::getHttpClient();
        
        $this->assertInstanceOf(CurlClient::class, $client);
    }

    public function testCanCreateAFormattedHttpMessage()
    {
        $message = new HTTPMessage(
            'http://example.com',
            'post',
            ['a' => 1, 'b' => 2],
            "Foo: abc\nBar: xyz"
        );
        
        $this->assertEquals('http://example.com', $message->url);
        $this->assertEquals('POST', $message->method);
        $this->assertEquals('a=1&b=2', $message->request);
        $this->assertInternalType('array', $message->requestHeaders);
        $this->assertCount(2, $message->requestHeaders);
    }

    public function testCanSendAnHttpMessage()
    {
        // Create a message to send
        $message = new HTTPMessage('http://example.com', 'POST');

        // Create a mock client and configure to be used for sending HTTP messages
        $client = $this->createMock(Client::class);
        $client->expects($this->once())
            ->method('send')
            ->with($message)
            ->willReturnCallback(function (HTTPMessage $message) {
                return $message->ok = true;
            });
        HTTPMessage::setHttpClient($client);

        // Send the message
        $result = $message->send();

        // Verify success
        $this->assertTrue($result);
        $this->assertTrue($message->ok);
    }
    
    protected function setUp()
    {
        parent::setUp();
        
        // Reset the HTTP client
        HTTPMessage::setHttpClient(null);
    }

    protected function tearDown()
    {
        parent::tearDown();

        // Reset the HTTP client
        HTTPMessage::setHttpClient(null);
    }
}
