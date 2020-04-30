<?php 
 require_once("../master/function.php");
  $OfficeID = $_POST['OfficeID'];
  $id = $_POST['idUpdate'];
 
  $conn = new connectDB;
  $sSql = "UPDATE r_user SET OfficeID = '$OfficeID' WHERE id=$id";
  $conn->exe($sSql);
  
   header("Location:/repair/index.php?module=member");
  

 ?>