<?php

session_start();
// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}


    include 'db_connection.php';


    
?>