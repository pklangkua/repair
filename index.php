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
       }else if($_GET["module"]=="member")
       {
        include ("member/member.php");
       }
       else if($_GET["module"]=="test")
       {
        include ("test/autocomplete_test.php");
       }
       else if($_GET["module"]=="recive")
       {
        include("recive-repair/recive-repair.php");
       }else if($_GET["module"]=="ict")
       {
        include("ict-repair/ict-repair.php");
       }
       else if($_GET["module"]=="profile")
       {
        include("profile/profile.php");
       }else if($_GET["module"]=="durprofile")
       {
        include("durprofile/durable.php");
       }
       else if($_GET["module"]=="error")
       {
        include ("error.php");
       }
       else{
         echo "<br>";
       include ("card.php");
       }
     }
  ?>

<?php include ("master/footer.php")?>