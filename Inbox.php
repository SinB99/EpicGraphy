<?php
require('config.php');
include('session.php');

// Retrieve the list of received messages for the current user
$photographerID = $_SESSION['photographerID'];
$sql = "SELECT * FROM messages WHERE photographerID = '$photographerID' ORDER BY date_time DESC";
$result = mysqli_query($conn, $sql);

// Check if any messages are found
if (mysqli_num_rows($result) > 0) {
    // Display the list of messages
    while ($row = mysqli_fetch_assoc($result)) {
        $messageID = $row['messageID'];
        $senderID = $row['photographerID'];
        $message = $row['message'];
        $dateTime = $row['date_time'];

        // Retrieve the sender's details from the 'photographer' table
        $senderQuery = "SELECT * FROM photographer WHERE photographerID = '$senderID'";
        $senderResult = mysqli_query($conn, $senderQuery);
        $senderData = mysqli_fetch_assoc($senderResult);

        echo "<a href='ViewMessage.php?messageID=$messageID'>";
        echo "<strong>From:</strong> " . $senderData['photographerID'] . "<br>";
        echo "<strong>Date/Time:</strong> " . $dateTime . "<br>";
        echo "<strong>Message:</strong> " . $message;
        echo "</a>";
        echo "<hr>";
    }
} else {
    // Display a message if no messages are found
    echo "No messages found.";
}
?>

<!-- Add any additional HTML code as needed -->
