<?php
    include 'database/db-user.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user</title>
    <link rel="stylesheet" href="styles/user.css">
</head>
<body>
    <nav>
        <input type="search"" class="search">
        <input type="submit" value="search" class="searchBtn">
    </nav>


    <div class="tb">
    <table>
            <tr>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>EMAIL</th>
                <th>PHONE NUMBER</th>
                <th>ID NO</th>
                <th>COUNTY</th>
                <th>CONSTITUENCY</th>
            </tr>
            <?php
                // Display user information in a table
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        echo "<td>{$row['first_name']}</td>";
                        echo "<td>{$row['second_name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['phone_no']}</td>";
                        echo "<td>{$row['national_id']}</td>";
                        echo "<td>{$row['county']}</td>";
                        echo "<td>{$row['sub_county']}</td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>

        
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($conn);
?>