<?php

    /*session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "boe-logistics";

    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the user ID is provided in the URL
    if (isset($_GET['id'])) {
        $userId = mysqli_real_escape_string($conn, $_GET['id']);

        // Retrieve user information based on the provided user ID
        //$sql = "SELECT id, first_name, second_name, email, phone_no, national_id, county, sub_county FROM agents WHERE id = $userId";
        $sql = "SELECT * FROM agents WHERE id = $userId";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Check if the user exists
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
        } else {
            // Redirect to a page indicating that the user does not exist
            header("Location: user_not_found.php");
            exit();
        }
    } else {
        // Redirect to a page indicating that the user ID is not provided
        header("Location: user_not_provided.php");
        exit();
    }

    // Check if the form is submitted
    if(isset($_POST['submit'])){
        // Retrieve edited user details from the form
        $editedFirstName = mysqli_real_escape_string($conn, $_POST['edited_first_name']);
        $editedSecondName = mysqli_real_escape_string($conn, $_POST['edited_second_name']);
        $editedEmail = mysqli_real_escape_string($conn, $_POST['edited_email']);
        $editedPhoneNo = mysqli_real_escape_string($conn, $_POST['edited_phone_no']);
        $editedNationalId = mysqli_real_escape_string($conn, $_POST['edited_national_id']);
        $editedCounty = mysqli_real_escape_string($conn, $_POST['edited_county']);
        $editedSubCounty = mysqli_real_escape_string($conn, $_POST['edited_sub_county']);

        // Update the user details in the database
        $updateSql = "UPDATE agents SET
                      first_name = '$editedFirstName',
                      second_name = '$editedSecondName',
                      email = '$editedEmail',
                      phone_no = '$editedPhoneNo',
                      national_id = '$editedNationalId',
                      county = '$editedCounty',
                      sub_county = '$editedSubCounty'
                      WHERE id = $userId";

        $updateResult = mysqli_query($conn, $updateSql);

        if (!$updateResult) {
            die("Update failed: " . mysqli_error($conn));
        } else {
            // Redirect to a page indicating successful update
            header("Location: user.php");
            exit();
        }
    }

    // Check if the form is submitted for deletion
    if (isset($_POST['delete'])) {
        // Delete the user record from the database
        $deleteSql = "DELETE FROM agents WHERE id = $userId";
        $deleteResult = mysqli_query($conn, $deleteSql);

        if (!$deleteResult) {
            die("Deletion failed: " . mysqli_error($conn));
        } else {
            // Redirect to a page indicating successful deletion
            header("Location: user.php?delete=success");
            exit();
        }
    }*/

 
   session_start();
    // Check if the user is not logged in, redirect to login page
    if (!isset($_SESSION["email"])) {
        header("Location: index.php");
        exit();
    }

    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "boe-logistics";

    $conn = mysqli_connect($db_server, $db_user, $db_password, $db_name);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the user ID is provided in the URL
    if (isset($_GET['id'])) {
        $userId = mysqli_real_escape_string($conn, $_GET['id']);

        // Retrieve user information based on the provided user ID
        $sql = "SELECT * FROM agents WHERE id = $userId";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        // Check if the user exists
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Fetch and store the hashed password
            $hashedPassword = $user['password'];

            // Check if the form is submitted
    if(isset($_POST['submit'])){
        // Retrieve edited user details from the form
        $editedFirstName = mysqli_real_escape_string($conn, $_POST['edited_first_name']);
        $editedSecondName = mysqli_real_escape_string($conn, $_POST['edited_second_name']);
        $editedEmail = mysqli_real_escape_string($conn, $_POST['edited_email']);
        $editedPhoneNo = mysqli_real_escape_string($conn, $_POST['edited_phone_no']);
        $editedNationalId = mysqli_real_escape_string($conn, $_POST['edited_national_id']);
        $editedCounty = mysqli_real_escape_string($conn, $_POST['edited_county']);
        $editedSubCounty = mysqli_real_escape_string($conn, $_POST['edited_sub_county']);

        // Update the user details in the database
        $updateSql = "UPDATE agents SET
                      first_name = '$editedFirstName',
                      second_name = '$editedSecondName',
                      email = '$editedEmail',
                      phone_no = '$editedPhoneNo',
                      national_id = '$editedNationalId',
                      county = '$editedCounty',
                      sub_county = '$editedSubCounty'
                      WHERE id = $userId";

        $updateResult = mysqli_query($conn, $updateSql);

        if (!$updateResult) {
            die("Update failed: " . mysqli_error($conn));
        } else {
            // Redirect to a page indicating successful update
            header("Location: user.php");
            exit();
        }
    }
    
            // Check if the delete button is clicked
            if (isset($_POST['delete'])) {
                // Insert the user data into the deleted_agents table before deletion with timestamp
                $insertSql = "INSERT INTO deleted_data (id, first_name, second_name, email, phone_no, national_id,password, county, sub_county, del_date_time)
                               VALUES ('{$user['id']}', '{$user['first_name']}', '{$user['second_name']}', '{$user['email']}',
                                       '{$user['phone_no']}', '{$user['national_id']}','$hashedPassword', '{$user['county']}', '{$user['sub_county']}', CURRENT_TIMESTAMP)";
                $insertResult = mysqli_query($conn, $insertSql);

                if (!$insertResult) {
                    die("Insertion into deleted_agents table failed: " . mysqli_error($conn));
                }

                // Delete the user record from the agents table
                $deleteSql = "DELETE FROM agents WHERE id = $userId";
                $deleteResult = mysqli_query($conn, $deleteSql);

                if (!$deleteResult) {
                    die("Deletion failed: " . mysqli_error($conn));
                } else {
                    // Redirect to a page indicating successful deletion
                    header("Location: user.php?delete=success");
                    exit();
                }
            }
        } else {
            // Redirect to a page indicating that the user does not exist
            header("Location: user.php");
            exit();
        }
    } else {
        // Redirect to a page indicating that the user ID is not provided
        header("Location: user.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="styles/edit.css">
</head>
<body>

    
    <form method="post" class="edit_details">
        <div class="titlee">Edit User</div>
        <div class="names">
        <input type="text" id="edited_first_name" name="edited_first_name"  value="<?php echo $user['first_name']; ?>"placeholder="First Name" class="input" required>

        <input type="text" id="edited_second_name" name="edited_second_name" value="<?php echo $user['second_name']; ?>" placeholder="Second Name" class="input" required>

        </div>
       
        <input type="email" id="edited_email" name="edited_email" value="<?php echo $user['email']; ?>" placeholder="email" class="input"required>

        <div class="numbers">

        <input type="tel" id="edited_phone_no" name="edited_phone_no" value="<?php echo $user['phone_no']; ?>" placeholder="Phone Number" class="input" required>

        <input type="text" id="edited_national_id" name="edited_national_id" value="<?php echo $user['national_id']; ?>"  placeholder="ID number" class="input" required>

        </div>
        <div class="location">
        <input type="text" id="edited_county" name="edited_county" value="<?php echo $user['county']; ?>" placeholder="County" class="input"required>

        <input type="text" id="edited_sub_county" name="edited_sub_county" value="<?php echo $user['sub_county']; ?>" placeholder="Sub-County" class="input" required>

        </div>
        
        <div class="btns">
            <input type="submit" name="submit" value="Update"  class="submitBtn" >
        <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this user?')"  class="submitBtn">Delete User</button>
        </div>
        
    </form>
</body>
</html>

<?php
    // Close the database connection
    mysqli_close($conn);
?>
