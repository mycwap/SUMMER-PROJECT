<?php

include ("dbinfo.php");

 
        $email=$_POST['email'];
        $password=$_POST['password'];
             

$sql = "SELECT username FROM user WHERE email = '$email' and password = '$password'";


$result = $connection->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $uname=$row["username"];
         setcookie("username", $uname, time()+3600);
     }
 }
header('Location: home_user.php');

$connection->close();
 

?>

