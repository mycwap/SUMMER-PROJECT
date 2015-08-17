<?php
include_once("dbinfo_li.php");

if (isset($_POST['submit']))  // 这里的save要和 type="submit" name="save" 一致
{
	// echo "<h4>你已经点击提交</h4><br>";
	if(($_FILES['image']['type']=='image/jpeg')   //image 与 下面的name="image"一致
		||($_FILES['image']['type']=='image/png') 
		&&($_FILES['image']['size']<900000))
	{
		if($_FILES['image']['error']>0)
		{
			echo "出现错误";
			echo $_FILES['image']['error'];

		}

		else if(file_exists('meal_image/'.$_FILES['image']['name'])) //如果服务器里已经有这个文件，那么就结束上传了
		{
			// echo "<h2>上传文件".$_FILES['image']['name']."已经存在，请重新上传<br></h2>";
		}


		else if (move_uploaded_file($_FILES['image']['tmp_name'],'meal_image/'.$_FILES['image']['name']))
		{
			

			// $business_contact=$_COOKIE["business_contact"];	

			// echo "<h4>文件成功转移至 meal_image 文件夹</h4>";
			$business_u_contact=$_COOKIE["bcontact"];
			$mi = $_FILES['image']['name']; //图片			
			$mn =$_POST['meal_name'];
			$mp = $_POST['meal_price'];
			$md = $_POST['meal_description'];
			$mpt = $_POST['meal_prepared_time'];

			
			$sql = "SELECT business_id FROM business WHERE business_contact = '$business_u_contact'";
			$result = $connection->query($sql);
			if($result){
				while($row = $result->fetch_object()){
					$unique_business_id = $row->business_id;
					setcookie("business_id",$unique_business_id, time()+3600);
					// echo "成功抽取 business_id";
				}

				// echo "Business_id : $unique_business_id ";
			}
			else{
				// echo "抽取 business_id 失败";
			}

			
			$sql1="INSERT INTO meal (meal_name, meal_price, meal_description, meal_image_route, prepared_time, meal_allergen_id, meal_available, business_id)
			VALUES('$mn', '$mp', '$md', '$mi', '$mpt','','', '$unique_business_id')";


  			$result1 = $connection->query($sql1);
  			if($result1)
  			{
  				// echo "<h1>成功将信息+business_id 录入到数据库<br></h1>";
  			}
  			 
		}	

	}
	// else{echo "图片尺寸过大或不符合png jpg格式";}
	
}

?>


<!--  //////////////////////////// 分        割    ////////////////////////                       -->



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

       <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1">   
          <ul class="nav navbar-nav " style="
    margin-top: 20px;
">                                               
            
             
             <b style="color:white; font-weight:border;">Welcome:
              <?php
              $_COOKIE["sign_email"];
              echo $_COOKIE["sign_username"];                
              ?>
          </b>
          </ul>
       </div>
    </div>
  </nav>







  <div class="jumbotron npm" style="
    margin-bottom: 50px;
">    


	<form id="form" method="post" enctype="multipart/form-data" style=" width: 180px; margin: auto; height: 380px;">  
		
		<label style="
    margin-top: 20px;
">Meal Name</label><br>
		<input type="text" name="meal_name"  /><br>

		<label>Price</label><br>
		<input type="text" name="meal_price"/><br>

		<label>Description</label><br>
		<input type="text" name="meal_description"/><br>

		<label>Prepared time</label><br>
		<input type="text" name="meal_prepared_time"/><br>


		<label>Image(jpeg/jpg/png)</label><br><br>
		<input type="file"  name="image" size="30" /><br><br>
		<input type="submit" name="submit"  value="save" />
		<button type="button" style="
    margin-left: 85px;
"><a href="business_info_order.php" style="text-decoration: none; color:black">Next</a></button>

	</form>

    

	<table style="border:1px solid #000; width:100%">
		<thead>
			<th>Image</th>
			<th>Created Time</th>
			<th>Meal Name</th>
			<th>Price &euro;</th>
			<th>Description</th>	
			<th>Prepared Time min</th>     
			
					 
			 
		</thead>

		<tbody>
			<?php
				include_once("dbinfo_li.php");

				// $business_contact=$_COOKIE["business_contact"];		

				$business_u_contact=$_COOKIE["bcontact"];


				$sqlx = "SELECT business_id FROM business WHERE business_contact = '$business_u_contact'";
				$resultx = $connection->query($sqlx);
				if($resultx){
					while($rowx = $resultx->fetch_object()){
						$unique_business_id = $rowx->business_id;
						// echo "成功抽取 business_id";
					}

					// echo "Business_id : $unique_business_id ";
				}
				else{
					echo "抽取 business_id 失败";
				}


				$sql = "SELECT * FROM meal   WHERE business_id = '$unique_business_id'  ORDER BY time DESC ";

				$result = $connection->query($sql);
				
				while ($row = $result->fetch_object()) {
					

				echo "
					<tr>
						<td><img src='meal_image/$row->meal_image_route'></td>
						<td>$row->time</td>
						<td>$row->meal_name</td>
						
						<td>$row->meal_price</td>
						<td>$row->meal_description</td>
						<td>$row->prepared_time</td> 
						
						 
						


						
					</tr>
				"
				;}
			?>
		</tbody>

	</table>
	
</div>


 

 

  <div class="footer">
    <div class="info">
      <ul class="footer-nav no_padding  ">
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="home3.html">Logout</a></li>
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
