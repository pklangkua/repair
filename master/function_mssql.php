<?php

ini_set('display_errors', 1);
error_reporting(~0);
   $serverName = "PRADIT\SQLEXPRESS";
   $userName = "sa";
   $userPassword = "21652671";
   $dbName = "DUR";
  
   $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true, "CharacterSet" => "UTF-8");

   $conn = sqlsrv_connect( $serverName, $connectionInfo);

	if(!$conn)
	{
		die( print_r( sqlsrv_errors(), true));
	}

	//sqlsrv_close($conn);
?>