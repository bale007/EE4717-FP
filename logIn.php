
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

//mysqli_select_db($conn,"burger_bear");
session_start();


$cookie_username = null;
$cookie_password = null;
$cookie_re = 'off';
if(isset($_COOKIE['username'])) {

   $cookie_username=$_COOKIE['username'];
  $cookie_password=$_COOKIE['password'];
  $cookie_re = 'on';
  //echo 'mail'.$usermail.'pass'.$password;
}

if (isset($_POST['submit'])) {
  if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on')
                    {
                    $hour = time() + 3600 * 24 * 30;
                    setcookie('username', $login, $hour);
                    setcookie('password', $password, $hour);
                    }


  if (empty($_POST['mail']) || empty ($_POST['password'])) {
  echo "All blanks should be filled in";
  exit;}

  $usermail=$_POST['mail'];
  $password=$_POST['password'];
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
    echo 'You are logged in as: '.$_SESSION['userid'].' <br />';
    echo "<a href='profile.php'> View Profile</a>";














  }









  else
  {
    if (isset($usermail))
    {
      
      echo "<div class='login' align=center >
      <h3 style='width:70%''>Log in failed:( <br> Email not found or password wrong.</h3>";
    }
    else 
    {
      
      echo "<div class='login' align=center >
       <h2 style='width:60%'> Welcome. Sign in to start ordering.</h2>";
    }



    echo "
 
    
    <p><a>Sign In </a> |  <a href='signUp.php'> Sign Up</a></p>
    <form action='logIn.php' method=POST>
    <table>
      <tr>
        <input type='text' class='blanks' style='width:60%;    padding: 3%;' placeholder='Registered Email' name='mail' value=".$cookie_username." required>
        </tr>
        <tr>
        <input type='password' class='blanks' style='width:60%;    padding: 3%;' placeholder='Password' name='password' value=".$cookie_password." required>
        </tr>
        <tr >
        <br><input type='checkbox' name='remember_me' value='remember_me' style='position: relative;  width:25px; height:25px;' >Remember Me<br>
      </tr>
      <button type='submit' class='signUpButton' style='width:60%;' name=submit value=Submit >Log In</button><br>
      <a style='font-size:small' href='signUp.php'> Don't have an account? Click to sign up!</a>
    </table>
    </form>


  
  </div>";





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
