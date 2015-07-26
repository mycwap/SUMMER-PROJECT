<!Doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FunDeli</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/customize.css" rel="stylesheet">



    <script>
      function logincheck() 
      {
      var email = document.forms["loginform"]["email"].value;
      var pword = document.forms["loginform"]["password"].value;

      if (email==null || email=="")
      {
        document.getElementById("error_username").innerHTML="Please input your email";
        return false;
        if (pword==null || pword=="")
          {
            document.getElementById("error_password").innerHTML="Please input your password";
            return false;
          }
        else
          {
            return true;
          }
        }
      }
    </script>

  <script> 
   
    function formcheck() 
    {
      
      var un = document.forms["registration"]["username"].value;
      var pw = document.forms["registration"]["password"].value;
      var cpw = document.forms["registration"]["cpassword"].value; 


      var em = document.forms["registration"]["email"].value;
      var at = t.indexOf("@");
      var dot = t.lastIndexOf(".");

      if (un==null || un=="")
      {
        document.getElementById("error_uname").innerHTML="Please input your Username"; 
        return false;
      }

      if (at<1 || dot<at + 2 || dot + 2> em.length)
      {
        document.getElementById("error_email").innerHTML="Please input a valid email address"; 
        return false;  
      }

      if (pw==null || pw=="")
      {
        document.getElementById("error_pword").innerHTML="Please input password"; 
        return false;
      }

      if (pw!=cpw)
      {
        document.getElementById("error_cpword").innerHTML="Please confirm password again"; 
        return false;
      }

      else 
      {
        return true;
      }
    }
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

      <div class="collapse navbar-collapse  navbar-right" id="bs-FunDeli-navbar-collapse-1">   
        <ul class="nav navbar-nav ">                                                
          <li><a href="product_list.html">How it works/ </a></li>
          <b>Welcome:
              <?php
              echo $_COOKIE["sign_username"];                
              ?>
          </b>
          <!--<li><a href="#myModal" data-toggle="modal" data-target="#myModal">Log-in</a></li>-->
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
                  <h3 class="login-title">Login:</h3>
                        
                  <input id="email" class="form-control" id="email" placeholder="Enter email" type="email" name="email">
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
                  <button type="submit" class="btn btn-default">Submit</button>     
              </form>
            </div>

            <div class="col-md-6 signin-area">
              <form id="registration" action="registration_send.php" method="post" onsubmit="return formcheck()">
                <div class="form-group">
                  <h3 class="signin-title">Sign up:</h3>    
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
        <p>We provide</p>
        <p>On demand, fast lunch food</p>
      </div>

      <div class="search" style="text-align:center;">
        <form>
          
          <label class="typechoose" for="deliver">Delivery</label>
          <input class="choose" type="radio" name="food" id="delivery" value="delivery"> 
          <label class="typechoose" for="female">Collect</label>
          <input class="choose" type="radio" name="food" id="delivery" value="pickup"><br>

         

          <input type="text" name="address" id="address" placeholder="Street address, city">
          
          <select id="foodtype">
            <option value="Chinese">Chinese</option>
            <option value="Japanese">Japanese</option>
            <option value="Italian">Italian</option>
            <option value="French">French</option>
          </select>

         

          <input type="submit" value="Search" id="pressbutton">




        </form>
      </div>       
    
  </div>

 

  <div class="footer">
    <div class="info">
      <ul class="footer-nav no_padding  ">
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">Blog</a></li>  
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