<?php

session_start();
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

include 'database/db_connection.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userEmail = $_SESSION["email"];

$sql = "SELECT first_name FROM agents WHERE email = '$userEmail'";
$results = $conn->query($sql);

if ($results->num_rows > 0) {
    $userDetails = $results->fetch_assoc();
    $firstName = $userDetails['first_name'];
} else {
    echo "User details not found";
    // You can handle the error or redirect the user to an error page
    exit();
}

// Close the database connection
$conn->close();
?>
