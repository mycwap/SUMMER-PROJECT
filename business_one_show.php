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

<h2>edit.php 文件里 有抓取的 功能实现</h2>
 			
<?php
include_once("dbinfo_li.php");
$id = $_GET['ide'];
setcookie("business_id",$id, time()+3600);

if (isset($_GET['ide']))    
{

  
            echo "获得了ID: $id ";
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

             echo "$number 条商业信息 <br>";

             $sql1 = "SELECT meal_id, meal_name, prepared_time, meal_price, meal_description, meal_image_route
                      FROM meal
                      WHERE business_id = '$id'
             ";

             $result1=mysqli_query($connection,$sql1) or die(mysqli_connect_error());

              $number1=mysqli_num_rows($result1);
              echo "$number1 条商品信息 <br>";


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
              
              

              $c_type_name = $row->cuisine_name;
              $b_type_name = $row->business_type_name;

              echo "
                
              <div style ='float:left;clear: left;'>
                <div>Business Logo: <img src='$logo'></div>

                <div style='color: sienna;'>Business_name: $b_name</div>
          
                 <div>address: $b_address</div>

                 <div>business_type:$b_type_name</div>                   
                                      
                <div>cuisine_type: $c_type_name</div> <br> <br>

                <div>

                <h4>以下为商品信息</h4>
                
                 

                </div>
              </div> ";
                       

            }

            while ($row1 = mysqli_fetch_object($result1)) {    
              
              $meal_id = $row1->meal_id;
              $meal_image =  'meal_image/'.$row1->meal_image_route;
              $meal_price =  $row1->meal_price;
              $meal_description = $row1->meal_description;
              $meal_prepare =  $row1->prepared_time;
              $meal_name = $row1->meal_name;
              echo "
                
              <div style ='float:left;clear: left;'>
                <div>meal image: <img src='$meal_image'></div>

                <div>meal name: $meal_name</div>

                <div>price: $meal_price</div>
          
                <div>prepared time: $meal_prepare</div>   

                <button type='button'><a href='order_process.php?ide=$meal_id'>Buy</a></button>      

                       
                
              </div> ";
            }

}

else{
  echo "fail to get the id";
}


            // $sql2 = "SELECT b.business_id , b.deliver_ability, b.logo_route , b.business_name , 
            // b.business_address ,c.cuisine_name, bt.business_type_name
            // FROM business b
                  
            //   INNER JOIN cuisine_type c
            //       ON b.cuisine_type_id = c.cuisine_type_id
            //   INNER JOIN business_type bt
            //       ON b.business_type_id = bt.business_type_id
              
            //   WHERE business_id = '$id'
            //  ";

            //  $result=mysqli_query($connection,$sql2) or die(mysqli_connect_error());

            
            //  $number=mysqli_num_rows($result);

            // echo "$number";
             





?>


<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


