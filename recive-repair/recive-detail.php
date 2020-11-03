<?php
ob_start();
include_once("../master/function.php");
include_once("../master/function_mssql.php");

//echo $UserOfficeID;
$ConMysql = new connectDB ;
?>

<?php 
$id = $_POST['id'];
$fname = $_POST['fname'];
$ustatus = $_POST['ustatus'];
//echo $uid,$fname,$ustatus ;
?>
<div class="form-group">
    <label>สถานะ</label>
    <select class="form-control" name="sellist1" id="sellist1">
        <!-- <option>------------------ เลือก ------------------</option> -->
        <?php  
                            $SQL = "SELECT * FROM r_category WHERE id  BETWEEN '2'AND'10' ";
                            $arrData2 = $ConMysql->return_sql($SQL);
                            $recCount2 = $ConMysql->record_count($SQL);
                                                if($recCount2>0)
                                                {
                                                    for ($sLoop2=0;$sLoop2<$recCount2;$sLoop2++)
                                                {
                                                //print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
                                            ?>
        <option value="<?=$arrData2[$sLoop2][2]?>" <?php if($arrData2[$sLoop2][0]==$ustatus){ echo "selected";}?>>
            <?=$arrData2[$sLoop2][3]?></option>
        <?php }}?>
    </select>
</div>
<div class="form-group">
    <label>รายละเอียด</label>
    <font color="red"> * กรุณากรอกข้อมูล </font>
    <textarea class="form-control" name="detail" id="detail_id" cols="50" rows="5"></textarea>
</div>
<div class="form-group">
    <label>ราคา</label>
    <!--<input type="number" name="price" id="price" /> -->
    <input type="hidden"  value=<?=$id?> name = "id">
    <input type="number" name="price" placeholder="1.0" step="0.01" min="0" max="10000" id="price">
</div>