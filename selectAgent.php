<?php
    include 'database/db_selectAgent.php';
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
        
    <form method="post" action="selectAgent.php">
        <?php
            while ($agentRow = mysqli_fetch_assoc($resultsAgents)) {
                echo "<label><input type='radio' name='agent' value='{$agentRow['first_name']}' required>{$agentRow['first_name']}</label>";
            }
        ?>

        <input type="submit" name="agentBtn" >
        <a href="database/db_exit.php"><input type="submit" name="agentBtn" ></a>

    
    </form>

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