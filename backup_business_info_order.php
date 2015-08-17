<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDeli Business</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/css_business_info_order.css" rel="stylesheet">   
 </head>



  <body> 

  <!-- 头部 -->
  <nav class="navbar navbar-default navbar-customize navbar-fixed-top" style="height: 81px;" role="navigation">  
    <div class="container">
      <div class="navbar-header">
      
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-FunDeli-navbar-collapse-1" aria-expanded="false" style="
    margin-top: 20px;">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
       
      <a class="navbar-brand" href="#" style="font-size: 30px;font-weight: 800; margin-top: 10px;">FunDeli</a>
      </div>

       <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1" style="height: 1px; background-color: rgb(248, 248, 248);">   
          <ul class="nav navbar-nav " style="margin-top: 12px;">                                                  
            <li><a href="#myModal" data-toggle="modal" data-target="#myModal3">Logout</a></li>
          </ul>
       </div>
    </div>
  </nav>

  <!-- 头部结束 -->


<!-- 中间部分 -->

  <div class="middle_part setting_middle">
  	<!-- <p class="no_padding no_margin">this is the beginning </p> -->

 		<div class="order_info">
 			<p class="info_header">Order Information</p>
 			<div class="order_info_spf">
 				
 			</div>

 		</div>
 		
 		<div class="business_info_basic">
 			<div class="business_info">
 				<p class="info_header">Business Information</p>
 				
        <?php 


        ?>






        <div class="logo_image">
 					  <img src="image_css/logo.jpg">
 				</div>

 				<table class="b_spf_info">
 					<tr>
 						<td class="table_title">Name</td>
 						<td></td>
 						<td></td>
 						<td></td>
 					</tr>

 					 <tr>
 						<td class="table_title">Contact</td>
 						<td></td>
 						<td></td>
 						<td></td>
 					</tr>

 					<tr>
 						<td class="table_title">Address</td>
 						<td></td>
 						<td></td>
 						<td></td>
 					</tr>

 					 <tr>
 						<td class="table_title">Email</td>
 						<td></td>
 						<td></td>
 						<td></td>
 					</tr>

					 <tr>
 						<td class="table_title">Type</td>
 						<td></td>
 						<td class="table_title">Cuisine</td>
 						<td></td>
 					</tr>
 				</table>
 			</div>

 			<div class="basic">
        <p class="info_header">Login Information</p>
 				<table class="basic_info">
 					<tr>
 						<td  class="table_title">User Name</td>
 						<td></td>
 					</tr>
 					<tr>
 						<td  class="table_title">Full Name</td>
 						<td></td>
 					</tr>
 					<tr>
 						<td class="table_title">Owner's Name</td>
 						<td></td>
 					</tr>
 					<tr>
 						<td class="table_title">Owner's Email</td>
 						<td></td>
 					</tr>
 					<tr>
 						<td class="table_title">Password</td>
 						<td></td>
 					</tr>
 				</table>
 			</div>

 		</div>



 		<div class="meal_info">
      <p class="info_header"></p>
 			<table>
 				
 			</table>
 		
 		</div>


  </div>
<!-- 中间部分结束 -->





<!-- 尾部 -->
  <div class="footer">
    <div class="info">
      <ul class="footer-nav no_padding  ">
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Blog</a></li>
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

 <!-- 尾部删掉 -->




<!-- 头部 -->

  
<!-- 食客删掉 -->


<!-- 送餐员删除 -->


<!-- 商家最后页面，只需要登出，没有登陆是不能进入到这个页面的 -->
  
<!-- 商家的进入端口从 footer 移动到了 nav  -->




  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  </body>
</html>


======================= php 部分 ======================




          <?php

            include_once("dbinfo_li.php");
            $business_id = $_COOKIE["business_id"];
            echo "$business_id<br>";

            $sql = "SELECT b.business_name,
            b.logo_route,
            b.business_address,
            b.business_contact,
            b.business_email,            
            c.cuisine_name,          
            bt.business_type_name,            
            o.username,
            o.owner_fullname,
            o.owner_contact,
            o.email,
            o.password           
            FROM business b
            INNER JOIN cuisine_type c  
            
            ON b.cuisine_type_id = c.cuisine_type_id

            INNER JOIN business_type bt
            ON b.business_type_id = bt.business_type_id

            INNER JOIN owner_business o
            ON b.owner_id = o.owner_id

            WHERE business_id = '$business_id'

            ";

            $result=mysqli_query($connection,$sql) or die(mysqli_connect_error());;
            // if($result){
            //   echo "Yes<br>";
            // }

             while ($row = mysqli_fetch_object($result)) {    
              
              $b_name = $row->business_name;
              $b_address = $row->business_address;
              $logo = 'b_logo/'.$row->logo_route;
            }

             
           

          ?>   