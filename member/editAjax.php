<?php
ob_start();
include_once("../master/function.php");
include_once("../master/function_mssql.php");

//echo $UserOfficeID;
$ConMysql = new connectDB ;
?>

<?php 
$id = $_POST['id'];
$ustatus = $_POST['ustatus'];
//echo $id ;
?>
<div class="form-group">
    <label>สถานะ</label>
    <select class="form-control" name="sellist1" id="sellist1">
        <!-- <option>------------------ เลือก ------------------</option> -->
        <?php  
                            $SQL = "SELECT * from r_status ";
                            $arrData2 = $ConMysql->return_sql($SQL);
                            $recCount2 = $ConMysql->record_count($SQL);
                                                if($recCount2>0)
                                                {
                                                    for ($sLoop2=0;$sLoop2<$recCount2;$sLoop2++)
                                                {
                                                //print $arrData[$sLoop][0] . "-" .  $arrData[$sLoop][1] . "";
                                            ?>
        <option value="<?=$arrData2[$sLoop2][0]?>" <?php if($arrData2[$sLoop2][0]==$ustatus){ echo "selected";}?>>
            <?=$arrData2[$sLoop2][1]?></option>
        <?php }}?>
    </select>
</div>
<input type="hidden"  value=<?=$id?> name = "id">
