<?php
ob_start();
require_once("master/function.php");

$conn = new connectDB;

$sSql = "SELECT r_user.id,r_user.fullname,r_user.lastvisit_login,r_user.create_date,
r_user.active,r_user.status_id,r_status.`status`,r_user.department,OfficeID from r_user LEFT JOIN r_status on r_status.id = r_user.status_id";
$arrData = $conn->return_sql($sSql);
$recCount = $conn->record_count($sSql);

$sSql2 = "SELECT * from r_status ";
$arrData2 = $conn->return_sql($sSql2);
$recCount2 = $conn->record_count($sSql2);

$sSql3 = "SELECT * from r_office WHERE OrganizationID='1' ";
$arrData3 = $conn->return_sql($sSql3);
$recCount3 = $conn->record_count($sSql3);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<form method="post" action="/repair/member/edit_status.php" name="frmEdit">
<div id="myModal" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">ปรับปรุง : สถานะการใช้งาน
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

<form method="post" action="/repair/member/deleteUser.php" name="frmDelete">
    <div id="DeleteModal" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ลบสมาชิก </h4>
                </div>
                <div class="modal-body">
                    <h6>หากคุณต้องการที่จะลบ</h6><div id="showText"></div><h6>ใช่หรือไม่</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idDelete" id="idDelete" />
                    <input type="submit" class="btn btn-danger" value="ลบ">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


</form>

<form method="post" action="/repair/member/updateOffice.php" name="frmUpdateOffice">
    <div id="myOffice" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update หน่วยงาน </h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <select class="form-control" name="OfficeID">
                            <?php  
                                                if($recCount3>0)
                                                {
                                                    for ($sLoop=0;$sLoop<$recCount3;$sLoop++)
                                                {
                                                //print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
                                            ?>
                            <option value="<?=$arrData3[$sLoop][0]?>"><?=$arrData3[$sLoop][3]?></option>
                            <?php }}?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idUpdate" id="idUpdate"  />
                    <input type="submit" class="btn btn-primary" value="บันทึก">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>


</form>

<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>ชื่อ-นามสกุล</th>
            <th>หน่วยงาน</th>
            <th>วันที่เข้าใช้งาน</th>
            <th>วันที่เข้าใช้งานล่าสุด</th>
            <th>สถานะ</th>
            <th>จัดการ</th>
        </tr>
    </thead>
    <tbody>
        <?php 
    if($recCount>0)
    {
        for ($sLoop=0;$sLoop<$recCount;$sLoop++)
        {
		//print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
    ?>
        <tr>
            <td><?=$sLoop+1?></td>
            <td><?=$arrData[$sLoop][1]?></td> 
            <td><?=$arrData[$sLoop][7]?> 
            <?php if($arrData[$sLoop][8] == null){?>
             <button type="button" class="btn btn-primary btn-sm  update" data-toggle="modal"
            data-target="#myOffice" id="<?=$arrData[$sLoop][0]?>">update id หน่วยงาน</button><?php }?></td>
            <td><?=$arrData[$sLoop][3]?></td>
            <td><?=$arrData[$sLoop][2]?></td>
            <td>
                <?php 
            if($arrData[$sLoop][5]==1)
            { 
                echo "<span class='badge badge-success '>".$arrData[$sLoop][6]."</span>";
            }else if ($arrData[$sLoop][5]==2)
            {
                echo "<span class='badge badge-primary '>".$arrData[$sLoop][6]."</span>";
            }else
            {
                echo "<span class='badge badge-secondary '>".$arrData[$sLoop][6]."</span>";
            }
            
            ?>
            </td>
            <td>
                <button type="button" class="btn btn-primary btn-sm  edit" data-toggle="modal" data-target="#myModal"
                    id="<?=$arrData[$sLoop][0]?>" status="<?=$arrData[$sLoop][5]?>">สถานะ</button>
                <button type="button" class="btn btn-danger btn-sm delete" data-toggle="modal"
                    data-target="#DeleteModal" id="<?=$arrData[$sLoop][0]?>" fname="<?=$arrData[$sLoop][1]?>"><i class="fa fa-trash"></i> ลบ</button>
            </td>
        </tr>
        <?php }}?>
    </tbody>
    <tfoot>
        <tr> 
            <th>ลำดับ</th>
            <th>ชื่อ-นามสกุล</th>
            <th>หน่วยงาน</th>
            <th>วันที่เข้าใช้งาน</th>
            <th>วันที่เข้าใช้งานล่าสุด</th>
            <th>สถานะ</th>
            <th>จัดการ</th>
        </tr>
    </tfoot>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();

   /* $("body").on("click", ".edit", function(event) {
        var uid = $(this).attr("id");
        $('#id').val(uid);
    });*/

    $("body").on("click", ".delete", function(event) {
    //$('.delete').on('click', function() {
        var uid = $(this).attr("id");
        $('#idDelete').val(uid);
        document.getElementById("showText").innerHTML = $(this).attr("fname");
    });
    $("body").on("click", ".update", function(event) {
    //$('.update').on('click', function() {
        var uid = $(this).attr("id");
        $('#idUpdate').val(uid);
    });

    $("body").on("click", ".edit", function(event) {
        /*var userid = $(this).attr('id2');
        var hname = $(this).attr('hname');
        var Officename = $(this).attr('Officename');
        var HardwareCode = $(this).attr('HardwareCode');
        var OfficeID = $(this).attr('OfficeID');
        var HardwareID = $(this).attr('HardwareID');*/
        var id = $(this).attr("id");
        var ustatus = $(this).attr("status");
        var fname = $(this).attr("fname");
        // AJAX request
        $.ajax({
            url: 'member/editAjax.php',
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