<?php

    session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    include 'database/db_connection.php';

    if($conn->connect_error){
        die("connection failed:" .$conn-> connect_error);
    }

    // Get the logged-in user's email
    $userEmail = $_SESSION["email"];

    // Query the database to get user details
    $sql = "SELECT * FROM agents WHERE email = '$userEmail'";
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
        $firstName = $userDetails['first_name'];
        
    } else {
        echo "User details not found";
        // You can handle the error or redirect the user to an error page
        exit();
    }


    if($userEmail == "admin@mail.com"){
        $sqlCode = "SELECT * FROM goods"; /*WHERE sender_name = '$firstName'";*/
        $results = $conn->query($sqlCode);
    
        if($results->num_rows>0){
            
        }else{
            echo "no data found";
        }
    }else{
        $sqlCode = "SELECT * FROM goods WHERE sender_name = '$firstName' ORDER BY item_id DESC";
        $results = $conn->query($sqlCode);
    
        if($results->num_rows>0){
            
        }else{
            echo "no data found";
        }
    }

    
    $sqlProgram = "SELECT * FROM goods WHERE receiver = '$firstName' ORDER BY item_id DESC";
    $resultShow = $conn->query($sqlProgram);
    
    if($resultShow->num_rows>0){
            
    }else{
        echo "no data found";
    }
    
    
    // Close the database connection
    $conn->close();

?>

