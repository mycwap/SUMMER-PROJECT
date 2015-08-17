<?php 

include ("dbinfo_li.php");

        $username=$_POST['username']; 
        setcookie("username", $username, time()+3600);       
        $email=$_POST['email'];
        $password=$_POST['password'];
        

       

$sql = "INSERT INTO user (username, email, password)
VALUES ('$username', '$email', '$password')";

if ($connection->query($sql) === TRUE) 
{
    header('Location: home.php');
} 




$connection->close();
?>
