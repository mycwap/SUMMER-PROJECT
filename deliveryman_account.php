<!DOCTYPE html>
<html>
  <head>
    <title>Delifriends Account</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      #map-canvas {
        height: 400px;
        width: 100%;
        margin: 0;
        padding: 0;
      }

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>




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
            <li><a href="delivery_account.php">My account</a></li>



            <!-- ************需要增加链接************ -->



          </ul>
      </div>
    </div>
  </nav>
    <div id="map-canvas"></div>

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