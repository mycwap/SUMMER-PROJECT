<?php
include ("dbconnector.php");

function parseToXML($htmlStr) 
{ 
$xmlStr=str_replace('<','&lt;',$htmlStr); 
$xmlStr=str_replace('>','&gt;',$xmlStr); 
$xmlStr=str_replace('"','&quot;',$xmlStr); 
$xmlStr=str_replace("'",'&#39;',$xmlStr); 
$xmlStr=str_replace("&",'&amp;',$xmlStr); 
return $xmlStr; 
} 

// Opens a connection to a MySQL server
$connection = mysqli_connect($servername, $username, $password);
if (!$connection) {
  die('Not connected : ' . mysqli_connect_error());
}

// Set the active MySQL database
$db_selected = mysqli_select_db($connection,$database);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysqli_connect_error());
}

$cuisines = $_COOKIE["cuisines_type"];

// Select all the rows in the markers table
$query = "SELECT business_id, business_name, business_address, business_address_lat, business_address_lng ,cuisine_type_id FROM business WHERE cuisine_type_id='$cuisines'";
$result = mysqli_query($connection, $query);
if (!$result) {
  die('Invalid query: ' . mysqli_connect_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<business ';
  echo 'name="' . parseToXML($row['business_name']) . '" ';
  echo 'address="' . parseToXML($row['business_address']) . '" ';
  echo 'lat="' . $row['business_address_lat'] . '" ';
  echo 'lng="' . $row['business_address_lng'] . '" ';
  echo 'type="' . $row['cuisine_type_id'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
