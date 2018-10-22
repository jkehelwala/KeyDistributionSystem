<?php
include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
if (isset($_POST)) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];
}

$uname = htmlspecialchars($uname);
$pass = htmlspecialchars($pass);
$role_int = htmlspecialchars($role);
echo $uname;
echo $pass;
echo $role_int;
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