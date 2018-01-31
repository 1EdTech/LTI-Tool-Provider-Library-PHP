<?php
namespace IMSGlobal\LTI\ToolProvider;

/**
 * Class to represent a tool consumer nonce.
 *
 * @author Stephen P Vickers <svickers@imsglobal.org>
 * @copyright 2016 IMS Global Learning Consortium Inc
 * @version 3.0.2
 * @license Apache-2.0
 */
class ConsumerNonce
{
    
    /** @var int Maximum age nonce values will be retained for (in minutes). */
    const MAX_NONCE_AGE = 30;

    /** @var int Date/time when the nonce value expires. */
    public $expires = null;

    /** @var ToolConsumer Tool Consumer to which this nonce applies. */
    private $consumer = null;

    /** @var string Nonce value. */
    private $value = null;

    /**
     * Class constructor.
     *
     * @param ToolConsumer $consumer Consumer object.
     * @param string|null $value Nonce value (optional, default is NULL).
     */
    public function __construct($consumer, $value = null)
    {
        $this->consumer = $consumer;
        $this->value = $value;
        $this->expires = time() + (self::MAX_NONCE_AGE * 60);
    }

    /**
     * Load a nonce value from the database.
     *
     * @return bool TRUE if the nonce value was successfully loaded
     */
    public function load()
    {
        return $this->consumer->getDataConnector()->loadConsumerNonce($this);
    }

    /**
     * Save a nonce value in the database.
     *
     * @return bool TRUE if the nonce value was successfully saved
     */
    public function save()
    {
        return $this->consumer->getDataConnector()->saveConsumerNonce($this);
    }

    /**
     * Get tool consumer.
     *
     * @return ToolConsumer Consumer for this nonce
     */
    public function getConsumer()
    {
        return $this->consumer;
    }

    /**
     * Get outcome value.
     *
     * @return string Outcome value
     */
    public function getValue()
    {
        return $this->value;
    }
}
