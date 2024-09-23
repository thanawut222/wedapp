<?php session_start();?>
<?php
		unset($_SESSION['ses_id']);
		session_unset();//ใช้ยกเลิกตัวแปร session ทั้งหมด
		session_destroy();//ใช้ยกเลิกข้อมูลทั้งหมดที่อยู่ใน session
					?>
			<script language="javascript">
			alert("ร้านเรียนเขียนอ่าน  ขอบคุณค่ะ");
				window.location.href="index.php";
			</script>	

?>

