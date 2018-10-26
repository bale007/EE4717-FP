
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

//echo "seesion id = $id <br>";


if(!isset($_SESSION['cart'])){
  $_SESSION['cart'] = array();
}
session_start();

if(isset($_SESSION['orderid'])){
  unset($_SESSION['orderid']);
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
        <li><a href="Menu.php">Menu</a></li>
        <li><a href="#">Account</a></li>
        <li><a href="trackorder.php">TrackOrder</a></li>
        <li><a href="#">Support</a></li>
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

             $sql = " select * from menu where foodid in ($whereIn)";

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
          <input type="text" size="10" class="form-control" name="cardNumber" placeholder="Valid Card Number"  required autofocus />

          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
          <label for="cardExpir" style="display: block;">EXPIRATION DATE       &nbsp;   &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;CV CODE</label> 
          <input type="text" size="5" class="form-control" name="cardExpiry" placeholder="MM / YY"  required style="width: 50%;display: inline-block;" />


          <input type="text" size="3" class="form-control" name="cardCVC" placeholder="CVC"  required style="width: 39%;display: inline-block;margin-left: 5%;" />

          <label for="Name" style="display: block;">FULL NAME</label>
          <input type="text" size="3" class="form-control" name="Name" placeholder="Name on card"  required />

          <label for="contactNumber">CONTACT NUMBER</label>
          <input type="text" size="3" class="form-control" name="contactNumber" placeholder="Contact Number" required />

           <label for="contactNumber">DELIVERY ADDRESS</label>
          <input type="text" size="3" class="form-control" name="address" placeholder="Delivery Address" required />

          <label for="emailAddress">EMAIL ADDRESS</label>
          <input type="text" size="3" class="form-control" name="emailAddress" placeholder="Email Address" />

          <?php echo" <input type='hidden' name='totalPrice' value=".$totalprice."> "; ?>

          <br>
          <a href="menu.php"  style="float:left; margin-left: 0.5%;margin-top: 2%;" class="checkoutBackBtn">Back</a>

          <button class="redButton" style="float:right;" type="submit">Confirm Payment</button>
          <br><br>
        </form>
        <!-- If you're using Stripe for payments -->
        <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

      </div>


    </div>


    <div id="copyright">
     <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
     THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
   </div>

 </div>


</body>

</html>
