<?php
$servername = "localhost";
$username="root";
$password="dream900412";
$database="spdb";


    $connection = mysqli_connect($servername, $username, $password);
    if (!$connection) {
    die('Not connected : ' . mysqli_connect_error());
    }

// Set the active MySQL database
    $db_selected = mysqli_select_db($connection,$database);
    if (!$db_selected) {
    die ('Can\'t use db : ' . mysqli_connect_error());
    }
?>