
<?php

$servername = "localhost";
$username = "root";
$password = "root";


// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"f38im");

if($_GET['SignUp']==True){

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <link href="css/style.css" rel="stylesheet">
  <script type="text/javascript" src="js/burgerbear.js"></script>

  <title>Burger Bear</title>

</head>

<body>



  <div id="wrapper">

    <div id="header">
      <p> <a href='#' >Sign In</a> | <a href='#'>Track My Order</a></p>
    </div>

    <div id="navigation">
      <ul>
        <li><a href="home.php">Logo</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="#">Account</a></li>
        <li><a href="trackorder.php">TrackOrder</a></li>
        <li><a href="#">Support</a></li>
      </ul>
    </div>


    <div id="content">

      <div id="feature-content">

        <div class="slideshow-container">

          <!-- Full-width images with number and caption text -->
          <div class="mySlides fade">
            <img src="asset/img/home/img1.jpg" style="width:100%;height: 100%;">
          </div>

          <div class="mySlides fade">
            <img src="asset/img/home/img2.jpg" style="width:100%;height: 100%;">
          </div>

          <div class="mySlides fade">
            <img src="asset/img/home/img3.jpg" style="width:100%;height: 100%;">
          </div>

          <!-- Next and previous buttons -->
        </div>


        <!-- The dots/circles -->
        <div style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span> 
        </div>

      </div>

      <div id="login-panel">
        <h1 id="login-panel-title">Start Ordering</h1>
        <?php
        if($_GET['SignUp']==True){
          echo "

          <p id='login-panel-sign'> <a href='home.php' style='color:#3d3d3d;'>Sign in </a> | <font style='color:rgba(0,0,0,0.3);'>I'm New</font></p>

          <p class='signup-text'>Creating an account will allow you to enjoy exclusive offers and promotions, retrieve saved orders and favorites, and faster checkout.
          </p>
          <a class='signup-button'  href='signUp.php'>Register Now</a>

          <p class='signup-text'>CONTINUE WITHOUT AN ACCOUNT
          Express checkout with online payment as guest
          </p>
          <a class='signup-button' href='menu.php'>Guest Order</a>
          ";
        }else{
         echo "

         <p id='login-panel-sign'>  <font style='color:rgba(0,0,0,0.3);'>Sign in</font> | <a href='home.php?SignUp=True' style='color:#3d3d3d;'> I'm New</a> </p>

         <form action='signUp.php' method='post'>
         <input id='login-email' type='text' name='email' placeholder='Email'>
         <input id='login-password' type='text' name='password' placeholder='Password'>
         <input id='login-checkbox' type='checkbox' name='vehicle' value='Bike'>

         <p id='login-remember-text' name='remember-me'>Remember Me</p><br>
         <input id='login-submit' type='submit' name='submit' value='Sign in'>
         </form>

         ";
       }

       ?>
     </div>

   </div>

   <div id="copyright">
     <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
     THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
   </div>

 </div>

 <script type="text/javascript">

  function startLoop() {
    if(myInterval > 0) clearInterval(myInterval);  // stop
    myInterval = setInterval( "nextSlide()", iFrequency );  // run
  }

  var slideIndex = 1;
  showSlides(slideIndex);

  var iFrequency = 5000; 
  var myInterval = 0;

  startLoop();

</script>

</body>

</html>
