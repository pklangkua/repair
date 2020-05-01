<?php 


$host = "localhost";    /* Host name */
$user = "root";         /* User */
$password = "";         /* Password */
$dbname = "repair";   /* Database name */

// Create connection
$con = mysqli_connect($host, $user, $password,$dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT * FROM r_user WHERE fullname like'%".$search."%'";
    $result = mysqli_query($con,$query);
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id'],"label"=>$row['fullname']);
    }

    echo json_encode($response);
    
}

exit;


