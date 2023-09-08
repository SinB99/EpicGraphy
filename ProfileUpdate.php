<?php
// sambung ke pangkalan data
require('config.php');
include('session.php');

$photographerID = $_SESSION['photographerID'];

// Update profile information
if (isset($_POST['UPDATE'])) {
    // Retrieve form data and sanitize it
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    $updateSql = "UPDATE photographer SET name='$name', email='$email', phonenumber='$phonenumber', address='$address' WHERE photographerID='$photographerID'";
    $updateResult = mysqli_query($conn, $updateSql);

    if ($updateResult) {
        echo "<script>alert('Your profile information has been updated successfully');
              window.location='ProfileUpdate.php'</script>";
    } else {
        echo "<script>alert('Failed to update your profile information');
              window.location='ProfileUpdate.php'</script>";
    }
}

// Change password
if (isset($_POST['UPDATE_PASSWORD'])) {
    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New password and confirm password do not match.');
              window.location='ProfileUpdate.php'</script>";
        exit();
    }

    // Verify the current password
    $verifySql = "SELECT password FROM photographer WHERE photographerID='$photographerID'";
    $verifyResult = mysqli_query($conn, $verifySql);

    if (mysqli_num_rows($verifyResult) == 1) {
        $row = mysqli_fetch_assoc($verifyResult);
        $storedPassword = $row['password'];

        // Verify the current password using password_verify
        if (password_verify($currentPassword, $storedPassword)) {
            // Generate a new password hash
            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password
            $updateSql = "UPDATE photographer SET password='$newPasswordHash' WHERE photographerID='$photographerID'";
            $updateResult = mysqli_query($conn, $updateSql);

            if ($updateResult) {
                echo "<script>alert('Password updated successfully.');
                      window.location='ProfileUpdate.php'</script>";
            } else {
                echo "<script>alert('Failed to update the password.');
                      window.location='ProfileUpdate.php'</script>";
            }
        } else {
            echo "<script>alert('Incorrect current password.');
                  window.location='ProfileUpdate.php'</script>";
        }
    } else {
        echo "<script>alert('User not found.');
              window.location='ProfileUpdate.php'</script>";
    }
}

// Change profile picture
if (isset($_POST['CHANGE_PICTURE'])) {
    $profilePicture = $_FILES["profile_picture"]["name"];
    $profilePictureTemp = $_FILES["profile_picture"]["tmp_name"];
    $uploadDirectory = "uploads/profile_pictures/";

    // Validate file type
    $allowedExtensions = array("png", "jpeg", "jpg");
    $fileExtension = strtolower(pathinfo($profilePicture, PATHINFO_EXTENSION));

    if (!in_array($fileExtension, $allowedExtensions)) {
        echo "<script>alert('Invalid file format. Only PNG, JPEG, and JPG files are allowed.');
              window.location='ProfileUpdate.php'</script>";
        exit();
    }

    // Move the uploaded image to the upload directory
    if (move_uploaded_file($profilePictureTemp, $uploadDirectory . $profilePicture)) {
        $updatePictureSql = "UPDATE photographer SET profile_picture='$uploadDirectory$profilePicture' WHERE photographerID='$photographerID'";
        $updatePictureResult = mysqli_query($conn, $updatePictureSql);

        if ($updatePictureResult) {
            echo "<script>alert('Your profile picture has been changed successfully');
                  window.location='ProfileUpdate.php'</script>";
        } else {
            echo "<script>alert('Failed to change your profile picture');
                  window.location='ProfileUpdate.php'</script>";
        }
    } else {
        echo "<script>alert('Failed to upload the profile picture');
              window.location='ProfileUpdate.php'</script>";
    }
}
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>PROFILE UPDATE</title>
    <style>
        .profile-form {
            width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group input[type="file"] {
            padding: 4px 8px;
        }

        .form-group .profile-picture {
            margin-top: 10px;
        }

        .form-group .profile-picture img {
                width: 10px;
                height: 10px;
                object-fit: cover;
                object-position: center;
                border: 1px solid #ccc;
                border-radius: 50%;
            }

        .form-group .btn {
            margin-top: 10px;
        }
    </style>
</head>
<body bgcolor="#d6d6c2">
    <center>
        <?php include('navbar_photographer.html') ?>
        <br>
        <center><h2 style="color: #00004d;">PROFILE UPDATE</h2></center>
        <div class="profile-form">
            <form action="ProfileUpdate.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Profile Information</legend>
                    <?php
                    $dataA = mysqli_query($conn, "SELECT * FROM photographer WHERE photographerID='$photographerID'");
                    $infoA = mysqli_fetch_array($dataA);
                    ?>
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" value="<?php echo $infoA['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $infoA['email']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phonenumber">Contact Number:</label>
                        <input type="text" id="phonenumber" name="phonenumber" value="<?php echo $infoA['phonenumber']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Home Address:</label>
                        <input type="text" id="address" name="address" value="<?php echo $infoA['address']; ?>" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="UPDATE" class="btn btn-primary">Update Profile</button>
                    </div>
                </fieldset>
            </form>
            <form action="ProfileUpdate.php" method="post">
                <fieldset>
                    <legend>Change Password</legend>
                    <div class="form-group">
                        <label for="current_password">Current Password:</label>
                        <input type="password" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password:</label>
                        <input type="password" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm New Password:</label>
                        <input type="password" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="UPDATE_PASSWORD" class="btn btn-primary">Change Password</button>
                    </div>
                </fieldset>
            </form>
            <form action="ProfileUpdate.php" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>Change Profile Picture</legend>
                    <div class="form-group">
                        <input type="file" id="profile_picture" name="profile_picture" accept="image/*" required>
                    </div>
                    <div class="form-group profile-picture">
                        <img src="<?php echo $infoA['profile_picture']; ?>" alt="Profile Picture">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="CHANGE_PICTURE" class="btn btn-primary">Change Profile Picture</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </center>
</body>
</html>
