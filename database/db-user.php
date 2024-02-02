<?php 
    session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "boe-logistics";

    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve user information from the database
    $sql = "SELECT id, first_name, second_name, email, phone_no, national_id, county, sub_county FROM agents";
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
?>