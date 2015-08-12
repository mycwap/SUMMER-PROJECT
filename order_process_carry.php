<?php 
$order_customer_id = 1001;
$user_id = 2001;
$business_id = $_COOKIE["business_id"];

echo "$business_id";
// $order_placed_time 自动生成
$deliver_address = $_POST['deliver_address'];
$businessdelivery_jobranger = $_COOKIE["deliver_ability"];

// $job_ranger_id = 若为空，自动填充为0
$order_delivery_fee = 5;
 


 $order_total_amount = 5 + $order_delivery_fee;  //可能会在此处出问题
echo "total price:$order_total_amount";

$deliver_address_lat = $_POST['lat'];
$deliver_address_lng = $_POST['lng'];
$dispatch_time = $_POST['dispatch_time'];
$deliver_distance = 2;
 
// $order_finish = 如果不输入，自动生成 1
$business_lat = $_COOKIE["business_lat"];
$business_lng = $_COOKIE["business_lng"];
$business_id = $_COOKIE["business_id"];


include_once("dbinfo_li.php");

$sql = "INSERT INTO business (deliver_ability, business_name)
VALUES ('$deliver','$bname', '$bcontact')";





?>