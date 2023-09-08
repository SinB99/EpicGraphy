<?php
// sambung ke pangkalan data
require('config.php');
include('session.php');

// memastikan pengguna login terlebih dahulu
$photographerID = $_SESSION['photographerID'];
$serviceID = $_GET['service']; // Updated variable name to match the query parameter

// Check if the form is submitted
    if (isset($_POST['submit'])) {

    // Retrieve form data
    $photographerID = $_POST['photographerID'];
    $serviceID = $_POST['serviceID'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $eventDate = $_POST['event_date'];
    $eventType = $_POST['event_type'];
    $location = $_POST['location'];
    $message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO service_requests (photographerID, serviceID, name, email, phone, event_date, event_type, location, message) 
            VALUES ('$photographerID', '$serviceID' ,'$name', '$email', '$phone', '$eventDate', '$eventType', '$location', '$message')";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "<script>alert('Your service successfully posted');
        window.location='BrowseService.php'</script>";
    } else {
        // Handle error case
    }
}
?>

<!-- HTML Bermula -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>Request Service Form</title>

<style type="text/css">
    body {
        font-family: Arial, sans-serif;
        background-color: #d6d6c2;
    }

    h2 {
        color: #333;
        text-align: center;
    }

    .form-container {
        max-width: 500px;
        padding: 20px;
        margin: 0 auto;
        background-color: #d6d6c2;
        border: 2px solid #000000;
        border-radius: 5px;
    }

    .form-style-2 label {
        display: block;
        margin-bottom: 10px;
    }

    .form-style-2 label > span {
        width: 100px;
        font-weight: bold;
        float: left;
        padding-top: 8px;
        padding-right: 5px;
    }

    .form-style-2 input[type="text"],
    .form-style-2 input[type="email"],
    .form-style-2 input[type="date"],
    .form-style-2 textarea,
    .form-style-2 select {
        width: 60%;
        padding: 8px;
        border: 1px solid #ccc;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }

    .form-style-2 input[type="submit"] {
        background: linear-gradient(to bottom, #64b96a 5%, #4caf50 100%);
        background-color: #4caf50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        box-shadow: 1px 1px 4px #888888;
        -moz-box-shadow: 1px 1px 4px #888888;
        -webkit-box-shadow: 1px 1px 4px #888888;
        cursor: pointer;
    }

    .form-style-2 input[type="submit"]:hover {
        background: linear-gradient(to bottom, #73d077 5%, #4caf50 100%);
        background-color: #73d077;
    }
</style>
</head>
<body>

<?php include('navbar_photographer.html') ?>

<br>
<center>
    <h2 style="color: #00004d;">Request Service</h2>

    <div class="form-container">
        <form name="form1" method="post" action="request_service.php" enctype="multipart/form-data" class="form-style-2">
            <?php
            // Retrieve photographer username from the database
            $dataA = mysqli_query($conn, "SELECT * FROM serviceadvertizing where serviceID = '$serviceID'");
            $infoA = mysqli_fetch_array($dataA);
            ?>

            <label for="photographerID"><span>Photographer ID</span></label>
            <input type="text" id="photographerID" name="photographerID" value="<?php echo $infoA['photographerID']; ?>"><br>

            <br>
            <label for="serviceID"><span>Service ID</span></label>
            <input type="text" id="serviceID" name="serviceID" value="<?php echo $infoA['serviceID']; ?>"><br>

            <br>
            <label for="name"><span>Name</span></label>
            <input type="text" id="name" name="name" required><br>
            <br>
            <label for="email"><span>Email</span></label>
            <input type="email" id="email" name="email" required><br>
            <br>
            <label for="phone"><span>Phone</span></label>
            <input type="text" id="phone" name="phone" required><br>
            <br>
            <label for="event_date"><span>Event Date</span></label>
            <input type="date" id="event_date" name="event_date" required><br>
            <br>
            <label for="event_type"><span>Event Type</span></label>
            <select id="event_type" name="event_type" required="required" style="width: 60%;">
                <option value=" "> --Choose--</option>
                <option value="Wedding">Wedding</option>
                <option value="Graduation">Graduation</option>
                <option value="Engagement">Engagement</option>
                <option value="Birthday Party">Birthday Party</option>
                <option value="Baby Shower">Baby Shower</option>
                <option value="Pre Weeding">Pre Weeding</option>
                <option value="Photoshoot">Photoshoot</option>
                <option value="Event">Event</option>
            </select>
            <br><br>
            <label for="location"><span>Location</span></label>
            <select id="location" name="location" required="required" style="width: 60%;">
                <option value=" "> --Choose--</option>
                <option value="Sabah">Sabah</option>
                <option value="Sarawak">Sarawak</option>
                <option value="Johor">Johor</option>
                <option value="Pahang">Pahang</option>
                <option value="Melaka">Melaka</option>
                <option value="Negeri sembilan">Negeri sembilan</option>
                <option value="Selangor">Selangor</option>
                <option value="Kuala Lumpur">Kuala Lumpur</option>
                <option value="Terengganu">Terengganu</option>
                <option value="Kelantan">Kelantan</option>
                <option value="Perak">Perak</option>
                <option value="Perlis">Perlis</option>
            </select>
            <br><br>
            <label for="message"><span>Message</span></label>
            <textarea id="message" rows="5" cols="40" name="message" required></textarea><br>
		<br>
            <input type="submit" name="submit" value="Submit">
        </form>
    </div>
</center>

</body>
</html>


