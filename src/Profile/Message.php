<?php
namespace IMSGlobal\LTI\Profile;

/**
 * Class to represent a resource handler message object.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.0
 * @license Apache-2.0
 */
class Message
{

    /** @var string LTI message type. */
    public $type = null;

    /** @var string Path to send message request to (used in conjunction with a base URL for the Tool Provider). */
    public $path = null;

    /** @var array Capabilities required by message. */
    public $capabilities = null;

    /** @var array Variable parameters to accompany message request. */
    public $variables = null;

    /** @var array Fixed parameters to accompany message request. */
    public $constants = null;

    /**
     * Class constructor.
     *
     * @param string $type LTI message type.
     * @param string $path Path to send message request to.
     * @param array $capabilities Array of capabilities required by message.
     * @param array $variables Array of variable parameters to accompany message request.
     * @param array $constants Array of fixed parameters to accompany message request.
     */
    public function __construct($type, $path, $capabilities = array(), $variables = array(), $constants = array())
    {
        $this->type = $type;
        $this->path = $path;
        $this->capabilities = $capabilities;
        $this->variables = $variables;
        $this->constants = $constants;
    }
}
