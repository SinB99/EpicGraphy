<?php
require('config.php');
include('session.php');

$photographerID = $_SESSION['photographerID'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $requestId = $_POST['requestID'];
    $status = $_POST['status'];

    // Update the status in the database
    $sql = "UPDATE service_requests SET status = '$status' WHERE requestId = $requestId";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "<script>alert('Your status updated successfully');
        window.location='completed.php'</script>";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
}

// Fetch service requests from the database
$dataA = mysqli_query($conn, "SELECT * FROM service_requests WHERE photographerID = '$photographerID'");

// Check if the status is "completed"
while ($infoA = mysqli_fetch_array($dataA)) {
    if ($infoA['status'] !== "completed") {
        // Display the table only for non-completed requests
        break;
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ongoing Services</title>
    <!-- Add your CSS styling here -->
</head>
<body bgcolor="#d6d6c2">

<?php include('navbar_photographer.html'); ?>

<h2>Ongoing Services</h2>

<table width="auto" border="1" data-name="mytable" class="mytable">
    <tr class="header">
        <td width="800" style="background-color: #00ace6; color: white; text-align: center;"><b>Requested By </b></td>
        <td width="800" style="background-color: #00ace6; color: white; text-align: center;"><b>Email </b></td>
        <td width="800" style="background-color: #00ace6; color: white; text-align: center;"><b>Phone </b></td>
        <td width="300" style="background-color: #00ace6; color: white; text-align: center;"><b>Event Date</b></td>
        <td width="300" style="background-color: #00ace6; color: white; text-align: center;"><b>Event Type</b></td>
        <td width="800" style="background-color: #00ace6; color: white; text-align: center;"><b>Location </b></td>
        <td width="800" style="background-color: #00ace6; color: white; text-align: center;"><b>Message </b></td>
        <td width="800" style="background-color: #00ace6; color: white; text-align: center;"><b>Status </b></td>
    </tr>

    <?php
    // Fetch service requests from the database
    $dataA = mysqli_query($conn, "SELECT * FROM service_requests WHERE photographerID = '$photographerID'");

    while ($infoA = mysqli_fetch_array($dataA)) {
        if ($infoA['status'] !== "completed") {
            // Display the table only for non-completed requests
            ?>
            <tr>
                <!-- panggil semula rekod ke dalam baris -->
                <td style="text-align: center;"><?php echo $infoA['name']; ?></a></td>
                <td style="text-align: center;"><?php echo $infoA['email']; ?></a></td>
                <td style="text-align: center;"><?php echo $infoA['phone']; ?></a></td>
                <td style="text-align: center;"><?php echo $infoA['event_date']; ?></a></td>
                <td style="text-align: center;"><?php echo $infoA['event_type']; ?></a></td>
                <td style="text-align: center;"><?php echo $infoA['location']; ?></a></td>
                <td style="text-align: center;"><?php echo $infoA['message']; ?></a></td>

                <td style="text-align: center; padding-top: 5px; padding-bottom: 5px;">
                    <form method="POST" action="ongoingservices.php">
                        <input type="hidden" name="requestID" value="<?php echo $infoA['requestID']; ?>">
                        <input type="hidden" name="status" value="completed">
                        <button type="submit" class="btn btn-primary btn-lg" style="font-size: 15px;">Completed</button>
                    </form>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>

</body>
</html>
