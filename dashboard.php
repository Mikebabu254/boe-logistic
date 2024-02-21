<?php
    session_start();
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    include 'db_connection.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userEmail = $_SESSION["email"];

    $sql = "SELECT first_name FROM agents WHERE email = '$userEmail'";
    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $userDetails = $results->fetch_assoc();
        $firstName = $userDetails['first_name'];
    } else {
        echo "User details not found";
        // You can handle the error or redirect the user to an error page
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>
    
    <div class="back">
        <div class="txt">Welcome, <?php echo $firstName; ?></div>


        <container>
            <div class="recieved_item">
                <img src="images/recieve.png" class="rec_img" alt="recieved image">
                <div class="txt1">RECEIVED</div>
                <table >
                    <tr>
                        <th>Pending</th>
                        <th>Received</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    
                </table>
            </div>

            <div class="sent_item">
            <img src="images/send.svg" class="rec_img" alt="recieved image">
                <div class="txt1">SENT</div>
                <table >
                    <tr>
                        <th>Pending</th>
                        <th>Sent</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    
                </table>
            </div>
        </container>

        <div class="contain">
            <div class="pending">
            <table >
                    <tr>
                        <th>Date</th>
                        <th>Sender</th>
                        <th>Item No</th>
                        <th>Received</th>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                    
                </table>
            </div>
        </div>
        
    </container>
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($conn);
?>