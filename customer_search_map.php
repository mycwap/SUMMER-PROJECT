<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDeli Business</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">

    <style>
      #map {
        height: 300px;
        width: 400px;
        margin: 0;
        padding: 0;
      }

      #address{
        float: left;
      }

      

    </style>
    <?php
    include ("dbinfo_li.php");
    $cuisines = $_COOKIE["cuisines_type"];
    // Select all the rows in the markers table
    $query = "SELECT business_id, business_name, business_address, business_address_lat, business_address_lng ,
    cuisine_type_id FROM business WHERE cuisine_type_id='$cuisines'";

    $result = mysqli_query($connection, $query);

    $business_id = array();
    while ($row = mysqli_fetch_object($result)){
    $business_id[] = $row->business_id;
    }

    // $business_id_string = join(",", $business_id);

    $business_id_string = implode(",", $business_id);

    setcookie("business_i_string", $business_id_string, time()+3600);

    // $delivery = $_COOKIE["delivery_option"];  
    

    ?>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      1: {
        icon: 'mapicon/takeaway.png' 
        // size: new google.maps.Size(48, 48),  
        // origin: new google.maps.Point(0,0), 
        // anchor: new google.maps.Point(0, 48)   
      },
      2: {
        icon: 'mapicon/restaurant.png'
        // size: new google.maps.Size(48, 48),  
        // origin: new google.maps.Point(0,0), 
        // anchor: new google.maps.Point(0, 48)

      },
      3: {
        icon: 'mapicon/delifood.png'
        // size: new google.maps.Size(48, 48),  
        // origin: new google.maps.Point(0,0), 
        // anchor: new google.maps.Point(0, 48)
      },
      4: {
        icon: 'mapicon/fastfood.png'
        // size: new google.maps.Size(48, 48),  
        // origin: new google.maps.Point(0,0), 
        // anchor: new google.maps.Point(0, 48)       
      },
      5: {
        icon: 'mapicon/homemade.png' 
        // size: new google.maps.Size(48, 48),  
        // origin: new google.maps.Point(0,0), 
        // anchor: new google.maps.Point(0, 48)     
      }
    };

    function load() {

      var latlng_array = 
      [<?php 

      $customer_position_lat = $_COOKIE["customer_position_lat"];

      $customer_position_lng = $_COOKIE["customer_position_lng"]; 

      echo $customer_position_lat.",".$customer_position_lng; ?>];

      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(latlng_array[0],latlng_array[1]),
        zoom: 14,
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
      downloadUrl("business_search_map.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("business");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var address = markers[i].getAttribute("address");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("lat")),
              parseFloat(markers[i].getAttribute("lng")));
          var html = "<b>" + name + "</b> <br/>" + address;
          var icon = customIcons[type] || {};
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow
          });
          bindInfoWindow(marker, map, infoWindow, html);
        }
      });
    }

    function codeAddress() {
  var address = document.getElementById('address').value;
  geocoder.geocode( { 'address': address}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
      map.setCenter(results[0].geometry.location);
      

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

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

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

    //]]>
  </script>
  <style>
      #locationField, #controls {
        position: relative;
        width: 200px;
        
      }
      #autocomplete {
        
        top: 0px;
        left: 0px;
        width: 200px;
        float:right;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
      }
      
  </style>
  
  </head>

  <body onload="load()"> 
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

       <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1" style="background-color: rgb(248, 248, 248);height: 121px;">   
          <ul class="nav navbar-nav " style="height: 80px;background-color: rgb(244, 65, 0);margin-top:0px;">                                               
            
            <li><a href="#myModal" data-toggle="modal" data-target="#myModal"style="color:white; font-weight:border;">Customer</a></li>
            <!-- <li><a href="#myModal" data-toggle="modal" data-target="#myModal3">Deliver</a></li> -->
            <li style="margin-bottom: 0px;margin-top: 15px;font-weight: bolder;color: white;">Welcome:
                <?php
                  echo $_COOKIE["username"];                
                ?>
            </li>
          </ul>
       </div>
  </nav>

  <div class="modal fade" id="myModal">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <img class="modal-title" src="image/logo.png"/>         
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6 " >
              <form id="loginform" action="login_send.php" method="post" onsubmit="return logincheck()">
                <div class="form-group">
                  <h3 class="login-title">User Login:</h3>
                        
                  <input id="email" class="form-control" placeholder="Enter email" type="email" name="email">
                    <br>
                      <span id="error_email" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                      
                  <input id="password" class="form-control" id="password" placeholder="Password" type="password" name="password">
                  <br>
                  <span id="error_password" style="color:red"></span>
                  <br>
                </div>
                <div class="checkbox-login">
                  <label>
                    <input type="checkbox"> Remember me
                  </label>
                    <p style="display:inline; margin-left:30px;"class="text-right"><a style="text-decoration: none;" href="#">Forgot password?</a>
                    </p>
                </div>
                <button type="submit" class="btn btn-default">Login</button>     
              </form>
            </div>

            <div class="col-md-6 signin-area">
              <form id="registration" action="registration_send.php" method="post" onsubmit="return formcheck()">
                <div class="form-group">
                  <h3 class="signin-title">Sign up(User):</h3>    
                    <input class="form-control" id="email" placeholder="Enter email" type="email" name="email">
                    <br>
                    <span id="error_email" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                           
                    <input class="form-control" id="username" placeholder="Username" type="type" name="username">
                    <br>
                    <span id="error_uname" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                           
                    <input class="form-control" id="password" placeholder="Password" type="password" name="password">
                    <br>
                    <span id="error_pword" style="color:red" ></span>
                    <br>
                </div>
                <div class="form-group">
                           
                    <input class="form-control" id="cpassword" placeholder="Re-enter password" type="password" name="repassword">
                    <br>
                    <span id="error_cpword" style="color:red" ></span>
                    <br>
                </div>
                <div class="checkbox-signin">
                  <label>
                    <input type="checkbox"> Keep me logged in to my account
                  </label>  
                </div>
                <button type="submit" class="btn btn-default">Sign up</button>
              </form>
            </div>
           
        </div>
      </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
        </div>
      </div>
    </div>
