<?php 

    $delivery = $_POST['deliver'];
    setcookie("delivery_option", $delivery, time()+3600);
   
    $cuisines = $_POST['cuisine_type'];
    setcookie("cuisines_type", $cuisines, time()+3600); 

    $customer_position_lat = $_POST['lat'];
    setcookie("customer_position_lat", $customer_position_lat, time()+3600);

    $customer_position_lng = $_POST['lng'];
    setcookie("customer_position_lng", $customer_position_lng, time()+3600);
        
    header('Location: customer_search_map.php');

// $conn->close();
?>