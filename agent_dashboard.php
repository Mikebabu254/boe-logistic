<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

// Your admin dashboard content goes here
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agent Details</title>
  <link rel="stylesheet" href="styles/agents.css">
</head>
<body>
    <div id="agentMenu">
      <button onclick="showAgentDetails('profile')">Profile</button>
      <button onclick="showAgentDetails('ordersSent')">Orders Sent</button>
      <button onclick="showAgentDetails('ordersReceived')">Orders Received</button>
      <a href="logout.php"><button class="btn" id="logout">logout</button></a>
    </div>

    <div id="agentDetails">
      <!-- Agent details will be displayed here -->
    </div>

  <script src="js file/script.js"></script>
</body>
</html>
