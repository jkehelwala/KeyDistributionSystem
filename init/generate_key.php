<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/10/2018
 * Time: 9:27 AM
 */

// Todo remove file
include $_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php';

$keys = new class extends Crypts{
    function __construct(){parent::__construct([Capability::DECRYPT_AUTHORIZED_KEY]);}
};
echo $keys->generateKeys();