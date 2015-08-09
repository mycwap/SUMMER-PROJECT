<?php

include ("dbinfo.php");

 
        $email=$_POST['email'];
        setcookie("sign_email", $email, time()+3600); 
        $password=$_POST['password'];
             

$sql = "SELECT username FROM owner_business WHERE email = '$email' and password = '$password'";

/*if (!mysqli_query($conn, $sql)) 

{
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$q = "SELECT username FROM user WHERE email='$email'"; //sql查询语句

$query = mysql_query($q);
$bianliang = mysql_result($query,0);
echo $bianliang;

setcookie('username', $_POST['username'], time()+60*60*24*365, 'www.UNI.edu.au');*/

//ddddddd


$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         $uname=$row["username"];
         setcookie("sign_username", $uname, time()+3600);
     }
 }
header('Location:business_login.php');

$conn->close();
 
/*mysql_query("set NAMES GB2312");
//$rs = mysql_query($q, $conn); //获取数据集
//if(!$rs){die("Valid result!");}

//$row = mysql_fetch_array($rs); //这样从资源中取结果，是一个数组
//print_r($row);

mysqli_close($conn);*/
?>

