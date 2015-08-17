<?php 
$business_id = $_COOKIE["business_id"];
$meal_price = $_COOKIE["meal_price"];
$meal_id = $_COOKIE["meal_id"];
// $order_customer_id = 1001;
$customer_name = $_POST['customer_name'];
$customer_phone = $_POST['phone_number'];
$deliver_address = $_POST['deliver_address'];
$businessdelivery_jobranger = $_COOKIE["deliver_ability"];
$order_delivery_fee = 5;
$order_total_amount = $meal_price + $order_delivery_fee;  //需要孟中来之后完成
$deliver_address_lat = $_POST['lat'];
$deliver_address_lng = $_POST['lng'];
$dispatch_time = $_POST['dispatch_time'];
$deliver_distance = $_POST['distance'];

// echo "$deliver_distance";


$business_lat = $_COOKIE["business_lat"];
$business_lng = $_COOKIE["business_lng"];

include_once("dbinfo_li.php");

$sql = "INSERT INTO order_customer 
(

customer_name,
customer_phone,
business_id,
delivery_address,
businessdelivery_jobranger,
order_total_amount,
order_delivery_fee,
delivery_address_lat,
delivery_address_lng,
order_dispatch,
delivery_distance

)
VALUES (


'$customer_name',
'$customer_phone',
'$business_id',
'$deliver_address',
'$businessdelivery_jobranger',
'$order_total_amount',
'$order_delivery_fee',
'$deliver_address_lat',
'$deliver_address_lng',
'$dispatch_time',
'$deliver_distance'
)";

$result = $connection->query($sql);

?>

<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDelir</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
  </head>
	<body>


	<nav class="navbar navbar-default navbar-customize navbar-fixed-top" role="navigation" style="height: 81px;">
    
	    <div class="container">
	      <div class="navbar-header">
	      
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-FunDeli-navbar-collapse-1" aria-expanded="false" style="margin-top: 20px;">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      
	      
	      <a class="navbar-brand" style="font-size: 30px;font-weight: 800; margin-top: 10px;" href="#">FunDeli</a>
	      </div>

       <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1" style="background-color: rgb(248, 248, 248);height: 121px;">   
          <ul class="nav navbar-nav " style="height: 80px;background-color: rgb(244, 65, 0);margin-top:0px;">                                               
            
            <li><a href="#myModal" data-toggle="modal" data-target="#myModal"style="color:white; font-weight:border;">Customer</a></li>
            <!-- <li><a href="#myModal" data-toggle="modal" data-target="#myModal3">Deliver</a></li> -->
            <li style="margin-bottom: 0px;margin-top: 15px;font-weight: bolder;color: white;">Welcome:
                <?php
                  echo $_COOKIE["username"];                
                ?>
            </li>
          </ul>
       </div>
	    </div>
 	</nav> 
	  
 	<div class="jumbotron npm" style="padding-top: 20px;margin-bottom: 50px;height: 400px;margin-top: 150px;">

		<h3 style="margin:0 auto;width: 295px;;">You order has been placed</h3><br><br>
		<h3 style="margin:0 auto;width: 1075px;;">The confirmation message will be sent to your phone 30 minutes before the dispatched time you set.</h3>

	</div>


<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <img class="modal-title" src="image/logo.png"/>         
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6 " >
              <form id="loginform" action="login_send.php" method="post" onsubmit="return logincheck()">
                <div class="form-group">
                  <h3 class="login-title">User Login:</h3>
                        
                  <input id="email" class="form-control" placeholder="Enter email" type="email" name="email">
                    <br>
                      <span id="error_email" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                      
                  <input id="password" class="form-control" id="password" placeholder="Password" type="password" name="password">
                  <br>
                  <span id="error_password" style="color:red"></span>
                  <br>
                </div>
                <div class="checkbox-login">
                  <label>
                    <input type="checkbox"> Remember me
                  </label>
                    <p style="display:inline; margin-left:30px;"class="text-right"><a style="text-decoration: none;" href="#">Forgot password?</a>
                    </p>
                </div>
                <button type="submit" class="btn btn-default">Login</button>     
              </form>
            </div>

            <div class="col-md-6 signin-area">
              <form id="registration" action="registration_send.php" method="post" onsubmit="return formcheck()">
                <div class="form-group">
                  <h3 class="signin-title">Sign up(User):</h3>    
                    <input class="form-control" id="email" placeholder="Enter email" type="email" name="email">
                    <br>
                    <span id="error_email" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                           
                    <input class="form-control" id="username" placeholder="Username" type="type" name="username">
                    <br>
                    <span id="error_uname" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                           
                    <input class="form-control" id="password" placeholder="Password" type="password" name="password">
                    <br>
                    <span id="error_pword" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                           
                    <input class="form-control" id="cpassword" placeholder="Re-enter password" type="password" name="repassword">
                    <br>
                    <span id="error_cpword" style="color:red" ></span>
                    <br>
                </div>
                <div class="checkbox-signin">
                  <label>
                    <input type="checkbox"> Keep me logged in to my account
                  </label>  
                </div>
                <button type="submit" class="btn btn-default">Sign up</button>
              </form>
            </div>
           
        </div>
      </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
 </div>







	<div class="footer">
		      <div class="info">
		        <ul class="footer-nav no_padding  ">
		          <li><a href="#">About</a></li>
		          <li><a href="#">Contact</a></li>
		          <li><a href="#">Blog</a></li>
		          <li><a href="index.php">Logout</a></li>
		        </ul>
		      </div>
		         
      <div class="icon">
         <ul class="footer-nav no_padding  ">
          <li><a href="#"><img src="image/facebook_30.gif"></a></li>
          <li><a href="#"><img src="image/Instagram_30.jpg"></a></li>
          <li><a href="#"><img src="image/twitter_30.png"></a></li>
        </ul>

      </div>
      <div class="copyright">
          &commat; 2015 FunDeli
      </div>
</div>





<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

