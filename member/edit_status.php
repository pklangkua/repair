<?php 
 require_once("../master/function.php");
  $status_id = $_POST['sellist1'];
  $id = $_POST['id'];

  $conn = new connectDB;
  $sSql = "UPDATE r_user SET status_id = '$status_id' WHERE id=$id";
  $conn->exe($sSql);
  
    header("Location:/repair/index.php?module=member");
  

 ?>
