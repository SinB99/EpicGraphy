<?php
//sambung ke pangkalan data
require('config.php');
//mulakan sesi login untuk kekalkan login
session_start();
//ambil nilai yang dihantar
if (isset($_SESSION['photographerID'])) {
    header("Location: BrowseServiceSS.php");
    exit;
}

//semak sama ada data dengan ID pengguna nama telah dihantar
if (isset($_POST['photographerID'])) {
    //pembolehubah untuk memegang data yang dihantar
    $userID = $_POST['photographerID'];
    $password = $_POST['password'];

    //arahan sql akan dilaksanakan
    $sql = "SELECT * FROM photographer WHERE photographerID='$userID' AND password='$password'";
    //melaksanakan pertanyaan sql dgn sambungan ke db
    $hasil = mysqli_query($conn, $sql);

    if (mysqli_num_rows($hasil)) {
        $_SESSION['photographerID'] = $userID;
        header("Location: BrowseServiceSS.php");
        exit;
    } else {
        echo "<script>alert('user ID wrong');
        window.location='Service_Login.php'</script>";
    }
}
?>

<!-- HTML code continues... -->

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EpicGraphy</title>
    <link rel="stylesheet" type="text/css" href="ojt3.css">
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body bgcolor="#d6d6c2">
    <?php include('navbar2.html') ?>
    <br><br><br>

    <center>
        <table border="1" width="60%">
            <tr>
                <td width="900px" align="center" style="font-family: arial; font-size: 20px;">Login for Service Seeker</td>
            </tr>
            <td>
                <center>
                    <form method="POST">
                        <br><br>
                        <!-- <img src="admin.png" height="20%" width="20%"> -->
                        <br><label for="inputID"  style="font-family: arial; font-size: 15px; font-weight: bold;">User ID</label><br>
                        <input type="text" name="photographerID" placeholder="userID" required>
                        <br><br>
                        <label for="inputPassword" style="font-family: arial; font-size: 15px; font-weight: bold;">Password</label><br>
                        <input type="password" name="password" id="inputPassword" placeholder="Password" required><br><br>
                        <input type="submit" value="LOG IN" class="btn btn-primary btn-lg" style="background-color: #000033;"><br>
                    </form>
                </center>
                <br>
            </td>
        </tr>
    </table>
</center>
</body>
</html>

