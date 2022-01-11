<?php

class TraderootCrypto{

    public static function encrypt($data,$key,$iv){
        $cipher = 'AES-256-CBC';
        $options = OPENSSL_RAW_DATA|OPENSSL_ZERO_PADDING;
        $raw = openssl_encrypt(
            $data,
            $cipher,
            $key,
            $options,
            $iv
        );
        return $raw;
    }

    public static function pkcs5_pad($text, $blocksize){
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    public static function process($data, $secretKey){
        $hashedData = hash("sha256", $data, true);
        //$secretKey  = "0000000000000000000000000000000000000000000000000000000000000000";
        $ivStr      = "00000000000000000000000000000000";

        $key        = pack('H*', $secretKey);
        $iv         = pack('H*', $ivStr);
        $inputData  = pkcs5_pad($hashedData, 16);

        return encrypt($inputData, $key, $iv);
    }

}




//showB64('key', $key);
//showB64('iv', $iv);
//showB64('hashedData', $hashedData);
//showB64('inputData', $inputData);
//showB64('checksum', $checksum);
//

  
//function showB64($label, $rawData) {
//  echo "{$label} :".base64_encode($rawData)."\n";
//}

/* Sample output :
key :AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA=
iv :AAAAAAAAAAAAAAAAAAAAAA==
hashedData :ZAgNCUfIbdT9EjdkCb3XDNpMFGV34rXNjcTOQ9cdZ3w=
inputData :ZAgNCUfIbdT9EjdkCb3XDNpMFGV34rXNjcTOQ9cdZ3wQEBAQEBAQEBAQEBAQEBAQ
checksum :9NS/ZKMscpa4V7i2YQQPoycxCwbL1BlK3h9O/1ujoD1iYgjE8tZx+JRGflw5WikH
*/