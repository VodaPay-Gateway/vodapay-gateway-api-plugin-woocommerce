<?php
/**
 * ErrorVodaPayGatewaySubmitRecurringResponse
 *
 * PHP version 7.3
 *
 * @category Class
 * @package  VodaPayGatewayClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * VodaPay Gateway
 *
 * Enabling ecommerce merchants to accept online payments from customers.
 *
 * The version of the OpenAPI document: v2.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.3.1
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace VodaPayGatewayClient\Model;

use \ArrayAccess;
use \VodaPayGatewayClient\ObjectSerializer;

/**
 * ErrorVodaPayGatewaySubmitRecurringResponse Class Doc Comment
 *
 * @category Class
 * @package  VodaPayGatewayClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ErrorVodaPayGatewaySubmitRecurringResponse implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'ErrorVodaPayGatewaySubmitRecurringResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'response_code' => 'string',
        'response_message' => 'string',
        'was_successful' => 'bool',
        'transmission_date_time' => '\DateTime',
        'payment_token' => 'string',
        'transaction_id' => 'string',
        'echo_data' => 'string',
        'trace_id' => 'string',
        'session_id' => 'string',
        'merchant_id' => 'string',
        'initiation_url' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'response_code' => null,
        'response_message' => null,
        'was_successful' => null,
        'transmission_date_time' => 'date-time',
        'payment_token' => null,
        'transaction_id' => null,
        'echo_data' => null,
        'trace_id' => null,
        'session_id' => null,
        'merchant_id' => null,
        'initiation_url' => null
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'response_code' => 'responseCode',
        'response_message' => 'responseMessage',
        'was_successful' => 'wasSuccessful',
        'transmission_date_time' => 'transmissionDateTime',
        'payment_token' => 'paymentToken',
        'transaction_id' => 'transactionId',
        'echo_data' => 'echoData',
        'trace_id' => 'traceId',
        'session_id' => 'sessionId',
        'merchant_id' => 'merchantId',
        'initiation_url' => 'initiationUrl'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'response_code' => 'setResponseCode',
        'response_message' => 'setResponseMessage',
        'was_successful' => 'setWasSuccessful',
        'transmission_date_time' => 'setTransmissionDateTime',
        'payment_token' => 'setPaymentToken',
        'transaction_id' => 'setTransactionId',
        'echo_data' => 'setEchoData',
        'trace_id' => 'setTraceId',
        'session_id' => 'setSessionId',
        'merchant_id' => 'setMerchantId',
        'initiation_url' => 'setInitiationUrl'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'response_code' => 'getResponseCode',
        'response_message' => 'getResponseMessage',
        'was_successful' => 'getWasSuccessful',
        'transmission_date_time' => 'getTransmissionDateTime',
        'payment_token' => 'getPaymentToken',
        'transaction_id' => 'getTransactionId',
        'echo_data' => 'getEchoData',
        'trace_id' => 'getTraceId',
        'session_id' => 'getSessionId',
        'merchant_id' => 'getMerchantId',
        'initiation_url' => 'getInitiationUrl'
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }


    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['response_code'] = $data['response_code'] ?? null;
        $this->container['response_message'] = $data['response_message'] ?? null;
        $this->container['was_successful'] = $data['was_successful'] ?? false;
        $this->container['transmission_date_time'] = $data['transmission_date_time'] ?? null;
        $this->container['payment_token'] = $data['payment_token'] ?? null;
        $this->container['transaction_id'] = $data['transaction_id'] ?? null;
        $this->container['echo_data'] = $data['echo_data'] ?? null;
        $this->container['trace_id'] = $data['trace_id'] ?? null;
        $this->container['session_id'] = $data['session_id'] ?? null;
        $this->container['merchant_id'] = $data['merchant_id'] ?? null;
        $this->container['initiation_url'] = $data['initiation_url'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['was_successful'] === null) {
            $invalidProperties[] = "'was_successful' can't be null";
        }
        if ($this->container['transmission_date_time'] === null) {
            $invalidProperties[] = "'transmission_date_time' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets response_code
     *
     * @return string|null
     */
    public function getResponseCode()
    {
        return $this->container['response_code'];
    }

    /**
     * Sets response_code
     *
     * @param string|null $response_code response_code
     *
     * @return self
     */
    public function setResponseCode($response_code)
    {
        $this->container['response_code'] = $response_code;

        return $this;
    }

    /**
     * Gets response_message
     *
     * @return string|null
     */
    public function getResponseMessage()
    {
        return $this->container['response_message'];
    }

    /**
     * Sets response_message
     *
     * @param string|null $response_message response_message
     *
     * @return self
     */
    public function setResponseMessage($response_message)
    {
        $this->container['response_message'] = $response_message;

        return $this;
    }

    /**
     * Gets was_successful
     *
     * @return bool
     */
    public function getWasSuccessful()
    {
        return $this->container['was_successful'];
    }

    /**
     * Sets was_successful
     *
     * @param bool $was_successful was_successful
     *
     * @return self
     */
    public function setWasSuccessful($was_successful)
    {
        $this->container['was_successful'] = $was_successful;

        return $this;
    }

    /**
     * Gets transmission_date_time
     *
     * @return \DateTime
     */
    public function getTransmissionDateTime()
    {
        return $this->container['transmission_date_time'];
    }

    /**
     * Sets transmission_date_time
     *
     * @param \DateTime $transmission_date_time transmission_date_time
     *
     * @return self
     */
    public function setTransmissionDateTime($transmission_date_time)
    {
        $this->container['transmission_date_time'] = $transmission_date_time;

        return $this;
    }

    /**
     * Gets payment_token
     *
     * @return string|null
     */
    public function getPaymentToken()
    {
        return $this->container['payment_token'];
    }

    /**
     * Sets payment_token
     *
     * @param string|null $payment_token payment_token
     *
     * @return self
     */
    public function setPaymentToken($payment_token)
    {
        $this->container['payment_token'] = $payment_token;

        return $this;
    }

    /**
     * Gets transaction_id
     *
     * @return string|null
     */
    public function getTransactionId()
    {
        return $this->container['transaction_id'];
    }

    /**
     * Sets transaction_id
     *
     * @param string|null $transaction_id transaction_id
     *
     * @return self
     */
    public function setTransactionId($transaction_id)
    {
        $this->container['transaction_id'] = $transaction_id;

        return $this;
    }

    /**
     * Gets echo_data
     *
     * @return string|null
     */
    public function getEchoData()
    {
        return $this->container['echo_data'];
    }

    /**
     * Sets echo_data
     *
     * @param string|null $echo_data echo_data
     *
     * @return self
     */
    public function setEchoData($echo_data)
    {
        $this->container['echo_data'] = $echo_data;

        return $this;
    }

    /**
     * Gets trace_id
     *
     * @return string|null
     */
    public function getTraceId()
    {
        return $this->container['trace_id'];
    }

    /**
     * Sets trace_id
     *
     * @param string|null $trace_id trace_id
     *
     * @return self
     */
    public function setTraceId($trace_id)
    {
        $this->container['trace_id'] = $trace_id;

        return $this;
    }

    /**
     * Gets session_id
     *
     * @return string|null
     */
    public function getSessionId()
    {
        return $this->container['session_id'];
    }

    /**
     * Sets session_id
     *
     * @param string|null $session_id session_id
     *
     * @return self
     */
    public function setSessionId($session_id)
    {
        $this->container['session_id'] = $session_id;

        return $this;
    }

    /**
     * Gets merchant_id
     *
     * @return string|null
     */
    public function getMerchantId()
    {
        return $this->container['merchant_id'];
    }

    /**
     * Sets merchant_id
     *
     * @param string|null $merchant_id merchant_id
     *
     * @return self
     */
    public function setMerchantId($merchant_id)
    {
        $this->container['merchant_id'] = $merchant_id;

        return $this;
    }

    /**
     * Gets initiation_url
     *
     * @return string|null
     */
    public function getInitiationUrl()
    {
        return $this->container['initiation_url'];
    }

    /**
     * Sets initiation_url
     *
     * @param string|null $initiation_url initiation_url
     *
     * @return self
     */
    public function setInitiationUrl($initiation_url)
    {
        $this->container['initiation_url'] = $initiation_url;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     * of any type other than a resource.
     */
    public function jsonSerialize()
    {
       return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}


