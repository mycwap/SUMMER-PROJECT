<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDeli Business</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">

    <style>
      #map-canvas {
        height: 300px;
        width: 400px;
        margin: 0;
        padding: 0;
      }

     
    </style>
    
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    
    <script>
// This example adds a search box to a map, using the Google Place Autocomplete
// feature. People can enter geographical searches. The search box will return a
// pick list containing a mix of places and predicted search terms.

var address;
var geocoder;
var map;

function initialize() {
  var myLatlng = new google.maps.LatLng(51.893609,-8.49119769999993);
  geocoder = new google.maps.Geocoder();
  
  map = new google.maps.Map(document.getElementById('map-canvas'),{
    center:myLatlng,
    zoom:15
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
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: results[0].geometry.location,
          icon: center_icon
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

  <body onload="initialize()" style="margin-top:80px"> 
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
                  <h3 class="login-title">Login (Customer):</h3>
                        
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
                  <h3 class="signin-title">Sign up (Customer):</h3>    
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

<div class="modal fade" id="myModal3">
  <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <img class="modal-title" src="image/logo.png"/>         
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-6 " >
              <form id="loginform" action="deliveryman_login_send.php" method="post" onsubmit="return logincheck()">
                <div class="form-group">
                  <h3 class="login-title">Login (deliveryman):</h3>
                  
                  <label>Email</label>
                  <input id="email" class="form-control" placeholder="Enter email" type="email" name="email">
                   
                      <span id="error_email" style="color:red" ></span>
                   
                </div>
                <div class="form-group">
                  <label>Password</label>   
                  <input id="password" class="form-control" id="password" placeholder="Password" type="password" name="password">
                  
                  <span id="error_password" style="color:red"></span>
                  
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
              <form id="registration" action="delivery_registration_send.php" method="post" onsubmit="return formcheck()">
                <div class="form-group">
                  <h3 class="signin-title">Sign up (deliveryman):</h3>    
                    <input class="form-control" id="email" placeholder="Enter email" type="email" name="email">
                    <br>
                    <span id="error_email" style="color:red" ></span>
                    <br>
                </div>

                <div class="form-group">                           
                    <input class="form-control" id="mobile" placeholder="Mobile Number" type="type" name="mobile">
                    <br>
                    <span id="error_uname" style="color:red" ></span>
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

 
  <div class="jumbotron npm" style="
    margin-bottom: 50px;
    padding-top: 30px;
">    
         <div class="search" >
              <form class="business_info" action="search_data_send.php" method="post" style="width: 520px;">

           
                <label style="margin-right: 0px;">Ask for:</label>
                <select  name="deliver" style="
                  height: 34px;
                  width: 202px;
                  margin-left: 66px;
                  margin-bottom: 10px;
                  margin-top: 40px;
                ">
                  <option value="1">Deliver</option>
                  <option value="2">Collect</option>    
                </select>
                
                <br>


                <label style="margin-right: 0px;">Cuisine Type:</label>
                <select id="foodtype" name="cuisine_type" style="height: 34px;width: 200px;margin-left: 25px;margin-bottom: 10px;
                    ">         
                          <option value="1">Chinese</option>
                          <option value="2">Japanese</option>
                          <option value="3">Irish</option>
                          <option value="4">American</option>
                          <option value="5">French</option>
                          <option value="6">Italian</option>
                          <option value="7">Spainish</option>
                          <option value="8">Thai</option>
                          <option value="9">Mexican</option>
                          <option value="10">Indian</option>
                          <option value="11">Turkish</option>     
                          <option value="12">Middle East</option>  
                </select><br>

                <label >Find food nearby</label>
                <input id="address" onFocus="geolocate()" type="textbox" name="business_address" placeholder="Street, City" style="width: 200px; height: 36px; ">
                </label>
                
                <input type="button" value="Search Map" onclick="codeAddress()" style="height: 36px;">
                <input type="submit" value="Search" id="b_info_update" style="width: 96px;height: 36px;">
          
                <div id="map-canvas" style="position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);width: 520px;margin-top: 20px;margin-bottom: 40px;"></div>
                
                <input type="hidden" name="lat" id="lat">
                
                <input type="hidden" name="lng" id="lng">
                  
              
               <!--  <input type="submit" value="Search" id="b_info_update"> -->
              
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
                        <h3 class="login-title">Login (Business):</h3>
                        
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
                      <h3 class="signin-title">Sign up (Business):</h3>
                          
                      <input name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter owner's email" type="email">
                    </div>
                    <div class="form-group">
                           
                      <input name="owner_fullname" class="form-control" id="exampleInputPassword1" placeholder="Owner's full name" type="type">
                    </div>

                    <div class="form-group">
                           
                      <input name="business_contact" class="form-control" id="exampleInputPassword1" placeholder="Business owner's contact (unique)" type="type">
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
        <li><a href="index.php">logout</a></li>
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