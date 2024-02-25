<?php
    session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    include 'db_connection.php';

    if($conn->connect_error){
        die("connection failed:" .$conn-> connect_error);
    }

    // Get the logged-in user's email
    $userEmail = $_SESSION["email"];

    if($userEmail === 'admin@boe.com'){
        $sql = "SELECT * FROM admin WHERE email = '$userEmail'";
    }else{
        // Query the database to get user details
        $sql = "SELECT * FROM agents WHERE email = '$userEmail'";
    }
    
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {
        $userDetails = $result->fetch_assoc();
        $firstName = $userDetails['first_name'];
        
    } else {
        echo "User details not found";
        // You can handle the error or redirect the user to an error page
        exit();
    }

    if($userEmail == "admin@boe.com"){
        $sqlCode = "SELECT * FROM goods"; /*WHERE sender_name = '$firstName'";*/
        $results = $conn->query($sqlCode);
    
        if($results->num_rows>0){
            
        }else{
            echo "no data found";
        }
    }else{
        $sqlCode = "SELECT * FROM goods WHERE sender_name = '$firstName' ORDER BY item_id DESC";
        $results = $conn->query($sqlCode);
    
        if($results->num_rows>0){
            
        }else{
            echo "no data yet";
        }
    }
    $sqlProgram = "SELECT * FROM goods WHERE receiver = '$firstName' ORDER BY item_id DESC";
    $resultShow = $conn->query($sqlProgram);
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
        <img src="images/male avator.png" class="img_avatar" alt="an avatar">
            <div class="name">
                <div class="name"> <?php echo $userDetails['first_name']; ?></div>
                <div class="name"> <?php echo $userDetails['second_name']; ?></div>
            </div>
            
            <div class="email"> <?php echo $userDetails['email']; ?></div>
            <div class="location"> <?php echo $userDetails['county']; ?></div>
            <div class="location"> <?php echo $userDetails['sub_county']; ?></div>
        </div>
    </container>
    
        <?php
            echo '<div class="recieved_transactions">';
                if($userEmail === 'admin@boe.com'){
                    echo '<div class="sent_transactions">';
                            echo "<table>";
                                echo "<tr>";
                                    echo '<th class="text"> Date sent </th>';
                                    echo '<th class="text"> Sent items</th>';
                                    echo '<th class="text"> Item Number </th>';
                                    echo '<th class="text"> Date Delivered </th>';
                                echo "</tr>";
                                while($row = mysqli_fetch_assoc($results)){
                                    echo"<tr>";
                                        echo "<td>{$row['date_send']}</td>";
                                        echo "<td>{$row['item_name']}</td>";
                                        echo "<td>{$row['item_id']}</td>";
                                        echo "<td>{$row['arrival_date']}</td>";
                                    echo"</tr>";
                                } 
                }
                else{ 
                    echo "<table>";
                        echo "<tr>";
                                echo '<th class="text"> Date Dispatched</th>';
                                echo '<th class="text"> Recieved items</th>';
                                echo '<th class="text"> Item Number </th>';
                                echo '<th class="text"> Date recieved </th>';   
                        echo "</tr>";
                                while($row = mysqli_fetch_assoc($resultShow)){
                                    echo"<tr>";
                                        echo "<td>{$row['date_send']}</td>";
                                        echo "<td>{$row['item_name']}</td>";
                                        echo "<td>{$row['item_id']}</td>";
                                        echo "<td>{$row['arrival_date']}</td>";
                                    echo"</tr>";
                                }
                }
                    echo "</table>";
            echo "</div>";
            
            if($userEmail === 'admin@boe.com'){

            }else{
                echo '<div class="sent_transactions">';
                    echo "<table>";
                        echo"<tr>";
                            echo'<th class="text"> Date sent </th>';
                            echo'<th class="text"> Sent items</th>';
                            echo'<th class="text"> Item Number </th>';
                            echo'<th class="text"> Date Delivered </th>';
                        echo"</tr>";
                        while($row = mysqli_fetch_assoc($results)){
                            echo"<tr>";
                                echo "<td>{$row['date_send']}</td>";
                                echo "<td>{$row['item_name']}</td>";
                                echo "<td>{$row['item_id']}</td>";
                                echo "<td>{$row['arrival_date']}</td>";
                            echo"</tr>";

                        }
                    echo "</table>";
                echo '</div>';
            }
                
        ?>
    
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($conn);
?>