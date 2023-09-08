<?php
session_start();

if (!isset($_SESSION["photographerID"]) && !isset($_SESSION["userID"]) && !isset($_SESSION["artworkID"]) && !isset($_SESSION["serviceID"]) && !isset($_SESSION["Course_ID"])) {
    header("Location:index.php");
    exit();
}

// $photographerID = $_SESSION['photographerID'];
// $userID = $_SESSION['userID'];

// memastikan pengguna login terlebih dahulu
?>
