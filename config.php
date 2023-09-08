<?php

$conn=mysqli_connect("localhost","root","","fyp");

if (mysqli_connect_error()){
	echo "Failed to connect to database : ".mysqli_connect_error();
}
?>