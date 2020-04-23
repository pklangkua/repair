<?php
require_once("master/function.php");
$status = new status;
$status->status();
$st = $status->status();
 if($st==1){

 }else{
    header("Location:/repair/index.php?module=");
 }
?>

<div class="card border-light mb-3" style="max-width:">
    <div class="card-header">จัดการสมาชิก</div>
    <div class="card-body">
        <div class="row">
            <div class="col">

                <?php  include("data-member.php")?>

            </div>
        </div>
    </div>
</div> 