<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["email"])) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agent Details</title>
  <link rel="stylesheet" href="styles/admin.css">
</head>
<body>
    <!--<div id="agentMenu">
      <button onclick="showAgentDetails('profile')">Profile</button>
      <button onclick="showAgentDetails('ordersSent')">Orders Sent</button>
      <button onclick="showAgentDetails('ordersReceived')">Orders Received</button>
      <a href="logout.php"><button class="btn" id="logout">logout</button></a>
    </div>-->

    <div class="menu">
        <button class="btn" id="dashboard">dashboard</button>
        <button class="btn" id="addUsers">dummy button</button>
        <button class="btn" id="addUsers">dummy button</button>
        <a href="logout.php"><button class="btn" id="logout">logout</button></a>
    </div>

    <div class="frm">
        <iframe src="dashboard.php" id="dashFrame" class="dashboard"></iframe>
    </div>

  <script src="js file/scipt.js"></script>
</body>
</html>
