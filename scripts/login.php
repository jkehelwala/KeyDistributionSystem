<?php

include('../init/overhead.php');
$uname = $_POST['uname'];
$pass = $_POST['pass'];
$uname = htmlspecialchars($uname);
$pass = htmlspecialchars($pass);

try {
    $result = $user->login($uname, $pass);
    if ($result) {
        $user->initializeUser();
        $_SESSION['user'] = $user;
        header('location: /users/'. $user->getPartition() . '/dashboard.php');
    }
} catch (Exception $e) {
    echo $e->getMessage(); # Todo
    echo "Login Error. Please try again.";
}

?>