
<?php

$servername = "localhost";
$username = "f38im";
$password = "f38im";

// Create connection
$conn = new mysqli($servername, $username, $password,'f38im');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

mysqli_select_db($conn,"f38im");
session_start();







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



  <div id="content">

    <?php
  if (isset($_SESSION['userid']))
  {
    $userid = $_SESSION['userid'];
    



    $query = 'select * from User '
           ."where userid='$userid' ";

    $result = $conn->query($query);

    while($row = $result->fetch_assoc()){
      $username = $row['username'];
      $phone = $row['phone'];
      $email = $row['email'];
      $address = $row['address'];
      $gender = $row['gender'];
      $img = $row['imgurl'];
    

    echo "

        <div class='userprofile'>
  <div class='topbar'>

    <div class='topbar_logo'>
      <img style=' 
      width: 100%;
      position: absolute; 
      top: 50%;
      transform: translateY(-50%);' 
      src='asset/img/profile.png' alt='profile picture'  />
    </div>

    <div class='topbar_title'>
      <p style='padding-top: 10px; 
      font-size: 18px;
      font-weight: 300;
      color: rgba(255,255,255,.3);
      margin-bottom: 13px'>Hi, there</p>
      
      <h1 style='
      font-size: 30px;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 4px;
      margin-bottom: 0px;
      margin:0px; '>".$username."</h1>
      
      <a href='logout.php'><p style='padding-top: 0px;
      margin-top:0; 
      font-size: 15px;
      font-weight: 300;
      color: white;
      text-align: right;
      padding-right: 10px;'>Log Out</p></a>
    </div>


  </div>

    <div class='profileInfo'>
    <p style='
  color:#fcc423;
  font-size:140%;
  margin-bottom: 20px;
  margin-left:15px;
  '><br><b>ABOUT YOU</b></p>

  <table class='table-content' align='center'>
          <tr>
            <th>Gender</th><td>".$gender."</td>
          </tr>
          <tr>
            <th>Contact Number</th><td>".$phone."</td>
          </tr>
          <tr>
            <th>Email</th><td>".$email."</td>
          </tr>
          <tr>
            <th>Address</th><td>".$address."</td>
          </tr>
          
          </table>


  </div>";}


    $query2 = 'select * from FoodOrder '
           ."where userid='$userid' ";

    $result2 = $conn->query($query2);

    echo "

          <div class='profileHistory'>
      <p style='
  color:#fcc423;
  font-size:140%;
  margin-left: 15px;'>
  <br><br><b>ORDER HISTORY</b></p>

<table class='table-content2' align='center'>
          <tr>
            <th width='33%'>Order ID</th><th width='33%'>Status</th><th width='33%'>Amount</th>
          </tr>

      ";
    if ($result2){
    while($row2 = $result2->fetch_assoc()){
      $orderid = $row2['orderid'];
      $amount = $row2['amount'];
      $status = $row2['status'];


      echo "

          <tr>
            <td>".$orderid."</td><td>".$status."</td><td>".$amount."</td>
          </tr>

      ";
      }
      
      
    
    }
    else{
      echo "<tr> <th colspan='3'>Looks like you don't have orders. <a href='menu.php'>Start Order Now!</a>
                 </th>
            </tr>";
    }

    echo"</table>


  </div>

  

  ";


  }

else{
  header('Location: logIn.php');
}


    ?>












</div>
<div id='copyright' style='width:100%'>
   <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
    THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
  </div>
</div>

</body>

</html>
