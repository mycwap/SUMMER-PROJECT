<!DOCTYPE html>
<html>
  <head>
    <title>Delifriends Home</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">
    <style>
      #map-canvas {
        height: 400px;
        width: 100%;
        margin: 0;
        padding: 0;
      }

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>

    <script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

var map;

function initialize() {
  var mapOptions = {
    zoom: 14
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var center_icon = {
      url: 'mapicon/center.png',
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
          position: pos,
          icon: center_icon
      });

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'You are here.'
      });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
}

function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: The Geolocation service failed.';
  } else {
    var content = 'Error: Your browser doesn\'t support geolocation.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
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
            <li><a href="deliveryman_account.php">My account</a></li>



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

        <div>
          <form action="dispatch_time_send.php" method="post" role="form">
            <div class="form-group">
              <label for="sel1">Select list (select one):</label>
              <select required id="dispatch_time" name="dispatch_time" class="form-control">
                <option value="9:00" label="9:00" >9:00</option>
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

              <input type="submit" value="Confirm">
              <br>
            </div>
          </form>

          
        </div>

        <div id="map-canvas"></div>
      </div>          
  </div>

  <div class="footer">
    <div class="info">
      <ul class="footer-nav no_padding  ">
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Blog</a></li>
        <li><a href="home.html" data-toggle="modal" data-target="#myModal2">Logout</a></li>
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