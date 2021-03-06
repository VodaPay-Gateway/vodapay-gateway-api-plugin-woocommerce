<?php
/**
 * PaymentBaseResponseModelAllOf
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
 * PaymentBaseResponseModelAllOf Class Doc Comment
 *
 * @category Class
 * @package  VodaPayGatewayClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class PaymentBaseResponseModelAllOf implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PaymentBaseResponseModel_allOf';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'transmission_date_time' => '\DateTime',
        'session_id' => 'string',
        'transaction_id' => 'string',
        'initiation_url' => 'string',
        'retrieval_reference_number_extended' => 'string',
        'echo_data' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'transmission_date_time' => 'date-time',
        'session_id' => null,
        'transaction_id' => null,
        'initiation_url' => null,
        'retrieval_reference_number_extended' => null,
        'echo_data' => null
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
        'transmission_date_time' => 'transmissionDateTime',
        'session_id' => 'sessionId',
        'transaction_id' => 'transactionId',
        'initiation_url' => 'initiationUrl',
        'retrieval_reference_number_extended' => 'retrievalReferenceNumberExtended',
        'echo_data' => 'echoData'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'transmission_date_time' => 'setTransmissionDateTime',
        'session_id' => 'setSessionId',
        'transaction_id' => 'setTransactionId',
        'initiation_url' => 'setInitiationUrl',
        'retrieval_reference_number_extended' => 'setRetrievalReferenceNumberExtended',
        'echo_data' => 'setEchoData'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'transmission_date_time' => 'getTransmissionDateTime',
        'session_id' => 'getSessionId',
        'transaction_id' => 'getTransactionId',
        'initiation_url' => 'getInitiationUrl',
        'retrieval_reference_number_extended' => 'getRetrievalReferenceNumberExtended',
        'echo_data' => 'getEchoData'
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
        $this->container['transmission_date_time'] = $data['transmission_date_time'] ?? null;
        $this->container['session_id'] = $data['session_id'] ?? null;
        $this->container['transaction_id'] = $data['transaction_id'] ?? null;
        $this->container['initiation_url'] = $data['initiation_url'] ?? null;
        $this->container['retrieval_reference_number_extended'] = $data['retrieval_reference_number_extended'] ?? null;
        $this->container['echo_data'] = $data['echo_data'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * Gets retrieval_reference_number_extended
     *
     * @return string|null
     */
    public function getRetrievalReferenceNumberExtended()
    {
        return $this->container['retrieval_reference_number_extended'];
    }

    /**
     * Sets retrieval_reference_number_extended
     *
     * @param string|null $retrieval_reference_number_extended retrieval_reference_number_extended
     *
     * @return self
     */
    public function setRetrievalReferenceNumberExtended($retrieval_reference_number_extended)
    {
        $this->container['retrieval_reference_number_extended'] = $retrieval_reference_number_extended;

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


