
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


  <div id="content">
    <img src="asset\img\menu\burger\beefburger.jpg">
     <img src="asset\img\menu\burger\beefburger.jpg">
     <img src="asset\img\menu\burger\beefburger.jpg">
     <img src="asset\img\menu\burger\beefburger.jpg">

  </div>

  <div id="copyright">
   <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
    THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
  </div>

</div>


</body>

</html>
