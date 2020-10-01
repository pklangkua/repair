<?php
ob_start();
require_once("master/function_mssql.php");
require_once("master/function.php");
$conn2 = new connectDB;
$sSql = "SELECT * from r_device where d_user ='$user'";
//echo $sSql;
$arrData = $conn2->return_sql($sSql);
$recCount = $conn2->record_count($sSql);
    /*if($recCount>0)
    {
        for ($sLoop=0;$sLoop<$recCount;$sLoop++)
            {
                $HardwareID = $arrData[$sLoop][1]; 
            }
    }
    
        $stmt = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,
        dbo.Office.OfficeName
        FROM
        dbo.Hardware AS h
        INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
        INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
        INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID WHERE h.HardwareID = '$HardwareID'  ";
        $query = sqlsrv_query( $conn, $stmt);
        $i=1;*/
    //}
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<!--
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script> -->

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

<form method="post" action="history-repair/insert_repair.php"   name="frmRepair">

    <div id="DurableRepair" class="modal modal-child fade  bd-example-modal-lg" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="DurableRepair">แจ้งซ่อม </h4>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="Save" >
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>

<table id="durable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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

    <?php if($recCount>0)
    {
        for ($sLoop=0;$sLoop<$recCount;$sLoop++)
            {
                $HardwareID = $arrData[$sLoop][1]; 
            
    
        $stmt = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,
        dbo.Office.OfficeName
        FROM
        dbo.Hardware AS h
        INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
        INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
        INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID WHERE h.HardwareID = '$HardwareID'  ";
        //echo $stmt;
        $query = sqlsrv_query( $conn, $stmt);
        $i=1;
    ?>
        <?php while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){  ?>
        <tr>
            <td><?=$i?></td>
            <td><?=$result['HardwareCode']?></td>
            <td><?=$result['HardwareName']?></td>
            <td><?=$result['HardwareTypeGroupName']?></td>
            <td><?=$result['OfficeName']?></td>
            <td>

                <button type="button" class="btn btn-info btn-sm view_data" id='<?=$result['HardwareID']?>' data-target="#DurableDetail"
                    data-toggle="modal"><i class="fas fa-edit"></i> รายละเอียด</button>
                <button type="button" class="btn btn-danger btn-sm repair" data-target="#DurableRepair"
                    data-toggle="modal" 
                    id2=<?=$user?>
                    hname='<?=$result['HardwareName']?>' 
                    OfficeID='<?=$result['OfficeID']?>' 
                    HardwareCode='<?=$result['HardwareCode']?>'
                    Officename='<?=$result['OfficeName']?>'
                    HardwareID='<?=$result['HardwareID']?>'> 
                    <i class="fas fa-edit"></i> แจ้งซ่อม</button>
            </td>
        </tr>
        <?php $i++; }}}?>
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
    $('#durable').DataTable();

    //$('.view_data').click(function() {
    $("body").on("click", ".view_data", function(event) {
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

    //$('.repair').click(function() {
    $("body").on("click", ".repair", function(event) {
        var userid = $(this).attr('id2');
        var hname = $(this).attr('hname');
        var Officename = $(this).attr('Officename');
        var HardwareCode = $(this).attr('HardwareCode');
        var OfficeID = $(this).attr('OfficeID');
        var HardwareID = $(this).attr('HardwareID');

        // AJAX request
        $.ajax({
            url: 'durable/ajaxfileRepair.php',
            type: 'post',
            data: {
                userid: userid,
                hname: hname,
                Officename: Officename,
                HardwareCode: HardwareCode,
                OfficeID: OfficeID,
                HardwareID:HardwareID
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