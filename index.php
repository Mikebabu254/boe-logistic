<?php

    include 'database/db_login.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <form method="post" action="index.php" class="login_form"  >
        <div class="title">Login</div> 
        <input type="email" name="email" placeholder="email" class="input" required>
        <input type="password" name="password" placeholder="password" class="input" required>
        <input type="submit" name="login_submit" class="submitBtn" value="Login">
    </form>
</body>

</html>
