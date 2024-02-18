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
            <div class="agent_location">
            <?php echo $county . ', ' . $sub_county; ?>
            </div>
        </div>
        <input type="text" placeholder="Item Name" id="itemName" name="itemName" class="itemdet" required>
        
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
        <input type="tel" placeholder="sender's customer phone no" name="sender_phone" class="input"> 
        <input type="tel" placeholder="receivers's customer phone no" name="receiver_phone" class="input"> 
        <div class="names">
            COUNTY
            <input type="radio" name="county" value="NAIROBI">Nairobi
            <input type="radio" name="county" value="KIAMBU">Kiambu
        </div>
        <select id="agentsSelect">
            <?php
                $categories = mysqli_query($conn, "SELECT * FROM agents WHERE sub_county = '$county_receiving'");
                while($c = mysqli_fetch_array($categories)){
                    ?>
                <option value="<?php echo $c['id'] ?>"><?php echo $c['first_name'] ?> <?php echo $c['sub_county'] ?></option>
                <?php } $conn->close(); ?>
        </select>

        <button id="refreshButton">Refresh Select</button>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const countyRadio = document.getElementsByName("county");
                const constituencyDiv = document.querySelector(".constituency");
                const submitButton = document.querySelector(".butn");
                const refreshButton = document.getElementById("refreshButton");
                const selectElement = document.getElementById("agentsSelect");

                submitButton.style.transition = "all 200s ease";

                for (let i = 0; i < countyRadio.length; i++) {
                    countyRadio[i].addEventListener("change", function() {
                        const selectedCounty = this.value;

                        if (selectedCounty === "NAIROBI") {
                            updateConstituency(["RUARAKA", "ROYSAMBU", "KASARANI", "EMBAKASI CENTRAL", "DAGORETTI SOUTH", "DAGORETTI NORTH", "WESTLANDS"]);
                        } else if (selectedCounty === "KIAMBU") {
                            updateConstituency(["RUIRU", "JUJA", "GITHUNGURI", "KIAMBAA", "LIMURU", "KABETE", "THIKA TOWN", "KIAMBU TOWN"]);
                        } else {
                            updateConstituency([]);
                        }
                    });
                }

                refreshButton.addEventListener("click", function() {
                    const selectedCounty = document.querySelector('input[name="county"]:checked').value;

                    // Use AJAX to fetch and update the options in the select element
                    const xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            const newOptions = JSON.parse(xhr.responseText);
                            updateSelectOptions(newOptions);
                        }
                    };

                    // Modify the URL according to your server-side script that fetches the data
                    xhr.open("GET", "get_agents.php?county=" + encodeURIComponent(selectedCounty), true);
                    xhr.send();
                });

                function updateSelectOptions(options) {
                    // Clear existing options
                    selectElement.innerHTML = "";

                    // Add new options
                    for (let i = 0; i < options.length; i++) {
                        const option = document.createElement("option");
                        option.value = options[i].id;
                        option.text = options[i].first_name + " " + options[i].sub_county;
                        selectElement.appendChild(option);
                    }
                }
            });
        </script>

        

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

        <input type="submit" value="submit" class="butn">

    </form>

    

    
    
    
    
</body>
</html>