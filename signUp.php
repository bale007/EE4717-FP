
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

if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty ($_POST['password'])
    || empty ($_POST['password2']) ) {
  echo "All records to be filled in";
  exit;}
  }
$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];

// echo ("$username" . "<br />". "$password2" . "<br />");
if ($password != $password2) {
  echo "Sorry passwords do not match";
  exit;
  }
//$password = md5($password);
// echo $password;
$sql = "INSERT INTO User (username,password) 
    VALUES ('$username', '$password')";
//  echo "<br>". $sql. "<br>";

$result = mysqli_query($conn, $sql);

//if (!$result) 
//  echo "Your query failed.";
//else
//  echo "Welcome ". $username . ". You are now registered";
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
<form action="sign up.php" method=POST>
Username:<br />
<input type=text name=username><br /><br />
Password:<br />
<input type=password name=password><br /><br />
Password confirmation:<br /> 
<input type=password name=password2><br /><br />

<input type=submit name=submit value=Submit>
<input type=reset name=reset value="Reset">
</form>

  </div>

  <div id="copyright">
   <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
    THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
  </div>

</div>


</body>

</html>
