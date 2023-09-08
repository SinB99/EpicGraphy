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
            window.location='messagess.php'</script>";
    } else {
        echo "<script>alert('Failed to send the message');
            window.location='messagess.php'</script>";
    }
}

// Retrieve the inbox messages for the logged-in user
$inboxQuery = "SELECT * FROM messages WHERE receiver_id = '$photographerID'";
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
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: white;
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
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myTable {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #ddd;
            font-size: 18px;
        }

        #myTable th, #myTable td {
            text-align: left;
            padding: 12px;
        }

        #myTable tr {
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header, #myTable tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body bgcolor="#d6d6c2">

<?php include('navbar_serviceSeeker.html') ?>
</div>
<br>
<center>
    <h2 style="color: #00004d;">MESSAGE</h2>

    <fieldset>
        <!-- Display the inbox messages -->
        <h2>Inbox</h2>
        <table>
            <thead>
                <tr>
                    <th>Sender</th>
                    <th>Message</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($inboxResult)) : ?>
                <tr>
                    <td><?php echo $row['sender_id']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['timestamp']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Form to send a new message -->
        <h2>Compose Message</h2>
        <form action="messagess.php" method="post">
            <label for="receiverID">Receiver ID:</label>
            <select name="receiverID" id="receiverID">
                <?php while ($userRow = mysqli_fetch_assoc($usersResult)) : ?>
                    <option value="<?php echo $userRow['photographerID']; ?>"><?php echo $userRow['photographerID']; ?></option>
                <?php endwhile; ?>
            </select>
            <br>
            <label for="message">Message:</label>
            <textarea name="message" id="message" rows="4" cols="50"></textarea>
            <br>
            <button type="submit" name="SIMPAN">Send Message</button>
        </form>

    </fieldset>
</center>
</body>
</html>