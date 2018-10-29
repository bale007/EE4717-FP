
<?php

$servername = "localhost";
$username = "root";
$password = "root";


// Create connection
$conn = new mysqli($servername, $username, $password,'burger_bear');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"burger_bear");
session_start();

if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty ($_POST['password'])
    || empty ($_POST['password2']) ) {
  echo "All records to be filled in";
  exit;}
  





}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<link href="css/style.css" rel="stylesheet">

<title>Burger Bear</title>

</head>

<body>

<div id="wrapper">

<div id="header">
  <p> <a href='#'>Sign In</a> | <a href='#'>Track My Order</a></p>
</div>

  <div id="navigation">
    <ul>
      <li><a href="#">Logo</a></li>
      <li><a href="#">Menu</a></li>
      <li><a href="#">Account</a></li>
      <li><a href="#">TrackOrder</a></li>
      <li><a href="#">Support</a></li>
    </ul>
  </div>


  <div id="content" align=center>

  <div class='login' align=center >
    <h2 style="width:60%"> Welcome. Sign in to start ordering.</h2>
    <p><a href="logIn.php">Sign In </a> |  <a > Sign Up</a></p>
    
    <p class='description' style="width:60%">Creating an account will allow you to enjoy exclusive offers and promotions, retrieve saved orders and favorites, and faster checkout.<br></p>
      <a href='signUp.php'><button class='signUpButton' style="width:60%" name=register value=Register> REGISTER NOW</button></a><br>
      <a style="font-size:70%">CONTINUE WITHOUT AN ACCOUNT<br></a>
      <a class='description'>Express checkout with online payment as guest</a>
      <a href='menu.php'><button class='signUpButton' style="width:60%;    margin-bottom: 4.5%;" name=guestorder value=GuestOrder> GUEST ORDER</button></a><br>

    


  </div>

  </div>

  <div id="copyright" style='width:100%'>
   <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
    THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
  </div>

</div>


</body>

</html>
