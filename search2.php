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


				<div>
					<?php
					
						include ("dbinfo_li.php");

						$business_id = $_COOKIE["business_i_string"];

						// $search=$_POST['search'];						
						

							// $sql2="SELECT b.business_name , b.business_address ,c.cuisine_name
							// FROM business b
							// INNER JOIN cuisine_type c
							// ON b.cuisine_type_id=c.cuisine_type_id

							// WHERE business_id = $search 
							// ";

						    // setcookie("business_id", $business_id[], time()+3600);

							// $arr = array(2,6); // 一个普通数组

							// $arr_string = join(',', $arr); // 用join把数组转化为1,2,3,4,5的字符串 或者 implode

							// WHERE meta_id IN ($arr_sting)  // 成功使用							


							$sql2 = "SELECT b.business_name , b.business_address ,c.cuisine_name, bt.business_type_name
							FROM business b
							    INNER JOIN cuisine_type c
							        ON b.cuisine_type_id = c.cuisine_type_id
							    INNER JOIN business_type bt
							        ON b.business_type_id = bt.business_type_id
							    WHERE business_id IN ($business_id) 
							   ";






						// $sql1="SELECT * FROM business
						//  WHERE business_id = $search
						  
						//  ORDER BY business_name ASC";

						 // run sql statement
						 $result=mysqli_query($connection,$sql2) or die(mysqli_connect_error());

						 // find out how many matches
						 $number=mysqli_num_rows($result);

						 echo "<h2 > $number  results found</h2>" ;
						 // echo "$search";

						while ($row = mysqli_fetch_object($result)) {

							$b_name = $row->business_name;
							// $b_contact = $row->business_contact;
							$b_address = $row->business_address;	 
							$c_type_name = $row->cuisine_name;
							$b_type_name = $row->business_type_name;
							 

							echo "
									<div style='color: sienna;'>Business_name: $b_name</div>
									
									 <div>address: $b_address</div>

									 <div>business_type:$b_type_name</div>

									 
									 						 
									
									<div>cuisine_type: $c_type_name</div> <br> <br>
									
							"
						;}
					?>
				</div>
				




<!-- <form method="post" action="search.php">
<input type="text" name="search" />
<input type="submit" name="submit" value=" Search ">
</form>
 -->

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


