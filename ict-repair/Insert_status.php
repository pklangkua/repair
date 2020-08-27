<?php 
ob_start();
 require_once("../master/function.php");
  $user = $_SESSION['user'];
  $sel = $_POST["sellist1"];
  $detail = $_POST["detail"];
  $IDrepair = $_POST["id"];
  $sentLine = new Line;
  
    $conn = new connectDB ;
    $sSql = "INSERT INTO r_repair_status VALUES(null,'$IDrepair','0','$sel','$detail','$user',NOW(),'0.00');";
    $conn->exe($sSql);

    $conn2 = new connectDB ;
    $sSql2 = "UPDATE r_data_repair SET CategoryID=$sel ,UserRecive ='$user' WHERE ID=$IDrepair;";
    $conn2->exe($sSql2);

    $conn3 = new connectDB ;
    $sSql3 = "SELECT r.ID,r.HardwareID,r.HardwareCode,r.HardwareName,r.OfficeID,r.Detail,r.`Comment`,
              r.UserID,r.UserOfficeID,r.CategoryID,r.DateRepair,u.fullname,o.OfficeName
              FROM r_data_repair AS r
              INNER JOIN r_user AS u ON u.username = r.UserID
              INNER JOIN r_office AS o ON o.OfficeID = r.OfficeID
              WHERE r.ID=$IDrepair;";
    $arrData = $conn3->return_sql($sSql3);
    $recCount = $conn3->record_count($sSql3);
      if($recCount>0){
        for ($sLoop=0;$sLoop<$recCount;$sLoop++){
              $HardwareName = $arrData[$sLoop][3];
              $HardwareCode = $arrData[$sLoop][2];
              $office       = $arrData[$sLoop][12];
              $fullname     = $arrData[$sLoop][11];
        }
      }
    if($sel=='7')
    {  
    $message = 'แจ้งซ่อมคอมพิวเตอร์ '."\n".'ครุภัณฑ์ชื่อ : '.$HardwareName."\n".'เลขทะเบียน : '.$HardwareCode.
                "\n".'ครุภัณฑ์หน่วยงาน : '.$office ."\n".'รายละเอียด : '.$detail ."\n".'ผู้แจ้งซ่อม : '.$fullname."\n".'สถานะ : :ซ่อมสำเร็จ';
    $sentLine->LineNotify($message);
    }

    header("Location:/repair/index.php?module=recive");
  
 ?>