<?php

namespace IMSGlobal\LTI\HTTP;

use IMSGlobal\LTI\HTTPMessage;

/**
 * Sends HTTP messages with cURL.
 *
 * @author  Stephen P Vickers <svickers@imsglobal.org>
 * @copyright  IMS Global Learning Consortium Inc
 * @date  2016
 * @version 3.0.0
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class CurlClient implements Client
{

    /**
     * @inheritdoc
     */
    public function send(HTTPMessage $message)
    {
        $message->ok = false;

        $resp = '';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $message->url);
        if (!empty($message->requestHeaders)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $message->requestHeaders);
        } else {
            curl_setopt($ch, CURLOPT_HEADER, 0);
        }
        if ($message->method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message->request);
        } else if ($message->method !== 'GET') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $message->method);
            if (!is_null($message->request)) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $message->request);
            }
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        $chResp = curl_exec($ch);
        $message->ok = $chResp !== false;
        if ($message->ok) {
            $chResp = str_replace("\r\n", "\n", $chResp);
            $chRespSplit = explode("\n\n", $chResp, 2);
            if ((count($chRespSplit) > 1) && (substr($chRespSplit[1], 0, 5) === 'HTTP/')) {
                $chRespSplit = explode("\n\n", $chRespSplit[1], 2);
            }
            $message->responseHeaders = $chRespSplit[0];
            $resp = $chRespSplit[1];
            $message->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $message->ok = $message->status < 400;
            if (!$message->ok) {
                $message->error = curl_error($ch);
            }
        }
        $message->requestHeaders = str_replace("\r\n", "\n", curl_getinfo($ch, CURLINFO_HEADER_OUT));
        curl_close($ch);
        $message->response = $resp;

        return $message->ok;
    }

}
