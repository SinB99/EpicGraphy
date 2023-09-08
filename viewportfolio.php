<?php
// Sambung ke pangkalan data
require('config.php');
include('session.php');

$photographerID = $_GET['photographerID'];

$dataB = mysqli_query($conn, "SELECT * FROM photographer WHERE photographerID='$photographerID'");
if (mysqli_num_rows($dataB) > 0) {
    $infoB = mysqli_fetch_array($dataB);
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
                    border: 1px solid #ccc;
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
                }
                
                .user-info {
                    text-align: left;
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
                        <fieldset class="user-profile">
                                    <div class="user-info">
                                        <br>
                                        <?php
                                        $dataA = mysqli_query($conn, "SELECT * FROM photographer WHERE photographerID='$photographerID'");
                                        $infoA = mysqli_fetch_array($dataA);
                                        ?>
                			<div class="user-profile-picture">
                			<?php
                				$profilePicture = $infoA['profile_picture'];
                			        if (!empty($profilePicture)) {
                			        	echo '<img src="' . $profilePicture . '" alt="Profile Picture" width="150" height="150">';
                			        }
                			        ?>
                			</div>
                			<br>
                			<b style="font-family: arial; font-size: 15px; color: #00004d;"> NAME :</b> <?php echo $infoA['name']; ?><br>
                                        <b style="font-family: arial; font-size: 15px; color: #00004d;"> USERNAME :</b> <?php echo $infoA['photographerID']; ?><br>
                                        <b style="font-family: arial; font-size: 15px; color: #00004d;"> EMAIL :</b> <?php echo $infoA['email']; ?><br>
                                        <b style="font-family: arial; font-size: 15px; color: #00004d;"> CONTACT NUMBER  : </b><?php echo $infoA['phonenumber']; ?><br>
                                        <b style="font-family: arial; font-size: 15px; color: #00004d;"> HOME ADDRESS  : </b><?php echo $infoA['address']; ?><br>
                                   	<br>
                <fieldset>
                    <center><h2 style="color: #00004d;">ARTWORK</h2></center>
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
