<?php 
require_once "function.php";
$conn = new connectDB;
$sSql = "SELECT * FROM r_user where username='pradit' ";
$arrData = $conn->return_sql($sSql);
$recCount = $conn->record_count($sSql);
if($recCount>0){
	for ($sLoop=0;$sLoop<$recCount;$sLoop++){
		print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][7] . "
";
	}
}
