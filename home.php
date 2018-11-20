
<?php

$servername = "localhost";
$username = "f38im";
$password = "f38im";



// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"f38im");

session_start();

$cookie_username = null;
$cookie_password = null;
$cookie_re = '';

if(isset($_COOKIE['username'])) {

   $cookie_username=$_COOKIE['username'];
 // $cookie_password=$_COOKIE['password'];
  $cookie_re = 'checked';
  //echo 'mail'.$usermail.'pass'.$password;
}

$panelText = "Start Ordering";
if (isset($_POST['submit'])) {
  if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on')
  {
    $hour = time() + 3600 * 24 * 30;
    setcookie('username',$_POST['email'], $hour);
    setcookie('password',$_POST['password'], $hour);
  }

  $usermail=$_POST['email'];
  $password=$_POST['password'];
  $password = md5($password);
  //echo 'mail'.$usermail.'pass'.$password;

  $query = 'select * from User '
  ."where email='$usermail' "
  ." and password='$password'";

  $result = $conn->query($query);

    // if they are in the database register the user id
  if($row = $result->fetch_assoc()){
     $_SESSION['userid'] = $row['userid'];
     $_SESSION['username'] = $row['username'];
     $_SESSION['loggedin'] = True;
     header('Location: menu.php');
     $panelText = "Start Ordering";

  }else{
     $panelText = "Login Failed";
  }
  }
$_POST = array();
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
      <?php 
      if($_SESSION['loggedin']){
        echo "  <p> <a href='#' >Hello,".$_SESSION['username']."</a> | <a href='logout.php'>Sign out</a></p>
        ";
      }else{
        echo " <p> <a href='logIn.php' >Sign In</a> | <a href='trackorder.php'>Track My Order</a></p> ";

      }

      ?>
    </div>

    <div id="navigation">
      <ul>
        <li style="background-color:#e83214;width: 14%;"><a href="home.php" style='font-family: cursive;padding-top: 9%;'>Burger Bear</a></li>
        <li><a href="menu.php">Menu</a></li>
        <?php
        if($_SESSION['loggedin']==True){
         echo" <li><a href='Profile.php'>Account</a></li>";
       }else{
         echo" <li><a href='logIn.php'>Account</a></li>";
       }


       ?>
       <li><a href="trackorder.php">TrackOrder</a></li>
       <li><a href="support.php">Support</a></li>
     </ul>
   </div>


   <div id="content">

    <div id="feature-content">

      <div class="slideshow-container">

        <div class="mySlides fade">
          <img src="asset/img/home/img1.jpg" style="width:100%;height: 100%;">
        </div>

        <div class="mySlides fade">
          <img src="asset/img/home/img2.jpg" style="width:100%;height: 100%;">
        </div>

        <div class="mySlides fade">
          <img src="asset/img/home/img3.jpg" style="width:100%;height: 100%;">
        </div>

      </div>


      <!-- The dots/circles -->
      <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span> 
        <span class="dot" onclick="currentSlide(2)"></span> 
        <span class="dot" onclick="currentSlide(3)"></span> 
      </div>

    </div>

   
      <?php
        if($_SESSION['loggedin']){


        }else if($_GET['SignUp']==True){
        echo "
      <div id='login-panel'>
      <h1 id='login-panel-title'>".$panelText."</h1>
        <p id='login-panel-sign'> <a href='home.php' style='color:#3d3d3d;'>Sign in </a> | <font style='color:rgba(0,0,0,0.3);'>I'm New</font></p>

        <p class='signup-text'>Creating an account will allow you to enjoy exclusive offers and promotions, retrieve saved orders and favorites, and faster checkout.
        </p>
        <a class='signup-button'  href='signUp.php'>Register Now</a>

        <p class='signup-text'>CONTINUE WITHOUT AN ACCOUNT
        Express checkout with online payment as guest
        </p>
        <a class='signup-button' href='menu.php'>Guest Order</a>
           </div>

 </div>
        ";
        }else{
            echo "
 <div id='login-panel'>
      <h1 id='login-panel-title'>".$panelText."</h1>
       <p id='login-panel-sign'>  <font style='color:rgba(0,0,0,0.3);'>Sign in</font> | <a href='home.php?SignUp=True' style='color:#3d3d3d;'> I'm New</a> </p>

       <form action method='post'>
       <input id='login-email' type='text' name='email' placeholder='Email' required value=".$cookie_username."  >
       <input id='login-password' type='password' name='password' required placeholder='Password'value=".$cookie_password." >
       <input id='login-checkbox' type='checkbox' name='remember_me' ".$cookie_re.">

       <p id='login-remember-text' name='remember_me'>Remember Me</p><br>
       <input id='login-submit' type='submit' name='submit' value='Sign in'>
       </form>
          </div>

 </div>
       ";
        }

     ?>


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
