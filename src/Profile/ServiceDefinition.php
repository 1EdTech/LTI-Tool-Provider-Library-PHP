<?php
namespace IMSGlobal\LTI\Profile;

/**
 * Class to represent an LTI service object.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.0
 * @license Apache-2.0
 */
class ServiceDefinition
{

    /** @var array Media types supported by service. */
    public $formats = null;

    /** @var array HTTP actions accepted by service. */
    public $actions = null;

    /** @var string ID of service. */
    public $id = null;

    /** @var string URL for service requests. */
    public $endpoint = null;

    /**
     * Class constructor.
     *
     * @param array $formats Array of media types supported by service.
     * @param array $actions Array of HTTP actions accepted by service.
     * @param string $id ID of service (optional).
     * @param string $endpoint URL for service requests (optional).
     */
    public function __construct($formats, $actions, $id = null, $endpoint = null)
    {
        $this->formats = $formats;
        $this->actions = $actions;
        $this->id = $id;
        $this->endpoint = $endpoint;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
}
