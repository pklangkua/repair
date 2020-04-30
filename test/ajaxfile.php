<?php  
	header('content-type: text/html; charset: utf-8');
	if(!empty($_GET["term"])){
	$connect=mysql_connect('localhost','root','root');
        mysql_select_db('salespro');
        mysql_query('SET NAMES utf8');
	mysql_query("SET character_set_results=utf8");
	mysql_query("SET character_set_client=utf8");
	mysql_query("SET character_set_connection=utf8");
        $param = $_GET["term"];  
        $query = mysql_query("SELECT * FROM customer WHERE Customer_Code LIKE '%$param%' "); 
        for ($x = 0, $numrows = 10; $x < $numrows; $x++) {  
        $row = mysql_fetch_assoc($query);  
        $employee[$x] = array("id" => $row["Customer_Code"],"custname" => $row["Customer_Name"],"address1"=>$row['Address1'],"address2"=>$row['Address2'],"address3"=>$row['Address3'],"address4"=>$row['Address4'],"city"=>$row['City'],"zipcode"=>$row['Zip_Code'],"phone1"=>$row['Tel_No'],"phone2"=>$row['Fax_No']); } 
    $response = json_encode($employee); 
	echo $response; 
	mysql_close($connect);
}
?>  