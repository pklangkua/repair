<?php 
 require_once("../master/function.php");
  $id = $_GET['id'];

  $conn = new connectDB;
  $sSql = "DELETE FROM r_device WHERE d_id='$id'";
  //echo $sSql;
 /* $sSql = "UPDATE r_user SET phone = '$phone',email = '$email',OfficeID = '$OfficeID' WHERE id=$id";*/
  $conn->exe($sSql);
  
    header("Location:/repair/index.php?module=profile");

 ?>