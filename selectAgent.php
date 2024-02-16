<?php
    include 'database/db_selectAgent.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            while ($row = mysqli_fetch_assoc($resultsGoods)) {
                echo "<tr>";
                    echo "<td>{$row['item_id']}</td>";
                    echo "<td>{$row['item_name']}</td>";
                    echo "<td>{$row['sender_name']}</td>";
                    echo "<td>{$row['date_send']}</td>";
                    echo "<td>{$row['sender_county']}</td>";
                    echo "<td>{$row['sender_subcounty']}</td>";
                    echo "<td>{$row['receiver_county']}</td>";
                    echo "<td>{$row['receiver_subcounty']}</td>";
                echo "</tr>";
            }
            ?>
        </table>
    
</body>
</html>