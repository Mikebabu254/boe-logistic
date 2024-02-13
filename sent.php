<?php
    include 'database/db_sent.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sent</title>
    <link rel="stylesheet" href="styles/sent.css">

</head>
<body>
    <div class="sent_form"> 
    
        <div class="text"> Sender</div>
        <div class="agentname">
            <?php echo $firstName; ?>
        </div>
        <input type="text" placeholder="Item Name" id="itemName" name="itemname" class="itemdet" required>
            
        <!--<div class="item_details">
            <div class="item_no" id="itemNo"> Item No: </div>
            <button class="butn" id="randNoGen">Generate</button>
        </div>  -->
        <div class="lable">
            <div class="delivery-date">Date of delivery</div>
            <div class="delivery-date">Time of delivery</div>
        </div>
        <div class="date_time"> 
            <input type="date" placeholder="Date" id="dateSend" name="date" class="input" required>
            <input type="time" placeholder="Time" id="timeSend" name="time" class="input" required>

        </div>
        <div class="location">
            <input type="text" placeholder="County" name="county" class="input" required>
            <input type="text" placeholder="Sub-county" name="subcounty" class="input" required>
        </div>
        <div class="text"> Receiver</div>
        <div class="agentname">
            Receiving Agent Name :
        </div>
        <div class="lable">
            <div class="delivery-date">Arrival Date</div>
            <div class="delivery-date">Arrival Time</div>
        </div>
        <div class="date_time"> 
            <input type="date" placeholder="Date" id="dateSend" name="date" class="input" required>
            <input type="time" placeholder="Time" id="timeSend" name="time" class="input" required>

        </div>
        <div class="location">
            <input type="text" placeholder="County" name="county" class="input" required>
            <input type="text" placeholder="Sub-county" name="subcounty" class="input" required>
        </div>
        
        

    </div>
    
    
</body>
</html>