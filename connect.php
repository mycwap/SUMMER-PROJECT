<?php
$servername = "localhost";
$name = "root";
$password = "dream900412";
$dbname = "spdb";

// Create connection
$conn = new mysqli($servername, $name, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

?>

