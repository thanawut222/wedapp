<?php 

$terms=$_POST['terms'];
if($terms=="")
{
	?>
 <script language="javascript">
	alert('กรุณา กดยอมรับและขอยืนยันการสั่งซื้อสินค้า');
	window.location.href="index.php?link=11";
</script>    
    <?php 
}

$payment=$_POST['payment'];
if($payment=="payment1")
{
 $payment="pay";
	}
	else
	{
		 $payment="credit";	
			}	
?>



<?php 
 $order_date=date("Y-m-d H:i:s");
 $order_idmem=$_SESSION['sess_ID_m'];
  $order_sum=$_POST['order_sum'];
 $order_type_pay=$payment;
  $order_status="Order";



//***คำเตือน หาก SQL มีปัญหาให้ระบุ ชื่อฐานข้อมูล.ชื่อตาราง
$SQL1="INSERT INTO order_d(order_date,order_idmem,order_sum,order_type_pay,order_status) VALUES('$order_date','$order_idmem','$order_sum','$order_type_pay','$order_status')";
$RESULT1=mysqli_query($con,$SQL1);


//2) เลือกข้อมูลจาก order ตาม order_id
$SQL2="SELECT*FROM order_d WHERE order_idmem='$order_idmem' and order_date='$order_date'";
$RESULT2=mysqli_query($con,$SQL2);
$DATA2=mysqli_fetch_array($RESULT2);

$order_id=$DATA2['order_id'];

//3) เลือกข้อมูลจากตาราง cart ที่ลูกค้าเลือกใส่ตระกร้าไว้ตาม cart_sid ที่ส่งมา
$SQL3="SELECT*FROM cart WHERE id_mem='$order_idmem'";
$RESULT3=mysqli_query($con,$SQL3);
$NUM3=mysqli_num_rows($RESULT3);//นับจำนวนแถวในตาราง cart


for($i=0;$i<$NUM3;$i++)
{
		$DATA3=mysqli_fetch_array($RESULT3);
		
		$cart_id=$DATA3['cart_id'];
		$pid=$DATA3['pid'];
		$p_price=$DATA3['p_price'];
		$cart_qty=$DATA3['cart_qty'];

		//เพิ่มข้อมูลในตาราง order_desc
		$SQL4="INSERT INTO order_desc(order_id,order_pid,p_price,order_qty)VALUES('$order_id','$pid','$p_price','$cart_qty')";
		$RESULT4=mysqli_query($con,$SQL4);
		
		//ลบรายการจากตาราง cart หลังจากเพิ่มข้อมูลในตาราง order และ order_desc เรียบร้อย
		$SQL7="DELETE FROM cart WHERE cart_id='$cart_id'";
		$RESULT7=mysqli_query($con,$SQL7);  

}
?>

<script language="javascript">
	alert('บันทึกการสั่งซื้อของท่านเรียบร้อยแล้ว...กรุณารอการยืนยันการสั่งซื้อจากทางร้านน่ะค่ะ');
	window.location.href="index.php";
</script>