 <html>
   <head>
     <title>Points select test1</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
     <meta charset="utf-8">
     <style>
       html, body {
         margin: 0;
         padding: 0;
         height: 100%;
       }
       #map_canvas {
         height: 500px;
         width: 600px;
       }
     </style>


     <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
     <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
     <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

     <script>
    function myFunction(){
    var destArray = [<?php 
    
            include ("dbinfo.php");

            $sql = "SELECT business_address_lat,business_address_lng FROM business WHERE business_id='5'";


            if ($result = $conn->query($sql)) {
			while ($row = $result->fetch_assoc()) {
 
            
            echo  "[lat:".$row["business_address_lat"]. ",lng:" .$row["business_address_lng"]."]";

            }
           	// To pretect the structure
            // echo "{lat:0.0 ,lng:0.0}";

            /* free result set */
            $result->free();
            }

            $conn->close();

            ?>];


    document.getElementById('demo').innerHTML = destArray;


    }

    





    </script>
    </head>
    <body>
        
    	<button onclick="myFunction()">Try it</button>
        <p id="demo"></p>
    </body>

</html>