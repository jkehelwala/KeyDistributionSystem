<?php

include($_SERVER['DOCUMENT_ROOT'] . '/init/overhead.php');
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$uname = htmlspecialchars($uname);
$pass = htmlspecialchars($pass);

try {
    $result = $user->login($uname, $pass);
    if ($result) {
        $user->initializeUser();
        $_SESSION['user'] = $user;
        header('location: ' . $user->getDashboardLink());
        exit();
    } else {
        throw new Exception("Login failed.");
    }
} catch (Exception $e) {
    $_SESSION['msg'] = new AlertMessage(true, $e);
    header('location: /login.php');
}

?>