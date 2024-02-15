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
    <form action="sent.php" method="post" class="sent_form" >
        
        <div class="text"> Sender</div>
        <div class="agentname" name="send_agent">
            <?php echo $firstName ; ?>

        </div>
        <input type="text" placeholder="Item Name" id="itemName" name="itemName" class="itemdet" required>
        <?php echo $county; ?>
        <?php echo $sub_county; ?>
        <!--<div class="item_details">
            <div class="item_no" id="itemNo"> Item No: </div>
            <button class="butn" id="randNoGen">Generate</button>
        </div>  -->
        <!--<div class="lable">
            <div class="delivery-date">Date of delivery</div>
            <div class="delivery-date">Time of delivery</div>
        </div>-->
        <!--<div class="date_time"> 
            <input type="date" placeholder="Date" id="dateSend" name="dateSend" class="input" required>
            <input type="time" placeholder="Time" id="timeSend" name="timeSend" class="input" required>

        </div>-->
        <!--<div class="location">
            <input type="text" placeholder="County" name="county" class="input" required>
            <input type="text" placeholder="Sub-county" name="subcounty" class="input" required>
        </div>-->
        <input type="tel" placeholder="sender's customer phone no" name="sender_phone"> 
        <input type="tel" placeholder="receivers's customer phone no" name="receiver_phone"> 
        <div class="names">
            COUNTY
            <input type="radio" name="county" value="NAIROBI">NAIROBI
            <input type="radio" name="county" value="KIAMBU">KIAMBU
        </div>

        

        <div class="constituency">
        <!-- Constituency options will be added dynamically here -->
        </div>

        <!--<div class="text"> Receiver</div>
        
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
        </div>-->

        <input type="submit" value="submit">

    </form>

    
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const countyRadio = document.getElementsByName("county");
            const constituencyDiv = document.querySelector(".constituency");

            for (let i = 0; i < countyRadio.length; i++) {
                countyRadio[i].addEventListener("change", function() {
                    const selectedCounty = this.value;

                    if (selectedCounty === "NAIROBI") {
                        updateConstituency(["RUARAKA","ROYSAMBU","KASARANI", "EMBAKASI CENTRAL","DAGORETTI SOUTH","DAGORETTI NORTH","WESTLANDS"]);
                    } else if (selectedCounty === "KIAMBU") {
                        updateConstituency(["RUIRU","JUJA","GITHUNGURI","KIAMBAA","LIMURU","KABETE","THIKS TOWN","KIAMBU TOWN"]);
                    } else {
                        updateConstituency([]);
                    }
                });
            }

            function updateConstituency(options) {
                constituencyDiv.innerHTML = "";

                for (let i = 0; i < options.length; i++) {
                    const input = document.createElement("input");
                    input.type = "radio";
                    input.name = "constituency";
                    input.value = options[i];
                    input.id = options[i];

                    const label = document.createElement("label");
                    label.htmlFor = options[i];
                    label.innerText = options[i];

                    constituencyDiv.appendChild(input);
                    constituencyDiv.appendChild(label);
                }
            }
        });
    </script>
    
</body>
</html>