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
                <img src="../repair/profile/img/profile.png" class="avatar img-circle img-thumbnail" alt="avatar">
                <h6 style="display:none">Upload a different photo...</h6><BR><BR>
                <input type="file" class="text-center center-block file-upload" name="img"><br>
                <input type="submit" value="แก้ไขรูป" name="submit">
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
                    <form class="form" action="../repair/profile/update_profile.php" method="post" id="registrationForm">
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
                                <input type="text" class="form-control" name="phone" id="phone"
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
                                    placeholder="you@email.com" title="enter your email." value="<?=$email?>" >
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
                                    <option value="<?=$arrData3[$sLoop][0]?>" 
                                    <?php
                                     if($arrData3[$sLoop][0]==$OfficeID)
                                     {
                                        echo "selected";
                                     }
                                    ?> ><?=$arrData3[$sLoop][3]?></option>
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
                                <button class="btn btn-lg" type="reset" style="display:none"><i class="glyphicon glyphicon-repeat"></i>
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
                    <form class="form" action="##" method="post" id="registrationForm">
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="first_name">
                                    <h4>First name</h4>
                                </label>
                                <input type="text" class="form-control" name="first_name" id="first_name"
                                    placeholder="first name" title="enter your first name if any.">
                            </div>
                        </div>
                        <div class="form-group">

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
                                    <h4>Phone</h4>
                                </label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                    placeholder="enter phone" title="enter your phone number if any.">
                            </div>
                        </div>

                        <div class="form-group">
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
                                    <h4>Email</h4>
                                </label>
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="you@email.com" title="enter your email.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="email">
                                    <h4>Location</h4>
                                </label>
                                <input type="email" class="form-control" id="location" placeholder="somewhere"
                                    title="enter a location">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="password">
                                    <h4>Password</h4>
                                </label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="password" title="enter your password.">
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
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
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i>
                                    Reset</button>
                            </div>
                        </div>
                    </form>

                </div>
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->