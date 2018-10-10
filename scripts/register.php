<?php
include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
if (isset($_GET)) {
    $uname = $_GET['uname'];
    $pass = $_GET['pass'];
    $role = $_GET['role'];
}

$uname = htmlspecialchars($uname);
$pass = htmlspecialchars($pass);
$role_int = htmlspecialchars($role);

$user = new User();
try {
    $result = $user->registration($uname, $pass, $role_int);
    if ($result > 0)
        $_SESSION['msg'] = new AlertMessage(false, "Registration Successful.");
} catch (Exception $e) {
    $_SESSION['msg'] = new AlertMessage(true, $e);
}
header('location: /');

?>