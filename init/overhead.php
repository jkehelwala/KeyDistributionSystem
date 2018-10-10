<?php

$path = $_SERVER['DOCUMENT_ROOT'];
foreach (glob($path . "/class/*.php") as $filename) {
    $class = basename($filename, '.php');
    spl_autoload_register(function ($class) {
        include $_SERVER['DOCUMENT_ROOT'] . '/class/' . $class . '.php';
    });
}
session_start();

if ($_GET) {
    if (array_key_exists('logout', $_GET)) {
        if ($_GET['logout']) {
            session_unset();
            session_destroy();
            header('location: /index.php');
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
    if (!$logged)
        header('location: /index.php?logout=1');
}
?>