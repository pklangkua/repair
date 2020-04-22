<?php  
require_once "function.php";
$conn = new connectDB;
$sSql = "SELECT * FROM t  ";
$arrData = $conn->return_sql($sSql);
$recCount = $conn->record_count($sSql);
if($recCount>0){
	for ($sLoop=0;$sLoop<$recCount;$sLoop++){
		print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "
";
	}
}
/*
$sSql ="insert into t(name) values('pradit') ";
$conn->exe($sSql);*/