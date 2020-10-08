<?php
/*session_start();

$ID = $_SESSION['ID'];
$member_name = $_SESSION['member_name'];
$level = $_SESSION['level'];

if ($level != 'admin') {
    Header("Location: ./logout.php");
}*/
?>

<?php
$mysqli = new mysqli("localhost", "root", "D#@m20%H", "mhcgoth2_covid");
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
}
?>
<?php
require_once("pagination_function.php");
?>

<?php

function burnOut($burnout)
{
    if ($burnout >= 3) {
        return '<span class="text-danger">เสี่ยง</span>';
    } else {
        return '<span class="text-success">ปกติ</span>';
    }
}

function st_5($data_st5)
{
    if ($data_st5 <= 4) {
        return '<span class="text-success">น้อย</span>';
    } elseif ($data_st5 >= 5 && $data_st5 <= 7) {
        return '<span class="text-primary">ปานกลาง</span>';
    } elseif ($data_st5 >= 8 && $data_st5 <= 9) {
        return '<span class="text-warning">มาก</span>';
    } elseif ($data_st5 >= 10 && $data_st5 <= 15) {
        return '<span class="text-danger">มากที่สุด</span>';
    }
}

function depression($data_depression)
{
    if ($data_depression <= 6) {
        return '<span class="text-success">ไม่มี</span>';
    } elseif ($data_depression >= 7 && $data_depression <= 12) {
        return '<span class="text-primary">เล็กน้อย</span>';
    } elseif ($data_depression >= 13 && $data_depression <= 18) {
        return '<span class="text-warning">ปานกลาง</span>';
    } elseif ($data_depression >= 19) {
        return '<span class="text-danger">รุนแรง</span>';
    }
}

function sucide($data_sucide)
{
    if ($data_sucide == 0) {
        return '<span class="text-success">ไม่มี</span>';
    } elseif ($data_sucide >= 1 && $data_sucide <= 8) {
        return '<span class="text-primary">น้อย</span>';
    } elseif ($data_sucide >= 9 && $data_sucide <= 16) {
        return '<span class="text-warning">ปานกลาง</span>';
    } elseif ($data_sucide >= 17) {
        return '<span class="text-danger">รุนแรง</span>';
    }
}

function agree($data)
{
    if ($data == 0) {
        return '<span class="text-danger"><i class="fas fa-times-circle"></i> ไม่ยินยอม</span>';
    } elseif ($data == 1) {
        return '<span class="text-success"><i class="fas fa-check-circle"></i> ยินยอม</span>';
    }
}

function twoQ($twoQ)
{
    if ($twoQ == 0) {
        return '<span class="text-success">ปกติ</span>';
    } else {
        return '<span class="text-danger">เสี่ยง</span>';
    }
}
?>

<?php
$dayTH = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];
$monthTH = [null, 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
$monthTH_brev = [null, 'ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];

function thai_date_and_time($time)
{   // 19 ธันวาคม 2556 เวลา 10:10:43
    global $dayTH, $monthTH_brev;
    $thai_date_return = date("j", $time);
    $thai_date_return .= " " . $monthTH_brev[date("n", $time)];
    $thai_date_return .= " " . (date("Y", $time) + 543);
    $thai_date_return .= " " . date("H:i:s", $time);
    return $thai_date_return;
}
function thai_date_short($time)
{   // 19  ธ.ค. 2556a
    global $dayTH, $monthTH_brev;
    $thai_date_return = date("j", $time);
    $thai_date_return .= " " . $monthTH_brev[date("n", $time)];
    $thai_date_return .= " " . (date("Y", $time) + 543);
    return $thai_date_return;
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./dist/css/bootstrap.min.css">

    <title>MENTAL HEALTH CHECK IN ตรวจเช็คสุขภาพใจ</title>

    <link rel="shortcut icon" href="../assets/images/favicon.ico">
    <link href="../assets/fonts/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Datepicker -->
    <!-- <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script> -->
    <!-- <link rel="stylesheet" href="jqueryui/style.css"> -->
    <link rel="stylesheet" href="datatable/jquery.dataTables.min.css">
    <link rel="stylesheet" href="datatable/buttons.dataTables.min.css">


    <script src="datatable/jquery-3.5.1.js"></script>
    <script src="datatable/jquery.dataTables.min.js"></script>
    <script src="datatable/dataTables.buttons.min.js"></script>
    <script src="datatable/buttons.flash.min.js"></script>
    <script src="datatable/jszip.min.js"></script>
    <script src="datatable/pdfmake.min.js"></script>
    <script src="datatable/vfs_fonts.js"></script>
    <script src="datatable/buttons.html5.min.js"></script>
    <script src="datatable/buttons.print.min.js"></script>

    <script>
    $(function() {
        $("#datestart").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"], //กำหนดชื่อย่อของวัน เป็น ภาษาไทย
            monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ]
        });
    });
    </script>
    <script>
    $(function() {
        $("#dateend").datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            dayNamesMin: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"], //กำหนดชื่อย่อของวัน เป็น ภาษาไทย
            monthNamesShort: ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
            ]
        });
    });
    </script>

