<?php

$path = $_SERVER['DOCUMENT_ROOT'];
foreach (glob($path . "/class/*.php") as $filename) {
    $class = basename($filename, '.php');
    spl_autoload_register(function ($class) {
        include $_SERVER['DOCUMENT_ROOT'] . '/class/' . $class . '.php';
    });
}
session_start();
$message = null;
if ($_SESSION && isset($_SESSION['msg'])) {
    $message = $_SESSION['msg'];
}

if ($_GET) {
    if (array_key_exists('logout', $_GET)) {
        if ($_GET['logout']) {
            session_unset();
            session_destroy();
            session_start();
            $_SESSION['msg'] = $message;
            header('location: /index.php');
            exit();
        }
    }
}

$logged = false;
$user = new User();
if ($_SESSION) {
    if (isset($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $logged = $user->loggedIn;
    }
    unset($_SESSION['msg']);
}
//    if (!$logged)
//        header('location: /index.php?logout=1');
?>