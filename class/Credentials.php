<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/10/2018
 * Time: 9:02 AM
 */

final class Credentials extends Permission
{
    private static $instance = null;
    private $credential_array;

    const HOST = "host";
    const DB_NAME =  "db";
    const AES_KEY = "aes_key";
    const INITIALIZATION_VECTOR = "iv";
    const ROLE_MIN_PRIV = "root"; // Todo

    private function __construct(){
        parent::__construct([]);
        // Todo Must be set to absolute Path placed outside DOCUMENT_ROOT
        $ini_loc =  realpath($_SERVER['DOCUMENT_ROOT']."/init/cred.ini");
        $this->credential_array = parse_ini_file($ini_loc);
    }

    private function setCapabilities($capabilities){
        $this->capabilities = $capabilities;
    }

    public static function Instance($capabilities)
    {
        if(Credentials::$instance === null){
            Credentials::$instance = new self();
        }
        Credentials::$instance->setCapabilities($capabilities);
        return Credentials::$instance;
    }

    public function get($key){
        if ($key == Credentials::AES_KEY || $key == Credentials::INITIALIZATION_VECTOR)
            $this->checkPermissions(Capability::ENCRYPT_KEY, Capability::DECRYPT_AUTHORIZED_KEY);
        return $this->credential_array[$key];
    }

}