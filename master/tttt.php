<html>

<head>
    <title>ThaiCreate.Com PHP & SQL Server Tutorial</title>
</head>

<body>
    <?php
include("function_mssql.php");

$stmt = "SELECT * FROM AccessDetail WHERE PageID ='7082' ";

$query = sqlsrv_query( $conn, $stmt);

while ($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){


?>

    <table width="284" border="1">
        <tr>
            <th width="120">CustomerID</th>
            <td width="238"><?php echo $result["AccessDetailID"];?></td>
        </tr>

    </table>
<?php }?>
</body>

</html>