<?php
// sambung ke pangkalan data
require('config.php');
include('session.php');

$photographerID = $_SESSION['photographerID'];

// semak sama ada data telah dihantar
if (isset($_POST['SIMPAN'])) {
    // pemboleubah untuk memegang data yang dihantar
    $artwork_image = $_FILES["artwork_image"]["name"];
    $artwork_temp = $_FILES["artwork_image"]["tmp_name"];
    $upload_directory = "uploads/"; // Directory for uploaded images

    // Validate file type
    $allowed_extensions = array("png", "jpeg", "jpg");
    $file_extension = strtolower(pathinfo($artwork_image, PATHINFO_EXTENSION));

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "<script>alert('Invalid file format. Only PNG, JPEG, and JPG files are allowed.');
              window.location='portfolio.php'</script>";
        exit();
    }

    // Move the uploaded image to the upload directory
    if (move_uploaded_file($artwork_temp, $upload_directory . $artwork_image)) {
        $sql = "INSERT INTO artwork (photographerID, artwork_image) 
                VALUES ('$photographerID', '$artwork_image')";

        $hasil = mysqli_query($conn, $sql);

        if ($hasil) {
            echo "<script>alert('The image is successfully posted');
                  window.location='portfolio.php'</script>";
        } else {
            echo "<script>alert('Failed to post the image');
                  window.location='portfolio.php'</script>";
        }
    } else {
        echo "<script>alert('Failed to upload the image');
              window.location='portfolio.php'</script>";
    }
}

// Delete selected artwork
if (isset($_POST['DELETE'])) {
    $selectedArtwork = $_POST['selected_artwork'];

    // Delete selected artwork from the database and remove the image file
    foreach ($selectedArtwork as $artworkID) {
        $deleteSql = "SELECT artwork_image FROM artwork WHERE artworkID='$artworkID' AND photographerID='$photographerID'";
        $deleteResult = mysqli_query($conn, $deleteSql);

        if ($deleteResult) {
            $artworkData = mysqli_fetch_assoc($deleteResult);
            $artwork_image = $artworkData['artwork_image'];
            $upload_directory = "uploads/"; // Directory for uploaded images
            $file_path = $upload_directory . $artwork_image;

            // Delete the image file
            if (file_exists($file_path)) {
                unlink($file_path);
            }

            // Delete the artwork record from the database
            $deleteSql = "DELETE FROM artwork WHERE artworkID='$artworkID' AND photographerID='$photographerID'";
            $deleteResult = mysqli_query($conn, $deleteSql);
        }
    }

    if ($deleteResult) {
        echo "<script>alert('The selected images are successfully deleted');
              window.location='portfolio.php'</script>";
    } else {
        echo "<script>alert('Failed to delete the images');
              window.location='portfolio.php'</script>";
    }
}
?>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>PORTFOLIO</title>
    <style>
        .image-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        
        .image-item {
            width: 350px;
            height: 350px;
            overflow: hidden;
	    
           
        }
        
        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
	    
        }
        
       .user-profile {
           display: flex;
           align-items: flex-start;
           justify-content: space-between;
           border: 2px solid black; /* Add border style */
           padding: 15px; /* Add padding for spacing */
       }
               
               .user-info {
                   text-align: left;
                   width: 50%;
               }
               
               .user-profile-picture {
                   align-self: flex-start;
                   border-radius: 50%; /* Add border-radius to create a circle shape */
                   overflow: hidden; /* Hide any overflow outside the circle */
                   width: 150px;
                   height: 150px;
               }
               
               .user-profile-picture img {
                   width: 100%;
                   height: 100%;
                   object-fit: cover; /* Ensure the image covers the circle shape */
               }
	
    </style>
