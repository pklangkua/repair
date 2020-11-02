<div id="myModal" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">แจ้งซ่อม : <div id="showText"></div>
                </h4>
            </div>
            <div class="modal-body">

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
                        <option value="<?=$arrData2[$sLoop2][2]?>"
                            <?php /*if($arrData2[$sLoop2][0]==9){ echo "selected";}*/?>>
                            <?=$arrData2[$sLoop2][3]?></option>
                        <?php }}?>
                    </select>
                </div>
                <div class="form-group">
                    <label>รายละเอียด</label>
                    <textarea class="form-control" name="detail" id="detail_id" cols="50" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label>ราคา</label>
                    <!--<input type="number" name="price" id="price" /> -->
                    <input type="number" name="price" placeholder="1.0" step="0.01" min="0" max="10000" id="price">
                </div>

            </div>
            <div class="modal-footer">

                <input type="hidden" name="id" id="id" />
                <input type="submit" class="btn btn-primary" value="บันทึก">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>


<form method="post" action="/repair/recive-repair/Insert_status.php" name="frmInsertStatus"
    onSubmit="JavaScript:return fncSubmit2();">
    <div id="myModal" class="modal modal-child fade addNewRequestModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" data-modal-parent="#ViewDetailModal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">แจ้งซ่อม : <div id="showText"></div>
                    </h4>
                </div>
                <div class="modal-body">

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
                            <option value="<?=$arrData2[$sLoop2][2]?>"
                                <?php /*if($arrData2[$sLoop2][0]==9){ echo "selected";}*/?>>
                                <?=$arrData2[$sLoop2][3]?></option>
                            <?php }}?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>รายละเอียด</label>
                        <textarea class="form-control" name="detail" id="detail_id" cols="50" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label>ราคา</label>
                        <!--<input type="number" name="price" id="price" /> -->
                        <input type="number" name="price" placeholder="1.0" step="0.01" min="0" max="10000" id="price">
                    </div>

                </div>
                <div class="modal-footer">

                    <input type="hidden" name="id" id="id" />
                    <input type="submit" class="btn btn-primary" value="บันทึก">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
</form>