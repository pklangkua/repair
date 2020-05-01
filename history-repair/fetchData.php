<?php 
/*
ini_set('display_errors', 1);
error_reporting(~0);
   $serverName = "PRADIT\SQLEXPRESS";
   $userName = "sa";
   $userPassword = "21652671";
   $dbName = "DUR";
  
   $connectionInfo = array("Database"=>$dbName, "UID"=>$userName, "PWD"=>$userPassword, "MultipleActiveResultSets"=>true, "CharacterSet" => "UTF-8");

   $conn = sqlsrv_connect( $serverName, $connectionInfo);

	if(!$conn)
	{
		die( print_r( sqlsrv_errors(), true));
    }
    */
    require_once("../master/function_mssql.php");
/*
$host = "localhost";   
$user = "root";         
$password = "";         
$dbname = "repair";   

// Create connection
$con = mysqli_connect($host, $user, $password,$dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT * FROM users WHERE name like'%".$search."%'";
    $result = mysqli_query($con,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id'],"label"=>$row['name']);
    }

    echo json_encode($response);
}*/

if(isset($_POST['search'])){
    $search = $_POST['search'];

    $query = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,dbo.Office.OfficeName
    FROM
    dbo.Hardware AS h
    INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
    INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
    INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID
    WHERE HardwareName LIKE '%".$search."%' OR HardwareCode LIKE '%".$search."%'";
    $result = sqlsrv_query( $conn,$query);
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
        //echo $row['HardwareCode'];
        $response[] = array("value"=>$row['HardwareCode'],"label"=>$row['HardwareName']);
    }

    echo json_encode($response);
}

exit;
