<?php

namespace IMSGlobal\LTI\HTTP;

use IMSGlobal\LTI\HTTPMessage;

/**
 * An HTTP client for sending the HTTP messages.
 *
 * @author  Stephen P Vickers <svickers@imsglobal.org>
 * @copyright  IMS Global Learning Consortium Inc
 * @date  2016
 * @version 3.0.0
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
interface Client
{

    /**
     * Send the provided HTTPMessage and then updates it with the response data.
     * 
     * @param HTTPMessage $message The HTTP message to send
     * @return bool If successful, returns true
     */
    public function send(HTTPMessage $message);

}
