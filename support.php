
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
$ak = "";

if ($_POST['feedback']!=null) {

  if (!empty($_POST['feedback']) ) 
    {
      $feedback = $_POST['feedback'];
      $datee = date("Y/m/d");
      if (isset($_SESSION['userid'])){
        $userid = $_SESSION['userid'];
      }
      else{
        $userid = '0';
    }

      $query="INSERT INTO `Feedback`(`userid`, `date`, `feedback`) VALUES ('$userid','$datee','$feedback')";

      $result =$conn->query($query);
      $ak ='Thanks for your feedback!';
      
}}

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



  <div id="content" >
    <div class='payment' style='overflow:auto; margin:3%'>
    <div  style='width:50%; float:left'>
    <img src="asset\img\map.png"  style='width:100%;margin-top:20px;border: 1px solid #ddd;padding:5px'>
  </div>
  <div  style='width:50%; float:left;padding:6%;'>
   <p >
     <b>Contact Number:</b> <br>  (65)83868683<br> <br>
     <b>Address:</b>      <br>  38 Nanyang Cres, Singapore 636866 <br>
   </p>
    
 </div>
  </div>

  <div class='payment' style='overflow:auto; margin:3%'>
    <?php


    if ($_POST['feedback']!=null) {
    if (!$result) {
    echo "
          Your query failed. Please try again!";

  }
      else{
        echo $ak;
      }}

    ?>
        <p style='
  color:#fcc423;
  font-size:140%;
  margin-bottom: 20px;
  margin-left:15px;
  margin-top:0;
  '><br><b>FEEDBACK</b><br></p>


  <form action="support.php" method='post'>
  <textarea class='blanks' name='feedback' rows='10' ></textarea>

  <input type='submit' class='signUpButton' name='submit' style="float: right; margin-top:10px">
  </form>
  </div>

  <div id="copyright" >
   <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
    THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
  </div>




</body>

</html>
