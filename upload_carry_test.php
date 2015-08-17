<?php

include_once("dbinfo_li.php");

if ($_FILES["logo"]["error"] > 0)
  {
  echo "Error: " . $_FILES["logo"]["error"] . "<br />";
  }
else
  {


  if(move_uploaded_file($_FILES['logo']['tmp_name'],"b_logo/".$_FILES['logo']['name']))
  {
    // echo "Stored in: " . "b_logo/".$_FILES["logo"]["name"]."<br/>";
    // echo "Upload: " . $_FILES["logo"]["name"] . "<br />";
    // echo "Type: " . $_FILES["logo"]["type"] . "<br />";
    // echo "Size: " . ($_FILES["logo"]["size"] / 1024) . " Kb<br />";
  
        $b_logo = $_FILES['logo']['name'];
        setcookie("logo", $b_logo,time()+10800);
        
        $btype=$_POST['business_type'];
        setcookie("business_type", $btype,time()+10800);
        
        $cuisinetype=$_POST['cuisine_type'];
        setcookie("cuisinetype", $cuisinetype,time()+10800);
       
        $email=$_COOKIE["sign_email"];
        setcookie("email", $email,time()+10800);
        
        $username=$_COOKIE["sign_username"];    
        setcookie("username", $username,time()+10800);
       
        $baddress=$_POST['business_address'];
        setcookie("baddress", $baddress,time()+10800);        
        $bcity=$_POST['business_city'];
        
        $deliver = $_POST['deliverable'];
        
        $bname=$_POST['business_name'];
        setcookie("bname", $bname,time()+10800);
        
        $bcontact=$_POST['business_contact'];
        setcookie("bcontact", $bcontact, time()+10800);        
        
        $bemail=$_POST['business_email'];
        setcookie("bemail", $bemail, time()+10800);  
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



$sql4 = "INSERT INTO business (deliver_ability, business_name, business_contact ,business_email, owner_id, business_type_id, business_area_id, business_address, business_address_lat, business_address_lng, cuisine_type_id, logo_route)
VALUES ('$deliver','$bname', '$bcontact', '$bemail', '$owner_id', '$business_type_id', '$business_area_id', '$baddress', '$business_address_lat', '$business_address_lng', '$cuisine_type_id','$b_logo')";

if ($connection->query($sql4) === TRUE) 
{
    
    header('Location: business_meal_info.php');
} 
$connection->close();











  }

  else{
    echo "fail to move";
  }
  

  }
?>