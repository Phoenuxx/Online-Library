<?php
require 'dbHandlerScript.php';
require 'functions.php';
if(isset($_POST['signup-submit'])) {


    $username = $_POST['userID'];
    $email = $_POST['userEmail'];
    $password = $_POST['pwd'];
    $password2 = $_POST['pwd2'];
    

   //error catching to ensure 'proper' info input by user
    if (emptySignup($username, $email, $password, $password2) !== false) {
        header("Location: ../signup.php?error=emptyfield");
        exit();
    }
    if (invalidUsername($username) !== false) {
        header("Location: ../signup.php?error=invalidusername");
        exit();
    }
    if (invalidEmail($email) !== false) {
        header("Location: ../signup.php?error=invalidemail");
        exit();
    }
    if (passwordMatch($password, $password2) !== false) {
        header("Location: ../signup.php?error=invalidpassword");
        exit();
    }
    if (usernameExists($conn, $username, $email) !== false) {
        header("Location: ../signup.php?error=usernametaken");
        exit();
    }

    addNewUser($conn, $username, $email, $password);

} else {
    header("Location: ../signup.php");
    exit();
}
           