</div>

 
  <div class="jumbotron nmp">
     
      

      <div class="search" style="
    padding-top: 50px;
">
        <form class="business_info" action="business_deliverable_judge.php" method="post">
          
          <button type="submit" id="b_info_update"  style="width: 106px;height: 25px;margin-left: 0px;float: right;margin-right: 0px;">Next</button>
          <div id="map" style="width: 500px;"></div>
          
          <input type="hidden" name="lat" id="lat">
          <br>
          <input type="hidden" name="lng" id="lng">
          <br>      
        
          
        
        </form>

      </div>       
    
  </div>

  <div class="modal fade" id="myModal2">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <img class="modal-title" src="image/logo.png"/>         
        </div>
        <div class="modal-body">
          <div class="row">

              <div class="col-md-6 " >
                <form action="business_owner_login.php" method="post">
                    <div class="form-group">
                        <h3 class="login-title">Business Login:</h3>
                        
                        <input name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's email" type="email">
                    </div>
                    <div class="form-group">
                      
                      <input name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" type="password">
                    </div>
                    <div class="checkbox-login">
                      <label>
                        <input type="checkbox"> Remember me
                      </label>
                      <p style="display:inline; margin-left:30px;"class="text-right"><a style="text-decoration: none;" href="#">Forgot password?</a></p>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>  
                </form>
              </div>

              <div class="col-md-6 signin-area">
                <form action="business_owner_sign.php" method="post">

                    <div class="form-group">
                      <h3 class="signin-title">Sign up(Business):</h3>
                          
                      <input name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's email" type="email">
                    </div>
                    <div class="form-group">
                           
                      <input name="owner_fullname" class="form-control" id="exampleInputPassword1" placeholder="Owner's full name" type="type">
                    </div>

                    <div class="form-group">
                           
                      <input name="business_contact" class="form-control" id="exampleInputPassword1" placeholder="Business owner's contact" type="type">
                    </div>

                    <div class="form-group">
                           
                      <input name="owner_username" class="form-control" id="exampleInputPassword1" placeholder="Owner's username" type="type">
                    </div>

                    <div class="form-group">
                           
                      <input name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" type="password">
                    </div>
                    <div class="form-group">
                           
                      <input class="form-control" id="exampleInputPassword1" placeholder="Re-enter password" type="password">
                    </div>
                    <div class="checkbox-signin">
                      <label>
                        <input type="checkbox"> Keep me logged in to my account
                      </label>
                    </div>
                  <button type="submit" class="btn btn-default">Sign up</button>
                </form>
              </div>
            </div>
          </div>
          <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
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
        <li><a href="#myModal" data-toggle="modal" data-target="#myModal2">Business</a></li>
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