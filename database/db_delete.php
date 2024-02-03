<?php
    session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    include 'db_connection.php';

    // Check if the user ID is provided in the URL
    if (isset($_GET['id'])) {
        $userId = mysqli_real_escape_string($conn, $_GET['id']);

        // Delete the user record from the database
        $deleteSql = "DELETE FROM agents WHERE id = $userId";
        $deleteResult = mysqli_query($conn, $deleteSql);

        if (!$deleteResult) {
            die("Deletion failed: " . mysqli_error($conn));
        } else {
            // Redirect to a page indicating successful deletion
            header("Location: user.php");
            exit();
        }
    } else {
        // Redirect to a page indicating that the user ID is not provided
        header("Location: user.php");
        exit();
    }
?>