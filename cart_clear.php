<?PHP
session_start();

$id_mem=$_SESSION['sess_ID_m'];

include_once 'connect.php';

$SQL="DELETE FROM cart WHERE id_mem='$id_mem'";
$RESULT=mysqli_query($con,$SQL);

?>
    <script language="javascript">
				alert("ยกเลิกตะกร้าสินค้าเรียบร้อย");
				window.location.href="index.php";
			</script>