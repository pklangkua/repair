<?php
ob_start();
include_once("../master/function.php");
include_once("../master/function_mssql.php");
//$idrepair = $_REQUEST["detailID"];
$user = $_SESSION['user'];
$UserOfficeID =$_SESSION['OfficeID'];
$ConMysql = new connectDB ;
$cat = new category;


$sSql = "SELECT * FROM r_data_repair WHERE HardwareID='$id'";
$arrData = $ConMysql->return_sql($sSql);
$recCount = $ConMysql->record_count($sSql);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> 

<div class="card">
    <!-- <div class="card-header">
        ประวัติการทำรายการ
    </div> -->
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <form method="post" action="/repair/history-repair/delete-repair.php">

                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>วันที่แจ้งซ่อม</th>
                            <th>สถานะ</th>
                            <th>รายละเอียด</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php   if($recCount>0){
	                        for ($sLoop=0;$sLoop<$recCount;$sLoop++){
	                ?>
                        <tr>
                             <td><?=$sLoop+1?></td>
                            <td><?=$arrData[$sLoop][10]?></td>
                            <td><?php  $cat->cat_chk($arrData[$sLoop][9]); ?></td>
                            <td><?=$arrData[$sLoop][5]?></td>
                            
                        </tr>
                        <?php } }?>
                    </tbody>
                </table>
            </form>
        </li>
    </ul>
</div>


<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>