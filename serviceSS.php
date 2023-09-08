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

<?php include('navbar_serviceSeeker.html') ?>
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
<a href="request_serviceSS.php?service=<?php echo $infoA['serviceID'];?>" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none;">Request Service</a>

<!-- Add the "Message" button with a link to the message page -->
<a href="message.php?photographer=<?php echo $infoA['photographerID'];?>" style="background-color: #008CBA; color: white; padding: 10px 20px; text-decoration: none; margin-left: 10px;">Message</a>

<!-- Add the "Photographer Portfolio" button with a link to the viewportfolio page -->
<a href="viewportfolioss.php?photographerID=<?php echo $infoA['photographerID']; ?>" style="background-color: #FFC107; color: white; padding: 10px 20px; text-decoration: none; margin-left: 10px;">Photographer Portfolio</a>

</fieldset>

</body>
</html>