<?php
require 'db.php';
$id = $_POST['id'];
$fullname = $_POST['fullname'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
//echo $fname. $lname. $email;
if ($id!='') {
  echo "UPDATE";
  $query = $conn->prepare('UPDATE r_users SET fullname = :fullname  WHERE id = :id');
  $result = $query->execute([
    'fullname'=>$fullname,
    'id' => $id
  ]);
}else {
  echo "INSERT";
  $query = $conn->prepare('INSERT INTO users(first_name, last_name, email) VALUES(:first_name, :last_name, :email)');
  $result = $query->execute(array(
                      'first_name' => $first_name,
                      'last_name' => $last_name,
                      'email' => $email
                    ));
}
if ($result) {
  echo "success";
}else {
  echo "error";
}
 ?>
