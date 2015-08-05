<?php

$servername = "localhost";
$name = "root";
$password = "dream900412";
$dbname = "spdb";






// $connection=mysql_connect ('localhost', $username, $password);
// if (!$connection) {  die('Not connected : ' . mysql_error());}

// // Set the active MySQL database

// $db_selected = mysql_select_db($database, $connection);
// if (!$db_selected) {
//   die ('Can\'t use db : ' . mysql_error());
// }

// Opens a connection to a MySQL server
$conn = new mysqli($servername, $name, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
// Select all the rows in the markers table


$center_lat = $_GET["lat"];
$center_lng = $_GET["lng"];
$radius = $_GET["radius"];

// Start XML file, create parent node
$dom = new DOMDocument("1.0");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node);

$query = sprintf("SELECT address, name, lat, lng, ( 3959 * acos( cos( radians('%s') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('%s') ) + sin( radians('%s') ) * sin( radians( lat ) ) ) ) AS distance FROM markers HAVING distance < '%s' ORDER BY distance LIMIT 0 , 20",
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($center_lng),
  mysql_real_escape_string($center_lat),
  mysql_real_escape_string($radius));


$result = $conn->query($query);



header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

while ($row=$result->fetch_assoc()){
  // ADD TO XML DOCUMENT NODE
  $node = $dom->createElement("marker");
  $newnode = $parnode->appendChild($node);
  $newnode->setAttribute("name", $row['name']);
  $newnode->setAttribute("address", $row['address']);
  $newnode->setAttribute("lat", $row['lat']);
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("distance", $row['distance']);
}

echo $dom->saveXML();

?>

