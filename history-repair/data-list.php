<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>พัสดุ</th>
            <th>วันที่แจ้งซ่อม</th>
            <th>วันที่รับซ่อม</th>
            <th>ผู้ปฎิบัติงาน</th>
            <th>สถานะการซ่อม</th>
            <th>รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td><span class="badge badge-primary ">แจ้งซ่อม</span></td>
            <td>
                <button type="button" class="btn btn-primary btn-sm">สถานะ</button>
                <button type="button" class="btn btn-info btn-sm">รายละเอียด</button>
                <button type="button" class="btn btn-danger btn-sm">ลบ</button>
                <button type="button" class="btn btn-danger " onclick="window.location.href = '?module=data-history-detail';" >รายละเอียด</button>
            </td>
        </tr>
        <tr>
            <td>Tiger Nixon</td>
            <td>System Architect</td>
            <td>Edinburgh</td>
            <td>61</td>
            <td><span class="badge badge-primary ">แจ้งซ่อม</span></td>
            <td>
                <button type="button" class="btn btn-primary btn-sm">สถานะ</button>
                <button type="button" class="btn btn-info btn-sm">รายละเอียด</button>
                <button type="button" class="btn btn-danger btn-sm">ลบ</button>
                <button type="button" class="btn btn-danger " onclick="window.location.href = '?module=data-history-detail';" >รายละเอียด</button>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th>พัสดุ</th>
            <th>วันที่แจ้งซ่อม</th>
            <th>วันที่รับซ่อม</th>
            <th>ผู้ปฎิบัติงาน</th>
            <th>สถานะการซ่อม</th>
            <th>รายละเอียด</th>
        </tr>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
 -->

<?php
ob_start();
include_once("master/function.php");
include_once("master/function_mssql.php");

$user = $_SESSION['user'];
$UserOfficeID =$_SESSION['OfficeID'];
$ConMysql = new connectDB ;
$cat = new category;
$sSql = "SELECT * FROM r_data_repair WHERE UserOfficeID ='$UserOfficeID'";
$arrData = $ConMysql->return_sql($sSql);
$recCount = $ConMysql->record_count($sSql);
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>รายการ</th>
            <th>เลขครุภัณฑ์</th>
            <th>อาการ/สาเหตุ</th>
            <th>วันที่แจ้งซ่อม</th>
            <th>สถานะ</th>
            <th>รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <?php if($recCount>0){
	for ($sLoop=0;$sLoop<$recCount;$sLoop++){
		//print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
	?>

        <tr>
            <td><?=$sLoop+1?></td>
            <td><?=$arrData[$sLoop][3]?></td>
            <td><?=$arrData[$sLoop][2]?></td>
            <td><?=$arrData[$sLoop][5]?></td>
            <td><?=$arrData[$sLoop][10]?></td>
            <th>
            <?php 
                $cat->cat_chk($arrData[$sLoop][9]);
            ?>
             
            </th>
            <td><button type="button" class="btn btn-info "
                    onclick="window.location.href = '?module=data-history-detail&&detailID=<?=$arrData[$sLoop][0]?>';">รายละเอียด</button></td>
        </tr><?php } }?>
    </tbody>
    <tfoot>
        <tr>
        <th>ลำดับ</th>
            <th>รายการ</th>
            <th>เลขครุภัณฑ์</th>
            <th>อาการ/สาเหตุ</th>
            <th>วันที่แจ้งซ่อม</th>
            <th>สถานะ</th>
            <th>รายละเอียด</th>
        </tr>
    </tfoot>
</table>

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
