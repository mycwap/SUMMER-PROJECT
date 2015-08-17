<!DOCTYPE html>
<html>
  <head>
    <title>Delifriends Home</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
    <style>
      #map {
        height: 400px;
        width: 100%;
        margin: 0 auto;
        padding: 0;
      }

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script type="text/javascript">

    var directionsService = new google.maps.DirectionsService();
    var directionsDisplay;
    var arrLatLon;
    var orderLatlng;
    var point;
    // var destinationID;

    var order_icon = {
      url: 'mapicon/takeaway.png',
      // This marker is 20 pixels wide by 32 pixels tall.
      size: new google.maps.Size(48, 48),
      // The origin for this image is 0,0.
      origin: new google.maps.Point(0,0),
      // The anchor for this image is the base of the flagpole at 0,32.
      anchor: new google.maps.Point(0, 48)
      };

      function load() {

      var latlng_array = 
      [<?php 

      $deliveryman_position_lat = $_COOKIE["deliveryman_position_lat"];

      $deliveryman_position_lng = $_COOKIE["deliveryman_position_lng"]; 

      echo $deliveryman_position_lat.",".$deliveryman_position_lng;?>];


      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(latlng_array[0],latlng_array[1]),
        zoom: 15,
        mapTypeId: 'roadmap'
      });

      var newcenter = new google.maps.LatLng(latlng_array[0], latlng_array[1]);

      var center_icon = {
      url: 'mapicon/center.png',
      // This marker is 20 pixels wide by 32 pixels tall.
      size: new google.maps.Size(48, 48),
      // The origin for this image is 0,0.
      origin: new google.maps.Point(0,0),
      // The anchor for this image is the base of the flagpole at 0,32.
      anchor: new google.maps.Point(0, 48)
      };

      var marker = new google.maps.Marker({

          map: map,
          animation: google.maps.Animation.DROP,
          position: newcenter,
          icon: center_icon
      });

      var infoWindow = new google.maps.InfoWindow;

      // Change this depending on the name of your PHP file
      downloadUrl("deliveryman_order_search_map.php", function(data) {
        var xml = data.responseXML;

        var markers = xml.documentElement.getElementsByTagName("deliveryman");

        for (var i = 0; i < markers.length; i++) {

          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));

          var html = "<b>" + name + "</b> <br/>" + address;

          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: order_icon   
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });

      
    }

function initialize(id) {

      // var od = id;

      var bat = 'b_a_lat' + id;
      var bag = 'b_a_lng' + id;

      var oat = 'o_a_lat' + id;
      var oag = 'o_a_lng' + id;


        var b_a_lat = document.getElementById(bat).value;
        var b_a_lng = document.getElementById(bag).value;

        var o_a_lat = document.getElementById(oat).value;
        var o_a_lng = document.getElementById(oag).value;

        
        var orderLatlng = new google.maps.LatLng(b_a_lat,b_a_lng);

        var latlng_array2 = 
        [<?php 

        $deliveryman_position_lat2 = $_COOKIE["deliveryman_position_lat"];

        $deliveryman_position_lng2 = $_COOKIE["deliveryman_position_lng"]; 

        echo $deliveryman_position_lat2.",".$deliveryman_position_lng2;?>];


        // var map = new google.maps.Map(document.getElementById("map"), {
        //   center: new google.maps.LatLng(latlng_array2[0],latlng_array2[1]),
        //   zoom: 15,
        //   mapTypeId: 'roadmap'
        // });

        var newcenter = new google.maps.LatLng(latlng_array2[0], latlng_array2[1]);

        var center_icon1 = {
        url: 'mapicon/center.png',
        // This marker is 20 pixels wide by 32 pixels tall.
        size: new google.maps.Size(48, 48),
        // The origin for this image is 0,0.
        origin: new google.maps.Point(0,0),
        // The anchor for this image is the base of the flagpole at 0,32.
        anchor: new google.maps.Point(0, 48)
        };

        // var marker = new google.maps.Marker({

        //     map: map,
        //     animation: google.maps.Animation.DROP,
        //     position: newcenter,
        //     icon: center_icon
        // });
        

        var myOptions = {
            // zoom: 14,
            center: newcenter,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), myOptions);

        var infowindow = new google.maps.InfoWindow({
            content: ''
        });

        var order_focus_icon = {
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
          position: newcenter,
          icon: center_icon1
      });

      var marker = new google.maps.Marker({

          map: map,
          animation: google.maps.Animation.DROP,
          position: orderLatlng,
          icon: order_focus_icon
      });


        directionsDisplay = new google.maps.DirectionsRenderer({
            
            map: map, 
            markerOptions: {
            
            },
            panel: document.getElementById("directionsPanel"),
            infoWindow: infowindow
        });

            
            var arrLatLon = new google.maps.LatLng(o_a_lat,o_a_lng);

          // arrLatLon = new google.maps.LatLng(51.891327,-8.470776);


          google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
            computeTotalDistance(directionsDisplay.directions);
        });

        
        var selectedMode = document.getElementById("mode").value;
        var selectedUnits = document.getElementById("units").value;


        var request1 = {
            origin: orderLatlng,
            destination:arrLatLon,
            travelMode: google.maps.DirectionsTravelMode[selectedMode],
            unitSystem: google.maps.UnitSystem[selectedUnits]
        };

        directionsService.route(request1, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });

      //   var bounds = new google.maps.LatLngBounds();
      // bounds.extend(newcenter);
      // bounds.extend(orderLatlng);
      // map.fitBounds(bounds);

    }

   

 function computeTotalDistance(result) {
        var total = 0;
        var myroute = result.routes[0];
        for (i = 0; i < myroute.legs.length; i++) {
            total += myroute.legs[i].distance.value;
        }
        total = total / 1000;

        var selectedUnits = document.getElementById("units").value;

        if (selectedUnits == "IMPERIAL") {
            document.getElementById("total").innerHTML = (Math.round((total* 0.6214)*100)/100) + " miles";
        } else {
            document.getElementById("total").innerHTML = total + " kilometres";
        }
    }


    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function(){
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}



    
    </script>

    </head>
  <body onload="load()">
  <nav class="navbar navbar-default navbar-customize navbar-fixed-top" role="navigation">
    
    <div class="container">
      <div class="navbar-header">
      
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-FunDeli-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      
       <a class="navbar-brand" style="font-size: 30px;font-weight: 800; margin-top: 10px; " href="#">FunDeli</a>
      </div>

      

      <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1" style="background-color: rgb(248, 248, 248);height: 121px;">   
          <ul class="nav navbar-nav " style="height: 80px;background-color: rgb(244, 65, 0);margin-top:0px;">                                               
            
            <li><a href="###" style="color:white; font-weight:border;">My account</a></li>
             
            <li style="margin-bottom: 0px;margin-top: 15px;font-weight: bolder;color: white;">Welcome:
                <?php
                  echo $_COOKIE["username"];                
                ?>
            </li>
          </ul>
       </div>
    </div>
  </nav>

  <div class="jumbotron" style="margin-top: 0px;padding: 20px;">
     
     

      <div class="search" style="text-align:center;width: 85%;height: 600px;">

        <div style="
    height: 650px;
