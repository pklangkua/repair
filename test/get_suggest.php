<?php  
	header('content-type: text/html; charset: utf-8');

                $host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "repair"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);

$pagesize = 50; // จำนวนรายการที่ต้องการแสดง
$table_db="province_th"; // ตารางที่ต้องการค้นหา
$find_field="province_name"; // ฟิลที่ต้องการค้นหา
if($_GET['term']!=""){
    $q = $_GET["term"];
    $sql = "select * from $table_db 
    where  locate('$q', $find_field) > 0 
    order by locate('$q', $find_field), $find_field limit $pagesize";
}else{
    $sql = "select * from $table_db  where 1 limit $pagesize";      
}
$qr=mysqli_query($con,$sql);
$total=mysqli_num_rows($qr);
while($rs=mysqli_fetch_array($qr)) {
    $json_data[]=array(  
        "id"=>$rs['province_id'],  
        "label"=>$rs['province_name'],  
        "value"=>$rs['province_name'],  
    );  
    $rs['province_name'];  
}  
$json= json_encode($json_data);  
//echo $json;  
mysqli_close();  
exit;
?>