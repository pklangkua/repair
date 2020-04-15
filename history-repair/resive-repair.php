<?php
//echo $_POST["email"];
?>

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
                                <label for="comment" class="mr-sm-2"> พัสดุ </label>
                                <input  type="text" class="form-control mr-sm-2" name="email"
                                    placeholder="ค้นหาพัสดุโดย พัสดุ, หมายเลขเครื่อง/เลขทะเบียน">
                                <br><label class="mr-sm-2">เลขทะเบียน </label>
                                <input  type="password" class="form-control" name="password"
                                    placeholder="เลขทะเบียน">
                            </div>
                            <div class="form-group">
                                <br>
                                <label for="comment">รายละเอียดการซ่อม/ปัญหา</label>
                                <textarea class="form-control" rows="5" id="comment"></textarea>
                            </div>
                            <div class="form-group">
                                <br><label class="mr-sm-2">หมายเหตุ </label>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input  type="password" class="form-control" name="password"
                                    placeholder="คำอธิบายหรือหมายเหตุเพิ่มเติม">
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                </div>
                                <div class="col-sm-2">
                                <button type="submit" class="btn btn-success">บันทึกข้อมูล</button>
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