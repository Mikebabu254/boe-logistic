<?php

session_start();

// Check if the user is already logged in
if (isset($_SESSION["email"])) {
    // Redirect to the admin dashboard if already logged in
    header("Location: admin_dashboard.php");
    exit();
}

include 'database/db_connection.php';

// Function to sanitize user input
function sanitize_input($data)
{
    global $conn; // Make $conn accessible inside the function
    return mysqli_real_escape_string($conn, htmlspecialchars(trim($data)));
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_submit"])) {
    // Get the email and password from the form
    $email = sanitize_input($_POST["email"]);
    $password = sanitize_input($_POST["password"]);

    // Use prepared statement to avoid SQL injection
    $query = "SELECT * FROM agents WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If a matching record is found, log in the user
    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
        $hashed_password = $user_data["password"];

        if (password_verify($password, $hashed_password)) {
            // Password is correct, log in the user
            $_SESSION["email"] = $email; // Store email in session
            header("Location: admin_dashboard.php");
            exit();
        } else {
            // Display an error message if password is incorrect
            $error_message = "Invalid email or password.";
            echo '<script>alert("Invalid email or password.");</script>';
        }

    } else {
        // Display an error message if credentials are incorrect
        $error_message = "Invalid email or password.";
        echo '<script>alert("Invalid email or password.");</script>';
    }
}

// Close the connection
mysqli_close($conn);
?>
