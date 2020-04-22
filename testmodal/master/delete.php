<?php
$id = $_POST['id'];
echo $id;
include 'db.php';
  $sql = "DELETE FROM r_user WHERE id=$id";
  $query = $conn->prepare($sql);
  $query ->execute();
?>
