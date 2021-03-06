<?php
/**
 * PaymentTokenListItemDataModel
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
 * PaymentTokenListItemDataModel Class Doc Comment
 *
 * @category Class
 * @package  VodaPayGatewayClient
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 * @implements \ArrayAccess<TKey, TValue>
 * @template TKey int|null
 * @template TValue mixed|null
 */
class PaymentTokenListItemDataModel implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $openAPIModelName = 'PaymentTokenListItemDataModel';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $openAPITypes = [
        'payment_instrument_category_code' => 'string',
        'issue_date' => 'string',
        'payment_token' => 'string',
        'payment_instrument_name' => 'string',
        'payment_token_expiry_date_time' => 'string',
        'payment_token_status' => 'string',
        'truncated_payment_instrument' => 'string',
        'payment_instrument_association_name' => 'string',
        'payment_instrument_type' => 'string',
        'payment_instrument_message_sequence' => 'string',
        'default_payment_instrument' => 'bool',
        'payment_instrument_expiry_date' => 'string',
        'additional_payment_token_information' => 'string'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      * @phpstan-var array<string, string|null>
      * @psalm-var array<string, string|null>
      */
    protected static $openAPIFormats = [
        'payment_instrument_category_code' => null,
        'issue_date' => null,
        'payment_token' => null,
        'payment_instrument_name' => null,
        'payment_token_expiry_date_time' => null,
        'payment_token_status' => null,
        'truncated_payment_instrument' => null,
        'payment_instrument_association_name' => null,
        'payment_instrument_type' => null,
        'payment_instrument_message_sequence' => null,
        'default_payment_instrument' => null,
        'payment_instrument_expiry_date' => null,
        'additional_payment_token_information' => null
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
        'payment_instrument_category_code' => 'paymentInstrumentCategoryCode',
        'issue_date' => 'issueDate',
        'payment_token' => 'paymentToken',
        'payment_instrument_name' => 'paymentInstrumentName',
        'payment_token_expiry_date_time' => 'paymentTokenExpiryDateTime',
        'payment_token_status' => 'paymentTokenStatus',
        'truncated_payment_instrument' => 'truncatedPaymentInstrument',
        'payment_instrument_association_name' => 'paymentInstrumentAssociationName',
        'payment_instrument_type' => 'paymentInstrumentType',
        'payment_instrument_message_sequence' => 'paymentInstrumentMessageSequence',
        'default_payment_instrument' => 'defaultPaymentInstrument',
        'payment_instrument_expiry_date' => 'paymentInstrumentExpiryDate',
        'additional_payment_token_information' => 'additionalPaymentTokenInformation'
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'payment_instrument_category_code' => 'setPaymentInstrumentCategoryCode',
        'issue_date' => 'setIssueDate',
        'payment_token' => 'setPaymentToken',
        'payment_instrument_name' => 'setPaymentInstrumentName',
        'payment_token_expiry_date_time' => 'setPaymentTokenExpiryDateTime',
        'payment_token_status' => 'setPaymentTokenStatus',
        'truncated_payment_instrument' => 'setTruncatedPaymentInstrument',
        'payment_instrument_association_name' => 'setPaymentInstrumentAssociationName',
        'payment_instrument_type' => 'setPaymentInstrumentType',
        'payment_instrument_message_sequence' => 'setPaymentInstrumentMessageSequence',
        'default_payment_instrument' => 'setDefaultPaymentInstrument',
        'payment_instrument_expiry_date' => 'setPaymentInstrumentExpiryDate',
        'additional_payment_token_information' => 'setAdditionalPaymentTokenInformation'
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'payment_instrument_category_code' => 'getPaymentInstrumentCategoryCode',
        'issue_date' => 'getIssueDate',
        'payment_token' => 'getPaymentToken',
        'payment_instrument_name' => 'getPaymentInstrumentName',
        'payment_token_expiry_date_time' => 'getPaymentTokenExpiryDateTime',
        'payment_token_status' => 'getPaymentTokenStatus',
        'truncated_payment_instrument' => 'getTruncatedPaymentInstrument',
        'payment_instrument_association_name' => 'getPaymentInstrumentAssociationName',
        'payment_instrument_type' => 'getPaymentInstrumentType',
        'payment_instrument_message_sequence' => 'getPaymentInstrumentMessageSequence',
        'default_payment_instrument' => 'getDefaultPaymentInstrument',
        'payment_instrument_expiry_date' => 'getPaymentInstrumentExpiryDate',
        'additional_payment_token_information' => 'getAdditionalPaymentTokenInformation'
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
        $this->container['payment_instrument_category_code'] = $data['payment_instrument_category_code'] ?? null;
        $this->container['issue_date'] = $data['issue_date'] ?? null;
        $this->container['payment_token'] = $data['payment_token'] ?? null;
        $this->container['payment_instrument_name'] = $data['payment_instrument_name'] ?? null;
        $this->container['payment_token_expiry_date_time'] = $data['payment_token_expiry_date_time'] ?? null;
        $this->container['payment_token_status'] = $data['payment_token_status'] ?? null;
        $this->container['truncated_payment_instrument'] = $data['truncated_payment_instrument'] ?? null;
        $this->container['payment_instrument_association_name'] = $data['payment_instrument_association_name'] ?? null;
        $this->container['payment_instrument_type'] = $data['payment_instrument_type'] ?? null;
        $this->container['payment_instrument_message_sequence'] = $data['payment_instrument_message_sequence'] ?? null;
        $this->container['default_payment_instrument'] = $data['default_payment_instrument'] ?? null;
        $this->container['payment_instrument_expiry_date'] = $data['payment_instrument_expiry_date'] ?? null;
        $this->container['additional_payment_token_information'] = $data['additional_payment_token_information'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['default_payment_instrument'] === null) {
            $invalidProperties[] = "'default_payment_instrument' can't be null";
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
     * Gets payment_instrument_category_code
     *
     * @return string|null
     */
    public function getPaymentInstrumentCategoryCode()
    {
        return $this->container['payment_instrument_category_code'];
    }

    /**
     * Sets payment_instrument_category_code
     *
     * @param string|null $payment_instrument_category_code payment_instrument_category_code
     *
     * @return self
     */
    public function setPaymentInstrumentCategoryCode($payment_instrument_category_code)
    {
        $this->container['payment_instrument_category_code'] = $payment_instrument_category_code;

        return $this;
    }

    /**
     * Gets issue_date
     *
     * @return string|null
     */
    public function getIssueDate()
    {
        return $this->container['issue_date'];
    }

    /**
     * Sets issue_date
     *
     * @param string|null $issue_date issue_date
     *
     * @return self
     */
    public function setIssueDate($issue_date)
    {
        $this->container['issue_date'] = $issue_date;

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
     * Gets payment_instrument_name
     *
     * @return string|null
     */
    public function getPaymentInstrumentName()
    {
        return $this->container['payment_instrument_name'];
    }

    /**
     * Sets payment_instrument_name
     *
     * @param string|null $payment_instrument_name payment_instrument_name
     *
     * @return self
     */
    public function setPaymentInstrumentName($payment_instrument_name)
    {
        $this->container['payment_instrument_name'] = $payment_instrument_name;

        return $this;
    }

    /**
     * Gets payment_token_expiry_date_time
     *
     * @return string|null
     */
    public function getPaymentTokenExpiryDateTime()
    {
        return $this->container['payment_token_expiry_date_time'];
    }

    /**
     * Sets payment_token_expiry_date_time
     *
     * @param string|null $payment_token_expiry_date_time payment_token_expiry_date_time
     *
     * @return self
     */
    public function setPaymentTokenExpiryDateTime($payment_token_expiry_date_time)
    {
        $this->container['payment_token_expiry_date_time'] = $payment_token_expiry_date_time;

        return $this;
    }

    /**
     * Gets payment_token_status
     *
     * @return string|null
     */
    public function getPaymentTokenStatus()
    {
        return $this->container['payment_token_status'];
    }

    /**
     * Sets payment_token_status
     *
     * @param string|null $payment_token_status payment_token_status
     *
     * @return self
     */
    public function setPaymentTokenStatus($payment_token_status)
    {
        $this->container['payment_token_status'] = $payment_token_status;

        return $this;
    }

    /**
     * Gets truncated_payment_instrument
     *
     * @return string|null
     */
    public function getTruncatedPaymentInstrument()
    {
        return $this->container['truncated_payment_instrument'];
    }

    /**
     * Sets truncated_payment_instrument
     *
     * @param string|null $truncated_payment_instrument truncated_payment_instrument
     *
     * @return self
     */
    public function setTruncatedPaymentInstrument($truncated_payment_instrument)
    {
        $this->container['truncated_payment_instrument'] = $truncated_payment_instrument;

        return $this;
    }

    /**
     * Gets payment_instrument_association_name
     *
     * @return string|null
     */
    public function getPaymentInstrumentAssociationName()
    {
        return $this->container['payment_instrument_association_name'];
    }

    /**
     * Sets payment_instrument_association_name
     *
     * @param string|null $payment_instrument_association_name payment_instrument_association_name
     *
     * @return self
     */
    public function setPaymentInstrumentAssociationName($payment_instrument_association_name)
    {
        $this->container['payment_instrument_association_name'] = $payment_instrument_association_name;

        return $this;
    }

    /**
     * Gets payment_instrument_type
     *
     * @return string|null
     */
    public function getPaymentInstrumentType()
    {
        return $this->container['payment_instrument_type'];
    }

    /**
     * Sets payment_instrument_type
     *
     * @param string|null $payment_instrument_type payment_instrument_type
     *
     * @return self
     */
    public function setPaymentInstrumentType($payment_instrument_type)
    {
        $this->container['payment_instrument_type'] = $payment_instrument_type;

        return $this;
    }

    /**
     * Gets payment_instrument_message_sequence
     *
     * @return string|null
     */
    public function getPaymentInstrumentMessageSequence()
    {
        return $this->container['payment_instrument_message_sequence'];
    }

    /**
     * Sets payment_instrument_message_sequence
     *
     * @param string|null $payment_instrument_message_sequence payment_instrument_message_sequence
     *
     * @return self
     */
    public function setPaymentInstrumentMessageSequence($payment_instrument_message_sequence)
    {
        $this->container['payment_instrument_message_sequence'] = $payment_instrument_message_sequence;

        return $this;
    }

    /**
     * Gets default_payment_instrument
     *
     * @return bool
     */
    public function getDefaultPaymentInstrument()
    {
        return $this->container['default_payment_instrument'];
    }

    /**
     * Sets default_payment_instrument
     *
     * @param bool $default_payment_instrument default_payment_instrument
     *
     * @return self
     */
    public function setDefaultPaymentInstrument($default_payment_instrument)
    {
        $this->container['default_payment_instrument'] = $default_payment_instrument;

        return $this;
    }

    /**
     * Gets payment_instrument_expiry_date
     *
     * @return string|null
     */
    public function getPaymentInstrumentExpiryDate()
    {
        return $this->container['payment_instrument_expiry_date'];
    }

    /**
     * Sets payment_instrument_expiry_date
     *
     * @param string|null $payment_instrument_expiry_date payment_instrument_expiry_date
     *
     * @return self
     */
    public function setPaymentInstrumentExpiryDate($payment_instrument_expiry_date)
    {
        $this->container['payment_instrument_expiry_date'] = $payment_instrument_expiry_date;

        return $this;
    }

    /**
     * Gets additional_payment_token_information
     *
     * @return string|null
     */
    public function getAdditionalPaymentTokenInformation()
    {
        return $this->container['additional_payment_token_information'];
    }

    /**
     * Sets additional_payment_token_information
     *
     * @param string|null $additional_payment_token_information additional_payment_token_information
     *
     * @return self
     */
    public function setAdditionalPaymentTokenInformation($additional_payment_token_information)
    {
        $this->container['additional_payment_token_information'] = $additional_payment_token_information;

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


