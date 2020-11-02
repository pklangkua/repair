<?php
ob_start();
include_once("master/function.php");
include_once("master/function_mssql.php");

$user = $_SESSION['user'];
$UserOfficeID =$_SESSION['OfficeID'];
//echo $UserOfficeID;
$ConMysql = new connectDB ;
$cat = new category;

$sSql = "SELECT r.ID,
r.HardwareID,
r.HardwareCode,
r.HardwareName,
r.OfficeID,
r.Detail,
r.`Comment`,
r.UserID,
r.UserOfficeID,
r.CategoryID,
r.DateRepair,
u.fullname FROM r_data_repair r inner join r_user u  on u.username = r.UserID
WHERE r.UserOfficeID ='$UserOfficeID' AND r.CategoryID not in(7,1) AND  r.UserRecive = '$user'";
$arrData = $ConMysql->return_sql($sSql);
$recCount = $ConMysql->record_count($sSql);

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<!-- <form method="post" action="" name="">

    <div id="repairDetail" class="modal modal-child fade  bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">รายละเอียด ครุภัณฑ์ </h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</form> -->

<script type="text/javascript">
function fncSubmit2() {
    if (document.getElementById('detail_id').value == "") {
        alert('กรุณากรอกข้อมูลให้ถูกต้อง');
        return false;
    }
}
</script>

<form method="post" action="/repair/recive-repair/Insert_status.php" name="frmInsertStatus"
    onSubmit="JavaScript:return fncSubmit2();">
    <div id="myModal" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แจ้งซ่อม : <div id="showText"></div>
                    </h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="บันทึก">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
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
            <th>ผู้แจ้ง</th>
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
            <td><?=$arrData[$sLoop][11]?></td>
            <td>

                <button type="button" class="btn btn-info "
                    onclick="window.location.href = '?module=data-history-detail&&detailID=<?=$arrData[$sLoop][0]?>';"
                    title="รายละเอียด">
                    <!--i class="fas fa-database"--><i class="fas fa-edit"></i>
                </button>

                <button type="button" class="btn btn-danger edit " title="ดำเนินการ" data-toggle="modal"
                    data-target="#myModal" id="<?=$arrData[$sLoop][0]?>" fname="<?=$arrData[$sLoop][3]?>"
                    status="<?=$arrData[$sLoop][9]?>" style="display:none"><i class="fas fa-desktop"></i></button>

                <button type="button" class="btn btn-danger repair " title="ดำเนินการ" data-toggle="modal"
                    data-target="#myModal" id="<?=$arrData[$sLoop][0]?>" fname="<?=$arrData[$sLoop][3]?>"
                    status="<?=$arrData[$sLoop][9]?>"><i class="fas fa-desktop"></i></button>
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
            <th>ผู้แจ้ง</th>

        </tr>
    </tfoot>
</table>
<script>
$(document).ready(function() {
    $('#example').DataTable();

    /* $("body").on("click", ".detail", function(event) {
        var detailID = $(this).attr('id');

        // AJAX request
        $.ajax({
            url: 'history-repair/data-history-detail2.php',
            type: 'post',
            data: {
                detailID: detailID
            },
            success: function(response) {
                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#DurableDetail').modal('show');
            }
        });
    }); */

    // $('.edit').on('click', function() {
    /* $("body").on("click", ".edit", function(event) {
         var uid = $(this).attr("id");
         var ustatus = $(this).attr("status");
         //var fname = $(this).attr("fname");
         $('#id').val(uid);
         $('#status').val(ustatus);
         //$('#name').val(fname);
         document.getElementById("showText").innerHTML = $(this).attr("fname"); //"HELLO";
         document.getElementById("status").innerHTML = $(this).attr("status");
     });*/

    $("body").on("click", ".repair", function(event) {
        /*var userid = $(this).attr('id2');
        var hname = $(this).attr('hname');
        var Officename = $(this).attr('Officename');
        var HardwareCode = $(this).attr('HardwareCode');
        var OfficeID = $(this).attr('OfficeID');
        var HardwareID = $(this).attr('HardwareID');*/
        var id = $(this).attr("id");
        var ustatus = $(this).attr("status");
        var fname = $(this).attr("fname");
        document.getElementById("showText").innerHTML = $(this).attr("fname");

        // AJAX request
        $.ajax({
            url: 'recive-repair/recive-detail.php',
            type: 'post',
            data: {
                id: id,
                fname: fname,
                ustatus: ustatus
            },
            success: function(response) {
                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#DurableRepair').modal('show');
            }
        });
    });


});
</script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>