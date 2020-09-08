<?php 
 require_once("../master/function.php");
  $first_name = $_POST['first_name'];
  $id = $_POST['id'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $OfficeID = $_POST['OfficeID'];
  
  /*echo $first_name;
  echo $id;
  echo $phone;
  echo $email;
  echo $OfficeID;*/
  //$id = $_POST['id'];

  $conn = new connectDB;
  $sSql = "UPDATE r_user SET phone = '$phone',email = '$email',OfficeID = '$OfficeID' WHERE id=$id";
  $conn->exe($sSql);
  
    header("Location:/repair/index.php?module=profile");

 ?>