<?php

namespace IMSGlobal\LTI\ToolProvider;

/**
 * Class to represent an outcome
 *
 * @author  Stephen P Vickers <svickers@imsglobal.org>
 * @copyright  IMS Global Learning Consortium Inc
 * @date  2016
 * @version 3.0.2
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class Outcome
{

/**
 * Language value.
 *
 * @var string $language
 */
    public $language = null;
/**
 * Outcome status value.
 *
 * @var string $status
 */
    public $status = null;
/**
 * Outcome date value.
 *
 * @var string $date
 */
    public $date = null;
/**
 * Outcome type value.
 *
 * @var string $type
 */
    public $type = null;
/**
 * Outcome data source value.
 *
 * @var string $dataSource
 */
    public $dataSource = null;

/**
 * Outcome value.
 *
 * @var string $value
 */
    private $value = null;
    private $text = null;
    private $url = null;

/**
 * Class constructor.
 *
 * @param string $value     Outcome score value (optional, default is none)
 * @param string $text Outcome text value (optional, default is none)
 * @param string $url Outcome url value (optional, default is none)
 */
    public function __construct($value = null, $text=null, $url=null)
    {

        $this->value = $value;
        $this->text = $text;
        $this->url = $url;
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
 * @param string $value  Outcome value
 */
    public function setValue($value)
    {

        $this->value = $value;

    }

	/**
	 * Get the outcome text.
	 *
	 * @return string Outcome text
	 */
	public function getText()
	{
	
		return $this->text;
	
	}
	
	/**
	 * Set the outcome text.
	 *
	 * @param string $text  Outcome text
	 */
	public function setText($text)
	{
	
		$this->text = $text;
	
	}
	
	/**
	 * Get the outcome url.
	 *
	 * @return string Outcome url
	 */
	public function getUrl()
	{
	
		return $this->url;
	
	}
	
	/**
	 * Set the outcome url.
	 *
	 * @param string $url  Outcome url
	 */
	public function setUrl($url)
	{
	
		$this->url = $url;
	
	}

}