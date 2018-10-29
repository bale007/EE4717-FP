
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

mysqli_select_db($conn,"burger_bear");

session_start();

$id =session_id();

//echo "seesion id = $id <br>";




if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}


//ADDING & DELETEING FROM CART
if(!empty( $_GET['id'])){
  if($_GET['delete']==True){
    if (($key = array_search($_GET['id'], $_SESSION['cart'])) !== false) {
      unset($_SESSION['cart'][$key]);
    }

  }else{
    array_push($_SESSION['cart'], $_GET['id']);
  }
  header("Location:menu.php?category=".$_GET['category']);
}
//CHAGING CATEGORY

if(!empty($_GET['category'])){
  $category = $_GET['category'];
}else{
  $category = "promotion";
}

//var_dump($_SESSION['cart']);

 //$_SESSION['cart'] = array();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <link href="css/style.css" rel="stylesheet">
  <script type="text/javascript" src="js/burgerbear.js"></script>

  <title>Burger Bear</title>

</head>

<body onload="updateMenuColor()">

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

    <div id = "leftmenu">
     <a href="menu.php?"><p>Food Menu</p></a>
     <ul>
      <a href="menu.php?category=promotion" id="menu_promotion"><li>Promotion</li></a>
      <a href="menu.php?category=burger"  id="menu_burger"  ><li>Burger</li></a>
      <a href="menu.php?category=sides"  id="menu_sides"  ><li>Sides</li></a>
      <a href="menu.php?category=drink"  id="menu_drink"><li>Beverage</li></a>
      <a href="menu.php?category=dessert"  id="menu_dessert"  ><li>Dessert</li></a>
    </ul>
  </div>

  <div id = "menucontent">
    <?php 

    $temp = ucwords(strtolower($category));
    echo "<p id='trace'> Menu > ". $temp."</p>";

    if($category=="all"){
     $sql = "select * from menu";
   }else{
     $sql = "select * from menu where category = '".$category."'";
   }
   
   $result = $conn->query($sql);
   while($row = $result->fetch_assoc() ){

     echo " <div class='menuitem' >
     <img   onmouseover='showOverlay(".$row["foodid"].");'  class='itemimg' src='".$row["imgurl"]."'>
    <div class='overlay' id=".$row["foodid"]." onmouseout='closeOverlay(".$row["foodid"].");'><div class='text'>".$row["description"]."</div></div>
     <p class='itemname'> ".$row["name"]." </p>
     <p class='itemprice'>From $".$row["price"]."</p>
     <a class='itemadd' href='menu.php?category=".$_GET["category"]."&id=".$row["foodid"]."'>Add</a></div>
     ";
   };


   ?>

 </div>


 <div id = "cartcontent">

  <p>Food Cart</p>
  <table>
    <?php 

    if(empty($_SESSION['cart'])){

      echo "<tr><td colspan=3 style='text-align:center;color:rgba(0,0,0,0.4);'>Start Ordering !</td><tr>";

    }else{

      $unique = array_unique($_SESSION['cart']);

      $whereIn = implode(',', $unique);

      $sql = " select * from menu where foodid in ($whereIn)";

      $result = $conn->query($sql);

      $duplicate = array_count_values($_SESSION['cart']);

      $totalprice = 0;

      while($row = $result->fetch_assoc() ){

        echo "<tr><td>".$row['name']." </td><td>".$duplicate[$row['foodid']]."</td><td> $".$row['price']*$duplicate[$row['foodid']].
        "</td><td><a class='itemminus' href='menu.php?category=".$_GET['category']."&delete=True&id=".$row['foodid']."'>-</a></td> </tr> ";
        $totalprice += $row['price']*$duplicate[$row['foodid']];
      };

      echo "<tr><td colspan=4>Total: $".$totalprice."</td></tr>";
    }


    ?>


  </table>
 <?php

   if(!empty($_SESSION['cart'])){
    echo"
  <div id ='checkoutbutton'>
    <a href='checkout.php'>Check out</a>
  </div>
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


</body>

</html>
