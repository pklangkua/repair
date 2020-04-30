<?php
    $host = "localhost"; /* Host name */
    $user = "root"; /* User */
    $password = ""; /* Password */
    $dbname = "repair"; /* Database name */
    
    $con = mysqli_connect($host, $user, $password,$dbname);
    // Check connection
    if (!$con) {
     die("Connection failed: " . mysqli_connect_error());
    }
     if(isset($_POST["sCusID"]) && isset($_POST["eMail"]))
     {
       $sCusID = $_POST["sCusID"];
       $eMail = $_POST["eMail"];
     }

	$strSQL = "SELECT * FROM customer WHERE  CustomerID = '$sCusID' OR Email = '$eMail' ";
	$objQuery = mysqli_query($con,$strSQL) or die (mysqli_error());
	$intNumField = mysqli_num_fields($objQuery);
	$resultArray = array();
	while($obResult = mysqli_fetch_array($objQuery))
	{
		$arrCol = array();
		for($i=0;$i<$intNumField;$i++)
		{
			$arrCol[mysqli_field_name($objQuery,$i)] = $obResult[$i];
		}
		array_push($resultArray,$arrCol);
	}
	
	//mysqli_close($objConnect);
	
	echo json_encode($resultArray);
?>