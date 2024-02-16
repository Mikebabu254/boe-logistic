<?php
    include 'db_connection.php';

    session_start();
    if(!isset($_SESSION["email"]) || ($_SESSION["email"]== "admin@mail.com")){
        header("location: index.php");
    }

    if($conn->connect_error){
        die("connection failed:" .$conn-> connect_error);
    }

    $userEmail = $_SESSION["email"];

    echo $userEmail;

    $sql = "SELECT * FROM agents WHERE email='$userEmail'";
    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $userDetails = $results->fetch_assoc();
        $firstName = $userDetails['first_name'];
        // ... (retrieve other user details if needed)
        echo $firstName;
    } else {
        echo "user data not found";
        exit();
    }

    // Fetch data from goods table
    $sqlGoods = "SELECT * FROM goods WHERE sender_name='$firstName' ORDER BY item_id DESC LIMIT 1";
    $resultsGoods = $conn->query($sqlGoods);

    $conn->close();
?>