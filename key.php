

<?php

    session_start();
    if(!isset($_SESSION['email'])){
        header('index.php');
        exit();
    }

    $userEmail = $_SESSION['email'];
    echo $userEmail;

    include 'database/db_connection.php';

    
    $results = $conn->query("SELECT * FROM AGENTS  WHERE email = '$userEmail'");
    $userDetail = $results->fetch_assoc();
    $name = $userDetail['first_name'];
    $id = $userDetail['id'];

    $concat = $name.$id;

    
    echo $concat;

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //collection of user input
        $passKey = $_POST['passKey'];
        echo $passKey;
        $sql_query = mysqli_query($conn, "INSERT INTO entry_key (userID,email,key_value) VALUES ('$concat','$userEmail','$passKey')");
        
        
        
        if($sql_query){
            echo "<script>alert('inserted successful')</script>";

        }else{
            echo "<script>alert(' not inserted successful')</script>";    
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>key</title>
</head>
<body>
    
    <form action="key.php" method="post" class="">
        <input type="password" placeholder="key" name="passKey" id="pass">
        <input type="submit" value="submit">
    </form>
</body>
</html>