<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDeli</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
    <script>
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

var placeSearch, autocomplete;
var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  country: 'long_name',
  postal_code: 'short_name'
};

function initialize() {
  // Create the autocomplete object, restricting the search
  // to geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      /** @type {HTMLInputElement} */(document.getElementById('autocomplete')),
      { types: ['geocode'] });
  // When the user selects an address from the dropdown,
  // populate the address fields in the form.
  google.maps.event.addListener(autocomplete, 'place_changed', function() {
    fillInAddress();
  });
}

// [START region_fillform]
function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}
// [END region_fillform]

// [START region_geolocation]
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = new google.maps.LatLng(
          position.coords.latitude, position.coords.longitude);
      var circle = new google.maps.Circle({
        center: geolocation,
        radius: position.coords.accuracy
      });
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
// [END region_geolocation]

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

       <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1">   
          <ul class="nav navbar-nav ">                                               
            
            <li><a href="#">How It Works</a></li>
            <b>Welcome:
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
     
      <div class="slogan">
        <p>Fundeli</p>
        <p>Business Home Page</p>
      </div>

      <div class="search" style="text-align:center;">
        <form class="business_info" action="business_info_send.php" method="post">

        <!--<label style="margin-right: 65px;">First name:</label>
        <input type="text" name="fn"><br>
        <label style="margin-right: 65px;">Last name:</label>
        <input stype="text" name="ln"><br>-->
        <label style="margin-right: 40px;">Business Type:</label>
        <select id="b_foodtype" name="business_type">
            <option value="takeaway">Takeaway</option>
            <option value="restaurant">Restaurant</option>
            <option value="delifood">Deli food</option>
            <option value="fastfood">Fast food</option>
        </select><br>

          <label style="width: 310px;">Business Area:&nbsp;
            <input id="autocomplete" placeholder="Enter your address"
             onFocus="geolocate()" type="text" name="business_address">
          </label>
        <br>
        <label style="margin-right: 32px;">Street Address:</label>
        <input type="text" name="business_street"><br>
        <label style="margin-right: 44px;">City Address:</label>
        <input stype="text" name="business_city"><br>

        <label style="margin-right: 30px;">Business Name:</label>
        <input stype="text" name="business_name"><br>
        <label style="margin-right: 18px;">Business Contact:</label>
        <input type="text" name="business_contact"><br>
        <label style="margin-right: 32px;">Business Email:</label>
        <input type="text" name="business_email"><br>

        <label style="margin-right: 46px;">Cuisine Type:</label>
        <select id="b_foodtype">
            <option value="Chinese">Chinese</option>
            <option value="Japanese">Japanese</option>
            <option value="Italian">Italian</option>
            <option value="French">French</option>
            <option value="Spainish">Spainish</option>
            <option value="Mexican">Mexican</option>
            <option value="Turkish">Turkish</option>
            <option value="Thai">Thai</option>
            <option value="Indian">Indian</option>
        </select><br>
        
        <button type="submit" id="b_info_update"style="
        width: 50px; margin-top: 20px;"><a href="business_menu.php">Next</a></button>
        
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