<?php 
include ("dbinfo.php");


        $btype=$_POST['business_type'];
        $cuisinetype=$_POST['cuisine_type'];

        $email=$_COOKIE["sign_email"];
        $username=$_COOKIE["sign_username"];

        $baddress=$_POST['business_address'];
        
        $bcity=$_POST['business_city'];

        $bname=$_POST['business_name'];
        $bcontact=$_POST['business_contact'];
        $bemail=$_POST['business_email'];
        $business_address_lat=$_POST['lat'];
        $business_address_lng=$_POST['lng'];

 
$sql1 = "SELECT owner_id FROM owner_business WHERE email = '$email' and username = '$username'";  

$result = $connection->query($sql1);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $owner_id=$row["owner_id"];
     }
 }

$sql2 = "SELECT business_type_id FROM business_type WHERE business_type_name = '$btype'";  

$result = $connection->query($sql2);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $business_type_id=$row["business_type_id"];
     }
}

$sql3 = "SELECT business_area_id FROM business_city WHERE business_area_name = '$bcity'";  

$result = $connection->query($sql3);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $business_area_id=$row["business_area_id"];
     }
}

$sql5 = "SELECT cuisine_type_id FROM cuisine_type WHERE cuisine_name = '$cuisinetype'";  

$result = $connection->query($sql5);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $cuisine_type_id=$row["cuisine_type_id"];
     }
}



$sql4 = "INSERT INTO business (business_name, business_contact ,business_email, owner_id, business_type_id, business_area_id, business_address, business_address_lat, business_address_lng, cuisine_type_id)
VALUES ('$bname', '$bcontact', '$bemail', '$owner_id', '$business_type_id', '$business_area_id', '$baddress', '$business_address_lat', '$business_address_lng', '$cuisine_type_id')";

if ($connection->query($sql4) === TRUE) 
{
    
    header('Location: business_login.php');
} 
$connection->close();
?>