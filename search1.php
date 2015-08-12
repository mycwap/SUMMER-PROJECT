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

<!-- http://v3.bootcss.com/components/#input-groups -->
<!-- 这里请避免使用 <select> 元素，因为 WebKit 浏览器不能完全绘制它的样式。
     避免使用 <textarea> 元素，由于它们的 rows 属性在某些情况下不被支持。 -->

<!-- html w3s 里面有 boostrap 的教程 Bootstrap Forms -->
 <!-- Bootstrap相关优质项目推荐 -->

 				<h2>edit.php 文件里 有抓取的 功能实现</h2>
				<div>
					<?php
					
						include ("dbinfo_li.php");

						$business_id = $_COOKIE["business_i_string"];



						$sql2 = "SELECT b.business_id , b.deliver_ability, b.logo_route , b.business_name , 
						b.business_address ,c.cuisine_name, bt.business_type_name
						FROM business b
							    
					    INNER JOIN cuisine_type c
					        ON b.cuisine_type_id = c.cuisine_type_id
					    INNER JOIN business_type bt
					        ON b.business_type_id = bt.business_type_id
					    
					    WHERE business_id IN ($business_id) 
					   ";

						 $result=mysqli_query($connection,$sql2) or die(mysqli_connect_error());

						
						 $number=mysqli_num_rows($result);

						echo "$number";
						 

						while ($row = mysqli_fetch_object($result)) {    
							$id =  $row->business_id;
							// $deliver_ability = $row->deliver_ability;
							$logo = 'b_logo/'.$row->logo_route;
							$b_name = $row->business_name;
							$b_address = $row->business_address;	 
							$c_type_name = $row->cuisine_name;
							$b_type_name = $row->business_type_name;
							$deliver_ability = $row->deliver_ability;
							

							if($deliver_ability == "1") {  //使用 Uber

								echo "
									
								<div style ='float:left;clear: left;'>
									<div>Business Logo: <img src='$logo'></div>

									<div style='color: sienna;'>Business_name: $b_name</div>
									
									<div style='color: sienna;'>Business_id: $id</div>

									 <div>address: $b_address</div>

									 <div>business_type:$b_type_name</div>									 
									 											
									<div>cuisine_type: $c_type_name</div> <br> <br>

									<div>
									
									<button type='button'><a href='business_one_show.php?ide=$id'>View</a></button>

									</div>
								</div> ";


							}

							else{							//不使用 Uber

								echo "

								<div style ='float:right;clear: right;'>
									<div>Business Logo: <img src='$logo'></div>

									<div style='color: yellow;'>Business_name: $b_name</div>
									
									<div style='color: yellow;'>Business_id: $id</div>

									 <div>address: $b_address</div>

									 <div>business_type:$b_type_name</div>									 
									 											
									<div>cuisine_type: $c_type_name</div> <br> <br>

									<div>
																			
									<button type='button'><a href='business_one_show.php?ide=$id'>View</a></button>

									</div>
								</div> ";
							}

						}

						 
					?>
				</div>


				
				




 

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


