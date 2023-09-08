<?php
// sambung ke pangkalan data
require('config.php');
include('session.php');

$photographerID = $_SESSION['photographerID'];
// $serviceID = $_SESSION['serviceID'];
// memastikan pengguna login terlebih dahulu
?>

<!-- HTML Starts -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
<title>BROWSE SERVICES</title>

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
<center><h2 style="color: #00004d;">BROWSE SERVICES</h2>

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

    <label for="priceFilter">Filter by Price:</label>
    <select id="priceFilter" onchange="filterTable()">
        <option value="">All Prices</option>
        <?php
        // Retrieve distinct prices from the database
        $distinctPricesQuery = mysqli_query($conn, "SELECT DISTINCT price FROM serviceadvertizing");
        while ($priceRow = mysqli_fetch_array($distinctPricesQuery)) {
            $price = $priceRow['price'];
            echo "<option value='$price'>$price</option>";
        }
        ?>
    </select>

    <table width="80%" align="center" id="myTable">
        <tr>
            <th><b>SERVICE TYPE</b></th>
            <th><b>SERVICE DETAIL</b></th>
            <th><b>LOCATION</b></th>
            <th><b>PRICE (RM)</b></th>
        </tr>
        <?php
        // Display service advertising list
        $dataA = mysqli_query($conn,"SELECT * FROM serviceadvertizing ORDER BY date_time DESC");
        $no = 1; // pemula bagi pembilang
        while ($infoA = mysqli_fetch_array($dataA)) {
            ?>
            <tr>
                <!-- panggil semula rekod ke dalam baris -->
                <td><a href="serviceSS.php?serviceID=<?php echo $infoA['serviceID']; ?>"><?php echo $infoA['service']; ?></a></td>
                <td><?php echo $infoA['detail']; ?></td>
                <td><?php echo $infoA['location']; ?></td>
                <td><?php echo $infoA['price']; ?></td>
            </tr>
            <?php
            $no++; // increment
        }
        ?>
    </table>

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

</body>