<?php
// $business_lat = $_COOKIE["business_lat"];
// $business_lng = $_COOKIE["business_lng"];
include_once("dbinfo_li.php");
$meal_id = $_GET['ide'];
if (isset($_GET['ide']))    
{
		$sql = "SELECT meal_price 
		FROM meal			    	    	    
	    WHERE meal_id = '$meal_id' 
	   ";	   
	   $result=mysqli_query($connection,$sql) or die(mysqli_connect_error());
	   while ($row = mysqli_fetch_object($result)){
	   	$meal_price = $row->meal_price;
	   	setcookie("meal_price",$meal_price,time()+3600);
	    // echo "price: $meal_price";

	   }

}
else{
   echo "fail to get the id";
}
?>
<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDelir</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
    <style>
      #map-canvas {
        height: 300px;
        width: 400px;
        margin: 0;
        padding: 0;
      }

      #address{
        float: left;
      }

    </style>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>

    
    <script>
var address;
var geocoder;
var map;
var directionsService = new google.maps.DirectionsService();
    var directionsDisplay;

function initialize() {
  var myLatlng = new google.maps.LatLng(51.893609,-8.49119769999993);
  geocoder = new google.maps.Geocoder();
  
  map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:myLatlng,
    zoom:18
  });


  address = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('address')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(address, 'place_changed', function() {
    fillInAddress();
  });
}



function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: results[0].geometry.location
      });

        document.getElementById('lat').value = marker.getPosition().lat();
        document.getElementById('lng').value = marker.getPosition().lng();

      google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('lat').value = this.getPosition().lat();
        document.getElementById('lng').value = this.getPosition().lng();
    });

    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      address.setBounds(circle.getBounds());
    });
  }
}


function calculate() {

      // var od = id;

      // var bat = 'b_a_lat' + id;
      // var bag = 'b_a_lng' + id;

      // var oat = 'o_a_lat' + id;
      // var oag = 'o_a_lng' + id;

      var latlng_array = 
      [<?php 

      $business_position_lat = $_COOKIE["business_lat"];

      $business_position_lng = $_COOKIE["business_lng"]; 

      echo $business_position_lat.",".$business_position_lng;?>];

      var order_position = new google.maps.LatLng(latlng_array[0], latlng_array[1]);


        var o_a_lat = document.getElementById('lat').value;
        var o_a_lng = document.getElementById('lng').value;

        
        var myLatlng2 = new google.maps.LatLng(o_a_lat,o_a_lng);
        

        var myOptions = {
            zoom: 14,
            center: order_position,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), myOptions);

        var infowindow = new google.maps.InfoWindow({
            content: ''
        });

        var center_icon = {
      url: 'mapicon/takeaway.png',
      // This marker is 48 pixels wide by 48 pixels tall.
      size: new google.maps.Size(48, 48),
      // The origin for this image is 0,0.
      origin: new google.maps.Point(0,0),
      // The anchor for this image is the base of the flagpole at 0,48.
      anchor: new google.maps.Point(0, 48)
      };

      var marker = new google.maps.Marker({

          map: map,
          animation: google.maps.Animation.DROP,
          position: order_position,
          icon: center_icon
      });

        directionsDisplay = new google.maps.DirectionsRenderer({
            
            map: map, 
            markerOptions: {
            
            },
            panel: document.getElementById("directionsPanel"),
            infoWindow: infowindow
        });

            
            // var arrLatLon = new google.maps.LatLng(o_a_lat,o_a_lng);

          // arrLatLon = new google.maps.LatLng(51.891327,-8.470776);


          google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
            computeTotalDistance(directionsDisplay.directions);
        });

        // only seems possible to display 1 directions at a time?
        // calcRoute();
        var selectedMode = document.getElementById("mode").value;
        var selectedUnits = document.getElementById("units").value;

        // if(typeof(id) != "undefined"){
        //     destinationID = id;
        // }

        var request1 = {
            origin: order_position,
            destination:myLatlng2,
            travelMode: google.maps.DirectionsTravelMode[selectedMode],
            unitSystem: google.maps.UnitSystem[selectedUnits]
        };

        directionsService.route(request1, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
    }

   

    function computeTotalDistance(result) {
        var total = 0;
        var total1 = 0;
        var myroute = result.routes[0];
        for (i = 0; i < myroute.legs.length; i++) {
            total += myroute.legs[i].distance.value;
        }
        total = total / 1000;
        total1 = total;

        var selectedUnits = document.getElementById("units").value;

        if (selectedUnits == "IMPERIAL") {
            document.getElementById("total").innerHTML = (Math.round((total* 0.6214)*100)/100) + " miles";
            document.getElementById("total1").innerHTML = (Math.round((total1* 0.6214)*100)/100) + " miles";
        } else {
            document.getElementById("total").innerHTML = total + " kilometres";
            document.getElementById("total1").innerHTML = total1 + " kilometres";
        }
    }




  </script>
  </head>
