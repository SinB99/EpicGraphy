<?php
// sambung ke pangkalan data
require('config.php');
include('session.php');

$serviceID = $_GET['service'];

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Retrieve form data
    $photographerID = $_POST['photographerID'];
    $userID = $_POST['userID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $eventDate = $_POST['event_date'];
    $eventType = $_POST['event_type'];
    $location = $_POST['location'];
    $message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO service_requests (photographerID, userID, serviceID, name, email, phone, event_date, event_type, location, message) 
            VALUES ('$photographerID', '$userID', '$serviceID', '$name', '$email', '$phone', '$eventDate', '$eventType', '$location', '$message')";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "<script>alert('Your service request was successfully posted');
        window.location='BrowseServiceSS.php'</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Retrieve Photographer ID based on serviceID
$photographerData = mysqli_query($conn, "SELECT photographerID FROM serviceadvertizing WHERE serviceID = '$serviceID'");
$photographerInfo = mysqli_fetch_array($photographerData);
$photographerID = $photographerInfo['photographerID'];

// Retrieve data from the "serviceadvertizing" table
$dataA = mysqli_query($conn, "SELECT * FROM serviceadvertizing WHERE serviceID = '$serviceID'");
$infoA = mysqli_fetch_array($dataA);
?>

<!-- HTML Start -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Request Service Form</title>

<style type="text/css">
    /* Add your CSS styles here */
</style>
</head>
<body bgcolor="#d6d6c2">

<?php include('navbar_serviceSeeker.html') ?>
<br>
<center><h2 style="color: #00004d;">Request Service</h2>

<fieldset>
<form name="form1" method="post" action="request_service.php?service=<?php echo $serviceID; ?>" enctype="multipart/form-data">
    <label for="photographerID">Photographer ID:</label>
    <input type="text" id="photographerID" name="photographerID" value="<?php echo $photographerID; ?>" readonly><br>

    <br>
    <label for="serviceID">Service ID:</label>
    <input type="text" id="serviceID" name="serviceID" value="<?php echo $infoA['serviceID']; ?>" readonly><br>

    <br>
    <label for="userID">User ID:</label>
    <input type="text" id="userID" name="userID" placeholder="Enter User ID" required><br>

    <br>
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br>
    
    <br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    
    <br>
    <label for="phone">Phone:</label>
    <input type="text" id="phone" name="phone" required><br>
    
    <br>
    <label for="event_date">Event Date:</label>
    <input type="date" id="event_date" name="event_date" required><br>
    
    <br>
    <label for="event_type">Event Type:</label>
    <input type="text" id="event_type" name="event_type" required><br>
    

    <br>
    <label for="location">Location:</label>
    <select id="location" name="location" required="required" style="width: 15%;">
        <option value=" "> --Choose--</option>
        <option value="Sabah">Sabah</option>
        <option value="Sarawak">Sarawak</option>
        <option value="Johor">Johor</option>
        <option value="Pahang">Pahang</option>
        <option value="Melaka">Melaka</option>
        <option value="Negeri Sembilan">Negeri Sembilan</option>
        <option value="Selangor">Selangor</option>
        <option value="Kuala Lumpur">Kuala Lumpur</option>
        <option value="Terengganu">Terengganu</option>
        <option value="Kelantan">Kelantan</option>
        <option value="Perak">Perak</option>
        <option value="Perlis">Perlis</option>
    </select>
    
    <br>
    <br>
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea><br>
    
    <br>
    <input type="submit" name="submit" value="Submit">
</form>
</fieldset>

<br>
</body>
</html>
