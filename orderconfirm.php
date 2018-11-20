
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

//generating food order
$userid = "0";
if(isset($_SESSION['userid'])){
  $userid = $_SESSION['userid'];
}
$now = new DateTime();
$orderid = $userid.$now->getTimestamp(); 
$date = $now->getTimestamp();
$status = "YOUR FOOD IS BEING PREPARED";
$cart = implode(" ",$_SESSION['cart']);
$totalPrice = $_POST['totalPrice'];
$address = $_POST['address'];
$contact = $_POST['contactNumber'];
$ETA = date( "Y-m-d H:i:s", strtotime( $now->format('Y-m-d H:i:s') )+1*60*60 );

// preventing from readding
if(!isset($_SESSION['orderid'])){
  $_SESSION['orderid'] = $orderid;
  $_SESSION['ETA'] =  $ETA;
}else{
  $orderid =  $_SESSION['orderid'] ;
  $ETA =  $_SESSION['ETA'];
}
if($userid=="0"){
$sql = "insert into FoodOrder (orderid,amount,status,foodlist,address,contact,timestamp) values(".$orderid.",".$totalPrice.",'".$status."','".$cart."','".$address."','".$contact."',".$date.")";
}else{
  $sql = "insert into FoodOrder values(".$orderid.",".$userid.",".$totalPrice.",'".$status."','".$cart."','".$address."','".$contact."',".$date.")";
}


$result = $conn->query($sql);


$exploded=explode(" ",$cart);

$unique = array_unique($exploded);

$whereIn = implode(',', $unique);

$sql2 = " select * from Menu where foodid in ($whereIn)";

$result2 = $conn->query($sql2);

$duplicate = array_count_values($exploded);

        if($userid=="0")$userid="null";
while($row = $result2->fetch_assoc() ){

        
        $qty = $duplicate[$row['foodid']];
        $foodid = $row['foodid'];
        $category = $row['category'];
        $totalPrice = $qty*$row['price'];

        $sql_sales = "INSERT into SalesOrder values($orderid,$userid,$foodid,$totalPrice,$qty,'$category')";
        $result_sales = $conn->query($sql_sales);

      }


          //clear session cart
$_SESSION['cart'] = array();
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

      $sql = "select * from FoodOrder where orderid = ".$orderid;

      $result = $conn->query($sql);

      if($row = $result->fetch_assoc()){
        $cart = $row['foodlist'];
        $date = $row['timestamp'];
      }

      echo"
      <div>
      <div class='orderdetail'>
      <div class='order-status-div'>
      <img class='order-placed-image' src='asset/img/greentick.png' />
      <p class='order-status-text'> We Have Received Your Order ! </p>
      <p class='order-id'> Order id: ".$orderid."</p>
      </div>

      <div class='customer-details'>
      <p class='delivery-text'> Delivery details </p>
      <p class='delivery-address'> ".$address ." </p>
      <p class='delivery-text'> Contact Number </p>
      <p class='consumer-phonenumber'> ".$contact."</p>
      </div>
      </div>

      <p class='arriving-in-header'> ESTIMATED TIME ARRIVED </p>

      <div class='arriving-in-details'>
      <p class='delivery-time'> Today ".date('H:i', $date + 1*60*60)."</p>       
      </div>

      <p class='arriving-in-header'> ORDER INFORMATION </p>

      <div class='order-information-div'>
      <p class='orderId'> Order id: &nbsp ".$orderid." </p>
      <p class='ordered-time'> Placed Time: &nbsp ". date('Y-m-d H:i', $date)." </p>
      </div>

      <p class='arriving-in-header'> ORDER FOOD LIST</p>
      <div class='item-container-div'>    
      <ul>        
      ";

   

      $exploded=explode(" ",$cart);

      $unique = array_unique($exploded);

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
      </div>
      </div>

      ";


      ?>
      <div id="confirmationpage">
        <a  href="menu.php">New Order</a>  <a  href="trackorder.php">Track Order</a>  <a onclick="window.print();">Print Order</a> 
      </div>


    </div>


    <div id="copyright">
     <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
     THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
   </div>

 </div>


</body>

</html>
