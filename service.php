<?php
//sambung ke pangkalan data
require('config.php');
include('session.php');

$photographerID = $_SESSION['photographerID'];
 $serviceID = $_GET['serviceID'];

// if (isset($_GET['serviceID'])) {
//     $serviceID = $_GET['serviceID'];
// } else {
//     // Service ID tidak ditemukan, lakukan tindakan yang sesuai (misalnya, redirect ke halaman lain)
//     // ...
//     exit;
// }
?>

<!--HTML Bermula-->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>DETAILED SERVICE</title>

<style type="text/css">
    /* Add your CSS styles here */
</style>
</head>
<body bgcolor="#d6d6c2">

<?php include('navbar_photographer.html') ?>
</div>
<br>
<center><h2 style="color: #00004d;">DETAILED SERVICE</h2>

<fieldset>
    
  <table width="auto" border="1"  class="imagetable">

  <?php
 
 $dataA = mysqli_query($conn, "SELECT * FROM serviceadvertizing WHERE serviceID='$serviceID'");
 $infoA = mysqli_fetch_array($dataA);
 
 ?>

<tr>
<td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;" ><b>Service ID </b></td>
  <td style="width: auto; padding-left: 5px; height: auto;"><?php echo $infoA['serviceID']; ?></td>
</tr>

<tr>
<td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;" ><b>Photographer ID </b></td>
<td style="width: auto; padding-left: 5px; height: auto;"><?php echo $infoA['photographerID']; ?></td>
</tr>

<tr>
<td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;" ><b>Service </b></td>
<td style="width: auto; padding-left: 5px; height: auto;"><?php echo $infoA['service']; ?></td>
</tr>

<tr>
<td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;" ><b>Detail </b></td>
<td style="width: auto; padding-left: 5px; height: auto;"><?php echo $infoA['detail']; ?></td>
</tr>
 
 <tr>
<td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;" ><b>Location </b></td>
<td style="width: auto; padding-left: 5px; height: auto;"><?php echo $infoA['location']; ?></td>
</tr>
 
 <tr>
<td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;" ><b>Price (RM) </b></td>
<td style="width: auto; padding-left: 5px; height: auto;"><?php echo $infoA['price']; ?></td>
</tr>
 
 <tr>
<td width="200" style="background-color: #FF8500; color: white; text-align: center; height: 50px;" ><b>Date & Time </b></td>
<td style="width: auto; padding-left: 5px; height: auto;"><?php echo $infoA['date_time']; ?></td>
</tr>
 
</table>
<br><br>


            <!-- Add the "Request Service" button with a link to the request service form -->
            <a href="request_service.php?service=<?php echo $infoA['serviceID'];?>" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none;">Request Service</a>

	    <!-- Add the "View Portfolio" button with a link to the portfolio page -->
	    <a href="viewportfolio.php?photographerID=<?php echo $infoA['photographerID']; ?>" style="background-color: #3366cc; color: white; padding: 10px 20px; text-decoration: none;">View Portfolio</a>

		<!-- Add the "Message" button with a link to the portfolio page -->
		<a href="message.php?photographerID=<?php echo $infoA['photographerID']; ?>" style="background-color: #737373; color: white; padding: 10px 20px; text-decoration: none;">Message</a>	    

</fieldset>

</body>
</html>

