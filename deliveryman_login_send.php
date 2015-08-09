<?php

include ("dbinfo.php");

 
        $email=$_POST['email'];
        $password=$_POST['password'];
             

$sql = "SELECT job_ranger_username FROM job_ranger WHERE job_ranger_email = '$email' and job_ranger_password = '$password'";


$result = $connection->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $uname=$row["job_ranger_username"];
         setcookie("username", $uname, time()+3600);
     }
 }
header('Location: mobile_deliveryman_home.php');

$conn->close();
 

?>

