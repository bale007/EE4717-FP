
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

session_start();

if($_POST['foodid']){
  $sql = "UPDATE menu set price = ".$_POST['price']." where foodid = ".$_POST['foodid']."";
    $conn->query($sql);
}


if($_POST['orderid']){

  if($_POST['status']=='preparing'){
  $status = "YOUR FOOD IS BEING PREPARED";
  }
  else if($_POST['status']=='deliverying'){
  $status = "WE ARE DELIVERYING YOUR FOOD";
  }
  else if($_POST['status']=='completed'){
  $status = "YOUR FOOD IS DELIVERED";
  }

    $sql = "UPDATE foodorder set status = '".$status."' where orderid = ".$_POST['orderid']."";
    $conn->query($sql);
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
      <p> <a href='#'>Admin Page</a> 
    </div>

    <div id="navigation">
      <ul>
        <li><a href="admin.php">Admin Home</a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
        <li><a href="#"></a></li>
      </ul>
    </div>


    <div id="content">
      <div id='adminpage'>

        <?php
        if($_GET['viewuser']==True){


        }
        else if($_GET['updateprice']==True){

          $sql = "select * from menu";

          $result = $conn->query($sql);
          while($row = $result->fetch_assoc() ){
           echo " 

           <div class='menuitem'>
           <img class='itemimg' src=".$row["imgurl"].">
           <p class='itemname'> ".$row["name"]." </p>
           <form action method='post'>
           <input type='number' min=0 step=0.1 class='itemprice' name ='price' value = ".$row["price"]." style='width: 18%; margin-left: 15%;margin-top: 2%;'>
           <input type='hidden' name = 'foodid' value=".$row["foodid"].">
           <input class='itemadd' style='margin: 0;margin-right: 12%;margin-bottom: 3%;margin-top: 0.5%;' type='submit' value = Update>
            </form>
           </div>
           ";
         };
       }
       else if($_GET['updateorder']==True){

        $sql = "select * from foodorder";

          $result = $conn->query($sql);

          echo "<table style='margin-top:3%;'>";
          while($row = $result->fetch_assoc() ){
           echo "
           <tr>
           <form action method='post'>
                <td>   Order id: ".$row['orderid']."  <input type='hidden' name='orderid' value=".$row['orderid']." >  </td>
                <td> 
                Status: <select name='status'>
                ";
                ?>
                <option value='preparing' <?php if($row['status'] == 'YOUR FOOD IS BEING PREPARED'): ?> selected='selected'<?php endif; ?>> Preparing</option>
                <option value='deliverying'<?php if($row['status'] == 'WE ARE DELIVERYING YOUR FOOD'): ?> selected='selected'<?php endif; ?>>Deliverying</option>
                <option value='completed' <?php if($row['status'] == 'YOUR FOOD IS DELIVERED'): ?> selected='selected'<?php endif; ?> >Completed</option>
                <?php
                echo"
                </select> </td>
                <td> <input type='submit' value = 'Update' class='itemadd' style='width:100%;'></td>
             </form>
           </tr>              
           ";
         };
          echo "</table>";
       }else{
        echo "
 
        <a class='itemadd' href='admin.php?updateorder=True'>Update Order Status</a> 
        <a class='itemadd' href='admin.php?updateprice=True'>Update Food Price</a>
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
