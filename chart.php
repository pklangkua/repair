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

