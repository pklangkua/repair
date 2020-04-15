<?php
// initialize session
ob_start();
//session_start();
 
if(!isset($_SESSION['user'])) {
	// user is not logged in, do something like redirect to login.php
	header("Location: index.php");
	die();
}else
{
	header("Location: ../index.php?module=");
}
 
if($_SESSION['access'] != 2) {
	// another example...
	// user is logged in but not a manager, let's stop him
	//die("Access Denied");

	//header("Location: ./");
}
?>
 
<p>Welcome <?= $_SESSION['user'] ?>!</p>
 
<p><strong>Secret Protected Content Here!</strong></p>
 
<p>Mary Had a Little Lamb</p>
 
<p><a href="index.php?out=1">Logout</a></p>