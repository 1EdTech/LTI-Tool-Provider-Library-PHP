<?php
namespace IMSGlobal\LTI\ToolProvider;

/**
 * Class to represent a content-item image object.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.2
 * @license Apache-2.0
 */
class ContentItemImage
{

    /**
     * Class constructor.
     *
     * @param string $id URL of image.
     * @param int $height Height of image in pixels (optional).
     * @param int $width Width of image in pixels (optional).
     */
    public function __construct($id, $height = null, $width = null)
    {
        $this->{'@id'} = $id;
        
        if (!is_null($height)) {
            $this->height = $height;
        }
        
        if (!is_null($width)) {
            $this->width = $width;
        }
    }
}
