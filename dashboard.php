<?php
    //include 'database/db_dashboard.php';


    session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }


    include 'database/db_connection.php';

    if($conn->connect_error){
        die("connection failed:" .$conn-> connect_error);
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM agents where id = $user_id";
    $result = $conn->query($sql);

    if($result->num_rows>0){
        $userDetails = $result->fetch_assoc();
    }else{
        echo "results not found";
        exit();
    }

    // Close the database connection
    $conn->close();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>
    <nav>
        <div class="title">WELCOME ADMIN</div>
    </nav>

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