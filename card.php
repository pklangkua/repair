<?php
ob_start();
require_once("master/function.php");

$user = $_SESSION['user'];
$UserOfficeID =$_SESSION['OfficeID'];
$status = $_SESSION['status'];
$conn = new connectDB;
$sSql = "SELECT * FROM r_user";
$arrData = $conn->return_sql($sSql);
$recCount = $conn->record_count($sSql);
//print $status ;
 
if($status =='3')
{
    $SQL = "SELECT * FROM r_data_repair WHERE UserID ='$user'";
    $arrData2 = $conn->return_sql($SQL);
    $recCount2 = $conn->record_count($SQL);
   // print $status ;
}else if($status =='2' )
{
    $SQL = "SELECT * FROM r_data_repair WHERE UserID ='$user'";
    $arrData2 = $conn->return_sql($SQL);
    $recCount2 = $conn->record_count($SQL); 
    //print $SQL ;  
}else 
{
    $SQL = "SELECT * FROM r_data_repair ";
    $arrData2 = $conn->return_sql($SQL);
    $recCount2 = $conn->record_count($SQL); 
    //print $status ;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col">
        </div>
        <div class="col">

            <div class="card text-center ">
                <div class="card-header bg-success">
                    <h4>รายการซ่อม</h4>
                </div>
                <div class="card-body bg-light">
                    <h5 class="card-title ">จำนวนรายการซ่อมของฉัน</h5>
                    <p class="card-text">จำนวน <?=$recCount2?> รายการ</p>

                </div>
                <div class="card-footer  ">
                    <a href="index.php?module=history-repair" class="btn btn-success">รายละเอียด</a>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card text-center  ">
                <div class="card-header bg-info">
                    <h4>สมาชิก</h4>
                </div>
                <div class="card-body bg-light">
                    <h5 class="card-title ">สมาชิก ทั้งหมด</h5>
                    <p class="card-text">จำนวน <?=$recCount?> คน</p>

                </div>
                <div class="card-footer ">
                    <a href="index.php?module=member" class="btn btn-info">รายละเอียด</a>
                </div>
            </div>

        </div>
        <div class="col">

        </div>
    </div>
<BR>
    <div class="row">
        <div class="col-2">
        </div>
        <div class="col">
        <?php include("chart.php")?>
        </div>
        <div class="col-2">
        </div>
    </div>

</div>