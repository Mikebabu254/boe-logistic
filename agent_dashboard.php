<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION["email"]) || ($_SESSION["email"] == "admin@mail.com")) {
  header("Location: admin_dashboard.php");
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Agent Details</title>
  <link rel="stylesheet" href="styles/agent_dashboard.css">
</head>
<body>
    
    <nav>
      <img src="images/icons.jpg">
      <ul>
          <li><a href="#" id="dashboard">Dashboard</a></li>
          <li><a href="#" id="account">Account</a></li>
          <li><a href="#" id="sent">Send</a></li>
          <li><a href="#" id="inventory">Inventory</a></li>
          <li><a href="#" id="key">details</a></li>
          <li><a href="logout.php">Logout</a></li>
      </ul>
  </nav>

    <div class="frm">
        <iframe src="dashboard.php" id="dashFrame" class="dashFrame"></iframe>
        <iframe src="account.php" id="accountFrame" class="accountFrame"></iframe>
        <iframe src="sent.php" id="sentFrame" class="sentFrame"></iframe>
        <iframe src="inventory.php" id="inventoryFrame" class="inventoryFrame"></iframe>
        <iframe src="key.php" id="key_frame" class="keyFrame"></iframe>
    </div>

  <script src="js file/scipt.js"></script>
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($conn);
?>