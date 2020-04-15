<?php 
include ("master/head.php");
?>

  <?php 
     if(isset($_GET["module"]))
     {
       if($_GET["module"]=="resive-repair")
       {
        include ("history-repair/resive-repair.php");
       }else if( $_GET["module"]=="history-repair")
       {
         include ("history-repair/history-repair.php");
       }else if($_GET["module"]=="data-history-detail")
       {
        include ("history-repair/data-history-detail.php");
       }else if($_GET["module"]=="list-repair")
       {
        include ("history-repair/list-repair.php");
       }
       else if($_GET["module"]=="durable")
       {
        include ("durable/durable.php");
       }
       else{
         echo "<br>";
       include ("card.php");
       }
     }
  ?>

<?php include ("master/footer.php")?>