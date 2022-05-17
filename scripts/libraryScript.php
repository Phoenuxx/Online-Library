<?php

require_once 'dbHandlerScript.php';
require_once 'functions.php';


if(isset($_GET['checkout-book'])) {
    session_start();
    checkoutBook($conn, $_SESSION['ID'], $_GET['checkout-book']);
     header("Location: ../library.php?checkout=success");
}
