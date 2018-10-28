<?php


$user = 'root';
$password = 'root';
$db = 'auth';
$host = '127.0.0.1';
$port = 8889;
$socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';

$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port,
   $socket
);


//if (!$success->select_db ("auth"))
//	exit("<p>Unable to locate the auth database</p>");
//	
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
