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
    $receiverID = $_POST['receiverID'];
    $message = $_POST['message'];

    // Insert the message into the 'messages' table
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$photographerID', '$receiverID', '$message')";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "<script>alert('Message sent');
            window.location='message.php'</script>";
    } else {
        echo "<script>alert('Failed to send the message');
            window.location='message.php'</script>";
    }
}

// Retrieve the inbox messages for the logged-in user
$inboxQuery = "SELECT DISTINCT sender_id FROM messages WHERE receiver_id = '$photographerID'";
$inboxResult = mysqli_query($conn, $inboxQuery);

// Retrieve the list of available users to send messages to
$usersQuery = "SELECT photographerID FROM photographer WHERE photographerID != '$photographerID'";
$usersResult = mysqli_query($conn, $usersQuery);
?>

<!-- HTML code starts -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>MESSAGE</title>

    <style type="text/css">
        /* CSS styles for the inbox box */
        .inbox-box {
            background-color: #d6d6c2;
            padding: 20px;
            margin-bottom: 20px;
            border: 2px solid black;
        }

        .inbox-box table {
            border-collapse: collapse;
            width: 40%;
	    border: 1px solid black;
        }

        .inbox-box th, .inbox-box td {
            text-align: left;
            padding: 8px;
            text-align: center;
	    border: 1px solid black;
        }

        .inbox-box tr:nth-child(even) {
                    background-color: white;
                }

        .inbox-box th {
            background-color: #00ace6;
            color: white;
        }

        /* CSS styles for the compose message box */
        .compose-box {
            background-color: #d6d6c2;
            padding: 20px;
            border: 2px solid black;
        }

        .compose-box label {
            display: block;
            margin-bottom: 5px;
        }

        .compose-box select, .compose-box textarea {
            width: 30%;
            padding: 12px;
            border: 1px solid black;
            margin-bottom: 12px;
            resize: vertical;
        }

        .compose-box button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
        }

        .compose-box button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body bgcolor="#d6d6c2">

<?php include('navbar_photographer.html') ?>
</div>
<br>
<center>
    <h2 style="color: #00004d;">MESSAGE</h2>

    <div class="inbox-box">
        <!-- Display the inbox messages -->
        <h2>Inbox</h2>
        <table>
            <thead>
                <tr>
                    <th>Sender</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($inboxResult)) : ?>
                <tr>
                    <td><a href="ViewMessage.php?senderID=<?php echo $row['sender_id']; ?>"><?php echo $row['sender_id']; ?></a></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <div class="compose-box">
        <!-- Form to send a new message -->
        <h2>Compose Message</h2>
        <form action="message.php" method="post">
            <label for="receiverID">Receiver ID:</label>
            <select name="receiverID" id="receiverID">
                <?php while ($userRow = mysqli_fetch_assoc($usersResult)) : ?>
                    <option value="<?php echo $userRow['photographerID']; ?>"><?php echo $userRow['photographerID']; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="message">Message:
	    </label>
            <textarea name="message" id="message" rows="4" cols="50"></textarea>
	    </label>
            <br>
            <button type="submit" name="SIMPAN">Send Message</button>
        </form>
    </div>

</center>
</body>
</html>
