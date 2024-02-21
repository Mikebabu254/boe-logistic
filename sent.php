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
    $county_receiving = $_POST['county_receiving'];
    $subcounty_receiving = $_POST['subcounty_receiving'];
    $agent_receiving = $_POST['agent_receiving'];  
    $passKey = $_POST['passkey'];

    // Validate passKey
    

    // Sanitize input values
    $item_name_value = htmlspecialchars($item_name);
    $first_name_value = htmlspecialchars($firstName);
    $sender_phone_value = htmlspecialchars($sender_phone);
    $receiver_phone_value = htmlspecialchars($receiver_phone);
    $county_receiving_value = htmlspecialchars($county_receiving);
    $subcounty_receiving_value = htmlspecialchars($subcounty_receiving);
    $agent_receiving_value = htmlspecialchars($agent_receiving);

    $stmt = $conn->prepare("INSERT INTO goods(item_name, sender_name, sender_county, sender_subcounty, receiver_county, receiver_subcounty, sender_phone, receiver_phone, receiver) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssss", $item_name_value, $first_name_value, $county, $sub_county, $county_receiving_value, $subcounty_receiving_value, $sender_phone_value, $receiver_phone_value, $agent_receiving_value);

    if ($stmt->execute()) {
        echo '<script>alert("Registered successfully!");</script> ';
        // Redirect with query parameter
        $redirectUrl = $_GET['redirect'] ?? 'selectAgent.php';
        header("location: sent.php");
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
    <form action="sent.php" method="post" class="sent_form">
        <div class="text"> Sender</div>
        <div class="agentname" name="send_agent">
            <?php echo $firstName ; ?>
            <div class="agent_location">
                <?php echo $county . ', ' . $sub_county; ?>
            </div>
        </div>
        <input type="text" placeholder="Item Name" id="itemName" name="itemName" class="itemdet" required>
        <input type="tel" placeholder="sender's customer phone no" name="sender_phone" class="input"> 
        <input type="tel" placeholder="receiver's customer phone no" name="receiver_phone" class="input"> 
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
        <select name="countySelect" id="countySelect">
            <!-- Add an id attribute for easier JavaScript manipulation -->
            <?php
                $mySql = $conn->query("SELECT * FROM agents");
                // Check if there are rows in the result set
                if ($mySql->num_rows > 0) {
                    while ($agentRow = mysqli_fetch_assoc($mySql)) {
                        echo "<option value='{$agentRow['county']}|{$agentRow['sub_county']}|{$agentRow['first_name']}'>{$agentRow['county']} {$agentRow['sub_county']} {$agentRow['first_name']}</option>";
                    }
                } else {
                    echo "<option value=''>No counties found</option>";
                }
            ?>
        </select>
        <!-- Add hidden input fields to store the selected values -->
        <input type="hidden" name="county_receiving" id="countyReceiving">
        <input type="hidden" name="subcounty_receiving" id="subcountyReceiving">
        <input type="hidden" name="agent_receiving" id="receivingAgent">
        <a href="database/db_logout.php"><input type="submit" value="submit" class="butn"></a>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const countySelect = document.getElementById("countySelect");
            const countyReceivingInput = document.getElementById("countyReceiving");
            const subcountyReceivingInput = document.getElementById("subcountyReceiving");
            const agentReceivingInput = document.getElementById("receivingAgent");
            
            countySelect.addEventListener("change", function() {
                const selectedOption = countySelect.options[countySelect.selectedIndex].value;
                const [selectedCounty, selectedSubCounty, selectedAgent] = selectedOption.split("|");
                countyReceivingInput.value = selectedCounty;
                subcountyReceivingInput.value = selectedSubCounty;
                // Update the agentReceivingInput with the selected agent
                agentReceivingInput.value = selectedAgent;
            });
        });
    </script>
</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
