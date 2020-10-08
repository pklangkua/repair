<?php

$mysqli = new mysqli("localhost", "root", "D#@m20%H", "mhcgoth2_covid");
/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
}

$sql = "
SELECT data.id AS id,gender,age,q1,Reg_Name,agree,data_create,name_amphure,name_province,
(q2+q3+q4+q5+q6) AS st_5,
(_9q1+_9q2+_9q3+_9q4+_9q5+_9q6+_9q7+_9q8+_9q9) AS depression,
(_8q1+_8q2+_8q3+_8q4+_8q5+_8q6+_8q7+_8q8) AS sucide,
(q7+q8) AS twoQ
FROM data
LEFT JOIN provinces ON data.province_id = provinces.id 
LEFT JOIN region ON region.Reg_id = provinces.Reg_id
WHERE 1  limit 10000
";

/*$result = sqlsrv_query( $conn,$query);
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            
            $response[] = array("value"=>$row['HardwareCode'],"label"=>$row['HardwareName'],
                                "office"=>$row['OfficeName'],"officeID"=>$row['OfficeID'],"HardwareID"=>$row['HardwareID']);
        }*/
       $result = $mysqli->query($sql);
        $total = $result->num_rows;
        while ($row = $result->fetch_assoc()) {
            $response[] = array("id"=>$row['id'],"gender"=>$row['gender'],
                                "age"=>$row['age'],"q1"=>$row['q1'],"Reg_Name"=>$row['Reg_Name']);
        }
        echo json_encode($response);

?>