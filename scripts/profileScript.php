<?php

require 'dbHandlerScript.php';
require 'functions.php';

if(!isset($_SESSION['userName'])) { header("Location: index.php"); }
$username = $_SESSION['userName'];

if($username == "Admin") header("Location: admin.php");

fetchLibrary($conn, $_SESSION['ID']);

if(isset($_POST['return-book'])) {
    echo test;
    //returnBook($conn, $_SESSION['ID']);
}