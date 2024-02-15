<?php
    include 'db_connection.php';
    session_start();
    if(!isset($_SESSION["email"]) || ($_SESSION["email"]== "admin@mail.com")){
        header("location: index.php");
    }
?>