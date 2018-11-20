
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

//echo "seesion id = $id <br>";


if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}
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

      if(!empty($_POST['orderid'])){

        $sql = "select * from FoodOrder where orderid = ".$_POST['orderid'];

        $result = $conn->query($sql);

        if($row = $result->fetch_assoc() ){
          $now = new DateTime();
          $stampNow = $now->getTimestamp();
          $arriveIn = ($row['timestamp']+1*60*60 - $stampNow) /60;
          $date = date('Y-m-d H:i', $row['timestamp']);
          if($arriveIn>0){
            $arriveIn = round($arriveIn)."mins";
          }else{
            $arriveIn = "Arrived";
          }
          echo"
          <div>
          <div class='orderdetail'>
          <a  href='trackorder.php' class='track_another_order'> TRACK ANOTHER ORDER </a>

          <div class='order-status-div'>
          <img class='order-placed-image' src='asset/img/greentick.png' />
          <p class='order-status-text'> ".$row['status']." </p>
          <p class='order-id'> Order id: ".$row['orderid']."</p>
          </div>

          <div class='customer-details'>
          <p class='delivery-text'> Delivery details </p>
          <p class='delivery-address'> ".$row['address']." </p>
          <p class='delivery-text'> Contact Number </p>
          <p class='consumer-phonenumber'> ".$row['contact']."</p>
          </div>
          </div>

          <p class='arriving-in-header'> ARRIVING IN </p>

          <div class='arriving-in-details'>
          <p class='delivery-time'> ".$arriveIn."</p>       
          </div>

          <p class='arriving-in-header'> ORDER INFORMATION </p>

          <div class='order-information-div'>
          <p class='orderId'> Order id: &nbsp ".$row['orderid']." </p>
          <p class='ordered-time'> Placed Time: &nbsp ".$date." </p>
          </div>

          <p class='arriving-in-header'> ORDER FOOD LIST</p>
          <div class='item-container-div'>    
          <ul>        
          ";

          $exploded=explode(" ",$row['foodlist']);

          $unique = array_unique( $exploded);

          $whereIn = implode(',', $unique);

          $sql = " select * from Menu where foodid in ($whereIn)";

          $result = $conn->query($sql);

          $duplicate = array_count_values($exploded);

          while($row = $result->fetch_assoc() ){
            $qty = $duplicate[$row['foodid']];

            echo" 
            <li class='combo-item'> ".$row['name']." x ". $qty." </li>
            ";
          }

          echo"
          </ul>        
          ";
        }
        else{
         echo "
         <div id='track-order-page'>
         <h1> Opps, Order Numbe Not Found :(</h1>
         <div id='searchBox'>
         <form action method='post'>
         <input type='text' class='searchTerm' placeholder='Enter your order number here' name='orderid'>
         <button type='submit' class='searchButton'>Search</button>
         </form>
         ";
       }
     }
     else{
      echo "
      
      <div id='track-order-page'>
      <h1> Track Order </h1>
      <div id='searchBox'>
      <form action method='post'>
      <input type='text' class='searchTerm' placeholder='Enter your order number here' name='orderid'>
      <button type='submit' class='searchButton'>Search</button>
      </form>
      ";
    }
    ?>

</div>

</div>
</div>


<div id="copyright">
 <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
 THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
</div>

</div>


</body>

</html>
