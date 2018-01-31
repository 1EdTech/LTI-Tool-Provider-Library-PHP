<?php
namespace IMSGlobal\LTI\ToolProvider;

/**
 * Class to represent a tool consumer resource link share.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.0
 * @license Apache-2.0
 */
class ResourceLinkShare
{

    /** @var string Consumer key value. */
    public $consumerKey = null;

    /** @var string Resource link ID value. */
    public $resourceLinkId = null;

    /** @var string Title of sharing context. */
    public $title = null;

    /** @var bool Whether sharing request is to be automatically approved on first use. */
    public $approved = null;

    /**
     * Class constructor.
     */
    public function __construct()
    {
    }
}
