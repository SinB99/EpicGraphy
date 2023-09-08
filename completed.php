<?php
require('config.php');
include('session.php');

$photographerID = $_SESSION['photographerID'];
// $serviceID = $_SESSION['serviceID'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Completed Services</title>
    <!-- Add your CSS styling here -->
</head>
<body bgcolor="#d6d6c2" >
    
    <?php include('navbar_photographer.html'); ?>

    <h2>Completed Services</h2>

<table width="auto" border="1"  data-name="mytable" class="mytable">

<tr class="header">
<td width="800" style="background-color: #00ace6; color: white; text-align: center;" ><b>Requested By </b></td>
<td width="800" style="background-color: #00ace6; color: white; text-align: center;" ><b> Email </b></td>
<td width="800" style="background-color: #00ace6; color: white; text-align: center;" ><b>Phone </b></td>
<td width="300" style="background-color: #00ace6; color: white; text-align: center;" ><b>Event Date</b></td>
<td width="300" style="background-color: #00ace6; color: white; text-align: center;" ><b>Event Type</b></td>
<td width="800" style="background-color: #00ace6; color: white; text-align: center;" ><b> Location </b></td>
<td width="800" style="background-color: #00ace6; color: white; text-align: center;" ><b>Message </b></td>
<td width="800" style="background-color: #00ace6; color: white; text-align: center;" ><b>Status </b></td>
</tr>

<?php
//Papar senarai post yang disusun mengikut susunan menaik
$dataA = mysqli_query($conn, "SELECT * FROM service_requests WHERE photographerID = '$photographerID'");

    while($infoA=mysqli_fetch_array($dataA))
    {
    ?>
    
  <tr>
      <!-- panggil semula rekod ke dalam baris -->
    
    <td style="text-align: center;"><?php echo $infoA['name'];?></a></td>
    <td style="text-align: center;"><?php echo $infoA['email'];?></a></td>
    <td style="text-align: center;"><?php echo $infoA['phone'];?></a></td>
    <td style="text-align: center;"><?php echo $infoA['event_date'];?></a></td>
    <td style="text-align: center;"><?php echo $infoA['event_type'];?></a></td>
    <td style="text-align: center;"><?php echo $infoA['location'];?></a></td>
    <td style="text-align: center;"><?php echo $infoA['message'];?></a></td>
    <td style="text-align: center;"><?php echo $infoA['status'];?></a></td>

  </tr>
  <?php

}
?>
</table>


</body>
</html>