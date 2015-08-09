<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDeli Home</title>
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

  <body onload="initialize()"> 
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

      <b>Welcome:
              <?php
                echo $_COOKIE["username"];                
              ?>
      </b>

      <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1">   
          <ul class="nav navbar-nav ">                                                  
            <li><a href="user_account.php">My account</a></li>



            <!-- ************需要增加链接************ -->



          </ul>
      </div>
    </div>
  </nav>

 
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
          <input class="choose" type="radio" name="deliver" id="delivery" value="1">

          <label class="typechoose">or Collect</label>
          <input class="choose" type="radio" name="deliver" id="delivery" value="2">

          <br>
          <label style="margin-right: 46px;">Cuisine Type:</label>
        <select id="foodtype" name="cuisine_type">
          <!--the search functional value is cuisine_type_id-->
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

          <label style="width: 310px; float: left;">Find food nearby:&nbsp;
          <input id="address" onFocus="geolocate()" type="textbox" name="business_address" placeholder="Street, City">
          </label>
          
          <input type="button" value="Search Map" onclick="codeAddress()">
    
          <div id="map-canvas"></div>
          <br>
          <input type="hidden" name="lat" id="lat">
          <br>
          <input type="hidden" name="lng" id="lng">
          <br>      
        
        <input type="submit" value="Search" id="b_info_update" style="width: 50px; margin-top: 20px;">
        
        </form>


      </div>       
    
  </div>


  <div class="footer">
    <div class="info">
      <ul class="footer-nav no_padding  ">
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Blog</a></li>
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