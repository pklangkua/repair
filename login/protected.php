<?php
ob_start();
require_once("../master/function.php");

$conn = new connectDB;
 
if(!isset($_SESSION['user'])) {
	// user is not logged in, do something like redirect to login.php
	header("Location: index.php");
	die();
}else
{
	if(isset($_SESSION['user']) && isset($_SESSION['fullname'][0]) && isset($_SESSION['department']))
	{
		$username = $_SESSION['user'];
		$fullname = $_SESSION['fullname'][0];
		$department = $_SESSION['department'][0];
	}

		$sSql = "SELECT * FROM r_user WHERE username = '$username'";
		$arrData = $conn->return_sql($sSql);
		$recCount = $conn->record_count($sSql);
		if($recCount>0)
		{
			$sSql = "UPDATE r_user set lastvisit_login = NOW(),department='$department' WHERE username ='$username'";
			//echo $sSql;
			$conn->exe($sSql);
			header("Location: ../index.php?module=profile");
		}else 
		{
			$sSql = "INSERT r_user (id,username,fullname,create_date,lastvisit_login,department) VALUES (null,'$username','$fullname',NOW(),NOW(),'$department' )";
			$conn->exe($sSql);
		
			header("Location: ../index.php?module=profile");
		}

	
}
 
if($_SESSION['access'] != 2) {
	// another example...
	// user is logged in but not a manager, let's stop him
	//die("Access Denied");

	//header("Location: ./");
}
?>