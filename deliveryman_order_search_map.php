<?php


include ("dbinfo.php");

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
  

$dispatch_time = $_COOKIE["dispatch_time"];

// $dispatch_time = ;


$sql = "SELECT order_customer_id, delivery_address, delivery_address_lat, delivery_address_lng, deliveryman_type FROM order_customer WHERE order_dispatch='$dispatch_time'";

$result = mysqli_query($connection,$sql)
  or die("Error:".mysqli_error($connection));



if (!$result) {
  die('Invalid query: ' . mysqli_connect_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = mysqli_fetch_assoc($result)){
  // ADD TO XML DOCUMENT NODE
  echo '<deliveryman ';
  echo 'name="' . parseToXML($row['order_customer_id']) . '" ';
  echo 'address="' . parseToXML($row['delivery_address']) . '" ';
  echo 'lat="' . $row['delivery_address_lat'] . '" ';
  echo 'lng="' . $row['delivery_address_lng'] . '" ';
  echo 'type="' . $row['deliveryman_type'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
