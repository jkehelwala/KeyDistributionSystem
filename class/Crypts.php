<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/8/2018
 * Time: 6:16 PM
 */

class Crypts extends Permission
{
    private const CIPHER = "aes-128-gcm";
    private $key;
    private $iv;
    private $tag;

    function __construct($capabilities)
    {
        parent::__construct($capabilities);
        if (!in_array(Crypts::CIPHER, openssl_get_cipher_methods()))
            throw new Exception("Invalid Cipher Suite");
        # Must be set to absolute Path placed outside DOCUMENT_ROOT Todo
        $ini_loc = realpath($_SERVER['DOCUMENT_ROOT']."/init/cred.ini");
        $cred = parse_ini_file($ini_loc);
        $this->key = hex2bin($cred["aes_key"]);
        $this->iv =  hex2bin($cred["iv"]);
    }

    protected function encrypt($plaintext){
        $this->checkPermission(Capability::ENCRYPT_KEY);
        $ciphertext = openssl_encrypt($plaintext, Crypts::CIPHER, $this->key, $options=0, $this->iv, $tag);
        $this->tag = $tag;
        return $ciphertext;
    }

    protected function decrypt($ciphertext){
        $this->checkPermission(Capability::DECRYPT_AUTHORIZED_KEY);
        $plaintext = openssl_decrypt($ciphertext, Crypts::CIPHER,  $this->key, $options=0, $this->iv, hex2bin($this->tag));
        return $plaintext;
    }

    protected function getTag()
    {
        $this->checkPermissions(Capability::DECRYPT_AUTHORIZED_KEY, Capability::ENCRYPT_KEY);
        return $this->tag;
    }

    protected function setTag($tag)
    {
        $this->checkPermission(Capability::ENCRYPT_KEY);
        $this->tag = bin2hex($tag);
    }

//    private function gen_key(){
//        $key = openssl_random_pseudo_bytes ( openssl_cipher_iv_length("aes-128-gcm"), $strong );
//        return bin2hex($key);
//    }

}