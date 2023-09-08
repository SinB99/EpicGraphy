<?php
// Database connection and other required includes
require('config.php');

// Check if the registration form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $photographerID = $_POST['photographerID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phonenumber = $_POST['phonenumber'];
    $address = $_POST['address'];
    $password = $_POST['password'];

    // Perform validation on the form data
    // ...

    // Check if the photographerID already exists in the photographer table
    $query = "SELECT * FROM photographer WHERE photographerID='$photographerID'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_num_rows($result);

    if ($count > 0) {
        // PhotographerID already exists
        echo "<script>alert('Photographer ID already exists. Please choose a different ID.');";
        echo "window.location='register.php'</script>";
        exit;
    }

    // Handle profile picture upload
    $profilePicture = $_FILES['profile_picture'];
    $profilePictureName = $profilePicture['name'];
    $profilePictureTmp = $profilePicture['tmp_name'];
    $profilePictureError = $profilePicture['error'];

    // Check if the uploaded file has a valid format
    $allowedFormats = array('jpg', 'jpeg', 'png');
    $fileExtension = strtolower(pathinfo($profilePictureName, PATHINFO_EXTENSION));

    if ($profilePictureError === UPLOAD_ERR_OK) {
        if (!in_array($fileExtension, $allowedFormats)) {
            // Invalid file format
            echo "<script>alert('Invalid profile picture format. Only JPG, JPEG, and PNG formats are supported.');";
            echo "window.location='register.php'</script>";
            exit;
        }

        $profilePicturePath = 'profile_pictures/' . $profilePictureName;
        move_uploaded_file($profilePictureTmp, $profilePicturePath);
    } else {
        // Failed to upload profile picture
        $profilePicturePath = '';
    }

    // Insert the user's data into the photographer table
    $query = "INSERT INTO photographer (photographerID, name, email, phonenumber, address, profile_picture, password, registration_date) VALUES ('$photographerID', '$name', '$email', '$phonenumber', '$address', '$profilePicturePath', '$password', NOW())";
    $hasil = mysqli_query($conn, $query); // Execute the query

    // Redirect to the login page or display a success message
    if ($hasil) {
        echo "<script>alert('Your account is successfully registered');";
        echo "window.location='index.php'</script>";
    } else {
        echo "<script>alert('Failed to register');";
        echo "window.location='RegisterPhotographer.php'</script>";
    }
}
?>

<!-- HTML code begins -->
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photographer Registration</title>

    <style type="text/css">
        /* Add the CSS styles from service.php here */
    </style>
</head>
<body bgcolor="#d6d6c2">

<?php include('navbar2.html') ?>

<br>
<center>
    <h2 style="color: #00004d;">REGISTER</h2>
    <div class="form-style-2">
        <form method="post" enctype="multipart/form-data">
            <table width="auto" border="1" class="imagetable">
                <tr>
                    <td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;"><b>Username</b></td>
                    <td style="width: auto; padding-left: 5px; height: auto;"><input type="text" name="photographerID" size="12" placeholder="Username" class="input-field" required></td>
                </tr>
                <tr>
                    <td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;"><b>Name</b></td>
                    <td style="width: auto; padding-left: 5px; height: auto;"><input type="text" name="name" size="12" placeholder="Name" class="input-field" required></td>
                </tr>
                <tr>
                    <td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;"><b>Email Address</b></td>
                    <td style="width: auto; padding-left: 5px; height: auto;"><input type="text" name="email" size="12" placeholder="Email Address" class="input-field" required></td>
                </tr>
                <tr>
                    <td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;"><b>Mobile Number</b></td>
                    <td style="width: auto; padding-left: 5px; height: auto;"><input type="text" name="phonenumber" size="12" placeholder="Mobile Number" class="input-field" required></td>
                </tr>
                <tr>
                    <td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;"><b>Home Address</b></td>
                    <td style="width: auto; padding-left: 5px; height: auto;"><input type="text" name="address" size="12" placeholder="Home Address" class="input-field" required></td>
                </tr>
                <tr>
                    <td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;"><b>Profile Picture</b></td>
                    <td style="width: auto; padding-left: 5px; height: auto;"><input type="file" name="profile_picture" accept=".jpg, .jpeg, .png" required></td>
                </tr>
                <tr>
                    <td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;"><b>Password</b></td>
                    <td style="width: auto; padding-left: 5px; height: auto;"><input type="password" name="password" placeholder="Password" class="input-field" required></td>
                </tr>
            </table>
            <input type="submit" name="SIMPAN" value="REGISTER">
        </form>
    </div>
    <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
</center>

<br><br>
</body>
</html>
