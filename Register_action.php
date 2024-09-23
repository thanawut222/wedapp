<?php
session_start();
	include_once 'connect.php';	
	$Company_name=$_POST['Company_name'];	
	$id_card=$_POST['id_card'];
	
	$u_name=$_POST['u_name'];
	$p_word=$_POST['p_word'];
	$p_word_s=$_POST['p_word_s'];
	
	$name_m=$_POST['name_m'];
	$email_m=$_POST['email_m'];
	$tel_m=$_POST['tel_m'];
	
	$add_m=$_POST['add_m'];
	$district_id=$_POST['district_id'];
	$amphure_id=$_POST['amphure_id'];
	$province_id=$_POST['province_id'];
	$add_m5=$_POST['add_m5'];
	$pic_s=$_POST['pic_s'];
	
	if($p_word<>$p_word_s)
	{
		?>
			<script language="javascript">
				alert("ยืนยันรหัสผ่านไม่ถูกต้องค่ะ");
				window.location.href="index.php?link=1";
			</script>	
		<?php
	}else{	
	$SQL="SELECT * FROM member WHERE u_name='$u_name'";
	$RESULT=mysqli_query($con,$SQL);
	$NUM=mysqli_num_rows($RESULT);
		if($NUM<>0)	
		{
			?>
			<script language="javascript">
				alert("ชื่อผู้ใช้งานซ้ำค่ะ");
				window.location.href="index.php?link=1";
			</script>
			<?php
		}else{
		
			//แทรกฟิลด์สถานะ member
				if(empty($fileUpload)<>"")
                                             {		
			$SQL1="INSERT INTO member (Company_name,id_card,u_name,p_word,name_m,email_m,tel_m,add_m,ID_m,district_id,amphure_id,province_id,add_m5,status_m,pic_s)VALUES('$Company_name','$id_card','$u_name','$p_word','$name_m','$email_m','$tel_m','$add_m','','district_id','$amphure_id','$province_id','$add_m5','','".$_FILES["fileUpload"]["name"]."')";
			move_uploaded_file($_FILES["fileUpload"]["tmp_name"],"fileupload/".$_FILES["fileUpload"]["name"]);	
			$RESULT1=mysqli_query($con,$SQL1);
											 }
			if(!$RESULT1)
			{
				?>
					<script language="javascript">
						alert("ระบบผิดพลาด!! ไม่สามารถสมัครสมาชิกได้");
						window.location.href="index.php?link=1";
					</script>
				<?php
			}else{		
			
		
$sql="SELECT * FROM `member` WHERE member.u_name ='$u_name' and member.p_word ='$p_word'"; 
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
	
}
			
				?>
					<script language="javascript">
						alert("คุณได้สมัครสมาชิกเรียบร้อยแล้วค่ะ");
						window.location.href="index.php";
					</script>
				<?php
			}
		}
	}
?>