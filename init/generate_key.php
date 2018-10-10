<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/10/2018
 * Time: 9:27 AM
 */

include $_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php';
$user->authorizeView("MASTER_ADMIN"); // Inaccessible without access to source code
$keys = new class extends Crypts
{
    function __construct()
    {
        parent::__construct([Capability::DECRYPT_AUTHORIZED_KEY]);
    }
};
echo $keys->generateKeys();