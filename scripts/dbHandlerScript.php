<?php

$dbServerName = "ble5mmo2o5v9oouq.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$dbUsername = "qnhbmhejmme5tt1t";
$dbPassword = "ypndcftdfh8ib8yt6";
$dbName = "fi3kex7r9j7h9bzs";

$conn = mysqli_connect($dbServerName, $dbUsername, $dbPassword, $dbName );

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
};