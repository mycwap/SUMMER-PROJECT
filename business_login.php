<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
    <style>
      #map-canvas {
        height: 300px;
        width: 500px;
        margin: 0;
        padding: 0;
      }

      #address{
         
      }

      

    </style>
    
    <title>Business Information</title>
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

    </script>
    <style>
      #target {
        width: 345px;
      }
    </style>
  </head>
  <body onload="initialize()"> 
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
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <img class="modal-title" src="image/logo.png"/>         
          </div>
          
          <div class="modal-footer">
            <a href="#" data-dismiss="modal" class="btn">Close</a>
          </div>
        </div>
      </div>
  </div>

 
  <div class="jumbotron">
    

    <div class="search" style="
    padding-top: 50px;
    height: 820px;
" >
      <form class="business_info" action="upload_carry_test.php" method="post" enctype="multipart/form-data">

        <label style="margin-right: 40px;">Business Type:</label>
        <select id="b_foodtype" name="business_type">
            <option value="homemade">Homemade</option>
            <option value="takeaway">Takeaway</option>
            <option value="delifood">Deli food</option>
            <option value="fastfood">Fast food</option>

        </select><br>

        <label>Business address</label>
        <input id="address" onFocus="geolocate()" style="
    margin-left: 22px;
    width: 174px;
" type="textbox" name="business_address" placeholder="Street Number, City" >
        <input type="button" value="Search Map" onclick="codeAddress()">
    
        <div id="map-canvas"></div>
        
        <input type="hidden" name="lat" id="lat">
        
        <input type="hidden" name="lng" id="lng">   

        <br>
      
        <label style="margin-right: 32px;">Street Address:</label>
        <input type="text" name="business_street" style="
    margin-left: 8px;
"><br>
        <label style="margin-right: 44px;">City Address:</label>
        <input stype="text" name="business_city" style="
    margin-left: 9px;
"><br>

        <label style="margin-right: 30px;">Business Name:</label>
        <input stype="text" name="business_name" style="
    margin-left: 5px;
"><br>
        <label style="margin-right: 18px;">Business Contact:</label>
        <input type="text" name="business_contact"><br>
        <label style="margin-right: 32px;">Business Email:</label>
        <input type="text" name="business_email" style="
    margin-left: 3px;
"><br>

        <label style="margin-right: 46px;">Cuisine Type:</label>
        <select id="b_foodtype" name="cuisine_type" style="
    margin-left: 5px;
">
            <option value="American">American</option>
            <option value="Chinese">Chinese</option>
            <option value="French">French</option>
            <option value="Irish">Irish</option>
            <option value="Italian">Italian</option>
            <option value="Indian">Indian</option>
            <option value="Japanese">Japanese</option>
            <option value="Mexican">Mexican</option>
            <option value="Middle East">Middle East</option>
            <option value="Spanish">Spanish</option>
            <option value="Thai">Thai</option>
            <option value="Turkish">Turkish</option>
        </select><br>

        <label>Delivery Ability:</label>
        <input type="radio" name="deliverable" value="1" style="
    margin-left: 40px;
">Yes
        <input type="radio" name="deliverable" value="0">No
        <br>
 

        
        <label>Business Logo:</label>
        <input type="file" name="logo" /> 
        <br />
        
        <input type="submit" id="b_info_update" name="submit" value="next" style="width: 50px; margin-top: 20px;"/>
        
      </form>


    </div>       
    
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