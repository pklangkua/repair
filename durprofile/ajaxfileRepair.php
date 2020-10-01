<?php 
//echo $_POST['userid'],$_POST['hname'],$_POST['Officename'];
$UserID = $_POST['userid'];
$HardwareName = $_POST['hname'];
$HardwareCode = $_POST['HardwareCode'];
$OfficeID = $_POST['OfficeID'];
$Officename= $_POST['Officename'];
$HardwareID= $_POST['HardwareID'];
//echo $userid;
?>

<script type="text/javascript">
function fncSubmit()
{
    if(document.getElementById('comment').value == "")
    {
        alert('PLEASE INPUT DATA');
        return false;
    }
}
</script>
<div class="card border-light mb-3" style="max-width: 100rem;">
    <div class="card-header">
        <h4>รายละเอียดการซ่อม</h4>
    </div>
    <div class="card-body ">
            <div class="form-group">
                <label for="comment" class="mr-sm-2"> พัสดุ </label>
                <input type="text" class="form-control mr-sm-2" name="HardwareName" value='<?=$HardwareName?>' readonly >
                
                <br><label class="mr-sm-2">เลขทะเบียน </label>
                <input type="text" class="form-control" name="HardwareCode" value='<?=$HardwareCode?>' >
            </div>
            <div class="form-group">
                <label for="comment">หน่วยงาน</label>
                <input type="text" class="form-control" name="office" value='<?=$Officename?>' >
                
            </div>
            <div class="form-group">
                <br>
                <label for="comment">รายละเอียดการซ่อม/ปัญหา</label>
                <textarea class="form-control" rows="5" name="detail" ></textarea>
            </div>
            <div class="form-group">
                <br><label class="mr-sm-2">หมายเหตุ </label>
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="text" class="form-control" name="comment" placeholder="คำอธิบายหรือหมายเหตุเพิ่มเติม">
            </div>
            
            <div class="row">
                <div class="col-sm-5">
                <input type="hidden" class="form-control" name="officeID" value='<?=$OfficeID?>'>
                <input type="hidden" class="form-control" name="HardwareID" value='<?=$HardwareID?>' >
                <input type="hidden" class="form-control" name="UserID" value='<?=$UserID?>' >
                </div>
                <div class="col-sm-2">
                </div>
                <div class="col-sm-5">
                </div>
            </div>
    </div>
</div>