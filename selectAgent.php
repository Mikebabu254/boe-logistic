<?php

    include 'database/db_connection.php';

    session_start();
    if(!isset($_SESSION["userID"])){
        header("location: sent.php");
    }

    $userID = $_SESSION["userID"];

    echo $_SESSION['userID'].'<br>';
    echo $_SESSION['email'].'<br>';

    if($conn->connect_error){
        die("connection failed:" .$conn-> connect_error);
    }

    $userEmail = $_SESSION["email"];

    $sql = "SELECT * FROM agents WHERE email='$userEmail'";
    $results = $conn->query($sql);

    if ($results->num_rows > 0) {
        $userDetails = $results->fetch_assoc();
        $firstName = $userDetails['first_name'];
        // ... (retrieve other user details if needed)
        echo $firstName;
    } else {
        echo "user data not found";
        exit();
    }

    // Fetch data from goods table
    $sqlGoods = "SELECT * FROM goods WHERE sender_name='$firstName' ORDER BY item_id DESC LIMIT 1";
    $resultsGoods = $conn->query($sqlGoods);


    
    if ($resultsGoods->num_rows > 0) {
        $rowOne = mysqli_fetch_assoc($resultsGoods);
        $receiverSubcounty = $rowOne['receiver_subcounty'];

        //echo $receiverSubcounty;
    
        // Fetch agents in the specified receiver subcounty
        $sqlAgents = "SELECT * FROM agents WHERE sub_county='$receiverSubcounty'";
        $resultsAgents = $conn->query($sqlAgents);
    

    } else {
        echo "No goods data found";
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['agentBtn'])) {
            $agentName = $_POST['agent'];
    
            // Update the goods table with the selected agent
            $updateSql = "UPDATE goods SET receiver='$agentName' WHERE item_id='{$rowOne['item_id']}'";
    
            if ($conn->query($updateSql) === TRUE) {
                echo "Agent assigned successfully";
                header("location: sent.php");
                exit();
            } else {
                echo "Error updating goods table: " . $conn->error;
            }
        } elseif (isset($_POST['delete'])) {
            // Delete the selected row from the goods table
            $deleteSql = "DELETE FROM goods WHERE item_id='{$rowOne['item_id']}'";
    
            if ($conn->query($deleteSql) === TRUE) {
                echo "Record deleted successfully";
                header("location: database/db_exit.php");
                exit();
            } else {
                echo "Error deleting record: " . $conn->error;
            }
        } else {
            echo "Please select an agent or delete.";
        }
    }
        

     $conn->close();
    

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>select agent</title>
</head>
<body>
    <table>
        <tr>
            <th class="text"> item id</th>
            <th class="text"> item name</th>
            <th class="text"> sender name</th>
            <th class="text"> date send</th>
            <th class="text"> sender county</th>
            <th class="text"> sender sub conty</th>
            <th class="text"> Receiver county</th>
            <th class="text"> receiver sub county</th>
        </tr>
        <?php
            // Fetch the first row
            $row = mysqli_fetch_assoc($resultsGoods);

            // Display the first row in the table
            echo "<tr>";
            echo "<td>{$rowOne['item_id']}</td>";
            echo "<td>{$rowOne['item_name']}</td>";
            echo "<td>{$rowOne['sender_name']}</td>";
            echo "<td>{$rowOne['date_send']}</td>";
            echo "<td>{$rowOne['sender_county']}</td>";
            echo "<td>{$rowOne['sender_subcounty']}</td>";
            echo "<td>{$rowOne['receiver_county']}</td>";
            echo "<td>{$rowOne['receiver_subcounty']}</td>";
            echo "</tr>";
        ?>
    </table>

    <h2>select agent to recieve the package: <?php echo $receiverSubcounty; ?></h2>
        
    <form method="post" action="database/db_exit.php">
        <?php
            while ($agentRow = mysqli_fetch_assoc($resultsAgents)) {
                echo "<label><input type='radio' name='agent' value='{$agentRow['first_name']}' required>{$agentRow['first_name']}</label>";
            }
        ?>
        <input type="submit" name="agentBtn" ></a> 

    <form method="post" action="selectAgent.php" onsubmit="return confirmDelete()">
        <button type="submit" name="delete">Delete</button>
    </form>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete?");
        }
    </script>

    
        

</body>
</html>