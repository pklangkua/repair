<?php
ob_start();
require_once("function.php");
$chk = new checkLogin;
$chk->chk_login();

$status = new status;
//$status->status(); 
$OfficeID = $status->OfficeID();
$st = $status->status();
$_SESSION['status'] = $st;
$_SESSION['OfficeID'] = $OfficeID;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
        integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <!-- Datatable-->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> -->

    <!-- END Datatable-->
    <title>DMH Repair</title>

</head>

<body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
        <!-- Brand -->
        <a class="navbar-brand" href="/repair/index.php?module="><svg class="bi bi-tools" width="1em" height="1em"
                viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M0 1l1-1 3.081 2.2a1 1 0 01.419.815v.07a1 1 0 00.293.708L10.5 9.5l.914-.305a1 1 0 011.023.242l3.356 3.356a1 1 0 010 1.414l-1.586 1.586a1 1 0 01-1.414 0l-3.356-3.356a1 1 0 01-.242-1.023L9.5 10.5 3.793 4.793a1 1 0 00-.707-.293h-.071a1 1 0 01-.814-.419L0 1zm11.354 9.646a.5.5 0 00-.708.708l3 3a.5.5 0 00.708-.708l-3-3z"
                    clip-rule="evenodd" />
                <path fill-rule="evenodd"
                    d="M15.898 2.223a3.003 3.003 0 01-3.679 3.674L5.878 12.15a3 3 0 11-2.027-2.027l6.252-6.341A3 3 0 0113.778.1l-2.142 2.142L12 4l1.757.364 2.141-2.141zm-13.37 9.019L3.001 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"
                    clip-rule="evenodd" />
            </svg> ระบบแจ้งซ่อม</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse " id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="?module=" >หน้าหลัก</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        งานซ่อม
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="?module=resive-repair"   >แจ้งซ่อม</a>
                        <a class="dropdown-item" href="?module=history-repair">ติดตามการสั่งซ่อมของฉัน</a>
                        <a class="dropdown-item" href="?module=list-repair" <?php if($st==3){ echo 'style="display:none"';}?>>รายการแจ้งซ่อม</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?module=durable" >ครุภัณฑ์</a>  <!-- style="display:none" -->
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?module=test" style="display:none" >test</a>  <!-- style="display:none" -->
                </li>
                <li class="nav-item dropdown" <?php if($st==1){ echo 'style="display:true"';}else{ echo 'style="display:none"';}?>> <!-- style="display:none"-->
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        สมาชิก
                    </a>
                    <div class="dropdown-menu"> 
                        <a class="dropdown-item" href="?module=member">รายชื่อสมาชิก</a>
                        <!--<a class="dropdown-item" href="#">Link 2</a> 
                        <a class="dropdown-item" href="#">Link 3</a>--> 
                    </div>
                </li>
                
            </ul>
            
        </div>
        <form >
        <div class="collapse navbar-collapse pull-left " id="collapsibleNavbar"  > 
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item">
                    <a class="nav-link" href="#" title="" style="color: #FFFFFF;">ยินดีต้อนรับ: <?=$_SESSION['fullname'][0]?></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </a>
                    <!--<div class="dropdown-menu dropdown-menu-left">
                        <a class="dropdown-item" href="?module=">เข้าสู่ระบบ</a>
                        <a class="dropdown-item" href="?module=">โปรไฟล์</a>
                        <a class="dropdown-item" href="?module=">ออกจากระบบ</a>
                    </div>-->
                    <div class="dropdown-menu dropdown-menu-right"> 
                        <a class="dropdown-item" href="?module=">โปรไฟล์</a>
                        <a class="dropdown-item" href="login/index.php?out=1">ออกจากระบบ</a>
                        <!--<button class="dropdown-item" type="button">Action</button>
                        <button class="dropdown-item" type="button">Another action</button>
                        <button class="dropdown-item" type="button">Something else here</button>-->
                    </div>
                </li>
            </ul>
        </div>
        </form>
    </nav>