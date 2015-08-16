<?php


include ("dbinfo_li.php");

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
  

$dispatch_time = $_COOKIE["dispatch_time2"];

// $dispatch_time = ;


$sql = "SELECT order_customer_id, order_address, order_address_lat, order_address_lng,deliveryman_type FROM order_customer WHERE order_dispatch='$dispatch_time'";

$result = mysqli_query($connection,$sql)
  or die("Error:".mysqli_error($connection));

// $sql = "SELECT order_id, user_id FROM order WHERE dispatch_time='$dispatch_time'";
// $result = mysqli_query($connection, $sql);


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
  echo 'address="' . parseToXML($row['order_address']) . '" ';
  echo 'lat="' . $row['order_address_lat'] . '" ';
  echo 'lng="' . $row['order_address_lng'] . '" ';
  echo 'type="' . $row['deliveryman_type'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