">
          <form action="dispatch_time_send2.php" method="post" role="form">
            <div class="form-group">
              <label for="sel1">Select Dispatch Time(select one):</label>
              <select required id="dispatch_time" name="dispatch_time" class="form-control">
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
              <input type="hidden" name="lat" id="lat">
              
              <input type="hidden" name="lng" id="lng"> 

              <input type="submit" value="Check">
              <br>
              <div id="map" style="width: 100%; height: 300px; position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);"></div>
            </div>
          </form>
          <br>
          <?php 
          include ("dbinfo_li.php");

          $connection = mysqli_connect($servername, $username, $password);
          if (!$connection) {
          die('Not connected : ' . mysqli_connect_error());
          }

          // Set the active MySQL database
          $db_selected = mysqli_select_db($connection,$database);
          if (!$db_selected) {
          die ('Can\'t use db : ' . mysqli_connect_error());
          }

          $dispatch_time = $_COOKIE["dispatch_time"];

          $sql = "SELECT business.business_name, business.business_address,
          business.business_address_lat, business.business_address_lng,
          order_customer.delivery_address, order_customer.delivery_address_lat,
          order_customer.delivery_address_lng, order_customer.order_customer_id FROM order_customer
          INNER JOIN business ON order_customer.business_id = business.business_id
          WHERE order_customer.order_dispatch='$dispatch_time'";

          $result = mysqli_query($connection,$sql)
          or die("Error:".mysqli_error($connection));

          echo '<table style="width:100%;margin-bottom: 20px;">';
          echo '<tr style="font-weight: bold;text-align: center;">
                    <td></td>
                     
                    <td>Start From</td>
                    <td>Business Address</td>
                    <td></td><td>Destination</td>
                    <td>Dispatched By</td>
                    

                </tr>';

            $i = 1;
            while($row = mysqli_fetch_assoc($result)){
            

            echo '<tr><form action="accept_send.php" method="post">';
            echo '<td><button type="button" onclick="initialize('.$i.'); return false;">View</button></td>';
            
            echo '<td>'.$row['business_name'].'</td>';
            echo '<td>'.$row['business_address'].',</td>';
            echo '<td>To:</td>';
            echo '<td>'.$row['delivery_address'].'</td>';
            echo '<td>'.$dispatch_time.'</td>';

            echo '<td><input type="hidden" id = "b_a_lat'.$i.'" name="b_a_lat" value ="'.$row['business_address_lat'].'"></td>';
            echo '<td><input type="hidden" id = "b_a_lng'.$i.'" name="b_a_lng" value ="'.$row['business_address_lng'].'"></td>';
            echo '<td><input type="hidden" id = "o_a_lat'.$i.'" name="o_a_lat" value ="'.$row['delivery_address_lat'].'"></td>';
            echo '<td><input type="hidden" id = "o_a_lng'.$i.'" name="o_a_lng" value ="'.$row['delivery_address_lng'].'"></td>';
            echo '<td><input type="hidden" name="order_id" value ="'.$row['order_customer_id'].'"></td>';
            // echo 'lng="' . $row['order_address_lng'] . '" ';
            // echo 'type="' . $row['deliveryman_type'] . '" ';
            echo '<td><input type="submit" value="Accept"/></td>';
            echo '</form></tr>';
            // 
            
            $i = $i + 1;
          }
                   
          echo '</table>';

          ?>

          <p style="
    width: 280px;
    display: inline;
">Total Distance: <span id="total"></span></p>
          
       

           <div style="
    display: inline;
    margin-left: 80px;
">
                <strong>Mode of Travel: </strong>
                <select id="mode" onchange="initialize()">
                  <option value="WALKING" selected="selected">Walking</option>
                </select>
          </div>

          <div style="
    display: inline;
">
              <strong>Measurement units: </strong>
              <select id="units" onchange="initialize()">
                <option value="IMPERIAL" selected="selected">Miles</option>
              </select>
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
        <li><a href="index.php">Logout</a></li>
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
