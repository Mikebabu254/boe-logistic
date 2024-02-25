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

    if($userEmail === 'admin@boe.com'){
        $sql = "SELECT first_name FROM admin WHERE email = '$userEmail'";
    }else{
        $sql = "SELECT first_name FROM agents WHERE email = '$userEmail'";
    }
    
    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $userDetails = $results->fetch_assoc();
        $firstName = $userDetails['first_name'];
    } else {
        echo "User details not found";
        // You can handle the error or redirect the user to an error page
        exit();
    }

    $sqlTable = $conn->query("SELECT * FROM goods WHERE receiver ='$firstName' AND arrival_date = '0000-00-00'");
    $rowCount = $sqlTable->num_rows;
    $sqlTableTwo = $conn->query("SELECT * FROM goods WHERE receiver = '$firstName'");
    $rowCountTwo = $sqlTableTwo->num_rows;
    $receive = $rowCountTwo - $rowCount;


    $senderTable = $conn->query("SELECT * FROM goods WHERE sender_name = '$firstName' AND arrival_date = '0000-00-00'");
    $rowPendCount = $senderTable->num_rows;
    $senderTableTwo = $conn->query("SELECT * FROM goods WHERE sender_name = '$firstName'");
    $rowSendCount = $senderTableTwo->num_rows;
    $sent= $rowSendCount - $rowPendCount;
    
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
                        <th>
                            <?php
                                echo "$rowCount";
                            ?>
                        </th>
                        <th>
                            <?php
                                echo "$receive";
                            ?>
                        </th>
                        <th>
                            <?php
                                echo "$rowCountTwo";
                            ?>
                        </th>
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
                        <th>
                            <?php
                                echo "$rowPendCount";
                            ?>
                        </th>
                        <th>
                            <?php
                                echo "$sent";
                            ?>
                        </th>
                        <th>
                            <?php
                                echo " $rowSendCount";
                            ?>
                        </th>
                    </tr>
                    
                </table>
            </div>
        </container>

        <div class="contain">
            <div class="pending">
            <?php
            $rowCount = 0;
            echo
                "<table >
                    <tr>
                        <th class='hd'>Date</th>
                        <th class='hd'>Sender</th>
                        <th class='hd'>Item No</th>
                        <th class='hd'>Received</th>
                    </tr>";
                        while ($rw = mysqli_fetch_assoc($sqlTable)) {
                            echo "<tr>";
                                echo "<td >{$rw['date_send']}</td>";
                                echo "<td>{$rw['sender_name']}</td>";
                                echo "<td>{$rw['item_id']}</td>";
                                echo "<form method='post' action='dashboard.php'>";
                                echo "<input type='hidden' name='item_id' value='{$rw['item_id']}'>";
                                echo "<td><button type='submit' name='arrived'>Arrived</button></td>";
                                echo "</form>";

                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['arrived'])) {
                                    $item_id = $_POST['item_id'];
                                    $updateTime = "UPDATE goods SET arrival_date = NOW() WHERE item_id = '$item_id'";
                                    mysqli_query($conn, $updateTime);
                                    // You may want to add a check for successful update or handle errors
                                }
                            echo "</tr>";
                            }
                        
                    
                echo "</table>";
                ?>
            </div>
        </div>
        
    </container>
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($conn);
?>