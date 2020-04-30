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

$sSql3 = "SELECT * from r_office ";
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
                    <h4 class="modal-title" id="myModalLabel">Edit User Status </h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <select class="form-control" name="sellist1">
                            <?php  
                                                if($recCount2>0)
                                                {
                                                    for ($sLoop=0;$sLoop<$recCount2;$sLoop++)
                                                {
                                                //print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
                                            ?>
                            <option value="<?=$arrData2[$sLoop][0]?>"><?=$arrData2[$sLoop][1]?></option>
                            <?php }}?>
                        </select>
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

<form method="post" action="/repair/member/deleteUser.php" name="frmDelete">
    <div id="DeleteModal" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete User </h4>
                </div>
                <div class="modal-body">
                    <h6>หากคุณต้องการที่จะลบให้กด Delete</h6>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idDelete" id="idDelete" />
                    <input type="submit" class="btn btn-danger" value="Delete">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                echo "<span class='badge badge-secondary '>"."ผู้ใช้งาน"."</span>";
            }
            
            ?>
            </td>
            <td>
                <button type="button" class="btn btn-primary btn-sm  edit" data-toggle="modal" data-target="#myModal"
                    id="<?=$arrData[$sLoop][0]?>">สถานะ</button>
                <button type="button" class="btn btn-danger btn-sm delete" data-toggle="modal"
                    data-target="#DeleteModal" id="<?=$arrData[$sLoop][0]?>"><i class="fa fa-trash"></i> ลบ</button>
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

    $('.edit').on('click', function() {
        var uid = $(this).attr("id");
        $('#id').val(uid);
    });

    $('.delete').on('click', function() {
        var uid = $(this).attr("id");
        $('#idDelete').val(uid);
    });
    $('.update').on('click', function() {
        var uid = $(this).attr("id");
        $('#idUpdate').val(uid);
    });


});
</script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>