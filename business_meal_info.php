<?php
include_once("dbinfo_li.php");

if (isset($_POST['submit']))  // 这里的save要和 type="submit" name="save" 一致
{
	echo "<h4>你已经点击提交</h4><br>";
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
			echo "<h2>上传文件".$_FILES['image']['name']."已经存在，请重新上传<br></h2>";
		}


		else if (move_uploaded_file($_FILES['image']['tmp_name'],'meal_image/'.$_FILES['image']['name']))
		{
			

			// $business_contact=$_COOKIE["business_contact"];	

			echo "<h4>文件成功转移至 meal_image 文件夹</h4>";

			$mi = $_FILES['image']['name']; //图片			
			$mn =$_POST['meal_name'];
			$mp = $_POST['meal_price'];
			$md = $_POST['meal_description'];
			$mpt = $_POST['meal_prepared_time'];

			
			// $sql = "SELECT business_id FROM business ";
			// $result = $connection->query($sql);
			// if($result){
			// 	while($row = $result->fetch_object()){
			// 		$unique_business_id = $row->business_id;
			// 	}

			// 	echo "Business_id : $unique_business_id ";
			// }
			// else{
			// 	echo "fail to find the business_id";
			// }

			
			$sql1="INSERT INTO meal (meal_name, meal_price, meal_description, meal_image_route, prepared_time, meal_allergen_id, meal_available, business_id)
			VALUES('$mn', '$mp', '$md', '$mi', '$mpt','','', 2)";


  			$result1 = $connection->query($sql1);
  			if($result1)
  			{
  				echo "<h1>成功将信息录入到数据库<br></h1>";
  			}
  			 
		}	

	}
	else{echo "图片尺寸过大或不符合png jpg格式";}
	
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



 



	<form id="form" method="post" enctype="multipart/form-data">  
		
		<label>Meal Name(u r)</label><br>
		<input type="text" name="meal_name"  /><br>

		<label>Price(u r)</label><br>
		<input type="text" name="meal_price"/><br>

		<label>Description(not required)</label><br>
		<input type="text" name="meal_description"/><br>

		<label>Prepared time(r)</label><br>
		<input type="text" name="meal_prepared_time"/><br>


		<label>Image(jpeg/jpg/png)</label><br><br>
		<input type="file"  name="image" size="30" /><br><br>
		<input type="submit" name="submit"  value="save" />

	</form>


	<table style="border:1px solid #000; width:100%">
		<thead>
			<th>Image</th>
			<th>Created Time</th>
			<th>Meal Name</th>
			<th>Price</th>
			<th>Description</th>	
			<th>Prepared Time</th>     
			
					 
			<th>Action</th>
		</thead>

		<tbody>
			<?php
				include_once("dbinfo_li.php");

				// $business_contact=$_COOKIE["business_contact"];		

				$sql = "SELECT * FROM meal ORDER BY time DESC ";

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
						
						 
						<td><a href='edit.php?ide=$row->meal_id'>Edit</a> |
							<a href='delete.php?idd=$row->meal_id'>Delete</a>
						</td>


						
					</tr>
				"
				;}
			?>
		</tbody>

	</table>
	



 

 

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


