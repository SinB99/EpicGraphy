<?php
//sambung ke pangkalan data
require('config.php');
//mulakan sesi login untuk kekalkan login
session_start();
//ambil nilai yang dihantar
if (isset($_SESSION['photographerID'])){
 }
 
//semak sama ada data dengan ID pengguna nama telah dihantar
if (isset($_POST['photographerID'])) {
//pembolehubah untuk memegang data yang dihantar
 $photographerID = $_POST['photographerID'];
 $password = $_POST['password'];

//arahan sql akan dilaksanakan
$sql = "SELECT * FROM photographer WHERE photographerID='$photographerID' AND password='$password'";
//melaksanakan pertanyaan sql dgn sambungan ke db
 $hasil = mysqli_query($conn, $sql);

if (mysqli_num_rows($hasil)){

 $_SESSION['photographerID'] = $photographerID;

 header("Location: portfolio.php");
 }
 else {

 echo "<script>alert('Photographer ID wrong');
   window.location='index.php'</script>";
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

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            outline: none;
            border: none;
            border-radius: 5px;
            box-shadow: 0 3px #999;
            cursor: pointer;
            font-family: Arial, sans-serif;
        }

        .btn-primary {
            background-color: #000033;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #000066;
        }

        .login-box {
            background-color: #a7bed3;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .login-box h3 {
            font-family: Arial;
        }

        .login-box label {
            display: block;
            margin-bottom: 10px;
            font-family: Arial;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 100%;
        }

        .banner {
            width: 100%;
            height: auto;
            margin-bottom: 20px;
        }
    </style>
</head>
<body bgcolor="#d6d6c2">
    <?php include('navbar2.html') ?>
    <br>
    <center>
        <img src="banner1.png" alt="Banner Image" class="banner">
        <table>
            <tr>
                <td width="50%" align="center">
                    <div class="login-box">
                        <h3>Login</h3>
                        <form method="POST">
                            <label for="inputIDUser">Username</label>
                            <input type="text" name="photographerID" placeholder="Username" required><br><br>
                            <label for="inputPassword">Password</label>
                            <input type="password" name="password" id="inputPassword" placeholder="Password" required><br><br>
                            <input type="submit" value="LOG IN" class="btn btn-primary btn-lg"><br>
                        </form>
                    </div>
                
            </tr>
        </table>
    </center>
</body>
</html>
