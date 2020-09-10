<?php
ob_start();
require_once("master/function.php");

$conn = new connectDB;

$sql ="SELECT
u.id,u.username,u.email,u.department,u.OfficeID,
u.status_id,u.fullname,u.img,u.phone 
FROM r_user u
WHERE username='$user'";
$arrData = $conn->return_sql($sql);
$recCount = $conn->record_count($sql);
if($recCount>0){
    for ($sLoop=0;$sLoop<$recCount;$sLoop++){
            $id = $arrData[$sLoop][0] ;
            $username = $arrData[$sLoop][1] ;
            $email = $arrData[$sLoop][2] ;
            $department = $arrData[$sLoop][3] ;
            $OfficeID = $arrData[$sLoop][4] ;
            $status_id = $arrData[$sLoop][5] ;
            $fullname = $arrData[$sLoop][6] ;
            $img = $arrData[$sLoop][7] ;
            $phone = $arrData[$sLoop][8] ;
    }
}
//echo $sql;

$sSql3 = "SELECT * from r_office WHERE OrganizationID='1' ";
$arrData3 = $conn->return_sql($sSql3);
$recCount3 = $conn->record_count($sSql3);

?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- Auto complete-->
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">-->
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

    $("#autocomplete").autocomplete({
        //source: availableTags

        source: function(request, response) {

            $.ajax({
                url: "profile/fetchData.php",
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
<hr>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h2><?=$fullname?></h2>
        </div>
        <div class="col-sm-2"><a href="/users" class="pull-right" style="display:none"><img title="profile image"
                    class="img-circle img-responsive"
                    src="http://www.gravatar.com/avatar/28fd20ccec6865e2d5f0e1f4446eb7bf?s=100"></a></div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left http://ssl.gstatic.com/accounts/ui/avatar_2x.png col-->

            <form action="../repair/profile/upload.php" method="post" enctype="multipart/form-data">
                <div class="text-center">
                    <img src="../repair/profile/img/<?php if($img==''){ echo "profile.png"; }else{ echo $img;}?>"
                        class="avatar img-circle img-thumbnail" alt="avatar">
                    <h6 style="display:none">Upload a different photo...</h6><BR><BR>

                    <input type="file" name="fileToUpload" id="fileToUpload"><br>
                    <input type="submit" value="แก้ไขรูป" name="submit">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <!--
                    <input type="file" class="text-center center-block file-upload" name="img"><br>
                    <input type="submit" value="แก้ไขรูป" name="submit">
                -->
                </div>
            </form>
            </hr><br>


            <div class="panel panel-default" style="display:none">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                <div class="panel-body"><a href="http://bootnipets.com">bootnipets.com</a></div>
            </div>


            <ul class="list-group" style="display:none">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
            </ul>

            <div class="panel panel-default" style="display:none">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
                    <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i
                        class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i
                        class="fa fa-google-plus fa-2x"></i>
                </div>
            </div>

        </div>
        <!--/col-3-->
        <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">ข้อมูลส่วนตัว</a></li>
                <li><a data-toggle="tab" href="#messages">อุปกรณ์ของฉัน</a></li>
                <li style="display:none"><a data-toggle="tab" href="#settings">Menu 2</a></li>
            </ul>


            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <hr>
                    <form class="form" action="../repair/profile/update_profile.php" method="post"
                        id="registrationForm">
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="first_name">
                                    <h4>ชื่อ-สกุล</h4>
                                </label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                    placeholder="first name" title="enter your first name if any." readonly
                                    value="<?=$fullname?>">
                            </div>
                        </div>
                        <div class="form-group" style="display:none">

                            <div class="col-xs-6">
                                <label for="last_name">
                                    <h4>Last name</h4>
                                </label>
                                <input type="text" class="form-control" name="last_name" id="last_name"
                                    placeholder="last name" title="enter your last name if any.">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone">
                                    <h4>โทรศัพท์</h4>
                                </label>
                                <input type="number" class="form-control" name="phone" id="phone"
                                    placeholder="enter phone" title="enter your phone number if any."
                                    value="<?=$phone?>">
                            </div>
                        </div>

                        <div class="form-group" style="display:none">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4>Mobile</h4>
                                </label>
                                <input type="text" class="form-control" name="mobile" id="mobile"
                                    placeholder="enter mobile number" title="enter your mobile number if any.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>E-mail</h4>
                                </label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="you@email.com" title="enter your email." value="<?=$email?>">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>หน่วยงาน</h4>
                                </label>
                                <select class="form-control" name="OfficeID">
                                    <?php  
                                                if($recCount3>0)
                                                {
                                                    for ($sLoop=0;$sLoop<$recCount3;$sLoop++)
                                                {
                                                //print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
                                            ?>
                                    <option value="<?=$arrData3[$sLoop][0]?>" <?php
                                     if($arrData3[$sLoop][0]==$OfficeID)
                                     {
                                        echo "selected";
                                     }
                                    ?>><?=$arrData3[$sLoop][3]?></option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6" style="display:none">
                                <label for="password">
                                    <h4>Password</h4>
                                </label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="password" title="enter your password.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6" style="display:none">
                                <label for="password2">
                                    <h4>Verify</h4>
                                </label>
                                <input type="password" class="form-control" name="password2" id="password2"
                                    placeholder="password2" title="enter your password2.">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i
                                        class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <button class="btn btn-lg" type="reset" style="display:none"><i
                                        class="glyphicon glyphicon-repeat"></i>
                                    Reset</button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?=$id?>">
                    </form>

                    <hr>

                </div>
                <!--/tab-pane-->
                <div class="tab-pane" id="messages">

                    <h2></h2>

                    <hr>
                    <form class="form" action="../repair/profile/update_device.php" method="post" id="registrationForm">

                        <div class="form-group">
                            <label for="comment" class="mr-sm-2"> พัสดุ </label>
                            <input type="text" class="form-control mr-sm-2" name="HardwareName"
                                placeholder="ค้นหาพัสดุโดย ชื่อ,เลขทะเบียน" id="autocomplete">
                            <br><label class="mr-sm-2">เลขทะเบียน </label>
                            <input type="text" class="form-control" name="HardwareCode" placeholder="เลขทะเบียน"
                                id="selectuser_id">
                            <input type="hidden" name="HardwareID" id="HardwareID">
                        </div>
                        <div class="col-xs-12">
                            <br>

                            <button class="btn btn-lg btn-success" type="submit"><i
                                    class="glyphicon glyphicon-ok-sign"></i> Save</button>
                            <button class="btn btn-lg" type="reset" style="display:none"><i
                                    class="glyphicon glyphicon-repeat"></i>
                                Reset</button>
                        </div>
                        <input type="hidden" name="id" value="<?=$user?>">

                    </form>
                    <br><br><br><br>
                    <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ลำดับ</th>
                                <th>ชื่อครุภัณฑ์</th>
                                <th>เลขครุภัณฑ์</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $dSql = "SELECT * FROM r_device where d_user='$user'";
                            $arrData_d = $conn->return_sql($dSql);
                            $recCount_d = $conn->record_count($dSql);
                            if($recCount_d>0){
	                            for ($sLoopd=0;$sLoopd<$recCount_d;$sLoopd++){
		//print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
	                        ?>

                            <tr>
                                <td><?=$sLoopd+1?></td>
                                <td><?=$arrData_d[$sLoopd][2]?></td>
                                <td><?=$arrData_d[$sLoopd][3]?></td>
                                <td>
                                    <button style="display:none" type="button" class="btn btn-info "
                                        onclick="window.location.href = '?module=profile&&detailID=<?=$arrData_d[$sLoopd][0]?>';"
                                        title="รายละเอียด">
                                        <!--i class="fas fa-database"--><i class="fas fa-trash-alt"></i>
                                    </button>

                                    <a href="profile/delete.php?id=<?=$arrData_d[$sLoopd][0]?>"
                                        onClick="return confirm('Are you sure you want to delete?')">Delete</a>

                                    <button style="display:none" type="submit" class="btn btn-info ">
                                        <!--i class="fas fa-database"--><i class="fas fa-trash-alt"></i>
                                    </button>
                                    <button style="display:none" type="button" class="btn btn-danger edit "
                                        title="ดำเนินการ" data-toggle="modal" data-target="#myModal"
                                        id="<?=$arrData[$sLoop][0]?>" fname="<?=$arrData[$sLoop][3]?>"><i
                                            class="fas fa-desktop"></i></button>
                                </td>



                            </tr><?php  } }?>
                        </tbody>
                    </table>

                </div>


            </div>
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->
<script type='text/javascript'>
$(document).ready(function() {
    $(function() {

    })
})
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' type='text/javascript'></script>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>