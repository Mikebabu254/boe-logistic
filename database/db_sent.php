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

    
    
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
    
        if (empty($search)) {
            echo "<script>alert('Please enter the location of the delivery');</script>";
        } else {
            $sql = "SELECT first_name FROM agents WHERE county LIKE '%$search%' OR sub_county LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
    
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
    
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<input type='radio' name='agent' value='" . $row['first_name'] . "'>" . $row['first_name'] . "<br>";
                }
            } else {
                echo "No results found.";
            }
        }
    }

    if($_SERVER["REQUEST_METHOD"]==$_POST){
        if (isset($_POST['senderForm'])) {
            // Process data from the sender form
            $itemName = mysqli_real_escape_string($conn, $_POST['itemName']);
            $dateSend = mysqli_real_escape_string($conn, $_POST['dateSend']);
            $timeSend = mysqli_real_escape_string($conn, $_POST['timeSend']);
            $senderPhone = mysqli_real_escape_string($conn, $_POST['senderPhone']);
            $receiverPhone = mysqli_real_escape_string($conn, $_POST['receiverPhone']);
            $selectedCounty = isset($_POST['county']) ? mysqli_real_escape_string($conn, $_POST['county']) : '';
            $selectedConstituency = isset($_POST['constituency']) ? mysqli_real_escape_string($conn, $_POST['constituency']) : '';

            // Now you can use these variables to insert data into your 'goods' table
            // Example:
            $sqlInsert = "INSERT INTO goods (item_name,sender_name,date_send, time_send, county, subcounty,receiver, sender_phone, receiver_phone)
                          VALUES ('$itemName','$firstName', '$dateSend', '$timeSend', '$senderPhone', '$receiverPhone', '$selectedCounty', '$selectedConstituency')";

            if (mysqli_query($conn, $sqlInsert)) {
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
    
    $conn->close();
?>