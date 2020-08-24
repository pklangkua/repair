<?php
//echo $_POST['HardwareName'],"<br>",$_POST['HardwareID'],"<br>",$_POST['HardwareCode'],"<br>",$_POST['office'],"<br>",$_POST['officeID'],
//"<br>",$_POST['detail'],"<br>",$_POST['comment'],"<br>",$_POST['UserID'];
ob_start();
require_once("../master/function.php");
$fullname = $_SESSION['fullname'][0];
$conn = new connectDB;
$sentLine = new Line;

if(isset($_POST['HardwareName']) && isset($_POST['HardwareID'])&& isset($_POST['HardwareCode']) && isset($_POST['officeID']) 
&& isset($_POST['detail']) && isset($_POST['comment']) && isset($_POST['UserID'])&& isset($_POST['office'])){

    $HardwareName = $_POST['HardwareName'];
    $HardwareID = $_POST['HardwareID'];
    $HardwareCode = $_POST['HardwareCode'];
    $officeID = $_POST['officeID'];
    $office = $_POST['office'];
    $detail = $_POST['detail']; 
    $comment = $_POST['comment'];
    $UserID = $_POST['UserID'];
    $UserOfficeID =$_SESSION['OfficeID'];

    $sql = "INSERT INTO r_data_repair (HardwareID,HardwareCode,HardwareName,OfficeID,Detail,Comment,UserID,UserOfficeID,DateRepair)".
    $sql = " VALUES ('$HardwareID','$HardwareCode','$HardwareName','$officeID','$detail','$comment','$UserID','$UserOfficeID',NOW())";
    
    $conn->exe($sql);   
    $message = 'แจ้งซ่อมคอมพิวเตอร์ '."\n".'ครุภัณฑ์ชื่อ : '.$HardwareName."\n".'เลขทะเบียน : '.$HardwareCode.
                "\n".'หน่วยงาน : '.$office ."\n".'รายละเอียด : '.$detail ."\n".'ผู้แจ้งซ่อม : '.$fullname;
    $sentLine->LineNotify($message);
        header("Location:/repair/index.php?module=history-repair");
}
 ?>