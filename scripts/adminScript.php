<?php
require_once 'dbHandlerScript.php';
require_once 'functions.php';

if(!isset($_SESSION['userName'])) { header("Location: index.php"); }
// else {
//     header("Location: ../index.php");
// }

if(isset($_POST['new-book-submit'])) {

    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $genre2 = $_POST['genre2'];
    $pages = $_POST['pages'];
    
    //error catching to ensure 'proper' info input by user
    if (emptyBook($title, $author, $genre, $pages) !== false) {
        echo 'test';
        header("Location: ../admin.php?addbookerror=emptyfield");
        exit();
    }

    addNewBook($conn, $title, $author, $genre, $genre2, $pages);

} elseif(isset($_POST['remove-book'])) {
    $title = $_POST['title'];
    
    removeBook($conn, $title);
    header("Location: ../admin.php?removebook=success");
}