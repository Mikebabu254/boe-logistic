<?php
    include 'db_connection.php';

    session_start();
    if(!isset($_SESSION["email"]) || ($_SESSION["email"]== "admin@mail.com")){
        header("location: index.php");
    }

    if($conn->connect_error){
        die("connection failed:" .$conn-> connect_error);
    }

    $userEmail = $_SESSION["email"];

    echo $userEmail;

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
        if (isset($_POST['agent'])) {
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
        } else {
            echo "Please select an agent";
        }

        $conn->close();
    }
    

    
?>