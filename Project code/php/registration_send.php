<h1>Hello</h1>
<?php 
  phpinfo();
    //start php tag
//include connect.php page for database connection
  //include('connect.php');
$user = 'root';
$password = 'dream900412';
$db = 'spdb';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link, 
   $host, 
   $user, 
   $password, 
   $db,
   $port
);
  Echo "1";
//if submit is not blanked i.e. it is clicked.
  If(isset($_POST['submit'])!='')
  {
    If($_POST['email']=='' || $_POST['username']=='' || $_POST['password']=='')
      {
        Echo "please fill the empty field.";
      }
    Else
      {
        Echo "2";

        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=$_POST['password'];

        $sql="INSERT INTO `user`(`username`, `email`, `password`) VALUES ('$username','$email','$password')";

        $res=mysql_query($sql);
        If($res)
      {
  	Echo "Record successfully inserted";
  }
  Else
  {
  	Echo "There is some problem in inserting record";
  }
  //header('Location: product_list.html');


?>