<?php 
 require_once("../master/function.php");
  
  $id = $_POST['idDelete'];
  echo $id;

  $conn = new connectDB;
  $sSql = "DELETE FROM r_user WHERE id=$id";
  $conn->exe($sSql);
  
    header("Location:/repair/index.php?module=member");
 

 ?>