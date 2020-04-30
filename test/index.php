<html>
<head>
<title>ThaiCreate.Com</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){

	$("#txtCustomerID,#txtEmail").change(function(){

			$("#sCusID").empty();
			$("#sEmail").empty();

			$.ajax({ 
				url: "ajaxfile.php" ,
				type: "POST",
				data: 'sCusID=' +$("#txtCustomerID").val()+'&eMail='+$("#txtEmail").val()
			})
			.success(function(result) { 

					var obj = jQuery.parseJSON(result);

					if(obj != '')
					{
						  $.each(obj, function(key, inval) {

								   if($("#txtCustomerID").val() == inval["CustomerID"])
								  {
									   $("#sCusID").html(" <font color='red'>รหัสลูกค้านี้มีอยู่แล้ว</font>");
								  }

								   if($("#txtEmail").val() == inval["Email"])
								  {
									   $("#sEmail").html(" <font color='red'>อีเมล์นี้มีอยู่แล้ว</font>");
								  }

						  });
					}

			});

		});
	});
</script>
</head>
<body>
<h2>jQuery ตรวจสอบข้อมูลซ้ำ</h2>
<table width="399" border="1">
  <tr>
    <td width="114">CustomerID <font color="red">*</font></td>
    <td width="309"><input type="text" id="txtCustomerID" name="txtCustomerID" size="5">
	<span id="sCusID"></span>
	</td>
  </tr>
  <tr>
    <td>Name</td>
    <td><input type="text" id="txtName" name="txtName" size="20"></td>
  </tr>
  <tr>
    <td>Email <font color="red">*</font></td>
    <td><input type="text" id="txtEmail" name="txtEmail" size="25">
	<span id="sEmail"></span>
	</td>
  </tr>
  <tr>
    <td>CountryCode</td>
    <td><input type="text" id="txtCountryCode" name="txtCountryCode" size="2"></td>
  </tr>
  <tr>
    <td>Budget</td>
    <td><input type="text" id="txtBudget" name="txtBudget" size="5"></td>
  </tr>
  <tr>
    <td>Used</td>
    <td><input type="text" id="txtUsed" name="txtUsed" size="5"></td>
  </tr>
</table>

</body>
</html>