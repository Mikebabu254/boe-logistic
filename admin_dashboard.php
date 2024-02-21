<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["email"]) || ($_SESSION["email"] != "admin@mail.com")) {
    header("Location: agent_dashboard.php");
    exit();
}
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
    <nav>
      <img src="images/icons.jpg">
      <ul>
          <li><a href="#" id="dashboard">Agents</a></li>
          <li><a href="#" id="account">Account</a></li>
          <li><a href="#" id="sent">Register</a></li>
          <li><a href="#" id="inventory">Inventory</a></li>
          <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
    <div class="frm">
        <iframe src="user.php" id="dashFrame" class="dashboard"></iframe>
        <iframe src="account.php" id="accountFrame" class="account"></iframe>
        <iframe src="registration.php" id="sentFrame" class="sent"></iframe>
        <iframe src="inventory.php" id="inventoryFrame" class="inventory"></iframe>
    </div>
    <div class="details">
        
    </div>
    <script src="js file/scipt.js"></script>
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($conn);
?>