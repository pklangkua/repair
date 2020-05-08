<?php 
    ob_start();
    require_once("../master/function_mssql.php");
   
    $st = $_SESSION['status']; 
    $user = $_SESSION['OfficeID'];
  
if($st==1){ 


    if(isset($_POST['search'])){
        $search = $_POST['search'];

        $query = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,dbo.Office.OfficeName,dbo.Office.OfficeID
        FROM
        dbo.Hardware AS h
        INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
        INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
        INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID
        WHERE HardwareName LIKE '%".$search."%' OR HardwareCode LIKE '%".$search."%'";
        $result = sqlsrv_query( $conn,$query);
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            
            $response[] = array("value"=>$row['HardwareCode'],"label"=>$row['HardwareName'],
                                "office"=>$row['OfficeName'],"officeID"=>$row['OfficeID'],"HardwareID"=>$row['HardwareID']);
        }

       // echo $query;
        echo json_encode($response);
    }
    exit;
}else{

    if(isset($_POST['search'])){
        $search = $_POST['search']; 
    
        $query = "SELECT h.*,ht.HardwareTypeName,htg.HardwareTypeGroupName,dbo.Office.OfficeName,dbo.Office.OfficeID
        FROM
        dbo.Hardware AS h
        INNER JOIN dbo.HardwareType AS ht ON ht.HardwareTypeID = h.HardwareTypeID
        INNER JOIN HardwareTypeGroup AS htg ON htg.HardwareTypeGroupID = ht.HardwareTypeGroupID 
        INNER JOIN dbo.Office ON dbo.Office.OfficeID = h.OfficeID
        WHERE (HardwareName LIKE '%".$search."%' OR HardwareCode LIKE '%".$search."%') AND h.OfficeID = '$user' ";
        $result = sqlsrv_query( $conn,$query);
        while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            
            $response[] = array("value"=>$row['HardwareCode'],"label"=>$row['HardwareName'],
                                "office"=>$row['OfficeName'],"officeID"=>$row['OfficeID'],"HardwareID"=>$row['HardwareID']);
        }
        echo json_encode($response);
    }
    
    exit;
}