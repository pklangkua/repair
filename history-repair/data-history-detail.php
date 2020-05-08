<?php
ob_start();
include_once("master/function.php");
include_once("master/function_mssql.php");

$user = $_SESSION['user'];
$ID =$_GET['detailID'];
$ConMysql = new connectDB ;
$cat = new category;

$sSql = "SELECT * FROM r_data_repair WHERE ID ='$ID'";
$arrData = $ConMysql->return_sql($sSql);
$recCount = $ConMysql->record_count($sSql);
if($recCount>0){
	for ($sLoop=0;$sLoop<$recCount;$sLoop++){

            $name =$arrData[$sLoop][7];
            $sql2 ="SELECT fullname,phone FROM r_user WHERE username ='$name'";
            $arrData2 = $ConMysql->return_sql($sql2);
            $recCount2 = $ConMysql->record_count($sql2);
            if($recCount2>0){
                for ($sLoop2=0;$sLoop2<$recCount2;$sLoop2++){
            
                    $fullname = $arrData2[$sLoop2][0];
                    $tel = $arrData2[$sLoop2][1];
                }
            }

?>

<div class="card border-light mb-3" style="max-width:">
    <div class="card-header">แจ้งซ่อม / รายการแจ้งซ่อม </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        รายละเอียดของ ผู้แจ้งซ่อม
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="far fa-id-card mr-sm-2"> </i>ชื่อ นามสกุล: <?=$fullname?></li>
                        <li class="list-group-item"><i class="fas fa-phone-volume mr-sm-2"></i>โทรศัพท์: <?=$tel?></li>
                    </ul>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        รายละเอียดการซ่อม </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class="far fa-file-alt mr-sm-2"></i>พัสดุ: <?=$arrData[$sLoop][3]?></li>
                                <li class="list-group-item"><i
                                        class="fa fa-align-center mr-sm-2"></i>หมายเลขเครื่อง/เลขทะเบียน: <?=$arrData[$sLoop][2]?></li>
                                <li class="list-group-item"><i class="fas fa-calendar-alt mr-sm-2"></i>วันที่แจ้งซ่อม: <?=$arrData[$sLoop][10]?>
                                </li>
                                <li class="list-group-item"><i class="far fa-comment-alt mr-sm-2"></i>หมายเหตุการซ่อม: <?=$arrData[$sLoop][5]?>
                                </li>
                                <li class="list-group-item"><i class="fas fa-eye mr-sm-2"></i>รายละเอียดการซ่อม/ปัญหา: <?=$arrData[$sLoop][6]?>
                                </li>
                            </ul>
                    </div>
<br>
                    <?php include("history.php")?>
                    <div class="col-sm-2">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php } } ?>