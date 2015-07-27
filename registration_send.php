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

        $username=$_POST['username']; 
        setcookie("sign_username", $username, time()+3600);       
        $email=$_POST['email'];
        $password=$_POST['password'];
        

       

$sql = "INSERT INTO user (username, email, password)
VALUES ('$username', '$email', '$password')";

if ($conn->query($sql) === TRUE) 
{
    header('Location: signed_home.php');
} 



/*$sql2 = "SELECT username FROM user WHERE email = '$email' and password = '$password'";

$result = $conn->query($sql2);

if ($result->num_rows > 0) 
{
     // output data of each row
     while($row = $result->fetch_assoc()) 
     {
         $uname=$row["username"];
         setcookie("username", $uname, time()+3600);          
     }
} 
else 
{
     echo "0 results";
}*/

$conn->close();
?>
