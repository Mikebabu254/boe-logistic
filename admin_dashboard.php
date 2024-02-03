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
    <title>admin dashboard</title>
    <link rel="stylesheet" href="styles/admin.css">
</head>
<body>
    <div class="menu">
        <button class="btn" id="dashboard">dashboard</button>
        <button class="btn" id="viewList">agents</button>
        <button class="btn" id="addUsers">add users</button>
        <button class="btn" id="addUsers">dummy button</button>
        <button class="btn" id="addUsers">dummy button</button>
        <a href="logout.php"><button class="btn" id="logout">logout</button></a>
    </div>

    <div class="frm">
        <iframe src="user.php" id="userList" class="listFrame"></iframe>
        <iframe src="registration.php" id="regFrame" class="regFrame"></iframe>
        <iframe src="dashboard.php" id="dashFrame" class="dashboard"></iframe>
    </div>

    <div class="details">
        dfvdf v
    </div>
    


    <script src="js file/scipt.js"></script>
</body>
</html>

