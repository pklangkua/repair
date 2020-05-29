<?php
ob_start();
include_once("master/function.php");
include_once("master/function_mssql.php");

$user = $_SESSION['user'];
$UserOfficeID =$_SESSION['OfficeID'];
$ConMysql = new connectDB ;
$cat = new category;


$sSql = "SELECT * FROM r_data_repair WHERE UserOfficeID ='$UserOfficeID' AND CategoryID <>7";
$arrData = $ConMysql->return_sql($sSql);
$recCount = $ConMysql->record_count($sSql);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<form method="post" action="/repair/history-repair/Insert_status.php" name="frmInsertStatus">
    <div id="myModal" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แจ้งซ่อม : <div id="showText"></div>
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                    <label >สถานะ</label>
                        <select class="form-control" name="sellist1">
                            <option>------------------ เลือก ------------------</option>
                            <?php  
                            $SQL = "SELECT * FROM r_category WHERE id BETWEEN '2'AND'10'";
                            $arrData2 = $ConMysql->return_sql($SQL);
                            $recCount2 = $ConMysql->record_count($SQL);
                                                if($recCount2>0)
                                                {
                                                    for ($sLoop2=0;$sLoop2<$recCount2;$sLoop2++)
                                                {
                                                //print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
                                            ?>
                            <option value="<?=$arrData2[$sLoop2][2]?>"><?=$arrData2[$sLoop2][3]?></option>
                            <?php }}?>
                        </select></div>
                    <div class="form-group">
                    <label >รายละเอียด</label>
                        <textarea class="form-control" name="detail" id="" cols="50" rows="5"></textarea>
                    </div>

                </div>
                <div class="modal-footer">

                    <input type="hidden" name="id" id="id" />
                    <input type="submit" class="btn btn-primary" value="Save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</form>


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
            <td>
                <button type="button" class="btn btn-info "
                    onclick="window.location.href = '?module=data-history-detail&&detailID=<?=$arrData[$sLoop][0]?>';"
                    title="รายละเอียด">
                    <!--i class="fas fa-database"--><i class="fas fa-edit"></i> </button>
                
                <button type="button" class="btn btn-danger edit " title="ดำเนินการ" data-toggle="modal"
                    data-target="#myModal" id="<?=$arrData[$sLoop][0]?>" fname="<?=$arrData[$sLoop][3]?>"><i
                        class="fas fa-desktop"></i></button>
            </td>
        </tr><?php  } }?>
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

    $('.edit').on('click', function() {
        var uid = $(this).attr("id");
        var fname = $(this).attr("fname");
        $('#id').val(uid);
        $('#name').val(fname);
        document.getElementById("showText").innerHTML = $(this).attr("fname"); //"HELLO";
    });
});
</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>