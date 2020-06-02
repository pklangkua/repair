<?php
if($st=='1' || $st=='2')
{ ?>
    <div class="card border-light mb-3" style="max-width:">
    <div class="card-header">แจ้งซ่อม/รายการแจ้งซ่อม</div>
    <div class="card-body">
        <div class="row">
            <div class="col">

                <?php include("data-list.php")?>

            </div>
        </div>
    </div>
</div>
<?php 
}else{
    header("Location:/repair/index.php?module=error");
 }
?>

