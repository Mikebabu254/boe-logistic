<?php

    include 'database/db_register.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <form method="post" action="registration.php" class="Registration" >
        <div class="title">Register</div>
        <div class="names">
            <input type="text" placeholder="First Name" name="firstName" class="input" required>
            <input type="text" placeholder="Last Name" name="lastName" class="input" required>
        </div>
        
        <input type="email" placeholder="Email" name="email" class="input" required>

        <div class="number">
             <input type="tel" placeholder="Phone Number" name="PhoneNumber" class="input" required>
            <input type="number" placeholder="ID number" name="idNumber" class="input" required>
        </div>

       <div class="pass">
            <input type="password" placeholder="password" name="password" class="input" required>
            <input type="password" placeholder="confirm password" name="confirmPassword" class="input" required>
        </div>
        <div class="names">
            <input type="text" placeholder="County" class="input" name="county" required>
            <input type="text" placeholder=" Constituency" name="constituency" class="input" required>
        </div>
        
        
        <input type="submit" value="submit" class="submitBtn">
    </form>

</body>
</html>

