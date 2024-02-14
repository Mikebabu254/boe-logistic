<?php

    session_start();
    if(!isset($_SESSION["email"])){
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


    //insert data into table

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //  collects agents data about the product
        $itemName = $_POST['itemName'];
        $dateSend = $_POST['dateSend'];
        $time_send = $_POST['timeSend'];
        $county = $_POST['county'];
        $subconty = $_POST['subcounty'];
        $reciever = $_POST[''];
    
        $sqlCode = "INSERT INTO goods(item_name,sender_name,date_send,time_send,county,subcounty,reciever)VALUES($itemName,$firstName,$dateSend,$time_send,$county,$subconty,$reciever)";
    }
    

    $conn->close();
?>