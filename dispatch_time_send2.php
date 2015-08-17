<?php 
include ("dbinfo_li.php");



        $dispatch_time=$_POST['dispatch_time'];
        setcookie("dispatch_time",$dispatch_time,time()+3600);


        header('Location: deliveryman_search_map.php');

?>