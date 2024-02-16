<?php

    session_start();
    if(!isset($_SESSION["email"])|| ($_SESSION["email"] == "admin@mail.com")){
        header("location: index.php");
        exit();
    }

    include 'db_connection.php';

    if($conn->connect_error){
        die("connection failed:". $conn->connect_error);
    }

    $userEmail = $_SESSION["email"];

    $sql = "SELECT * FROM agents WHERE email='$userEmail'";
    $results = $conn->query($sql);

    if($results->num_rows > 0){
        $userDetails = $results->fetch_assoc();
        $firstName = $userDetails['first_name'];
        $county = $userDetails['county'];
        $sub_county = $userDetails['sub_county'];
    }else{
        echo "user data not found";
        exit();
    }


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $item_name = $_POST["itemName"];
        $sender_phone = $_POST["sender_phone"];
        $receiver_phone = $_POST["receiver_phone"];
        $county_receiving = $_POST["county"];
        $subcounty_receiving = $_POST["constituency"];

        //echo $firstName ."<br>" . $item_name ."<br>" . $county ."<br>" . $sub_county ."<br>" . $sender_phone ."<br>" . $receiver_phone  ."<br>" . $county_receiving ."<br>" . $subcounty_receiving;

        $item_name_value = htmlspecialchars($item_name);
        $first_name_value = htmlspecialchars($firstName);
        $sender_phone_value = htmlspecialchars($sender_phone);
        $receiver_phone_value = htmlspecialchars($receiver_phone);
        $county_receiving_value = htmlspecialchars($county_receiving);
        $subcounty_receiving_value = htmlspecialchars($subcounty_receiving);

        $stmt = $conn->prepare("INSERT INTO goods(item_name,sender_name,sender_county,sender_subcounty,receiver_county,receiver_subcounty,sender_phone,receiver_phone) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss",$item_name,$firstName,$county,$sub_county,$county_receiving,$subcounty_receiving,$sender_phone,$receiver_phone);

        if($stmt->execute()){
            echo '<script>alert("Registered successfully!");</script> ';
            header("location: selectAgent.php");
            exit();
        }else{
            echo '<script>alert("Registration failed!");</script>';
        }
    }
    
    
    $conn->close();
?>