<?php
	session_start();//เปิด session เพื่อใช้ตัวแปร cart_sid
	$cart_id=$_GET['cart_id'];
	$cart_sid=$_GET['cart_sid'];
	
	include_once 'connect.php';
	$SQL="DELETE FROM cart WHERE cart_id='$cart_id'";
	$RESULT=mysql_db_query($dbName,$SQL);
	//หลังจากลบข้อมูลแล้วต้องส่งค่า cart_sid ไปให้ไฟล์ cart_view เพื่อนำไปดึงข้อมูลได้
?>
	<script language="javascript">
		window.location.href="index.php?link=7&cart_sid=<?=$cart_sid;?>";
	</script>
