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
  if($OfficeID=='')
  {
    echo "error";
  }else{
    $SQL="SELECT OfficeName FROM r_office WHERE OfficeID='$OfficeID' ";

    $arrData = $conn->return_sql($SQL);
    $recCount = $conn->record_count($SQL);
    if($recCount>0){
      for ($sLoop=0;$sLoop<$recCount;$sLoop++)
      {
            $OfficeName = $arrData[$sLoop][0] ;
      }
    }
  $sSql = "UPDATE r_user SET phone = '$phone',email = '$email',OfficeID = '$OfficeID',department='$OfficeName' WHERE id=$id";
 
  }
    $conn->exe($sSql);
    header("Location:/repair/index.php?module=profile");

 ?>