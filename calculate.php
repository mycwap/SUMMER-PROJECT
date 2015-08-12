<?php 
$business_id = $_COOKIE["business_id"];
$meal_price = $_COOKIE["meal_price"];

$order_customer_id = 1001;
$user_id = 2001;

$deliver_address = $_POST['deliver_address'];
$businessdelivery_jobranger = $_COOKIE["deliver_ability"];
$order_delivery_fee = 5;
$order_total_amount = $meal_price + $order_delivery_fee;  //可能会在此处出问题
$deliver_address_lat = $_POST['lat'];
$deliver_address_lng = $_POST['lng'];
$dispatch_time = $_POST['dispatch_time'];
$deliver_distance = 2;




$business_lat = $_COOKIE["business_lat"];
$business_lng = $_COOKIE["business_lng"];

include_once("dbinfo_li.php");

$sql = "INSERT INTO order_customer 
(
user_id,
business_id,
delivery_address,
businessdelivery_jobranger,
order_total_amount,
order_delivery_fee,
delivery_address_lat,
delivery_address_lng,
dispatch_time,
delivery_distance

)
VALUES (

'$user_id', 
'$business_id',
'$deliver_address',
'$businessdelivery_jobranger',
'$order_total_amount',
'$order_delivery_fee',
'$deliver_address_lat',
'$deliver_address_lng',
'$dispatch_time',
'$deliver_distance'
)";

$result = $connection->query($sql);







?>