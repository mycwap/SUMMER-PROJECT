<?php 
include ("dbinfo_li.php");


        $dispatch_time=$_POST['dispatch_time'];
        setcookie("dispatch_time",$dispatch_time,time()+3600);

        $deliveryman_position_lat=$_POST['lat'];
        setcookie("deliveryman_position_lat",$deliveryman_position_lat,time()+3600);

        $deliveryman_position_lng=$_POST['lng'];
        setcookie("deliveryman_position_lng",$deliveryman_position_lng,time()+3600);

        header('Location: deliveryman_search_map.php');


?>