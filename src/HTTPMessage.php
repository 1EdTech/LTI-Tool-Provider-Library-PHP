<?php

namespace IMSGlobal\LTI;

use IMSGlobal\LTI\HTTP\Client as HTTPClient;
use IMSGlobal\LTI\HTTP\CurlClient;
use IMSGlobal\LTI\HTTP\StreamClient;

/**
 * Class to represent an HTTP message.
 *
 * @author  Stephen P Vickers <svickers@imsglobal.org>
 * @copyright  IMS Global Learning Consortium Inc
 * @date  2016
 * @version 3.0.0
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class HTTPMessage
{
    /**
     * @var HTTPClient The client used to send the request.
     */
    private static $httpClient;

    /**
     * @var bool True if message was sent successfully.
     */
    public $ok = false;

    /**
     * @var string|null Request body.
     */
    public $request = null;

    /**
     * @var array Request headers.
     */
    public $requestHeaders = [];

    /**
     * @var string|null Response body.
     */
    public $response = null;

    /**
     * @var string Response headers.
     */
    public $responseHeaders = '';

    /**
     * @var int Status of response (0 if undetermined).
     */
    public $status = 0;

    /**
     * @var string Error message
     */
    public $error = '';

    /**
     * @var string Request URL.
     */
    public $url = null;

    /**
     * @var string Request method.
     */
    public $method = null;

    /**
     * Allows you to set a custom HTTP client.
     * 
     * @param HTTPClient|null $httpClient The HTTP client to use for sending message.
     */
    public static function setHttpClient(HTTPClient $httpClient = null)
    {
        self::$httpClient = $httpClient;
    }

    /**
     * Retrieves the HTTP client used for sending the message. Creates a default client if one is not set.
     * 
     * @return HTTPClient
     */
    public static function getHttpClient()
    {
        if (!self::$httpClient) {
            // @codeCoverageIgnoreStart
            if (function_exists('curl_init')) {
                self::$httpClient =  new CurlClient();
            } elseif (ini_get('allow_url_fopen')) {
                self::$httpClient =  new StreamClient();
            } else {
                throw new \RuntimeException('Cannot create an HTTP client, because neither cURL or allow_url_fopen are enabled.');
            }
            // @codeCoverageIgnoreEnd
        }
        
        return self::$httpClient;
    }

    /**
     * Class constructor.
     *
     * @param string $url     URL to send request to
     * @param string $method  Request method to use (optional, default is GET)
     * @param array|string  $params  Associative array of parameter values to be passed or message body (optional, default is none)
     * @param array|string $header  Values to include in the request header (optional, default is none)
     */
    function __construct($url, $method = 'GET', $params = null, $header = null)
    {
        $this->url = $url;
        $this->method = strtoupper($method);
        $this->request = is_array($params) ? http_build_query($params) : $params;
        if ($header && !is_array($header)) {
            $this->requestHeaders = explode("\n", $header);
        }
    }

    /**
     * Send the request to the target URL.
     *
     * @return boolean True if the request was successful
     */
    public function send()
    {
        return self::getHttpClient()->send($this);
    }

}
