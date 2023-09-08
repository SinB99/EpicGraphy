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
    </style>
</head>
<body bgcolor="#d6d6c2">
    <center>
        <?php include('navbar_serviceSeeker.html') ?>
        <br>
        <center><h2 style="color: #00004d;">PHOTOGRAPHER PORTFOLIO</h2></center>
        <fieldset>
            <b style="color: #00004d;">WELCOME</b> <br>
            <br>
            <?php if (isset($infoB)) { ?>
                <b style="font-family: arial; font-size: 15px; color: #00004d;"> NAME :</b> <?php echo $infoB['name']; ?><br>
                <b style="font-family: arial; font-size: 15px; color: #00004d;"> EMAIL :</b> <?php echo $infoB['email']; ?><br>
                <b style="font-family: arial; font-size: 15px; color: #00004d;"> CONTACT NUMBER  : </b><?php echo $infoB['phonenumber']; ?><br>
                <b style="font-family: arial; font-size: 15px; color: #00004d;"> PHOTOGRAPHER ID :</b> <?php echo $infoB['photographerID']; ?><br>
		<b style="font-family: arial; font-size: 15px; color: #00004d;"> HOME ADDRESS  : </b><?php echo $infoB['address']; ?><br>
                <br><br> 
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
            <?php } else { ?>
                <p>No photographer information available.</p>
            <?php } ?>
        </fieldset>
    </center>
</body>
</html>