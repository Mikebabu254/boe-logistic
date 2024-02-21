<?php

session_start();
if (!isset($_SESSION["email"]) || ($_SESSION["email"] == "admin@mail.com")) {
    header("location: index.php");
    exit();
}

include 'db_connection.php';

if ($conn->connect_error) {
    die("connection failed:" . $conn->connect_error);
}

$userEmail = $_SESSION["email"];

$sql = "SELECT * FROM agents WHERE email='$userEmail'";
$results = $conn->query($sql);

if ($results->num_rows > 0) {
    $userDetails = $results->fetch_assoc();
    $firstName = $userDetails['first_name'];
    $county = $userDetails['county'];
    $sub_county = $userDetails['sub_county'];
} else {
    echo "user data not found";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST["itemName"];
    $sender_phone = $_POST["sender_phone"];
    $receiver_phone = $_POST["receiver_phone"];
    $county_receiving = $_POST["county"];
    $subcounty_receiving = $_POST["constituency"];
    $passKey = $_POST['passkey'];
    $_SESSION['userID'] = $userDetails['userID'];

    // Validate passKey
    $passKeyCheckQuery = "SELECT * FROM entry_key WHERE email = '$userEmail' AND key_value = '$passKey'";
    $passKeyCheckResult = $conn->query($passKeyCheckQuery);

    if ($passKeyCheckResult->num_rows == 0) {
        echo '<script>alert("Incorrect passKey!");</script>';
        exit();
    }

    // Sanitize input values
    $item_name_value = htmlspecialchars($item_name);
    $first_name_value = htmlspecialchars($firstName);
    $sender_phone_value = htmlspecialchars($sender_phone);
    $receiver_phone_value = htmlspecialchars($receiver_phone);
    $county_receiving_value = htmlspecialchars($county_receiving);
    $subcounty_receiving_value = htmlspecialchars($subcounty_receiving);

    $stmt = $conn->prepare("INSERT INTO goods(item_name,sender_name,sender_county,sender_subcounty,receiver_county,receiver_subcounty,sender_phone,receiver_phone) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssss", $item_name, $firstName, $county, $sub_county, $county_receiving, $subcounty_receiving, $sender_phone, $receiver_phone);

    if ($stmt->execute()) {
        echo '<script>alert("Registered successfully!");</script> ';
        // Redirect with query parameter
        $redirectUrl = $_GET['redirect'] ?? 'selectAgent.php';
        header("location: selectAgent.php");
        exit();
    } else {
        echo '<script>alert("Registration failed!");</script>';
    }
}
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
    
        <input type="tel" placeholder="sender's customer phone no" name="sender_phone" class="input"> 
        <input type="tel" placeholder="receivers's customer phone no" name="receiver_phone" class="input"> 
        <div class="names">
            COUNTY
            <input type="radio" name="county" value="NAIROBI">Nairobi
            <input type="radio" name="county" value="KIAMBU">Kiambu
        </div>

        

        <div class="constituency">
        <!-- Constituency options will be added dynamically here -->
        </div>

        <?php
            $sql = "SELECT * FROM entry_key WHERE email = '$userEmail'";
            $rslt = $conn->query($sql);

            // Check if the query was successful
            if ($rslt) {
                // Check if there are any rows returned
                if ($rslt->num_rows > 0) {
                    // Fetch the associative array representation of the result set
                    $row = $rslt->fetch_assoc();

                    // Access the 'userID' column from the result
                    $userid = $row['userID'];
                    $_SESSION['userID'] = $userid;

                    echo $userid;
                } else {
                    echo "No rows found";
                }
            } else {
                // Handle query error
                echo "Error executing the query: " . $conn->error;
            }
        ?>

        <input type="password" placeholder="key" name="passkey">

        <a href="database/db_logout.php"><input type="submit" value="submit" class="butn"></a>
        

    </form>

    
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const countyRadio = document.getElementsByName("county");
            const constituencyDiv = document.querySelector(".constituency");
            const submitButton = document.querySelector(".butn");

            submitButton.style.transition = "all 200s ease"; 

            for (let i = 0; i < countyRadio.length; i++) {
                countyRadio[i].addEventListener("change", function() {
                    const selectedCounty = this.value;

                    if (selectedCounty === "NAIROBI") {
                        updateConstituency(["RUARAKA","ROYSAMBU","KASARANI", "EMBAKASI CENTRAL","DAGORETTI SOUTH","DAGORETTI NORTH","WESTLANDS"]);
                    } else if (selectedCounty === "KIAMBU") {
                        updateConstituency(["RUIRU","JUJA","GITHUNGURI","KIAMBAA","LIMURU","KABETE","THIKA TOWN","KIAMBU TOWN"]);
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

<?php
    // Close the database connection
    mysqli_close($conn);
?>