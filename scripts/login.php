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
        header('location: /users/' . $user->getPartition() . '/dashboard.php');
    } else {
        throw new Exception("Login failed.");
    }
} catch (Exception $e) {
    echo $e->getMessage(); # Todo Prevent Printing
    echo "Login Error. Please try again.";
}

?>