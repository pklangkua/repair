<?php
ob_start();
require_once("master/function_mssql.php");
require_once("master/function.php");
$user = $_SESSION['user'];
$conn2 = new connectDB;
$sSql = "SELECT OfficeID,status_id,department from r_user where username ='$user'";
$arrData = $conn2->return_sql($sSql);
$recCount = $conn2->record_count($sSql);
    if($recCount>0)
    {
        for ($sLoop=0;$sLoop<$recCount;$sLoop++)
            {
                $OfficeID = $arrData[$sLoop][0];
                $status_id = $arrData[$sLoop][1];
                $department = $arrData[$sLoop][2];
            }
    }
    if($status_id==1)
    {
        $stmt = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,
        dbo.Office.OfficeName
        FROM
        dbo.Hardware AS h
        INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
        INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
        INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID ";
        //echo $stmt;
        $query = sqlsrv_query( $conn, $stmt);
        $i=1;
    }else
    {
        $stmt = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,
        dbo.Office.OfficeName
        FROM
        dbo.Hardware AS h
        INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
        INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
        INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID WHERE h.OfficeID = '$OfficeID'  ";
        //echo $stmt;
        $query = sqlsrv_query( $conn, $stmt);
        $i=1;
    }
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<form method="post" action="" name="frmDetail">

    <div id="DurableDetail" class="modal modal-child fade  bd-example-modal-lg" tabindex="-1" role="dialog"
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


</form>

<form method="post" action="" name="frmRepair">

    <div id="DurableRepair" class="modal modal-child fade  bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แจ้งซ่อม </h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</form>

<!-- <form method="post" action="index.php" name="frmRepair">

    <div id="DurableDetail" class="modal modal-child fade  bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แจ้งซ่อม </h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


</form> -->

<table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
    <thead>
        <tr>
            <th>ลำดับ</th>
            <th>เลขครุภัณฑ์</th>
            <th>ชื่อครุภัณฑ์</th>
            <th>ประเภทครุภัณ์</th>
            <th>หน่วยงาน</th>
            <th>รายละเอียด</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){  ?>
        <tr>
            <td><?=$i?><input type="checkbox" name="name[<?=$i?>]"></td>
            <td><?=$result['HardwareCode']?></td>
            <td><?=$result['HardwareName']?></td>
            <td><?=$result['HardwareTypeGroupName']?></td>
            <td><?=$result['OfficeName']?></td>
            <td>

                <button type="button" class="btn btn-info btn-sm view_data" id='1' data-target="#DurableDetail"
                    data-toggle="modal"><i class="fas fa-edit"></i> รายละเอียด</button>
                <button type="button" class="btn btn-danger btn-sm repair" data-target="#DurableRepair"
                    data-toggle="modal" id2="2"><i class="fas fa-edit"></i> แจ้งซ่อม</button>
            </td>
        </tr>
        <?php $i++; }?>
    </tbody>
    <tfoot>
        <tr>
            <th>ลำดับ</th>
            <th>เลขครุภัณฑ์</th>
            <th>ชื่อครุภัณฑ์</th>
            <th>ประเภทครุภัณ์</th>
            <th>หน่วยงาน</th>
            <th>รายละเอียด</th>
        </tr>
    </tfoot>
</table>
<!-- <span class="badge badge-success ">ปกติ</span>   <button type="button" class="btn btn-info btn-sm view_data" type="button" id='1'><i
                        class="fas fa-edit" data-target="#empModal" data-toggle="modal"></i> รายละเอียด</button>  -->
<script>
$(document).ready(function() {
    $('#example').DataTable();

    $('.view_data').click(function() {

        var userid = $(this).attr('id');

        // AJAX request
        $.ajax({
            url: 'durable/ajaxfileDetail.php',
            type: 'post',
            data: {
                userid: userid
            },
            success: function(response) {
                // Add response in Modal body
                $('.modal-body').html(response);

                // Display Modal
                $('#DurableDetail').modal('show');
            }
        });
    });

    $('.repair').click(function() {

        var userid = $(this).attr('id2');

        // AJAX request
        $.ajax({
            url: 'durable/ajaxfileRepair.php',
            type: 'post',
            data: {
                userid: userid
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>