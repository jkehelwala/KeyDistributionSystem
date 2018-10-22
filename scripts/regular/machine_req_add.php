<?php
/**
 * @author: NiroshJ
 */

include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
try {
    $user->authorizeView(UserRole::MachineUser);

    $machine_id = NULL;
    if (!$_POST)
        throw new Exception("Required variables not set");
    if (strcmp($_POST['cmbKeyType'], "") == 0)
        throw new Exception("Please select the Key Type");

    if (strcmp($_POST['cmbMachine'], "") == 0)
        throw new Exception("Please select the Machine");

    $keyType = $_POST['cmbKeyType'];
    $machine_id = $_POST["cmbMachine"];

    if($machine_id == NULL || $keyType == NULL)
        throw new Exception("Required variables not set");

    $success = $user->getActions()->addRequest($machine_id, $keyType);
    if ($success != 1)
        throw new Exception("Key Request Failed");
    $message = new AlertMessage(false, "Key Request Successful");
} catch (Exception $e) {
    $message = new AlertMessage(true, $e);
}
$_SESSION['msg'] = $message;
header('location: ' . $user->getDashboardLink());