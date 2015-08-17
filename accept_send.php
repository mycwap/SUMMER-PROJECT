<?php


$balat = $_POST['b_a_lat'];
setcookie("b_a_lat", $balat, time()+3600);  
$balng = $_POST['b_a_lng'];
setcookie("b_a_lng", $balng, time()+3600);  

$oalat = $_POST['o_a_lat'];
setcookie("o_a_lat", $oalat, time()+3600);  
$oalng = $_POST['o_a_lng'];
setcookie("o_a_lng", $oalng, time()+3600);  

$order_customer_id = $_POST['order_id'];
setcookie("order_customer_id", $order_customer_id, time()+3600);  

// echo $order_customer_id;

header('Location: accept_order_send.php');

?>