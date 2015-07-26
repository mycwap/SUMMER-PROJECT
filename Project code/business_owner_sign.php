<?php 
    //start php tag
//include connect.php page for database connection
  //include('connect.php');
$servername = "localhost";
$name = "root";
$password = "dream900412";
$dbname = "spdb";

// Create connection
$conn = new mysqli($servername, $name, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

        $username=$_POST['owner_username']; 
        setcookie("sign_username", $username, time()+3600);       
        $ownerfullname=$_POST['owner_fullname'];
        $email=$_POST['email'];
        setcookie("sign_email", $email, time()+3600);
        $b_contact=$_POST['business_contact'];
        $password=$_POST['password'];
        

$sql = "INSERT INTO owner_business (username, email, password, owner_fullname, owner_contact)
VALUES ('$username', '$email', '$password', '$ownerfullname', '$b_contact')";

if ($conn->query($sql) === TRUE) 
{
    header('Location: business_login.php');
} 
$conn->close();
?>