<body onload="initialize()">

<h2>Test</h2>

<form name="order_process" method="post" action="calculate.php">
	 
       <label>deliver address:</label>   <!-- 输入地址 -->

        <input id="address" onFocus="geolocate()" type="textbox" name="deliver_address" 
        placeholder="Street Number, City">
        
        <input type="button" value="Search Map" onclick="codeAddress()">
    
        <div id="map-canvas"></div>
        <br>


        <input type="hidden" name="lat" id="lat">
        <br>
        <input type="hidden" name="lng" id="lng"> 

        
      
        <button type="button" onclick="calculate()">Get distance</button>

        <p>Total Distance: <span id="total"></span></p>

        <input type="hidden" name="distance" id="total1"><br>
          

       <label>order delivery fee </label>     

       <label>dispatch time</label>
 	   <select required id="dispatch_time" name="dispatch_time" >
                <option value="9:00" label="9:00">9:00</option>
                <option value="9:30" label="9:30">9:30</option>
                <option value="10:00" label="10:00">10:00</option>
                <option value="10:30" label="10:30">10:30</option>
                <option value="11:00" label="11:00">11:00</option>
                <option value="11:30" label="11:30">11:30</option>
                <option value="12:00" label="12:00">12:00</option>
                <option value="12:30" label="12:30">12:30</option>
                <option value="13:00" label="13:00">13:00</option>
                <option value="13:30" label="13:30">13:30</option>
                <option value="14:00" label="14:00">14:00</option>
                <option value="14:30" label="14:30">14:30</option>
                <option value="15:00" label="15:00">15:00</option>
                <option value="15:30" label="15:30">15:30</option>
                <option value="16:00" label="16:00">16:00</option>
                <option value="16:30" label="16:30">16:30</option>
                <option value="17:00" label="17:00">17:00</option>
                <option value="17:30" label="17:30">17:30</option>
                <option value="18:00" label="18:00">18:00</option>
                <option value="18:30" label="18:30">18:30</option>
                <option value="19:00" label="19:00">19:00</option>
                <option value="19:30" label="19:30">19:30</option>
                <option value="20:00" label="20:00">20:00</option>
                <option value="20:30" label="20:30">20:30</option>
                <option value="21:00" label="21:00">21:00</option>
                <option value="21:30" label="21:30">21:30</option>
                <option value="22:00" label="22:00">22:00</option>
                <option value="22:30" label="22:30">22:30</option>
                <option value="23:00" label="23:00">23:00</option>
                <option value="23:30" label="23:30">23:30</option>
       </select>

       <input type="submit" name="submit" value="Submit"/>

</form>

		<div>
          <strong>Mode of Travel: </strong>
          <select id="mode" onchange="initialize()">
            <option value="WALKING" selected="selected">Walking</option>
          </select>
		</div>

        <div>
          <strong>Measurement units: </strong>
          <select id="units" onchange="initialize()">
            <option value="IMPERIAL" selected="selected">Miles</option>
            <option value="METRIC ">Kilometres</option>
          </select>
        </div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>


