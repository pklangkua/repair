<?php 
 require_once("../master/function.php");
  $HardwareName = $_POST['HardwareName'];
  $id = $_POST['id'];
  $HardwareID = $_POST['HardwareID'];
  $HardwareCode = $_POST['HardwareCode'];
 /* $email = $_POST['email'];
  $OfficeID = $_POST['OfficeID'];*/
  
  /*echo $first_name;
  echo $id;
  echo $phone;
  echo $email;
  echo $OfficeID;*/
  //$id = $_POST['id'];

  $conn = new connectDB;
  $sSql = "INSERT INTO r_device
  VALUES ('','$HardwareID', '$HardwareName','$HardwareCode','$id');";
  //echo $sSql;
 /* $sSql = "UPDATE r_user SET phone = '$phone',email = '$email',OfficeID = '$OfficeID' WHERE id=$id";*/
  $conn->exe($sSql);
  
    header("Location:/repair/index.php?module=profile");

 ?>