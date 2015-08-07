<?php 

include('dbinfo_li.php');

        $username=$_POST['owner_username']; 
        setcookie("sign_username", $username, time()+3600); 

        $ownerfullname=$_POST['owner_fullname'];

        $email=$_POST['email'];
        setcookie("sign_email", $email, time()+3600);

        $b_contact=$_POST['business_contact'];
        
        $password=$_POST['password'];
        

$sql = "INSERT INTO owner_business (username, email, password, owner_fullname, owner_contact)
VALUES ('$username', '$email', '$password', '$ownerfullname', '$b_contact')";

if ($connection->query($sql) === TRUE) 
{
    header('Location: business_login.php');
} 
$connection->close();
?>