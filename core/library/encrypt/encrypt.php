<?php 
    namespace encrypt;

    class AES {
        private $hash_iv;
        private $hash_key;
        private $method;

        public function __construct(?string $hash_iv=null, ?string $hash_key=null){
            $this->hash_iv = \base64_decode($hash_iv);
            $this->hash_key = $hash_key;   // key's length required 32.
            $this->method = "AES-256-CBC";
        }

        public function Encrypt(string $str):string{
            $encrypted = \base64_encode(\openssl_encrypt($str, $this->method, $this->hash_key, OPENSSL_RAW_DATA, $this->hash_iv));
            return $encrypted;
        }

        public function Decrypt(string $str):string{
            $encrypted = \base64_decode($str);
            $decryptedData = \openssl_decrypt($encrypted, $this->method, $this->hash_key, OPENSSL_RAW_DATA, $this->hash_iv);
            return $decryptedData;
        }

        public function GenerateKey():string{
            $hashKey = \base64_encode(\openssl_random_pseudo_bytes(32));
            return $hashKey;
        }

        public function GenerateIV():string{
            $hashIV = \openssl_random_pseudo_bytes(\openssl_cipher_iv_length($this->method));
            return \base64_encode($hashIV);
        }
    }