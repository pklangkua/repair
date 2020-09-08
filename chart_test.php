

<?php

	/*$GSQL = "SELECT COUNT(r.ID) as cc,o.OfficeName FROM r_data_repair r
	INNER JOIN r_office o ON o.OfficeID = r.OfficeID
	GROUP BY o.OfficeName";
	//echo $GSQL;
    $arrData3 = $conn->return_sql($GSQL);
	$recCount3 = $conn->record_count($GSQL);
	//echo $GSQL;
	for ($sLoop3=0;$sLoop3<$recCount3;$sLoop3++)
	{
		//$dataPoints= array(array("y" =>$arrData3[$sLoop3][0], "label" => $arrData3[$sLoop3][1] ));
		$dataPoints= array(array("y" =>$arrData3[$sLoop3][0], "label" => $arrData3[$sLoop3][1] ));
	}*/
 
/*$dataPoints = array( 
	array("y" => 3373.64, "label" => "ThaiLand" ),
	array("y" => 2435.94, "label" => "Phattalung" ),
	array("y" => 1842.55, "label" => "Nakhonsritamarat" ),
	array("y" => 1828.55, "label" => "Songkhla" ),
	array("y" => 1039.99, "label" => "Satun" ),
	array("y" => 765.215, "label" => "Trang" ),
	array("y" => 612.453, "label" => "Puket" )
);*/
 
?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {

var dataPoints = [];

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title: {
		text: "Daily Sales Data"
	},
	axisY: {
		title: "Units",
		titleFontSize: 24,
		includeZero: true
	},
	data: [{
		type: "column",
		yValueFormatString: "#,### Units",
		dataPoints: dataPoints
	}]
});

function addData(data) {
	for (var i = 0; i < data.length; i++) {
		dataPoints.push({
			x: new Date(data[i].date),
			y: data[i].units
		});
	}
	chart.render();

}

$.getJSON("https://canvasjs.com/data/gallery/javascript/daily-sales-data.json", addData);

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
