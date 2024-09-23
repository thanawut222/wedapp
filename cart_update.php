<?php
session_start();
$id_mem=$_POST['id_mem'];
$cart_id=$_POST['cart_id'];
$cart_qty=$_POST['cart_qty'];
$pid=$_POST['pid'];

$count_item=count($cart_qty);//นับจำนวนรายการที่ส่งมา

for($i=0;$i<$count_item;$i++)
{

	/*echo $cart_qty[$i]."<br>";//กำหนดตัวแปร $new_qty เพื่อรับค่าจำนวนสินค้าที่แก้ไขครั้งละรายการ
	echo $cart_id[$i]."<br>";
	echo $pid[$i]."<br>";*/
	
	if($cart_qty[$i]<1)
	{
		//ไม่สินค้าเหลือเลย
		$SQL2="DELETE FROM cart WHERE pid='$pid[$i]'";
		$RESULT2=mysqli_query($con,$SQL2);
			?>
        <script language="javascript">
						alert("เนื่องจากขณะนี้สินค้าได้หมดชั่วคราว");					
					window.location.href="index.php?link=7";
					</script>  
        <?php		
	}
	else
	{
		//ตรวจ stock จากตาราง product ก่อนอัพเดท
		$SQL="SELECT*FROM product WHERE pid='".$pid[$i]."'";
		$RESULT=mysqli_query($con,$SQL);
		$NUM=mysqli_num_rows($RESULT);
		$DATA=mysqli_fetch_array($RESULT);
		
		//ตรวจจำนวนสินค้าที่ลูกค้าแก้ไขว่า มากกว่าจำนวน stock หรือไม่
		if($cart_qty[$i]>$DATA['p_total'])
		{
			//กรณีลูกค้าสั่งมากกว่าจำนวนสินค้าคงเหลือ ให้กำหนดจำนวนเท่ากับสินค้าคงเหลือ
			$cart_qty[$i]=$DATA['p_total'];
			
			//แจ้ง erroe ตามเงื่อนไขจำนวนสินค้าคงเหลือในตาราง product
			if($DATA['p_total']>0)
			{
				?>
                <script language="javascript">
					alert('ขออภัย!!! จำนวนสินค้ามีน้อยกว่าที่คุณต้องการ');
				window.location.href="index.php?link=7";
				</script>
				<?php
			}
			else{
				//ไม่สินค้าเหลือเลย
				$SQL3="DELETE FROM cart WHERE cart_id='".$cart_id[$i]."'";
				$RESULT3=mysqli_query($con,$SQL3);		
					?>
        <script language="javascript">
						alert("เนื่องจากขณะนี้สินค้าได้หมดชั่วคราว");				
					window.location.href="index.php?link=7";
					</script>  
        <?php		
			}
		}
		//อัพเดทจำนวนสินค้าลงตาราง cart
		$SQL4="UPDATE cart SET cart_qty='".$cart_qty[$i]."' WHERE cart_id='".$cart_id[$i]."'";
		$RESULT4=mysqli_query($con,$SQL4);
		?>
        <script language="javascript">
						alert("คุณได้แก้ไขจำนวน การสั่งซื้อ เรียบร้อย");			
									window.location.href="index.php?link=7";
					</script>  
        <?php
	}
}
?>