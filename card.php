<?php
ob_start();
require_once("master/function.php");
$status = new connectDB;
$conn = new connectDB;
$sSql = "SELECT * FROM r_user";
$arrData = $conn->return_sql($sSql);
$recCount = $conn->record_count($sSql);

$SQL = "";
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
                    <h5 class="card-title ">จำนวนรายการซ่อมทั้งหมด</h5>
                    <p class="card-text">จำนวน 4 รายการ</p>

                </div>
                <div class="card-footer  ">
                    <a href="index.php?module=list-repair" class="btn btn-success">รายละเอียด</a>
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
</div>