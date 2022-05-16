<?php
if(isset($_POST["login-submit"])) {
    require_once 'dbHandlerScript.php';
    require_once 'functions.php';
    $username = $_POST['mailuid'];
    $password = $_POST['pwd'];


    if (emptyLogin($username, $password) !== false) {
        header("Location: ../index.php?error=emptyfield");
        exit();
    }

    loginUser($conn, $username, $password);

} else {
    header("Location: ../index.php");
    exit();
}