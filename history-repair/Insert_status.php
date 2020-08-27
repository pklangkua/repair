<?php 
ob_start();
 require_once("../master/function.php");
  $user = $_SESSION['user'];
  $sel = $_POST["sellist1"];
  $detail = $_POST["detail"];
  $IDrepair = $_POST["id"];
  
    $conn = new connectDB;
    $sSql = "INSERT INTO r_repair_status VALUES(null,'$IDrepair','0','$sel','$detail','$user',NOW(),'0.00');";
    $conn->exe($sSql);

    $conn2 = new connectDB;
    $sSql2 = "UPDATE r_data_repair SET CategoryID=$sel ,UserRecive ='$user' WHERE ID=$IDrepair;";
    $conn2->exe($sSql2);

    header("Location:/repair/index.php?module=list-repair");
  
 ?>