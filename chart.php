<?php /*
 
$dataPoints = array();
//Best practice is to create a separate file for handling connection to database
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=repair;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        '', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare('SELECT COUNT(r.ID) as cc,o.OfficeName FROM r_data_repair r
	INNER JOIN r_office o ON o.OfficeID = r.OfficeID
	WHERE r.UserID ="pradit_k"
	GROUP BY o.OfficeName'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints, array("x"=> $row->cc, "y"=> $row->OfficeName)); 
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
	*/
?>
<!--
<!DOCTYPE HTML>
<html>
<head>  
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "PHP Column Chart from Database"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc  
		dataPoints: <?php //  echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 80%; aligin:center;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html> 

-->

<?php

	$GSQL = "SELECT COUNT(r.ID) as cc,o.OfficeName FROM r_data_repair r
	INNER JOIN r_office o ON o.OfficeID = r.OfficeID
	GROUP BY o.OfficeName";

    $arrData3 = $conn->return_sql($GSQL);
	$recCount3 = $conn->record_count($GSQL);

	for ($sLoop3=0;$sLoop3<$recCount3;$sLoop3++)
	{
		$dataPoints[]= array("y" =>$arrData3[$sLoop3][0], "label" => $arrData3[$sLoop3][1] );
				
	}
     json_encode($dataPoints);

?>

<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "การแจ้งซ่อม"
	},
	axisY: {
		title: "จำนวนการแจ้งซ่อม (ครั้ง)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## ครั้ง",
		dataPoints:  <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>  

