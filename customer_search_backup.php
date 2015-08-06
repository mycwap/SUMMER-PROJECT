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
    $delivery = $_COOKIE["delivery_option"];  
    
    $customer_position_lat = $_COOKIE["customer_position_lat"];

    $customer_position_lng = $_COOKIE["customer_position_lng"];

    // $customer_position_lat=$_COOKIE["customer_position_lat"];
    // $customer_position_lat = $POST_['lat'];
    // $customer_position_lng=$_COOKIE["customer_position_lng"];
    // $customer_position_lng = $POST_['lng'];

    ?>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      restaurant: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      },
      bar: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    };

    function load() {

      var array = [<?php echo $customer_position_lat.",".$customer_position_lng; ?>];

      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(array[0],array[1]),
        zoom: 13,
        mapTypeId: 'roadmap'
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
  <nav class="navbar navbar-default navbar-customize navbar-fixed-top" role="navigation">
    
    <div class="container">
      <div class="navbar-header">
      
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-FunDeli-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      
      
      <a class="navbar-brand" href="#"><img class="modal-title" src="image/logo.png"/></a>
      </div>

       <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1">   
          <ul class="nav navbar-nav ">                                               
            
            <li><a href="#">How It Works</a></li>
            <li><a href="#myModal" data-toggle="modal" data-target="#myModal">Log-in</a></li>
          </ul>
       </div>
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

 
  <div class="jumbotron">
     
      <div class="slogan">
        <p>Fundeli</p>
        <p>Business Home Page</p>
      </div>

      <div class="search" style="text-align:center;">
        <form class="business_info" action="search_data_send.php" method="post">

        <!--<label style="margin-right: 65px;">First name:</label>
        <input type="text" name="fn"><br>
        <label style="margin-right: 65px;">Last name:</label>
        <input stype="text" name="ln"><br>-->
        <label class="typechoose" for="deliver">Ask for Delivery</label>
          <input class="choose" type="radio" name="deliver" id="delivery" value="1"><label class="typechoose">or Collect</label>
          <input class="choose" type="radio" name="deliver" id="delivery" value="2">

          <br>
          <label style="margin-right: 46px;">Cuisine Type:</label>
        <select id="foodtype" name="cuisine_type">
            <option value="4">American</option>
            <option value="1">Chinese</option>
            <option value="5">French</option>
            <option value="3">Irish</option>
            <option value="6">Italian</option>
            <option value="10">Indian</option>
            <option value="2">Japanese</option>
            <option value="9">Mexican</option>
            <option value="12">Middle East</option>
            <option value="7">Spainish</option>
            <option value="8">Thai</option>
            <option value="11">Turkish</option>
          </select><br>

          <label style="width: 310px; float: left;">Find food nearby:&nbsp;
          <input id="address" onFocus="geolocate()" type="textbox" name="business_address" placeholder="Street, City">
          </label>
          
          <input type="button" value="Search Map" onclick="codeAddress()">
    
          <div id="map" style="width: 500px; height: 300px"></div>
          <br>
          <input type="hidden" name="lat" id="lat">
          <br>
          <input type="hidden" name="lng" id="lng">
          <br>      
        
        <button type="submit" id="b_info_update" style="width: 50px; margin-top: 20px;">Search</button>
        
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