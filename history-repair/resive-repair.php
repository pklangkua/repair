<?php
ob_start();
$UserID = $_SESSION['user'];
require_once("master/function_mssql.php");
$user = $_SESSION['user'];
$query = "SELECT * FROM HardwareTypeGroup";
        $result = sqlsrv_query( $conn,$query);
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="test/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$(document).ready(function() {

    $('#autocomplete').keypress(function() {
        /* alert('The option with value ' + $(this).val() + ' and text ' + $(this).text() +
             ' was selected.');*/
        $('#selectuser_id').val('');
        $('#office').val('');
    });
    $('#autocomplete').keyup(function(e) {
        if(e.keyCode == 46||e.keyCode == 8||e.keyCode == 32) {
        $('#autocomplete').val('');
        $('#selectuser_id').val('');
        $('#office').val('');
        }
    });

    $("#autocomplete").autocomplete({
        //source: availableTags

        source: function(request, response) {

            $.ajax({
                url: "history-repair/fetchData.php",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function(data) {
                    // response(data)
                    response($.map(data, function(item) {
                        //var code = item.split("|");
                        return {
                            label: item.label + ' :: ' + item.value,
                            label2: item.label,
                            value2: item.value,
                            office: item.office,
                            officeID: item.officeID,
                            HardwareID: item.HardwareID
                        }
                    }));

                }
            });
        },
        select: function(event, ui) {
            $('#autocomplete').val(ui.item.label2) //display the selected text
            $('#selectuser_id').val(ui.item.value2); // save selected id to input
            $('#office').val(ui.item.office); //
            $('#officeID').val(ui.item.officeID); //HardwareID
            $('#HardwareID').val(ui.item.HardwareID); //HardwareID
            return false;
        }


    });
});
</script>
<script type="text/javascript">
function fncSubmit() {
    if (document.getElementById('comment').value == "") {
        alert('กรุณากรอกข้อมูลให้ถูกต้อง');
        return false;
    } else if (document.getElementById('selectuser_id').value == "") {
        alert('กรุณากรอกข้อมูลเลขทะเบียนให้ถูกต้อง');
        return false;
    }
}
</script>
<form action="history-repair/insert_repair.php" onSubmit="JavaScript:return fncSubmit();" method="post">
    <div class="card border-light mb-3" style="max-width:">
        <div class="card-header">แจ้งซ่อม/เพิ่ม</div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    <div class="card border-light mb-3" style="max-width: 100rem;">
                        <div class="card-header">
                            <h4>รายละเอียดการซ่อม</h4>
                        </div>
                        <div class="card-body ">
                            <form method="post" action="?module=resive-repair">
                                <div class="form-group">
                                    <label for="comment" class="mr-sm-2"> ครุภัณฑ์ </label>
                                    <font color="red"> * กรุณากรอกข้อมูล </font>
                                    <input type="text" class="form-control mr-sm-2 onchange" name="HardwareName"
                                        placeholder="ค้นหาพัสดุโดย ชื่อ,เลขทะเบียน" id="autocomplete">
                                    <br><label class="mr-sm-2">เลขทะเบียน </label>
                                    <font color="red"> * กรุณากรอกข้อมูล </font><font color="green"> (ข้อมูลจากการเลือกครุภัณฑ์) </font>
                                    <input type="text" class="form-control" name="HardwareCode" placeholder="เลขทะเบียน"
                                        id="selectuser_id" readonly>
                                </div>
                                <div class="form-group">
                                    <br>
                                    <label for="comment">หน่วยงาน</label>
                                    <input type="text" class="form-control" name="office" id="office"
                                        placeholder="หน่วยงาน" readonly>
                                    <input type="hidden" class="form-control" name="HardwareID" id="HardwareID">
                                    <input type="hidden" class="form-control" name="officeID" id="officeID">
                                </div>
                                <div class="form-group">
                                    <br>
                                    <label for="comment">รายละเอียดการซ่อม/ปัญหา</label>
                                    <font color="red"> * กรุณากรอกข้อมูล </font>
                                    <textarea class="form-control" rows="5" id="comment" name="detail"></textarea>
                                </div>
                                <div class="form-group">
                                    <br><label class="mr-sm-2">หมายเหตุ </label>
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="text" class="form-control" name="comment"
                                        placeholder="คำอธิบายหรือหมายเหตุเพิ่มเติม">
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="hidden" class="form-control" name="UserID" value="<?=$UserID?>">
                                        <button type="submit" name="save" class="btn btn-success">บันทึกข้อมูล</button>
                                    </div>
                                    <div class="col-sm-5">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
    </div>
</form>
<script type='text/javascript'>
/* $(document).ready(function() {
    $(function() {

    })
}) */
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>