</head>
<body bgcolor="#d6d6c2">
    <center>
        <?php include('navbar_photographer.html') ?>
        <br>
        <center><h2 style="color: #00004d;">USER PROFILE</h2></center>
                <div class="user-profile">
                    <div class="user-info">
                        <br>
                        <?php
                        $dataA = mysqli_query($conn, "SELECT * FROM photographer WHERE photographerID='$photographerID'");
                        $infoA = mysqli_fetch_array($dataA);
                        ?>
                        <div>
                            <b style="font-family: arial; font-size: 15px; color: #00004d;"> NAME :</b> <?php echo $infoA['name']; ?><br>
                            <b style="font-family: arial; font-size: 15px; color: #00004d;"> USERNAME :</b> <?php echo $infoA['photographerID']; ?><br>
                            <b style="font-family: arial; font-size: 15px; color: #00004d;"> EMAIL :</b> <?php echo $infoA['email']; ?><br>
                            <b style="font-family: arial; font-size: 15px; color: #00004d;"> CONTACT NUMBER  : </b><?php echo $infoA['phonenumber']; ?><br>
                            <b style="font-family: arial; font-size: 15px; color: #00004d;"> HOME ADDRESS  : </b><?php echo $infoA['address']; ?><br>
                        </div>
                        <br>
                        <!-- Add the button to redirect to ProfileUpdate.php -->
                        <a href="ProfileUpdate.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-primary" style="background-color: #000033; color: white;">Update Profile</button>
                        </a>
                    </div>
                    <div class="user-profile-picture">
                        <?php
                        $profilePicture = $infoA['profile_picture'];
                        if (!empty($profilePicture)) {
                            echo '<img src="' . $profilePicture . '" alt="Profile Picture" width="150" height="150">';
                        }
                        ?>
                    </div>
                </div>
                <br><br> 
                </fieldset>                    
            <fieldset>
                <center><h2 style="color: #00004d;">ARTWORK</h2></center>
                <?php if (isset($_POST['EDIT'])): ?>
                <form action="portfolio.php" method="post" style="padding-left: 70px;">
                    <br>
                    <h5><b>Select Images to Delete:</b></h5>
                    <?php
                    $dataA = mysqli_query($conn, "SELECT * FROM artwork WHERE photographerID='$photographerID'");
                    while ($infoB = mysqli_fetch_array($dataA)) {
                        $artworkID = $infoB['artworkID'];
                        $artwork_image = $infoB['artwork_image'];
                        ?>
                        <label>
                            <input type="checkbox" name="selected_artwork[]" value="<?php echo $artworkID; ?>">
                            <div class="image-item">
                                <img src="uploads/<?php echo $artwork_image; ?>" alt="Artwork">
                            </div>
                        </label>
                    <?php } ?>
                    <br><br>
                    <button type="submit" name="DELETE" class="btn btn-danger">Delete Selected Images</button>
                    <button type="submit" name="CANCEL" class="btn btn-secondary">Cancel</button>
                </form>
                <?php else: ?>
                <form action="portfolio.php" method="post" style="padding-left: 70px;" enctype="multipart/form-data">
                    
                    <h5><b>Upload Image:</b></h5>
                    <input type="file" id="artwork_image" name="artwork_image">
                    <br><br>
                    <button type="submit" name="SIMPAN" class="btn btn-primary btn-lg" style="height: 50px; background-color: #000033; color: white;">Upload</button>  
                </form>
                <form action="portfolio.php" method="post" style="padding-left: 70px;">
                    
                    <button type="submit" name="EDIT" class="btn btn-primary btn-lg" style="height: 50px; background-color: #000033; color: white;">Edit</button>  
                </form>
                <?php endif; ?>
                <center>
                    <div class="image-grid">
                        <?php
                        $sql = "SELECT * FROM artwork WHERE photographerID='$photographerID'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            $artwork_image = $row['artwork_image'];
                            ?>
                            <div class="image-item">
                                <img src="uploads/<?php echo $artwork_image; ?>" alt="Artwork">
                            </div>
                        <?php } ?>
                    </div>
                </center>
            </fieldset>
        </fieldset>
    </center>
</body>
</html>