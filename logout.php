<?php
  session_start();
  
  // store to test if they *were* logged in
  $old_user = $_SESSION['userid'];  
  unset($_SESSION['userid']);
   unset($_SESSION['username']);
    unset($_SESSION['loggedin']);
  session_destroy();

  if (!empty($old_user))
  {
    echo 'Logged out.<br />';
  }
  else
  {
    // if they weren't logged in but came to this page somehow
    echo 'You were not logged in, and so have not been logged out.<br />'; 
  }
  
  header("Location: home.php");
?> 

