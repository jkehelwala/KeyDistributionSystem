<?php
include('../init/overhead.php');
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
        echo "Registration Successful.";
} catch (Exception $e) {
    echo $e->getMessage();
    echo "Registration Error. Please try again.";
}

?>