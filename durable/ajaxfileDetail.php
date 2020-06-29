<?php 
ob_start();
$id = $_POST['userid'];

include_once("../master/function.php");
include_once("../master/function_mssql.php");

$user = $_SESSION['user'];
$UserOfficeID =$_SESSION['OfficeID'];
$ConMysql = new connectDB ;
$cat = new category;

$stmt = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,
dbo.Office.OfficeName
FROM
dbo.Hardware AS h
INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID
WHERE h.HardwareID='$id' ";
//echo $stmt;
$query = sqlsrv_query( $conn, $stmt);
while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){

    $date = $result["AcquirementDatetime"]->format(\DateTime::ISO8601);
    $date = substr($date,0,-14);
    //echo $date;
?>
<div class="card-body">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>ครุภัณฑ์:</strong> <?=$result['HardwareTypeName']?>
                </div>
                <?php /* $newDate = DateTime::createFromFormat("l dS F Y",'2009-09-18');
                      $newDate = $newDate->format('d/m/Y');*/
                ?>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i
                            class="far fa-id-card mr-sm-2"></i><strong>รหัสทะเบียนครุภัณฑ์:</strong>
                        <?=$result['HardwareCode']?></li>
                    <li class="list-group-item"><i class="fas fa-book mr-sm-2"></i><strong>ประเภทครุภัณฑ์:</strong>
                        <?=$result['HardwareTypeGroupName']?></li>
                    <li class="list-group-item"><i class="fas fa-info mr-sm-2"></i><strong>หน่วยงานรับผิดชอบ:</strong>
                        <?=$result['OfficeName']?></li>
                    <li class="list-group-item"><i
                            class="fas fa-eye-dropper mr-sm-2"></i><strong>คุณลักษณะ/ชื่อ:</strong>
                        <?=$result['HardwareName']?></li>
                    <li class="list-group-item"><i
                            class="fas fa-location-arrow mr-sm-2"></i><strong>สถานที่ติดตั้ง:</strong>
                        <?=$result['InstallationLocation']?></li>
                    <li class="list-group-item"><i
                            class="fas fa-calendar-alt mr-sm-2"></i><strong>วันที่ได้รับ:</strong> <?=$date?></li>
                    <li class="list-group-item"><i class="far fa-images mr-sm-2"></i><strong>จำนวนชุด:</strong>
                        <?=$result['PriceSetID']?></li>
                    <li class="list-group-item"><i class="fas fa-bullhorn mr-sm-2"></i><strong>ราคา:</strong>
                        <?=$result['PriceSetMoney']?></li>
                    <li class="list-group-item"><i class="fas fa-bullseye mr-sm-2"></i><strong>ผู้จัดจำหน่าย:</strong>
                        <?="-------"?></li>
                </ul>
            </div>
            <?php }?>
            <br>
            <div class="card">
                <div class="card-header"> ประวัติการซ่อม </div>
                <?php include_once("history.php")?>
                <!--<ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="far fa-file-alt mr-sm-2"></i>พัสดุ:
                    </li>
                    <li class="list-group-item"><i class="fa fa-align-center mr-sm-2"></i>หมายเลขเครื่อง/เลขทะเบียน:
                    </li>
                    <li class="list-group-item"><i class="fas fa-calendar-alt mr-sm-2"></i>วันที่แจ้งซ่อม:
                    </li>
                    <li class="list-group-item"><i class="far fa-comment-alt mr-sm-2"></i>หมายเหตุการซ่อม:
                    </li>
                    <li class="list-group-item"><i class="fas fa-eye mr-sm-2"></i>รายละเอียดการซ่อม/ปัญหา:
                    </li>
                </ul>-->
            </div>

        </div>
    </div>
</div>