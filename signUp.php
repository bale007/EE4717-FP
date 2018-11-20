
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

if (isset($_POST['submit'])) {
  if (empty($_POST['username']) || empty ($_POST['password'])
    || empty ($_POST['password2']) ) {
  echo "All records to be filled in";
  exit;}
  
$username = $_POST['username'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$mobilenum = $_POST['phone'];
$email = $_POST['email'];
$email2 = $_POST['email2'];
$password = $_POST['password'];
$password2 = $_POST['password2'];



if ($email != $email2) {
  echo "Sorry the emails you entered do not match";
  exit;
  }
// echo ("$username" . "<br />". "$password2" . "<br />");
if ($password != $password2) {
  echo "Sorry the passwords you entered do not match";
  exit;
  }

$sqlchk =    "SELECT * from User
           WHERE email='$email' ";
$chkresult = mysqli_query($conn, $sqlchk);



if(mysqli_num_rows($chkresult) == 0){
$password = md5($password);
// echo $password;
$sql = "INSERT INTO User (username,password,phone,email,address,gender) 
    VALUES ('$username', '$password','$mobilenum','$email','$address',   '$gender')";
//  echo "<br>". $sql. "<br>";

$result = mysqli_query($conn, $sql);

if (!$result) 
  echo "<h1 align=center style='color:red'>

Sorry, we failed to register your information.</h1>";
else{
  echo "<p>You've successfully registered.";

  $to = 'f32ee@localhost';
  $msg = "Congratulations,".$username." you've successfully register in Burger Bear as".$email.".\nWelcome to our Bear Family~~\nGreetings from Burger Bear.";
  $subject = "Confirmation Email for Account Registration";
  $headers = 'From: f38ee@localhost' . "\r\n" .
    'Reply-To: f38ee@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

  $sentemail= mail($to,$subject,$msg,$headers,'-ff38ee@localhost');
  if ($sentemail){
       echo " A confirmation email has been sent.";
     }

  $sql_getInfo = "SELECT * from User
           WHERE email='$email'";
  $result_getInfo = mysqli_query($conn, $sql_getInfo);
    if($row = $result_getInfo->fetch_assoc()){
     $_SESSION['userid'] = $row['userid'];
     $_SESSION['username'] = $row['username'];
     $_SESSION['loggedin'] = True;
     header("Location:Profile.php");
     
  }

}
}}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<link href="css/style.css" rel="stylesheet">
<script type="text/javascript" src="js/burgerbear.js"></script>
<style>
#content{
  overflow:auto;
}
</style>
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
    <h4 align=center style='border-bottom:1px dashed #c7c7c7; 
    color:#333333'>
      Welcome to Burger Bear! Please create an account to start ordering.
    </h4>
    
    <div class='signUpForm' style="width:75%; float:left">
<form action="signUp.php" id="SignUpForm" method=POST>
  <?php
if($chkresult){
    echo "<a style='color:red;'> OOPS. The information you filled seems wrong. Please check your email address.<br></a>";

}
?>
<p style="
  color:#fcc423;
  font-size:140%;
  margin-bottom: 0;
  "><b>ABOUT YOU</b></p>

<p class="description"
">*Required fields</p><br>

*Username:<br />
<input type='text' class='blanks' name='username' required><br /><br />

Gender:<br>
<div class='blanks' style='width:50%; padding:0'>
<select name='gender'>
  <option selected='selected' value='' >Select gender</option>
  <option value="Female">Female</option>
  <option value="Male">Male</option>
</select>
</div>
<br />

*Address:<br />
<input type=text class='blanks' name='address' required><br /><br />

Mobile Number:<br />
<input type=text class='blanks' style='width:50%'; placeholder='Digits Only - 8 digits' name='phone' id='phone'><br /><br />

<p style="
  color:#fcc423;
  font-size:140%;
  margin-bottom: 5%;
  "><b>CREATE YOUR SIGN-IN</b></p>

<?php
if($chkresult){
    echo "<a style='color:red;'> This email has already been registered.<br></a>";

}
?>
*Email:<br />
<input type=text class='blanks' placeholder='name@mail.com' name='email' id='email' required ><br /><br />



*Confirm Email:<br />
<input type=text class='blanks' placeholder='name@mail.com' id='email2' name='email2'  required><br /><br />
*Password:<br />
<input type=password class='blanks' name='password' id='password' required>
<p style="
    margin-top: 0;
    font-size: 60%;
    color: grey;
">Password must be 8-20 characters with at least 1 upper case letter and 1 numeric digit.</p>

*Confirm Password:<br /> 
<input type=password class='blanks' name='password2' id='password2' required><br /><br />

<p style="font-size:80%;"><input type="checkbox" name="terms" value="agree" style="position: relative;" required> Yes, I have read and agree to the Terms & Conditions (Burger Bear), Website Terms including the Privacy Policy for Online Services.*</p><br>


<button type='submit' class='signUpButton' name=submit value=Submit>CREATE ACCOUNT</button>
<button type='reset' class='signUpButton' name=reset value="Reset">RESET</button>

</form>

<script type="text/javascript">
  var email = document.getElementById("email");
  var email2 = document.getElementById("email2");
  var password = document.getElementById("password");
  var password2 = document.getElementById("password2");
  var phone = document.getElementById("phone");
  email.addEventListener("change", chkemail, false);
  email2.addEventListener("change", chkemail, false);
  password.addEventListener("change", chkpassword, false);
  password2.addEventListener("change", chkpassword, false);
  phone.addEventListener("change", chkphone, false);
  document.getElementById("SignUpForm").submit = chkboth;




</script>




  </div>

  <div class='promotion' style='width:20%; float:right'>
    <p style="
  color:#333333;
  font-size:130%;
  "><b>Promotion<br><br>
    Creating an account will allow you to:<br></b></p>

    <ul style="font-size:small; padding-left: 12%">
      <li>Engjoy faster checkout</li>
      <li>Retrieve saved orders and customized favorites</li>
      <li>Participate in exclusive offers and promotions</li>
    </ul>

  </div>


  </div>

  <div id="copyright" style='width:100%'>
   <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
    THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
  </div>

</div>


</body>

</html>
