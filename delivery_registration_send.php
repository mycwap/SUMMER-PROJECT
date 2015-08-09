<?php 
//delivery_registration_send.php
include ("dbinfo.php");

        $username=$_POST['username']; 
        setcookie("username", $username, time()+3600);       
        $email=$_POST['email'];
        $mobile=$_POST['mobile'];
        $password=$_POST['password'];
        

       

$sql = "INSERT INTO job_ranger (job_ranger_username, job_ranger_email, job_ranger_mobile, job_ranger_password)
VALUES ('$username', '$email', '$mobile', '$password')";

if ($connection->query($sql) === TRUE) 
{
    header('Location: mobile_deliveryman_home.php');
} 


$conn->close();
?>
