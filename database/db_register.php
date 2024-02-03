<?php
    session_start();
    
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    include 'database/db_connection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect user input
        $first_name = $_POST["firstName"];
        $last_name = $_POST["lastName"];
        $email = $_POST["email"];
        $Phone_Number = $_POST["PhoneNumber"];
        $id_number = $_POST["idNumber"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirmPassword"];
        $county = $_POST["county"];
        $constituency = $_POST["constituency"];

        // Initialize variables to store form data for redisplay
        $first_name_value = htmlspecialchars($first_name);
        $last_name_value = htmlspecialchars($last_name);
        $email_value = htmlspecialchars($email);
        $phone_number_value = htmlspecialchars($Phone_Number);
        $id_number_value = htmlspecialchars($id_number);
        $county_value = htmlspecialchars($county);
        $constituency_value = htmlspecialchars($constituency);

        try {
            if ($password !== $confirm_password) {
                echo '<script>alert("The passwords do not match");</script>';
            } elseif (strlen($password) < 8) {
                echo '<script>alert("Please enter a password with at least 8 characters");</script>';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Use prepared statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO agents (first_name, second_name, email, phone_no, national_id, password, county, sub_county) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $Phone_Number, $id_number, $hashedPassword, $county, $constituency);

                if ($stmt->execute()) {
                    echo '<script>alert("Registered successfully!");</script>';
                } else {
                    echo '<script>alert("An error occurred while inserting the data. Check for data duplication (e.g., phone number, id number, or email address)");</script>';
                }

                $stmt->close();
            }
        } catch (mysqli_sql_exception $e) {
            echo '<script>alert("An error occurred while inserting the data. Check for data duplication (e.g., phone number, id number, or email address). Try again by inserting correct data.");</script>';
        }
    }

    // Close the connection
    mysqli_close($conn);

?>