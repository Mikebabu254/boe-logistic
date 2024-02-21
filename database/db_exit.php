<?php
session_start();

if (isset($_POST["delete"])) {
    // Handle delete action
    echo "Deleting record...";
} elseif (isset($_POST["agentBtn"])) {
    // Handle submit action
    echo "Selecting agent...";
} else {
    // Handle cases where the form was submitted without a valid action
    echo "Invalid access to db_exit.php.";
}

// Additional code for logging out if needed
if (isset($_POST["logout_submit"])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other page after logout
    header("Location: sent.php?logout=true");
    exit();
}
?>
