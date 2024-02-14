<?php

    session_start();
    if(!isset($_SESSION["email"])|| ($_SESSION["email"] == "admin@mail.com")){
        header("location: index.php");
        exit();
    }

    include 'db_connection.php';

    if($conn->connect_error){
        die("connection failed:". $conn->connect_error);
    }

    $userEmail = $_SESSION["email"];

    $sql = "SELECT first_name FROM agents WHERE email='$userEmail'";
    $results = $conn->query($sql);

    if($results->num_rows > 0){
        $userDetails = $results->fetch_assoc();
        $firstName = $userDetails['first_name'];
    }else{
        echo "user data not found";
        exit();
    }

    
    
    $conn->close();
?>