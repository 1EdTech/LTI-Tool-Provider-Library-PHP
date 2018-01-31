<?php
namespace IMSGlobal\LTI\ToolProvider;

/**
 * Class to represent an outcome.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.2
 * @license Apache-2.0
 */
class Outcome
{

    /** @var string Language value. */
    public $language = null;

    /** @var string Outcome status value. */
    public $status = null;

    /** @var string Outcome date value. */
    public $date = null;

    /** @var string Outcome type value. */
    public $type = null;

    /** @var string Outcome data source value. */
    public $dataSource = null;

    /** @var string Outcome value. */
    private $value = null;

    /**
     * Class constructor.
     *
     * @param string $value Outcome value (optional, default is none).
     */
    public function __construct($value = null)
    {
        $this->value = $value;
        $this->language = 'en-US';
        $this->date = gmdate('Y-m-d\TH:i:s\Z', time());
        $this->type = 'decimal';
    }

    /**
     * Get the outcome value.
     *
     * @return string Outcome value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set the outcome value.
     *
     * @param string $value Outcome value.
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
