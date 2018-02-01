<?php
namespace IMSGlobal\LTI\Profile;

/**
 * Class to represent a resource handler object.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.0
 * @license Apache-2.0
 */
class ResourceHandler
{

    /** @var Item General details of resource handler. */
    public $item = null;

    /** @var string URL of icon. */
    public $icon = null;

    /** @var array Required Message objects for resource handler. */
    public $requiredMessages = null;

    /** @var array Optional Message objects for resource handler. */
    public $optionalMessages = null;

    /**
     * Class constructor.
     *
     * @param Item $item General details of resource handler.
     * @param string $icon URL of icon.
     * @param array $requiredMessages Array of required Message objects for resource handler.
     * @param array $optionalMessages Array of optional Message objects for resource handler.
     */
    public function __construct($item, $icon, $requiredMessages, $optionalMessages)
    {
        $this->item = $item;
        $this->icon = $icon;
        $this->requiredMessages = $requiredMessages;
        $this->optionalMessages = $optionalMessages;
    }
}
