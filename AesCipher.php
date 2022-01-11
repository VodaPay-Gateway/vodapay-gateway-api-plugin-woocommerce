<?php
namespace Vodapay;

class AesCipher {
    const CIPHER = 'AES-256-CBC';
    const INIT_VECTOR_LENGTH = 16;
    
    //Encoded/Decoded data     
    protected $data;
   
    //Initialization vector value     
    protected $initVector;
   
    //Error message if operation failed     
    protected $errorMessage;
   
    //AesCipher constructor    
    public function __construct($initVector, $data = null, $errorMessage = null)
    {
        $this->initVector = $initVector;
        $this->data = $data;
        $this->errorMessage = $errorMessage;
    }   
    

    //Encrypt input text by AES-128-CBC algorithm     
    public static function encrypt($secretKey, $plainText)
    {
        try {
            // Check secret length
            if (!static::isKeyLengthValid($secretKey)) {
                throw new \InvalidArgumentException("Secret key's length must be 128, 192 or 256 bits");
            }

            // Get random initialization vector
            $initVector = bin2hex(openssl_random_pseudo_bytes(static::INIT_VECTOR_LENGTH / 2));
            // Encrypt input text
            $raw = openssl_encrypt(
                $plainText,
                static::CIPHER,
                $secretKey,
                OPENSSL_RAW_DATA,
                $initVector
            );            

            // Return base64-encoded string: initVector + encrypted result
            $result = base64_encode($initVector . $raw);            

            if ($result === false) {
                // Operation failed
                return new static($initVector, null, openssl_error_string());
            }

            // Return successful encoded object            
            $encryptedResult = new static($initVector, $result);        
            
            return $encryptedResult;           

        } catch (\Exception $e) {
            // Operation failed
            return new static(isset($initVector), null, $e->getMessage());
        }
    }
   
    //Check that secret password length is valid     
    public static function isKeyLengthValid($secretKey)
    {
        $length = strlen($secretKey);

        return $length == 16 || $length == 24 || $length == 32;
    }

    //Get encoded data     
    public function getData()
    {
        return $this->data;
    }

    //Get initialization vector value     
    public function getInitVector()
    {
        return $this->initVector;
    }
    
    //Get error message     
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }
    
    //Check that operation failed     
    public function hasError()
    {
        return $this->errorMessage !== null;
    }
    
    //To string return resulting data     
    public function __toString()
    {
        return $this->getData();
    }
}