<?php
ob_start();
require_once("../../master/function.php");

$conn = new connectDB;

$sSql = "SELECT r_user.id,r_user.fullname,r_user.lastvisit_login,r_user.create_date,
r_user.active,r_user.status_id,r_status.`status`from r_user LEFT JOIN r_status on r_status.id = r_user.status_id";
$arrData = $conn->return_sql($sSql);
$recCount = $conn->record_count($sSql);

$sSql2 = "SELECT * from r_status ";
$arrData2 = $conn->return_sql($sSql2);
$recCount2 = $conn->record_count($sSql2);

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
            <th>ID</th>
            <th>ชื่อ-นามสกุล</th>
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
            <td><?=$arrData[$sLoop][0]?></td>
            <td><?=$arrData[$sLoop][1]?></td>
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
                <button type="submit" class="btn btn-primary btn-sm update_data" data-toggle="modal" data-target="#myModal" id="<?=$arrData[$sLoop][0]?>">สถานะ</button>
                <input type="button" data-toggle="modal" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-sm edit_data" data-target="#myModal" />
                <button type="button" class="btn btn-danger btn-sm">ลบ</button>
            </td>
        </tr>
        <?php }}?>
    </tbody>
    <tfoot>
        <tr>
            <th>ID</th>
            <th>ชื่อ-นามสกุล</th>
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
    $('.update_data').click(function(){//เมื่อมีการกดปุ่ม view_data
        var uid=$(this).attr("id");//รับค่า id จากปุ่มวิวมาใส่ไว้ใน uid
        $.ajax({
          url:"fetch.php",
          method:"post",
          data:{id:uid},
          dataType:"json",
          success:function(data){
            $('#id').val(data.id);
            $('#fname').val(data.fullname);
            $('#insert').val("Update");//เปลี่ยนข้อมความในปุ่ม insert เป็น Update
            $('#addModal').modal('show');
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