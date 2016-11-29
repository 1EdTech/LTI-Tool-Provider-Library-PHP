<?php

namespace IMSGlobal\LTI\HTTP;

use IMSGlobal\LTI\HTTPMessage;

/**
 * Sends HTTP messages with streams via fopen.
 *
 * @author  Stephen P Vickers <svickers@imsglobal.org>
 * @copyright  IMS Global Learning Consortium Inc
 * @date  2016
 * @version 3.0.0
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class StreamClient implements Client
{

    /**
     * @inheritdoc
     */
    public function send(HTTPMessage $message)
    {
        $message->ok = false;

        // Prepare options for the HTTP context.
        $opts = array(
            'method' => $message->method,
            'content' => $message->request
        );
        if (!empty($message->requestHeaders)) {
            $opts['header'] = $message->requestHeaders;
        }

        // Send the request.
        $http_response_header = null;
        $context = stream_context_create(['http' => $opts]);
        $stream = @fopen($message->url, 'rb', false, $context);
        if ($stream) {
            $message->response = @stream_get_contents($stream);
            fclose($stream);
        }

        // Read the headers to get the status.
        if ($http_response_header) {
            $message->responseHeaders = implode("\n", $http_response_header);
            $parts = explode(' ', $message->responseHeaders, 3);
            $message->status = $parts[1];
            $message->ok = $message->status < 400;
        }

        return $message->ok;
    }

}
