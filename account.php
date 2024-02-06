<?php

    include 'database/db_account.php';
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>account</title>
    <link rel="stylesheet" href="styles/account.css">
</head>
<body>
    

    <container>
        <div class="details">
        <img src="images/male avator.png" alt="an avatar">
            <div class="name">First Name: <?php echo $userDetails['first_name']; ?></div>
            <div class="name">Last Name: <?php echo $userDetails['second_name']; ?></div>
            <div class="name">Email: <?php echo $userDetails['email']; ?></div>
            <div class="name">County: <?php echo $userDetails['county']; ?></div>
            <div class="name">Sub-county: <?php echo $userDetails['sub_county']; ?></div>
        </div>
        
    </container>
</body>
</html>