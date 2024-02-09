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
            Delivery Agent Name :
        </div>
        <input type="text" placeholder="Item Name" name="itemname" class="itemdet" required>
            
        <div class="item_details">
            <div class="item_no" id="itemNo"> Item No: </div>
            <button class="butn" id="randNoGen">Generate</button>
        </div>  
      
        <div class="date_time"> 
            <input type="date" placeholder="Date" name="date" class="input" required>
            <input type="time" placeholder="Time" name="time" class="input" required>

        </div>
        <div class="location">
            <input type="text" placeholder="County" name="county" class="input" required>
            <input type="text" placeholder="Sub-county" name="subcounty" class="input" required>
        </div>

    </div>
    
    <script>
        var rand_No = document.getElementById('randNoGen');
        var item_No = document.getElementById('itemNo');

        rand_No.onclick = function(){
            var rand_number = Math.floor(Math.random(1, 100)*100);
            console.log("hello");
            console.log(rand_number);
            item_No.innerHTML = 'item no: ' + rand_number;
        }

    </script>
</body>
</html>