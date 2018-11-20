
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

//mysqli_select_db($conn,"f38im");
session_start();


$cookie_username = null;
$cookie_password = null;
$cookie_re = '';
if(isset($_COOKIE['username'])) {

   $cookie_username=$_COOKIE['username'];
 // $cookie_password=$_COOKIE['password'];
  $cookie_re = 'checked';
  //echo 'mail'.$usermail.'pass'.$password;
}

if (isset($_POST['submit'])) {
  if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on')
                    {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $login, $hour);
                    setcookie('password', $password, $hour);
                    }


  if (empty($_POST['email']) || empty ($_POST['password'])) {
  echo "All blanks should be filled in";
  exit;}

  $usermail=$_POST['email'];
  $password=$_POST['password'];
  $password = md5($password);
  //echo 'mail'.$usermail.'pass'.$password;

  $query = 'select * from User '
           ."where email='$usermail' "
           ." and password='$password'";

  $result = $conn->query($query);
  

  if ($result->num_rows >0 )
  {
    // if they are in the database register the user id
      
    if($row = $result->fetch_assoc()){
     $_SESSION['userid'] = $row['userid'];
     $_SESSION['username'] = $row['username'];
     $_SESSION['loggedin'] = True;
    }

    header('Location: Profile.php');
     
  }

  $conn->close();
}

$_POST = array();

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

  <div id="content" align=center>



<?php




if (isset($_SESSION['userid']))
  {
    header("Location:Profile.php");

  }


else
  {
    if (isset($usermail))
    {
      
      echo "<div class='login' align=center >
      <h3 style='width:70%'>Log in failed:( <br> Email not found or password wrong.</h3>";
    }
    else 
    {
      
      echo "<div class='login' align=center >
       <h2 style='width:60%'> Welcome. Sign in to start ordering.</h2>";
    }

    if($_GET['ImNew']==True){
      echo "
    
    <p><a href='logIn.php'>Sign In </a> |  <a > I'm New</a></p>
    
    <p class='description' style='width:60%'>Creating an account will allow you to enjoy exclusive offers and promotions, retrieve saved orders and favorites, and faster checkout.<br></p>
      <a href='signUp.php'><button class='signUpButton' style='width:60%;    margin-bottom: 26px;' name=register value=Register> REGISTER NOW</button></a><br>
      <a style='font-size:85%'>CONTINUE WITHOUT AN ACCOUNT<br></a>
      <a class='description'>Express checkout with online payment as guest</a>
      <a href='menu.php'><button class='signUpButton' style='width:60%;    margin-bottom: 4.5%;' name=guestorder value=GuestOrder> GUEST ORDER</button></a><br>

    


  </div>";
    }
    else{

    echo "
 
    
    <p><a>Sign In </a> |  <a href='logIn.php?ImNew=True' style='color:#3d3d3d;'> I'm New</a></p>
    <form action='logIn.php' method=POST>
    <table>
      <tr>
        <input type='text' class='blanks' style='width:60%;    padding: 3%;' placeholder='Registered Email' name='email' required value=".$cookie_username." >
        </tr>
        <tr>
        <input type='password' class='blanks' style='width:60%;    padding: 3%;' placeholder='Password' name='password' required value=".$cookie_password." >
        </tr>
        <tr >
        <br><input type='checkbox' name='remember_me' style='position: relative;  width:25px; height:25px;     margin-top: 2%;   margin-left: 39%;' ".$cookie_re." ><font style='
    float: right;
    margin-right: 35%;
    margin-top: 2%;
'>Remember Me</font><br>
      </tr>
      <button type='submit' class='signUpButton' style='width:60%;' name=submit value=Submit >Log In</button><br>
      <a style='font-size:small' href='signUp.php'> Don't have an account? Click to sign up!</a>
    </table>
    </form>


  
  </div>";}





    }
  

?>


  </div>

  <div id="copyright" style='width:100%'>
   <p> COPYRIGHT © 2018 ALL RIGHTS RESERVED BY BURGERBEAR'S® <br>
    THE BURGER BEAR LOGOS ARE TRADEMARKS OF BURGERBEAR'S CORPORATION AND ITS AFFILIATES. </p>
  </div>

</div>


</body>

</html>
