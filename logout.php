<?php
// tamatkan sesi log in
session_start();

session_destroy();
//link ke utama
header("Location: index.php");
exit;


?>