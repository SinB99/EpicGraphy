<?php 
// sambung ke pangkalan data
require('config.php');
include('session.php');

$photographerID = $_SESSION['photographerID'];

// semak sama ada data telah dihantar
if (isset($_POST['submit'])) {

    // pemboleubah untuk memegang data yang dihantar
    $photographerID = $_POST['photographerID'];
    $service = $_POST['service'];
    $detail = $_POST['detail'];
    $location = $_POST['location'];
    $price = $_POST['price'];

    $sql = "INSERT INTO serviceadvertizing (photographerID, service, detail, location, price, date_time) VALUES ('$photographerID', '$service', '$detail', '$location', '$price', NOW())";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "<script>alert('Your service successfully advertised');
        window.location='BrowseService.php'</script>";
    } else {
        // Handle error case
    }
}

// Retrieve photographer ID from the database
$dataA = mysqli_query($conn, "SELECT * FROM photographer WHERE photographerID ='$photographerID'");
$infoA = mysqli_fetch_array($dataA);

?>
<!-- HTML bermula -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <title>POST YOUR SERVICES</title>
    <style>
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
        .form-style-2 input[type="number"],
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
    <h2>POST YOUR SERVICE</h2>

    <div class="form-container">
        <form method="POST" class="form-style-2">
            <label for="photographerID" style="display: none;"><span>Photographer ID <span class="required"></span></span>
                <input type="text" id="photographerID" name="photographerID" value="<?php echo $photographerID; ?>" style="display: none;">
            </label>

            <label for="service"><span>Service Type <span class="required"></span></span>
                <select id="service" name="service" required="required">
                    <option value="">--Choose--</option>
                    <option value="Wedding">Wedding</option>
                    <option value="Graduation">Graduation</option>
                    <option value="Engagement">Engagement</option>
                    <option value="Birthday Party">Birthday Party</option>
                    <option value="Baby Shower">Baby Shower</option>
                    <option value="Pre Weeding">Pre Wedding</option>
                    <option value="Photoshoot">Photoshoot</option>
                    <option value="Event">Event</option>
                </select>
            </label>

            <label for="detail"><span>Detail Description <span class="required"></span></span>
                <textarea name="detail" rows="5" cols="40" id="detail" name="detail" placeholder="Detail" required="required"></textarea>
            </label>

            <label for="location"><span>Location <span class="required"></span></span>
                <select id="location" name="location" required="required">
                    <option value="">--Choose--</option>
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
            </label>

            <label for="price"><span>Price RM<span class="required">*</span></span>
                <input type="text" name="price" size="12" placeholder="Price" class="input-field" required>
            </label>

            <br><input type="submit" name="submit" value="POST">
        </form>
    </div>
</center>

<br><br>

</body>
</html>
