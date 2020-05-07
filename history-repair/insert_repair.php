<?php
echo $_POST['HardwareName'],"<br>",$_POST['HardwareID'],"<br>",$_POST['HardwareCode'],"<br>",$_POST['office'],"<br>",$_POST['officeID'],"<br>",$_POST['detail'],"<br>",$_POST['comment'],"<br>",$_POST['UserID'];

require_once("../master/function.php");
$conn = new connectDB;

if(isset($_POST['HardwareName']) && isset($_POST['HardwareID'])&& isset($_POST['HardwareCode']) && isset($_POST['officeID']) 
&& isset($_POST['detail']) && isset($_POST['comment']) && isset($_POST['UserID'])){

    $HardwareName = $_POST['HardwareName'];
    $HardwareID = $_POST['HardwareID'];
    $HardwareCode = $_POST['HardwareCode'];
    $officeID = $_POST['officeID'];
    $detail = $_POST['detail'];
    $comment = $_POST['comment'];
    $UserID = $_POST['UserID'];

    $sql = "INSERT INTO r_data_repair (HardwareID,HardwareCode,HardwareName,OfficeID,Detail,Comment,UserID)".
    $sql = " VALUES ('$HardwareID','$HardwareCode','$HardwareName','$officeID','$detail','$comment','$UserID')";
    
    echo $sql;
    $conn->exe($sql); 
        header("Location:/repair/index.php?module=history-repair");
}
 