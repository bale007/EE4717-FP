
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

session_start();
if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}


if(isset($_SESSION['orderid'])){
  unset($_SESSION['orderid']);
}

$session_address = "";
$session_email = "";
$session_phone = "";

if($_SESSION['loggedin']==True){

  $query = "select * from User where userid =".$_SESSION['userid'];

  var_dump($query);

  $result = $conn->query($query);
   
    $row = $result->fetch_assoc();
    $session_address = $row['address'];
    $session_email = $row['email'];
    $session_phone = $row['phone'];
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

      <div id="checkoutcart">

        <div class="reciept ">
          <h1 style="color: #ffc423;">Burger Bear</h1>
          <p>21 Lien Ying Drive <br/>
            Suite 401 <br />
            Singapore, NTU 639809
          </p>
          <p>(65) 6925-8452<p>


            <table>

             <?php

             $unique = array_unique($_SESSION['cart']);

             $whereIn = implode(',', $unique);

             
             $sql = "select * from Menu where foodid in ($whereIn)";


             $result = $conn->query($sql);

             $duplicate = array_count_values($_SESSION['cart']);

             $totalprice = 0;

             while($row = $result->fetch_assoc() ){
              $qty = $duplicate[$row['foodid']];
              $totalprice += $qty*$row['price'];
              echo" 
              <tr>
              <td>".$row['name']."*".$qty."</td>
              <td class='money'>$".$qty*$row['price']."</td>
              </tr>
              ";
            }

            echo"
            <tr>
            <td>Subtoal</td>
            <td class='money'>$".$totalprice."</td>
            </tr>      

            <tr>
            <td>GST</td>
            <td class='money'>$".$totalprice*0.1."</td>
            </tr>      
            ";

            $totalprice += $totalprice*0.1;

            echo"
            <tr class='totals'>
            <td>Total</td>
            <td class='money' colspan='2'>$".$totalprice."</td>
            </tr>   
            ";
            ?>

          </table>
        </div>


      </div>

      <div id="checkoutpayment">

        <form class="payment" action="orderconfirm.php" method="post">

          <div class="panel panel-default credit-card-box">
            <div class="panel-heading display-table">
              <div class="row display-tr">
                <h3 class="panel-title display-td">Payment Details</h3>
                <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
              </div>
            </div>
          </div>

          <br>
          <label for="cardNumber">CARD NUMBER</label>
          <input type="text" size="10" class="form-control" name="cardNumber" id="cardNumber" placeholder="Valid Card Number"  required autofocus />

          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
          <label for="cardExpir" style="display: block;">EXPIRATION DATE       &nbsp;   &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;CV CODE</label> 
          <input type="text" size="5" class="form-control" name="cardExpiry" id="cardExpiry" placeholder="MM/YY"  required style="width: 50%;display: inline-block;" />


          <input type="text" size="3" class="form-control" name="cardCVC" id="cardCVC" placeholder="CVC"  required style="width: 39%;display: inline-block;margin-left: 5%;" />

          <label for="Name" style="display: block;">FULL NAME</label>
          <input type="text" size="3" class="form-control" name="Name" id="Name" placeholder="Name on card"  required />

          <label for="contactNumber">CONTACT NUMBER</label>
          <input type="text" size="3" class="form-control" name="contactNumber" id="contactNumber" required placeholder="Contact Number" <?php echo " value=".$session_phone."";?>  >

           <label for="address">DELIVERY ADDRESS</label>
          <input type="text" size="3" class="form-control" name="address" required placeholder="Delivery Address" <?php echo " value='".$session_address."' ";?>  >

          <label for="emailAddress">EMAIL ADDRESS</label>
          <input type="text" size="3" class="form-control" name="emailAddress" id="emailAddress" required placeholder="Email Address" <?php echo " value=".$session_email."  ";?>  >

          <?php echo" <input type='hidden' name='totalPrice' value=".$totalprice."> "; ?>

          <br>
          <a href="menu.php"  style="float:left; margin-left: 0.5%;margin-top: 2%;" class="checkoutBackBtn">Back</a>

          <button class="redButton" style="float:right;" type="submit">Confirm Payment</button>
          <br><br>
        </form>
        <!-- If you're using Stripe for payments -->
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
        <script type="text/javascript">
          var cardNumber = document.getElementById("cardNumber");
          var cardExpiry = document.getElementById("cardExpiry");
          var cardCVC = document.getElementById("cardCVC");
          var cardName = document.getElementById("Name");
          var contactNumber = document.getElementById("contactNumber");
          var emailAddress = document.getElementById("emailAddress");
          cardNumber.addEventListener("change", chkcardNumber, false);
          cardExpiry.addEventListener("change", chkcardExpiry, false);
          cardCVC.addEventListener("change", chkCVC, false);
          cardName.addEventListener("change", chkcardName, false);
          contactNumber.addEventListener("change", chkphone, false);
          emailAddress.addEventListener("change", chkemail, false);




</script>

      </div>


    </div>


    <div id="copyright">
     <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
     THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
   </div>

 </div>


</body>

</html>
