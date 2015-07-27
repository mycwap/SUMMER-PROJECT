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

        $btype=$_POST['business_type'];

        $email=$_COOKIE["sign_email"];
        $username=$_COOKIE["sign_username"];

        $baddress=$_POST['business_address'];
        
        $bcity=$_POST['business_city'];

        $bname=$_POST['business_name'];
        $bcontact=$_POST['business_contact'];
        $bemail=$_POST['business_email'];

 
$sql1 = "SELECT owner_id FROM owner_business WHERE email = '$email' and username = '$username'";  

$result = $conn->query($sql1);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $owner_id=$row["owner_id"];
     }
 }

$sql2 = "SELECT business_type_id FROM business_type WHERE business_type_name = '$btype'";  

$result = $conn->query($sql2);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $business_type_id=$row["business_type_id"];
     }
}

$sql3 = "SELECT business_area_id FROM business_city WHERE business_area_name = '$bcity'";  

$result = $conn->query($sql3);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $business_area_id=$row["business_area_id"];
     }
}



$sql4 = "INSERT INTO business (business_name, business_contact ,business_email, owner_id, business_type_id, business_area_id, business_address)
VALUES ('$bname', '$bcontact', '$bemail', '$owner_id', '$business_type_id', '$business_area_id', '$baddress')";

if ($conn->query($sql4) === TRUE) 
{
    header('Location: business_login.php');
} 
$conn->close();
?>