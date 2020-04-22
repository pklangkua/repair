<?php
$id = $_POST['id'];
//echo $id;
include 'db.php';
$opt = '';
try {
  $sql = "SELECT * FROM r_user WHERE id=$id";
  $query = $conn->prepare($sql);
  $query ->execute();
} catch (\Exception $e) {
  echo "ไม่สามารถดึงข้อมูลได้: " .$e->getMessage();
}

$opt.='<div class="table-responsive">
<table class="table table-bordered">';
while ($row=$query -> fetch(PDO::FETCH_OBJ)) {
      $opt.='<tr>
              <td><lable>ID</lable></td>
              <td>'.$row->id.'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>Firstname</lable></td>
              <td>'.$row->fullname.'</td>
            </tr>';
      $opt.='<tr>
              <td><lable>Lastname</lable></td>
              <td>'.$row->lastvisit_login.'</td>
             <tr>';
      $opt.='<tr>
              <td><lable>Email</lable></td>
              <td>'.$row->create_date.'</td>
             <tr>';
}
    $opt.='</table></div>';
echo $opt;
 ?>
