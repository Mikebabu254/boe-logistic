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
    <div class="recieved_transactions">
        <table>
            <tr>
                
                <th class="text"> Date Dispatched</th>
                <th class="text"> Recieved items</th>
                <th class="text"> Item Number </th>
                <th class="text"> Date recieved </th>
                
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($results)){
                    echo"<tr>";
                        echo "<td>{$row['date_send']}</td>";
                        echo "<td>{$row['item_name']}</td>";
                        echo "<td>{$row['item_id']}</td>";
                        echo "<td>{$row['arrival_date']}</td>";
                    echo"</tr>";
                }
            ?>
        </table>
    </div>
    <div class="sent_transactions">
        <table>
            <tr>
                
                    <th class="text"> Date sent </th>
                    <th class="text"> Sent items</th>
                    <th class="text"> Item Number </th>
                    <th class="text"> Date Delivered </th>
                
            </tr>
            
        </table>
    </div>
</body>
</html>