<?php
require('config.php');
include('session.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SIMPAN'])) {
    // Get the message from the form
    $photographerID = $_POST["photographerID"];
    $message = $_POST["message"];

    // Insert the message into the 'messages' table
    $sql = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$photographerID', '$receiverID', '$message')";
    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        echo "<script>alert('Message sent');
            window.location='message.php'</script>";
    } else {
        echo "<script>alert('Failed to send the message');
            window.location='BrowseService.php'</script>";
    }
}
?>

<!-- HTML Starts -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>BROWSE SERVICES</title>

    <style type="text/css">
        .service-tile {
                           background-color: #d6d6c2;
                           padding: 10px;
                           margin-bottom: 20px;
                           border-radius: 5px;
                           width: 45%;
                           display: inline-block;
                           margin-right: 2%;
                           border: 1px solid black; /* Add border */
                           box-sizing: border-box; /* Include border in width calculation */
                       }       }

        .service-tile:nth-child(2n) {
            margin-right: 0;
        }

        .service-tile h3 {
            color: #00004d;
            margin-top: 0;
        }

        .service-tile p {
            margin-bottom: 0;
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

        #myTable th,
        #myTable td {
            text-align: left;
            padding: 12px;
        }

        #myTable tr {
            border-bottom: 1px solid #ddd;
        }

        #myTable tr.header,
        #myTable tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body bgcolor="#d6d6c2">

    <?php include('navbar_photographer.html') ?>
    <br>
    <center>
        <h2 style="color: #00004d;">BROWSE SERVICES</h2>

        <fieldset>

            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for service type..">

            <label for="locationFilter">Filter by Location:</label>
            <select id="locationFilter" onchange="filterTable()">
                <option value="">All Locations</option>
                <?php
                // Retrieve distinct locations from the database
                $distinctLocationsQuery = mysqli_query($conn, "SELECT DISTINCT location FROM serviceadvertizing");
                while ($locationRow = mysqli_fetch_array($distinctLocationsQuery)) {
                    $location = $locationRow['location'];
                    echo "<option value='$location'>$location</option>";
                }
                ?>
            </select>

	<br>
            <?php
            // Display service advertising list
            $dataA = mysqli_query($conn, "SELECT * FROM serviceadvertizing ORDER BY date_time DESC");
            $no = 1; // pemula bagi pembilang
            while ($infoA = mysqli_fetch_array($dataA)) {
                ?>
                <div class="service-tile">
                    <h3><a href="service.php?serviceID=<?php echo $infoA['serviceID']; ?>"><?php echo $infoA['service']; ?></a></h3>
                    <p><b>Location:</b> <?php echo $infoA['location']; ?></p>
                    <p><b>Price (RM):</b> <?php echo $infoA['price']; ?></p>
                </div>
                <?php
                $no++; // increment
            }
            ?>

            <button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
            <br>
            <script>
                function myFunction() {
                    var input, filter, table, tr, th, td, i, txtValue;
                    input = document.getElementById("myInput");
                    filter = input.value.toUpperCase();
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[0];
                        if (td) {
                            txtValue = td.textContent || td.innerText;
                            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }

                function filterTable() {
                    var inputLocation, inputPrice, table, tr, tdLocation, tdPrice, i;
                    inputLocation = document.getElementById("locationFilter");
                    inputPrice = document.getElementById("priceFilter");
                    table = document.getElementById("myTable");
                    tr = table.getElementsByTagName("tr");

                    for (i = 0; i < tr.length; i++) {
                        tdLocation = tr[i].getElementsByTagName("td")[2];
                        tdPrice = tr[i].getElementsByTagName("td")[3];
                        if (tdLocation && tdPrice) {
                            var locationValue = inputLocation.value;
                            var priceValue = inputPrice.value;

                            if (
                                (locationValue === "" || tdLocation.innerText === locationValue) &&
                                (priceValue === "" || tdPrice.innerText === priceValue)
                            ) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                }
            </script>
        </fieldset>
    </center>
</body>

</html>
