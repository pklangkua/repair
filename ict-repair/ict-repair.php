<?php
if($st=='1' || $st=='2')
{ ?>
    <div class="card border-light mb-3" style="max-width:">
    <div class="card-header">งานส่งต่อสำนักเทคโนโลยีสารสนเทศ</div>
    <div class="card-body">
        <div class="row">
            <div class="col">

                <?php include("ict-list.php")?>

            </div>
        </div>
    </div>
</div>
<?php 
}else{
    header("Location:/repair/index.php?module=error");
 }
?>

