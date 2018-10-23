<?php
/**
 * Created by NiroshJ.
 */

include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
try {
    $user->authorizeView(UserRole::Administrator);

    // start getting the required variables
    $request_id = NULL;
    if (!$_GET)
        throw new Exception("Required variables not set");
    if (!array_key_exists('id', $_GET))
        throw new Exception("Required variables not set");
    if ($_GET['id'])
        $request_id = $_GET['id'];
    if ($request_id === NULL)
        throw new Exception("Required variables not set");
    
    if(!$_POST)
        throw new Exception("Required variables not set");
    
    if (!array_key_exists('status', $_POST))
        throw new Exception("Required variables not set");
    
    $status = $_POST["status"];
    
    // end getting the required variables

    // changing the status of request made by regular user
    $success = $user->getActions()->changeKeyStatus($request_id, $status);
    if ($success != 1)
        throw new Exception("Action Unsuccessful");
    $message = new AlertMessage(false, "Action Successful");
} catch (Exception $e) {
    $message = new AlertMessage(true, $e);
}
$_SESSION['msg'] = $message;
header('location: ' . $user->getDashboardLink());