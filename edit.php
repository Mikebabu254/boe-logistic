<?php
    include 'database/db_edit.php';
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
