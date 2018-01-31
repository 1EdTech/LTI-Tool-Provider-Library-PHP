<?php
namespace IMSGlobal\LTI\ToolProvider\MediaType;

use IMSGlobal\LTI\Profile\ServiceDefinition;
use IMSGlobal\LTI\ToolProvider\ToolProvider;

/**
 * Class to represent an LTI Tool Proxy media type.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.0
 * @license Apache-2.0
 */
class ToolProxy
{

    /**
     * Class constructor.
     *
     * @param ToolProvider $toolProvider Tool Provider object.
     * @param ServiceDefinition $toolProxyService Tool Proxy service.
     * @param string $secret Shared secret.
     */
    public function __construct($toolProvider, $toolProxyService, $secret)
    {
        $contexts = array();
        
        $this->{'@context'} = array_merge(array(
            'http://purl.imsglobal.org/ctx/lti/v2/ToolProxy'
        ), $contexts);
        $this->{'@type'} = 'ToolProxy';
        $this->{'@id'} = "{$toolProxyService->endpoint}";
        $this->lti_version = 'LTI-2p0';
        $this->tool_consumer_profile = $toolProvider->consumer->profile->{'@id'};
        $this->tool_profile = new ToolProfile($toolProvider);
        $this->security_contract = new SecurityContract($toolProvider, $secret);
    }
}