</head>

<body>
    <nav class="navbar navbar-expand navbar-dark sticky-top" style="background-color:#900C3F; opacity:0.8;">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/images/logo-black-new.png" width="129">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02"
                aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample02">
                <ul class="navbar-nav mr-auto">
                    <!--                    <li class="nav-item active">
                                                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Link</a>
                                            </li>-->
                </ul>
                <a class="text-light"
                    href="https://datastudio.google.com/reporting/96e977d9-0c24-4bd4-bf21-2c140f932d7e"
                    target="_blank">Dashboard</a> &nbsp;&nbsp;&nbsp;&nbsp;
                <a class="text-light" href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a>
                <!--                <form class="form-inline my-2 my-md-0">
                                        <input class="form-control" type="text" placeholder="Search">
                                    </form>-->
            </div>
        </div>

    </nav>



    <div class="container-fluid">
        <br>
        <p class="text-center h5 text-info mb-3">ยินดีต้อนรับ : <?php echo $member_name; ?> [<?php echo $level; ?>]</p>
        <iframe width="100%" height="572px"
            src="https://datastudio.google.com/embed/reporting/96e977d9-0c24-4bd4-bf21-2c140f932d7e/page/FkgUB"
            frameborder="0" style="border:0" allowfullscreen></iframe>

        <div class="container">

            <h5 class="text-primary mb-3" href="index.php"><i class="fas fa-search"></i> รายงานตรวจเช็คสุขภาพใจ <i
                    class="fas fa-heartbeat"></i></h5>
            <form name="form1" method="GET" action="">
                <div class="border rounded shadow-sm p-3 mb-3">


                    <div class=" form-group row mb-0">
                        <label for="myselect" class="col-sm-2 col-form-label pt-0">เขตสุขภาพ : </label>
                        <div class="col-sm-4 mb-3">
                            <select class="custom-select custom-select-sm" name="reg_id" id="region"
                                onchange="this.form.submit();">
                                <option value="">เลือกเขตสุขภาพ</option>
                                <option value="1"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "1") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 1</option>
                                <option value="2"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "2") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 2</option>
                                <option value="3"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "3") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 3</option>
                                <option value="4"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "4") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 4</option>
                                <option value="5"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "5") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 5</option>
                                <option value="6"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "6") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 6</option>
                                <option value="7"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "7") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 7</option>
                                <option value="8"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "8") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 8</option>
                                <option value="9"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "9") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 9</option>
                                <option value="10"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "10") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 10</option>
                                <option value="11"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "11") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 11</option>
                                <option value="12"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "12") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 12</option>
                                <option value="13"
                                    <?= (isset($_GET['reg_id']) && $_GET['reg_id'] == "13") ? " selected" : "" ?>>
                                    เขตสุขภาพที่ 13</option>
                            </select>
                        </div>
                        <?php
                        $dataProvince = array(
                            'host' => 'localhost',
                            'user' => 'root',
                            'password' => 'D#@m20%H',
                            'dbname' => 'mhcgoth2_covid'
                        );
                        $connProvince = mysqli_connect($dataProvince['host'], $dataProvince['user'], $dataProvince['password'], $dataProvince['dbname']) or die('Error connection database!');
                        mysqli_set_charset($connProvince, 'utf8');

                        $sqProvince = "SELECT * FROM provinces WHERE Reg_id={$_GET['reg_id']} ORDER BY name_th";
                        $queryProvince = mysqli_query($connProvince, $sqProvince);
                        ?>
                        <label for="myselect" class="col-sm-2 col-form-label pt-0">จังหวัด : </label>
                        <div class="col-sm-4">
                            <select name="province_id" class="custom-select custom-select-sm" id="province">
                                <option value="">เลือกจังหวัด</option>
                                <?php while ($resultProvince = mysqli_fetch_array($queryProvince)) : ?>
                                <option value="<?php echo $resultProvince['id']; ?>">
                                    <?php echo $resultProvince['name_th']; ?></option>
                                <?php endwhile;
                                mysqli_close($connProvince);
                                ?>
                            </select>
                        </div>
                        </lable>
                    </div>
                </div>

                <div class="border rounded shadow-sm p-3 mb-3">

                    <fieldset class="form-group mb-0">
                        <div class="row">
                            <legend class="col-form-label col-sm-2 pt-0">เพศ : </legend>
                            <div class="col-sm-4 mb-3">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="gender1" name="gender" value="ชาย"
                                        <?= (isset($_GET['gender']) && $_GET['gender'] == "ชาย") ? " checked" : "" ?>
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="gender1">ชาย</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline margin_top_5">
                                    <input type="radio" id="gender2" name="gender" value="หญิง"
                                        <?= (isset($_GET['gender']) && $_GET['gender'] == "หญิง") ? " checked" : "" ?>
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="gender2">หญิง</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline margin_top_5">
                                    <input type="radio" id="gender3" name="gender" value=""
                                        <?= (isset($_GET['gender']) && $_GET['gender'] == "") ? " checked" : "" ?>
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="gender3">ทุกเพศ</label>
                                </div>
                            </div>

                            <label for="agree" class="col-sm-2 col-form-label pt-0">ยินยอมให้ข้อมูล : </label>
                            <div class="col-sm-4">
                                <div class="custom-control custom-control-inline">
                                    <input class="form-check-input" type="checkbox" id="agree" name="agree" value="1"
                                        <?= (isset($_GET['agree']) && $_GET['agree'] == "1") ? " checked" : "" ?>
                                        class="form-check-input">
                                    <label class="form-check-label text-success" for="agree"> ยินยอม</label>
                                </div>
                                <div class="custom-control custom-control-inline">
                                    <input class="form-check-input" type="checkbox" id="disagree" name="disagree"
                                        value="0"
                                        <?= (isset($_GET['disagree']) && $_GET['disagree'] == "0") ? " checked" : "" ?>
                                        class="form-check-input">
                                    <label class="form-check-label text-danger" for="disagree"> ไม่ยินยอม</label>
                                </div>
                            </div>

                        </div>
                    </fieldset>
                </div>

                <div class="border rounded shadow-sm p-3 mb-3">
                    <div class="form-group row mb-0">
                        <label for="burnout1" class="col-sm-2 col-form-label pt-0">Burnout : </label>
                        <div class="col-sm-4 mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="burnout1" name="burnout1" value="2"
                                    <?= (isset($_GET['burnout1']) && $_GET['burnout1'] == "2") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label text-success" for="burnout1"> ปกติ</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="burnout2" name="burnout2" value="3"
                                    <?= (isset($_GET['burnout2']) && $_GET['burnout2'] == "3") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label text-danger" for="burnout2"> เสี่ยง</label>
                            </div>
                        </div>

                        <label for="chk1" class="col-sm-2 col-form-label pt-0">ST-5 : </label>
                        <div class="col-sm-4 mb-3">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="chk1" name="chk1" value="4"
                                    <?= (isset($_GET['chk1']) && $_GET['chk1'] == "4") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label text-success" for="chk1"> น้อย</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="chk2" name="chk2" value="5"
                                    <?= (isset($_GET['chk2']) && $_GET['chk2'] == "5") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label text-primary" for="chk2"> ปานกลาง</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="chk3" name="chk3" value="8"
                                    <?= (isset($_GET['chk3']) && $_GET['chk3'] == "8") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label text-warning" for="chk3"> มาก</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="chk4" name="chk4" value="10"
                                    <?= (isset($_GET['chk4']) && $_GET['chk4'] == "10") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-danger" for="chk4"> มากที่สุด</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <label for="9qchk1" class="col-sm-2 col-form-label pt-0">9Q : </label>
                        <div class="col-sm-4 mb-3">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="9qchk1" name="9qchk1" value="6"
                                    <?= (isset($_GET['9qchk1']) && $_GET['9qchk1'] == "6") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-success" for="9qchk1"> ไม่มี</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="9qchk2" name="9qchk2" value="7"
                                    <?= (isset($_GET['9qchk2']) && $_GET['9qchk2'] == "7") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-primary" for="9qchk2"> เล็กน้อย</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="9qchk3" name="9qchk3" value="13"
                                    <?= (isset($_GET['9qchk3']) && $_GET['9qchk3'] == "13") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label text-warning" for="9qchk3"> ปานกลาง</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="9qchk4" name="9qchk4" value="19"
                                    <?= (isset($_GET['9qchk4']) && $_GET['9qchk4'] == "19") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-danger" for="9qchk4"> รุนแรง</label>
                            </div>
                        </div>

                        <label for="8qchk1" class="col-sm-2 col-form-label ">8Q : </label>
                        <div class="col-sm-4">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="8qchk1" name="8qchk1" value="0"
                                    <?= (isset($_GET['8qchk1']) && $_GET['8qchk1'] == "0") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-success" for="8qchk1"> ไม่มี</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="8qchk2" name="8qchk2" value="1"
                                    <?= (isset($_GET['8qchk2']) && $_GET['8qchk2'] == "1") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-primary" for="8qchk2"> น้อย</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="8qchk3" name="8qchk3" value="9"
                                    <?= (isset($_GET['8qchk3']) && $_GET['8qchk3'] == "9") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-warning" for="8qchk3"> ปานกลาง</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" id="8qchk4" name="8qchk4" value="17"
                                    <?= (isset($_GET['8qchk4']) && $_GET['8qchk4'] == "17") ? " checked" : "" ?>
                                    class="form-check-input">
                                <label class="form-check-label  text-danger" for="8qchk4"> รุนแรง</label>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="border rounded shadow-sm p-3 mb-3">
                    <div class="form-group row mb-0">
                        <label for="" class="col-sm-2 col-form-label pt-0">
                            จากวันที่ :
                        </label>
                        <div class="col-sm-4 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                                <input type="text" id="datestart" name="datestart" class="form-control"
                                    onchange="getdate(this.value);">

                            </div>
                        </div>
                        <label for="" class="col-sm-2 col-form-label pt-0">
                            ถึงวันที่ :
                        </label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>

                                <input type="text" id="dateend" name="dateend" class="form-control">

                            </div>
                        </div>
                    </div>
                </div>

                <script>
                function getdate(dateStart) {
                    document.getElementById("dateend").value = dateStart;
                }
                </script>

                <?php

                //กำหนดเวลาสุดท้ายของวัน 

                $_GET['dateend'] = $_GET['dateend'] . " " . '23.59.59';

                ?>

                <div class="form-group row ">
                    <div class="col-sm-12 text-center">
                        <button type="submit" class="btn btn-md btn-primary" name="btn_search" id="btn_search"><i
                                class="fas fa-search"></i> ค้นหา</button>
                        &nbsp;
                        <a href="index.php" class="btn btn-md btn-danger"><i class="far fa-times-circle"></i>
                            ล้างค่า</a>
                        <p class="text-monospace mt-2" id="countRow_id"></p>
                        <?php
                        $url = "exportExcel.php?" . $_SERVER['QUERY_STRING'];
                        $rulCsv = "exportCsv.php?" . $_SERVER['QUERY_STRING'];
                        ?>
                        <hr>
                        <span class="text-danger">Export to
                            <!--<i class="fas fa-angle-double-right"></i>-->
                        </span>&nbsp;
                        <a href="<?= $rulCsv; ?>" class="btn btn-md btn-outline-success">EXCEL <i
                                class="fas fa-file-excel"></i></a>
                        <!-- <a href=" <?//=$rulCsv; ?>" class="btn btn-md btn-outline-primary">CSV <i
                                    class="fas fa-file-csv"></i></a> -->

                    </div>
                </div>
            </form>
        </div>
        <?php 
                $num = 0;
                $sql = "
