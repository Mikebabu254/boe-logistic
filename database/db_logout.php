<?php
session_start();

// Check if the logout button is clicked
if (isset($_POST["logout_submit"])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other page after logout
    header("Location: index.php?logout=true");
    exit();
} else {
    // Handle cases where the logout button was not clicked
    //echo "Invalid access to logout script.";
}
?>
