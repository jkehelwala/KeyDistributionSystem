<?php
/**
 * Created by PhpStorm.
 * User: Janani
 * Date: 10/8/2018
 * Time: 2:59 PM
 */

include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
try{
$user->authorizeView(UserRole::SysAdmin);

$request_id = NULL;
if (!$_GET)
    throw new Exception("Required variables not set");
if (!array_key_exists('id', $_GET))
    throw new Exception("Required variables not set");
if ($_GET['id'])
    $request_id = $_GET['id'];
if ($request_id === NULL)
    throw new Exception("Required variables not set");

$valid_req = $user->getActions()->getAccessibleRequest($request_id);

if (!$_POST)
    throw new Exception("Required variables not set");
if ($_POST['addkey'] != 1)
    throw new Exception("Required variables not set");

$key_data = $_POST['key'];
$maintenance_data = $_POST['note'];

$success = $user->getActions()->addKey($valid_req->id, $key_data, $maintenance_data);
if ($success != 1)
    throw new Exception("Key Adding Unsuccessful");
    $message = new AlertMessage(false, "Key Adding Successful");
}catch (Exception $e){
    $message = new AlertMessage(true, $e);
}
$_SESSION['msg']  = $message;
header('location: ' . $user->getDashboardLink());