<?php 
ob_start();
include "connect.php";
?>
<?php 

if(isset($_POST['u_name']) or isset($_POST['p_word']))
{
$u_name=$_POST['u_name'];
$p_word=$_POST['p_word'];
}
$sql="SELECT * FROM member WHERE u_name ='$u_name' and p_word ='$p_word'"; 
$query=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($query);

$ID_m=$rs['ID_m'];
$Company_name=$rs['Company_name'];
$id_card=$rs['id_card'];
$name_m=$rs['name_m'];

session_start();

if (isset($id_card)){
	$_SESSION['sess_ID_m']=$ID_m; 
	$_SESSION['sess_Company_name']=$Company_name; 
	$_SESSION['sess_id_card']=$id_card;
	$_SESSION['sess_name_m']=$name_m; 
		echo "login ถูกต้อง";
	header("location:index.php");
	
}else{ // ถ้า login ผิด
	echo "ยังไม่ได้สมัครสมาชิก";
	header("location:index.php");
}
mysqli_close();
?>


<?php  ob_end_flush();
?>