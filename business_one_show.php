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

 			
<div class="jumbotron npm" style="padding-top: 20px;">
        
    <div class="business_meal_info">

<?php
include_once("dbinfo_li.php");
$id = $_GET['ide'];
setcookie("business_id",$id, time()+3600);

if (isset($_GET['ide']))    
{

  
            // echo "获得了ID: $id ";
            $sql = "SELECT 
            b.deliver_ability,b.business_name, b.logo_route, b.business_address, 
            b.business_address_lat, b.business_address_lng,
            c.cuisine_name, bt.business_type_name
            -- ,            
            -- m.meal_id, m.prepared_time, m.meal_price, m.meal_description, m.meal_image_route
                    FROM business b
                    INNER JOIN cuisine_type c  
                    ON b.cuisine_type_id = c.cuisine_type_id

                    INNER JOIN business_type bt
                    ON b.business_type_id = bt.business_type_id

                    -- INNER JOIN meal m
                    -- ON b.business_id = m.business_id 

                    WHERE business_id = '$id'
            ";

             $result=mysqli_query($connection,$sql) or die(mysqli_connect_error());

             $number=mysqli_num_rows($result);

             // echo "$number 条商业信息 <br>";

             $sql1 = "SELECT meal_id, meal_name, prepared_time, meal_price, meal_description, meal_image_route
                      FROM meal
                      WHERE business_id = '$id'
             ";

             $result1=mysqli_query($connection,$sql1) or die(mysqli_connect_error());

              $number1=mysqli_num_rows($result1);
              // echo "$number1 条商品信息 <br>";


             while ($row = mysqli_fetch_object($result)) {    
              
              $deliver_ability = $row->deliver_ability;
              setcookie("deliver_ability", $deliver_ability, time()+3600);
              $business_lat =  $row->business_address_lat;
              setcookie("business_lat", $business_lat, time()+3600); 
              $business_lng = $row->business_address_lng;
              setcookie("business_lng", $business_lng, time()+3600); 
              
              $logo = 'b_logo/'.$row->logo_route;
              $b_name = $row->business_name;
              $b_address = $row->business_address;   
              
               // echo "经度$business_lat<br>";
               // echo "维度$business_lng<br>";

              $c_type_name = $row->cuisine_name;
              $b_type_name = $row->business_type_name;

              echo "
              <div class='business_container' >
                <div class='business_c_logo'>
                  <img src='$logo'>            
                </div>

                <div class='business_c_info'>
                  <ul class='business_c_ul' style='margin-top: 0px;'>
                    <li>$b_name</li>
                    <li>$b_address</li>
                    <li>$c_type_name | $b_type_name</li>
                  </ul>
                </div>                
              </div>

              ";
                       

            }

            echo "<div class='business_multi_meal' style='overflow; height:300px;width: 872px;margin: 0 auto;'>";

            while ($row1 = mysqli_fetch_object($result1)) {    
              
              $meal_id = $row1->meal_id;
              $meal_image =  'meal_image/'.$row1->meal_image_route;
              $meal_price =  $row1->meal_price;
               
              $meal_description = $row1->meal_description;
              $meal_prepare =  $row1->prepared_time;
              $meal_name = $row1->meal_name;
              echo "
                
              

              <div class='business_container' style ='float:left; width:420px; height:138px;' >
                <div class='business_c_logo' style='height:132px;'>
                  <img src='$meal_image'>            
                </div>

                <div class='business_c_info' style='width: 202px;'>
                  <ul class='business_c_ul' style='margin-top: 0px;'>
                    <li>$meal_name</li>
                    <li>$meal_description</li>
                    <li>$meal_prepare min prepare</li>
                    <li>
                    $meal_price euro
                    <button type='button'><a href='order_process.php?ide=$meal_id'>Buy</a></button>  
                    </li>
                  </ul>
                </div>                
              </div>

               ";

            }

              echo "</div>";

}

else{
  echo "fail to get the id";
}

?>





    </div>



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
          <li><a href="#myModal" data-toggle="modal" data-target="#myModal2">Business</a></li>
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


