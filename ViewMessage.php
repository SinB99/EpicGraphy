<?php
require('config.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['photographerID'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit;
}

$photographerID = $_SESSION['photographerID'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SIMPAN'])) {
    // Get the message details from the form
    $receiverID = $_GET['senderID'];
    $message = $_POST['message'];

    // Insert the message into the 'messages' table
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$photographerID', '$receiverID', '$message')";
    $hasil = mysqli_query($conn, $sql);

   /* if ($hasil) {
        echo "<script>alert('Message sent');
            window.location='ViewMessage.php?senderID=$receiverID'</script>";
    } else {
        echo "<script>alert('Failed to send the message');
            window.location='ViewMessage.php?senderID=$receiverID'</script>";
    } */
}

// Retrieve the selected sender ID from the URL parameter
if (isset($_GET['senderID'])) {
    $senderID = $_GET['senderID'];

    // Retrieve the messages between the logged-in user and the selected sender
    $messagesQuery = "SELECT * FROM messages WHERE (sender_id = '$senderID' AND receiver_id = '$photographerID') OR (sender_id = '$photographerID' AND receiver_id = '$senderID') ORDER BY timestamp";
    $messagesResult = mysqli_query($conn, $messagesQuery);
} else {
    // If no sender ID is provided, redirect to the message.php page
    header("Location: message.php");
    exit;
}
?>

<!-- HTML code starts -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>View Message</title>

    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
	    border: 1px solid black;
        }

        th, td {
            text-align: left;
            padding: 8px;
            text-align: center;
	    border: 1px solid black;
	    
        }

        tr:nth-child(even) {
            background-color: white;
	    border: 1px solid black;
        }

        th {
            background-color:  #00ace6;
            color: white;
        }

        * {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid black;
            margin-bottom: 12px;
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid black;
            font-size: 18px;
        }

        #myTable th, #myTable td {
            text-align: left;
            padding: 12px;
	    border: 1px solid black;
        }

        #myTable tr {
            border-bottom: 1px solid black;
        }

        #myTable tr.header, #myTable tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body bgcolor="#d6d6c2">

<?php include('navbar_photographer.html') ?>
</div>
<br>
<center>
    <h2 style="color: #00004d;">View Message</h2>

    <fieldset>
        <!-- Display the messages between the logged-in user and the selected sender -->
        <h2>Chat</h2>
        <table>
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($messagesResult)) : ?>
                <tr>
                    <td><?php echo $row['sender_id']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Form to send a new message -->
        <h2>Reply</h2>
        <form action="ViewMessage.php?senderID=<?php echo $senderID; ?>" method="post">
            <label for="message">Message:</label>
	    <br>
	    <br>
            <textarea name="message" id="message" rows="4" cols="50"></textarea>
            <br>
	    <br>
            <button type="submit" name="SIMPAN">Send Message</button>
        </form>

    </fieldset>
</center>
</body>
</html>
