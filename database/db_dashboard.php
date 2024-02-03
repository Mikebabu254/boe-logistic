<?php

    session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }


    include 'db_connection.php';

    if($conn->connect_error){
        die("connection failed:" .$conn-> connect_error);
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM agents where id = $user_id";
    $result = $conn->query($sql);

    if($result->num_rows>0){
        $userDeatils = $result->fetch_assoc();
    }else{
        echo "results not found";
        exit();
    }

    // Close the database connection
    $conn->close();

?>