SELECT data.id AS id,gender,age,q1,Reg_Name,agree,data_create,name_amphure,name_province,
(q2+q3+q4+q5+q6) AS st_5,
(_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) AS depression,
(_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) AS sucide,
(q7+q8) AS twoQ
FROM data
LEFT JOIN provinces ON data.province_id = provinces.id 
LEFT JOIN region ON region.Reg_id = provinces.Reg_id
WHERE 1 limit 10000
";

                //////////////////// MORE QUERY 
                // เงื่อนไขสำหรับ  
                if (isset($_GET['gender']) && $_GET['gender'] != "") {
                    // ต่อคำสั่ง sql 
                    $sql .= " AND gender = '" . trim($_GET['gender']) . "' ";
                }

                // เงื่อนไขสำหรับ input text
                //                        if (isset($_GET['keyword']) && $_GET['keyword'] != "") {
                //                            // ต่อคำสั่ง sql 
                //                            $sql .= " AND province_name LIKE '%" . trim($_GET['keyword']) . "%' ";
                //                        }
                // เงื่อนไขสำหรับ เขตสุขภาพ
                if (isset($_GET['reg_id']) && $_GET['reg_id'] != "") {
                    // ต่อคำสั่ง sql 
                    $sql .= " AND provinces.Reg_id = '" . trim($_GET['reg_id']) . "' ";
                }
                // เงื่อนไขสำหรับ จังหวัด
                if (isset($_GET['province_id']) && $_GET['province_id'] != "") {
                    // ต่อคำสั่ง sql 
                    $sql .= " AND provinces.id = '" . trim($_GET['province_id']) . "' ";
                }


                // เงื่อนไขสำหรับ ค้นหาจากระหว่างวันที่ หน้า-หลัง ไม่ว่าง
                if (
                    (isset($_GET['datestart']) && $_GET['datestart'] != "") &&
                    (isset($_GET['dateend']) && $_GET['dateend'] != "")
                ) {
                    $sql .= " AND data_create BETWEEN '" . ($_GET['datestart']) . "' AND '" . ($_GET['dateend']) . "'  ";
                }

                // เงื่อนไขสำหรับ burnout
                if (
                    (isset($_GET['burnout1']) && $_GET['burnout1'] != "") ||
                    (isset($_GET['burnout2']) && $_GET['burnout2'] != "")
                ) {
                    // ต่อคำสั่ง sql 
                    if ($_GET['burnout1'] != "" && $_GET['burnout2'] != "") {
                        $sql .= " 
         AND (q1 <= '" . ($_GET['burnout1']) . "'
         OR q1 >= '" . ($_GET['burnout2']) . "' )
         ";
                    } elseif ($_GET['burnout1'] != "") {
                        $sql .= " AND q1 <= '" . ($_GET['burnout1']) . "' ";
                    } elseif ($_GET['burnout2'] != "") {
                        $sql .= " AND q1  >= '" . trim($_GET['burnout2']) . "' ";
                    }
                }

                // เงื่อนไขสำหรับ ST-5
                if (
                    (isset($_GET['chk1']) && $_GET['chk1'] != "") ||
                    (isset($_GET['chk2']) && $_GET['chk2'] != "") ||
                    (isset($_GET['chk3']) && $_GET['chk3'] != "") ||
                    (isset($_GET['chk4']) && $_GET['chk4'] != "")
                ) {

                    //=============== 1
                    //1234              
                    if ($_GET['chk1'] != "" && $_GET['chk2'] != "" && $_GET['chk3'] != "" && $_GET['chk4'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) <='" . ($_GET['chk1']) . "'
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk2']) . "' AND 7
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "' AND 9
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk4']) . "' AND 15
                                ) ";
                    }
                    //123
                    elseif ($_GET['chk1'] != "" && $_GET['chk2'] != "" && $_GET['chk3'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) <='" . ($_GET['chk1']) . "'
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk2']) . "' AND 7
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "' AND 9
                                ) ";
                    }
                    //124
                    elseif ($_GET['chk1'] != "" && $_GET['chk2'] != "" && $_GET['chk4'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) <='" . ($_GET['chk1']) . "'
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk2']) . "' AND 7
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk4']) . "' AND 15
                                ) ";
                    }
                    //134
                    elseif ($_GET['chk1'] != "" && $_GET['chk3'] != "" && $_GET['chk4'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) <='" . ($_GET['chk1']) . "'
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "' AND 9
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk4']) . "' AND 15
                                ) ";
                    }
                    //234              
                    elseif ($_GET['chk2'] != "" && $_GET['chk3'] != "" && $_GET['chk4'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk2']) . "' AND 7
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "' AND 9
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk4']) . "' AND 15
                                ) ";
                    }
                    //12                    
                    elseif ($_GET['chk1'] != "" && $_GET['chk2'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) <='" . ($_GET['chk1']) . "'
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk2']) . "' AND 7
                                ) ";
                    }
                    //13            
                    elseif ($_GET['chk1'] != "" && $_GET['chk3'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) <='" . ($_GET['chk1']) . "'
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "' AND 9
                                ) ";
                    }
                    //14           
                    elseif ($_GET['chk1'] != "" && $_GET['chk4'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) <='" . ($_GET['chk1']) . "'
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk4']) . "' AND 15
                                ) ";
                    }
                    //23         
                    elseif ($_GET['chk2'] != "" && $_GET['chk3'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk2']) . "' AND 7
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "' AND 9
                                ) ";
                    }
                    //34         
                    elseif ($_GET['chk3'] != "" && $_GET['chk4'] != "") {
                        $sql .= " 
                            AND (
                            (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "' AND 9
                            OR (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk4']) . "' AND 15
                                ) ";
                    } elseif ($_GET['chk1'] != "") {
                        $sql .= " AND (q2+q3+q4+q5+q6) <= '" . ($_GET['chk1']) . "' ";
                    } elseif ($_GET['chk2'] != "") {
                        $sql .= " AND (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk2']) . "'AND 7 ";
                    } elseif ($_GET['chk3'] != "") {
                        $sql .= " AND (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk3']) . "'AND 9 ";
                    } elseif ($_GET['chk4'] != "") {
                        $sql .= " AND (q2+q3+q4+q5+q6) BETWEEN '" . ($_GET['chk4']) . "'AND 15 ";
                    }
                }

                // เงื่อนไขสำหรับ 9Q
                if (
                    (isset($_GET['9qchk1']) && $_GET['9qchk1'] != "") ||
                    (isset($_GET['9qchk2']) && $_GET['9qchk2'] != "") ||
                    (isset($_GET['9qchk3']) && $_GET['9qchk3'] != "") ||
                    (isset($_GET['9qchk4']) && $_GET['9qchk4'] != "")
                ) {

                    //=============== 1
                    //1234              
                    if ($_GET['9qchk1'] != "" && $_GET['9qchk2'] != "" && $_GET['9qchk3'] != "" && $_GET['9qchk4'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <='" . ($_GET['9qchk1']) . "'
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "' AND 12
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "' AND 18
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >= '" . ($_GET['9qchk4']) . "' 
                                ) ";
                    }
                    //123
                    elseif ($_GET['9qchk1'] != "" && $_GET['9qchk2'] != "" && $_GET['9qchk3'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <='" . ($_GET['9qchk1']) . "'
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "' AND 12
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "' AND 18
                                ) ";
                    }
                    //124
                    elseif ($_GET['9qchk1'] != "" && $_GET['9qchk2'] != "" && $_GET['9qchk4'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <='" . ($_GET['9qchk1']) . "'
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "' AND 12
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >= '" . ($_GET['9qchk4']) . "' 
                                ) ";
                    }
                    //134
                    elseif ($_GET['9qchk1'] != "" && $_GET['9qchk3'] != "" && $_GET['9qchk4'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <='" . ($_GET['9qchk1']) . "'
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "' AND 18
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >= '" . ($_GET['9qchk4']) . "' 
                                ) ";
                    }
                    //234              
                    elseif ($_GET['9qchk2'] != "" && $_GET['9qchk3'] != "" && $_GET['9qchk4'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "' AND 12
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "' AND 18
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >= '" . ($_GET['9qchk4']) . "' 
                                ) ";
                    }
                    //12                    
                    elseif ($_GET['9qchk1'] != "" && $_GET['9qchk2'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <='" . ($_GET['9qchk1']) . "'
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "' AND 12
                                ) ";
                    }
                    //13            
                    elseif ($_GET['9qchk1'] != "" && $_GET['9qchk3'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <='" . ($_GET['9qchk1']) . "'
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "' AND 18
                                ) ";
                    }
                    //14           
                    elseif ($_GET['9qchk1'] != "" && $_GET['9qchk4'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <='" . ($_GET['9qchk1']) . "'
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >= '" . ($_GET['9qchk4']) . "' 
                                ) ";
                    }
                    //23         
                    elseif ($_GET['9qchk2'] != "" && $_GET['9qchk3'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "' AND 12
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "' AND 18
                                ) ";
                    }
                    //24
                    elseif ($_GET['9qchk2'] != "" && $_GET['9qchk4'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "' AND 12
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >= '" . ($_GET['9qchk4']) . "' 
                                ) ";
                    }
                    //34         
                    elseif ($_GET['9qchk3'] != "" && $_GET['9qchk4'] != "") {
                        $sql .= " 
                            AND (
                            (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "' AND 18
                            OR (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >= '" . ($_GET['9qchk4']) . "' 
                                ) ";
                    } elseif ($_GET['9qchk1'] != "") {
                        $sql .= " AND (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) <= '" . ($_GET['9qchk1']) . "' ";
                    } elseif ($_GET['9qchk2'] != "") {
                        $sql .= " AND (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk2']) . "'AND 12 ";
                    } elseif ($_GET['9qchk3'] != "") {
                        $sql .= " AND (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) BETWEEN '" . ($_GET['9qchk3']) . "'AND 18 ";
                    } elseif ($_GET['9qchk4'] != "") {
                        $sql .= " AND (_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) >='" . ($_GET['9qchk4']) . "' ";
                    }
                }


                // เงื่อนไขสำหรับ 8Q
                if (
                    (isset($_GET['8qchk1']) && $_GET['8qchk1'] != "") ||
                    (isset($_GET['8qchk2']) && $_GET['8qchk2'] != "") ||
                    (isset($_GET['8qchk3']) && $_GET['8qchk3'] != "") ||
                    (isset($_GET['8qchk4']) && $_GET['8qchk4'] != "")
                ) {

                    //=============== 1
                    //1234              
                    if ($_GET['8qchk1'] != "" && $_GET['8qchk2'] != "" && $_GET['8qchk3'] != "" && $_GET['8qchk4'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) ='" . ($_GET['8qchk1']) . "'
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "' AND 8
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "' AND 16
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >= '" . ($_GET['8qchk4']) . "' 
                            ) ";
                    }
                    //123
                    elseif ($_GET['8qchk1'] != "" && $_GET['8qchk2'] != "" && $_GET['8qchk3'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) ='" . ($_GET['8qchk1']) . "'
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "' AND 8
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "' AND 16
                            ) ";
                    }
                    //124
                    elseif ($_GET['8qchk1'] != "" && $_GET['8qchk2'] != "" && $_GET['8qchk4'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) ='" . ($_GET['8qchk1']) . "'
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "' AND 8
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >= '" . ($_GET['8qchk4']) . "' 
                            ) ";
                    }
                    //134
                    elseif ($_GET['8qchk1'] != "" && $_GET['8qchk3'] != "" && $_GET['8qchk4'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) ='" . ($_GET['8qchk1']) . "'
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "' AND 16
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >= '" . ($_GET['8qchk4']) . "' 
                            ) ";
                    }
                    //234              
                    elseif ($_GET['8qchk2'] != "" && $_GET['8qchk3'] != "" && $_GET['8qchk4'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "' AND 8
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "' AND 16
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >= '" . ($_GET['8qchk4']) . "' 
                            ) ";
                    }
                    //12                    
                    elseif ($_GET['8qchk1'] != "" && $_GET['8qchk2'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) ='" . ($_GET['8qchk1']) . "'
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "' AND 8
                            ) ";
                    }
                    //13            
                    elseif ($_GET['8qchk1'] != "" && $_GET['8qchk3'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) ='" . ($_GET['8qchk1']) . "'
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "' AND 16
                            ) ";
                    }
                    //14           
                    elseif ($_GET['8qchk1'] != "" && $_GET['8qchk4'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) ='" . ($_GET['8qchk1']) . "'
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >= '" . ($_GET['8qchk4']) . "' 
                            ) ";
                    }
                    //23         
                    elseif ($_GET['8qchk2'] != "" && $_GET['8qchk3'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "' AND 8
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "' AND 16
                            ) ";
                    }
                    //24       
                    elseif ($_GET['8qchk2'] != "" && $_GET['8qchk4'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "' AND 8
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >= '" . ($_GET['8qchk4']) . "' 
                            ) ";
                    }
                    //34         
                    elseif ($_GET['8qchk3'] != "" && $_GET['8qchk4'] != "") {
                        $sql .= " 
                        AND (
                        (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "' AND 16
                        OR (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >= '" . ($_GET['8qchk4']) . "' 
                            ) ";
                    } elseif ($_GET['8qchk1'] != "") {
                        $sql .= " AND (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) = '" . ($_GET['8qchk1']) . "' ";
                    } elseif ($_GET['8qchk2'] != "") {
                        $sql .= " AND (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk2']) . "'AND 8 ";
                    } elseif ($_GET['8qchk3'] != "") {
                        $sql .= " AND (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) BETWEEN '" . ($_GET['8qchk3']) . "'AND 16 ";
                    } elseif ($_GET['8qchk4'] != "") {
                        $sql .= " AND (_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) >='" . ($_GET['8qchk4']) . "' ";
                    }
                }
                // เงื่อนไขสำหรับการยินยอม
                if (
                    (isset($_GET['agree']) && $_GET['agree'] != "") ||
                    (isset($_GET['disagree']) && $_GET['disagree'] != "")
                ) {
                    // ต่อคำสั่ง sql 
                    if ($_GET['agree'] != "" && $_GET['disagree'] != "") {
                        $sql .= " 
         AND (agree = '" . ($_GET['agree']) . "'
         OR agree = '" . ($_GET['disagree']) . "' )
         ";
                    } elseif ($_GET['agree'] != "") {
                        $sql .= " AND agree = '" . ($_GET['agree']) . "' ";
                    } elseif ($_GET['disagree'] != "") {
                        $sql .= " AND agree  = '" . trim($_GET['disagree']) . "' ";
                    }
                }

                //////////////////// MORE QUERY 
                $result = $mysqli->query($sql);
                $total = $result->num_rows;
 ?>

        <table class="table table-sm table-responsive-sm table-bordered" id="reportAdmin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>เพศ</th>
                    <th>อายุ</th>
                    <th>burnout</th>
                    <th>ST-5</th>
                    <th>2Q</th>
                    <th>9Q</th>
                    <th>8Q</th>
                    <th>อำเภอ</th>
                    <th>จังหวัด</th>
                    <th>เขตสุขภาพ</th>
                    <th>ยินยอมให้ข้อมูล</th>
                    <th>เลขอ้างอิง</th>
                    <th>More..</th>
                    <th>วันที่ทำ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && $result->num_rows > 0) {  // คิวรี่ข้อมูลสำเร็จหรือไม่ และมีรายการข้อมูลหรือไม่
                    while ($row = $result->fetch_assoc()) { // วนลูปแสดงรายการ
                        
                 ?>
                <tr>
                    <th><?=$num+1 ?></th>
                    <td><?= $row['gender']; ?></td>
                    <td><?= $row['age']; ?> ปี</td>
                    <td><?= burnOut($row['q1']); ?></td>
                    <td><?= st_5($row['st_5']); ?></td>
                    <td><?= twoQ($row['twoQ']); ?></td>
                    <td><?= depression($row['depression']); ?></td>
                    <td><?= sucide($row['sucide']); ?></td>
                    <td><?= $row['name_amphure']; ?></td>
                    <td><?= $row['name_province']; ?></td>
                    <td><?= $row['Reg_Name']; ?></td>
                    <td><?php echo agree($row['agree']); ?></td>
                    <td>#<?= $row['id']; ?></td>
                    <td><a href="./result.php?id=<?php echo $row['id'] ?>" class="badge badge-info"><i
                                class="far fa-eye"></i> More...</a></td>
                    <td style="font-size: 14px;"><?php echo thai_date_and_time(strtotime($row['data_create'])); ?></td>
                </tr>
                <?php  $num++; } }
                ?>
            </tbody>

            

        </table>
    </div>

    <script>
    $(document).ready(function() {
        $('#reportAdmin').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ]
        });
    });
    </script>
</body>

</html>