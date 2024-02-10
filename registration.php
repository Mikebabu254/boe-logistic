<?php

    include 'database/db_register.php';

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
                        updateConstituency(["KASARANI", "EMBAKASI"]);
                    } else if (selectedCounty === "KIAMBU") {
                        updateConstituency(["RUIRU", "JUJA"]);
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

