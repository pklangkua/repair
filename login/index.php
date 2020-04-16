<?php 
ob_start();
//session_start();
?>

<?php 

include("ldap.php");
 
// check to see if user is logging out
if(isset($_GET['out'])) {
	// destroy session
	session_unset();
	$_SESSION = array();
	unset($_SESSION['user'],$_SESSION['access']);
	session_destroy();
}
 
// check to see if login form has been submitted
if(isset($_POST['uname'])){
	// run information through authenticator
	if(authenticate($_POST['uname'],$_POST['psw']))
	{
		// authentication passed
		header("Location: protected.php");
		die();
	} else {
		// authentication failed
		$error = 1;
	}
}
 /*
// output error to user
if(isset($error)) echo "<div class='\alert alert-success\'>
<strong>Success!</strong> Indicates a successful or positive action.
</div>";//header("Location: index.php");
// output logout success
if(isset($_GET['out'])) header("Location: index.php");*/
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>.:: Login ::.</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.4/examples/sign-in/">


    <link href="https://getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/apple-touch-icon.png"
        sizes="180x180">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32"
        type="image/png">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16"
        type="image/png">
    <link rel="manifest" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/safari-pinned-tab.svg"
        color="#563d7c">
    <link rel="icon" href="https://getbootstrap.com/docs/4.4/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="https://getbootstrap.com/docs/4.4/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>

    <link href="https://getbootstrap.com/docs/4.4/examples/sign-in/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
        <div class="alert alert-dark" role="alert">
            <form class="form-signin" method="post" action="index.php">
                <!-- <img class="mb-4" src="https://getbootstrap.com/docs/4.4/assets/brand/bootstrap-solid.svg" alt="" width="72"
            height="72"> -->
                <i class='fas fa-laptop' style='font-size:100px;color:primary'></i>
                <h1 class="h3 mb-3 font-weight-normal"></h1>

                <input class="form-control" type="text" placeholder="Username" name="uname" required>
                <input class="form-control" type="password" placeholder="Password" name="psw" required>
                <div class="checkbox mb-3">

                </div>
                <button class="btn btn-lg btn-dark btn-block" type="submit">เข้าสู่ระบบ</button><br>
                <?php
        if(isset($error)) {?>
                <div class="alert alert-danger">
                    <strong>Login error!</strong> Plese check Username and Password
                </div> <?php }?>
            </form>
        </div>
    </div>
    <div class="col-sm-4">
</body>

</html>

<?php if(isset($_GET['out'])) header("Location: index.php");

if(isset($_SESSION['user'])) {
	// user is not logged in, do something like redirect to login.php
	header("Location: ../index.php?module=");
	die();
}
?>