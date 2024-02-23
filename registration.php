<?php
    session_start();

    if (!isset($_SESSION["email"]) || ($_SESSION["email"] != "admin@boe.com")) {
        header("Location: index.php");
        exit();
    }

    include 'db_connection.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect user input
        $first_name = $_POST["firstName"];
        $last_name = $_POST["lastName"];
        $email = $_POST["email"];
        $Phone_Number = $_POST["PhoneNumber"];
        $id_number = $_POST["idNumber"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirmPassword"];
        $county = $_POST["county"];
        $constituency = $_POST["constituency"];

        // Initialize variables to store form data for redisplay
        $first_name_value = htmlspecialchars($first_name);
        $last_name_value = htmlspecialchars($last_name);
        $email_value = htmlspecialchars($email);
        $phone_number_value = htmlspecialchars($Phone_Number);
        $id_number_value = htmlspecialchars($id_number);
        $county_value = htmlspecialchars($county);
        $constituency_value = htmlspecialchars($constituency);

        try {
            if ($password !== $confirm_password) {
                echo '<script>alert("The passwords do not match");</script>';
            } elseif (strlen($password) < 8) {
                echo '<script>alert("Please enter a password with at least 8 characters");</script>';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Use prepared statement to prevent SQL injection
                $stmt = $conn->prepare("INSERT INTO agents (first_name, second_name, email, phone_no, national_id, password, county, sub_county) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssss", $first_name, $last_name, $email, $Phone_Number, $id_number, $hashedPassword, $county, $constituency);

                if ($stmt->execute()) {
                    echo '<script>alert("Registered successfully!");</script>';
                } else {
                    echo '<script>alert("An error occurred while inserting the data. Check for data duplication (e.g., phone number, id number, or email address)");</script>';
                }

                $stmt->close();
            }
        } catch (mysqli_sql_exception $e) {
            echo '<script>alert("An error occurred while inserting the data. Check for data duplication (e.g., phone number, id number, or email address). Try again by inserting correct data.");</script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <form method="post" action="registration.php" class="Registration" >
        <div class="title">Register</div>
        <div class="names">
            <input type="text" placeholder="First Name" name="firstName" class="input" required>
            <input type="text" placeholder="Last Name" name="lastName" class="input" required>
        </div>
        
        <input type="email" placeholder="Email" name="email" class="input" required>

        <div class="number">
             <input type="tel" placeholder="Phone Number" name="PhoneNumber" class="input" required>
            <input type="number" placeholder="ID number" name="idNumber" class="input" required>
        </div>

       <div class="pass">
            <input type="password" placeholder="password" name="password" class="input" required>
            <input type="password" placeholder="confirm password" name="confirmPassword" class="input" required>
        </div>
        <div class="names">
            COUNTY
            <input type="radio" name="county" value="NAIROBI">NAIROBI
            <input type="radio" name="county" value="KIAMBU">KIAMBU
        </div>

        <div class="constituency">
    <!-- Constituency options will be added dynamically here -->
        </div>
        
        
        <input type="submit" value="submit" class="submitBtn">
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

<?php
    // Close the database connection
    mysqli_close($conn);
?>