<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDeli Business</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/css_business_info_order.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet"> 
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
          <ul class="nav navbar-nav " style=" background-color: rgb(244, 65, 0);margin-top:0px;">                                                  
            <li><a href="index.php"  style="color:white; font-weight:border;">Logout</a></li>
          </ul>
       </div>
    </div>
  </nav>

  <!-- 头部结束 -->


<!-- 中间部分 -->

  <div class="middle_part setting_middle" style="background-color:rgb(224, 239, 255);">
  	<!-- <p class="no_padding no_margin">this is the beginning </p> -->

 		<!-- <div class="order_info">
 			<p class="info_header">Order Information</p>
 			<div class="order_info_spf">
 				
 			</div>
 		</div> -->

 		
 		<div class="business_info_basic" style="padding-top: 50px;height: 510px;">
 			<div class="business_info" style="width: 702px;">
 				<p class="info_header">Business Information</p>

        <div class="logo_image" style="margin-left: 10px;">
 					  <img src="b_logo/<?php echo"$_COOKIE[logo]";?>">   
 				</div>

 				<table class="b_spf_info" style="width: 502px;">
 					<tr>
 						<td class="table_title">Name</td>
 						<td>:<?php echo"$_COOKIE[bname]";?></td>
 						<td></td>
 						<td></td>
 					</tr>

 					 <tr>
 						<td class="table_title">Contact</td>
 						<td>:<?php echo"$_COOKIE[bcontact]";?></td>
 						<td></td>
 						<td></td>
 					</tr>

 					<tr>
 						<td class="table_title">Address</td>
 						<td>:<?php echo"$_COOKIE[baddress]";?></td>
 						<td></td>
 						<td></td>
 					</tr>

 					 <tr>
 						<td class="table_title">Email</td>
 						<td>:<?php echo"$_COOKIE[bemail]";?></td>
 						<td></td>
 						<td></td>
 					</tr>

					 <tr>
 						<td class="table_title">Type</td>
 						<td style="width: 200px;">:<?php echo"$_COOKIE[business_type]";?></td>
 						<td class="table_title">Cuisine</td>
 						<td>:<?php echo"$_COOKIE[cuisinetype]";?></td>
 					</tr>
 				</table>
 			</div>

 			<div class="basic" style="
    margin-right: 100px;
">
        <p class="info_header">Login Information</p>
 				<table class="basic_info">
 					<tr>
 						<td  class="table_title">User Name</td>
 						<td>:<?php echo"$_COOKIE[username]";?></td>
 					</tr>
 					
 					<tr>
 						<td class="table_title">Owner's Email</td>
 						<td>:<?php echo"$_COOKIE[bemail]";?></td>
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