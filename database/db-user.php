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




    // Check if the form is submitted
    if(isset($_GET['search'])){
        $search = mysqli_real_escape_string($conn, $_GET['search']);
        $sql = "SELECT id, first_name, second_name, email, phone_no, national_id, county, sub_county 
                FROM agents 
                WHERE first_name LIKE '%$search%' OR second_name LIKE '%$search%' OR email LIKE '%$search%'
                OR phone_no LIKE '%$search%' OR national_id LIKE '%$search%' OR county LIKE '%$search%' 
                OR sub_county LIKE '%$search%'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
    }else {
        // If no search query, fetch all users
        $sql = "SELECT id, first_name, second_name, email, phone_no, national_id, county, sub_county FROM agents";
        $result = mysqli_query($conn, $sql);

    }if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
?>