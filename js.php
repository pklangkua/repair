<html>
<body>
<?php
 $username = "สมทรง";
?>
<script>
 var username = "<?php print $username ?>";
</script>
ชื่อ
<p id="thisName">.............</p>
<script>
function showName ()
{
 document.getElementById('thisName').innerHTML= username;
}
</script>
<button type="button" onclick="showName()"  onmouseover="this.style.cursor='pointer';">ส่งค่าตัวแปร</button>
</body>
</html>