<?php
namespace IMSGlobal\LTI\Profile;

/**
 * Class to represent a generic item object.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.0
 * @license Apache-2.0
 */
class Item
{

    /** @var string ID of item. */
    public $id = null;

    /** @var string Name of item. */
    public $name = null;

    /** @var string Description of item. */
    public $description = null;

    /** @var string URL of item. */
    public $url = null;

    /** @var string Version of item. */
    public $version = null;

    /** @var int Timestamp of item. */
    public $timestamp = null;

    /**
     * Class constructor.
     *
     * @param string $id ID of item (optional).
     * @param string $name Name of item (optional).
     * @param string $description Description of item (optional).
     * @param string $url URL of item (optional).
     * @param string $version Version of item (optional).
     * @param int $timestamp Timestamp of item (optional).
     */
    public function __construct($id = null, $name = null, $description = null, $url = null, $version = null, $timestamp = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->version = $version;
        $this->timestamp = $timestamp;
    }
}
