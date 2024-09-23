<?php
  if(isset($_SESSION['sess_ID_m'])=='')
{
	?>
    <script language="javascript">
				alert("กรุณา Login เข้าใช้งานระบบด้วยนะคะ");
				window.location.href="index.php";
			</script>	
    <?php
}else
{
	
//$pid=isset($_GET['pid']);
 $pid='';
	if(isset($_GET['pid']))
	{
		 $pid=$_GET['pid'];
	}

 $cur_stock=0;	
 
	$SQL_product="SELECT*FROM product WHERE pid='$pid'";
	$RESULT=mysqli_query($con,$SQL_product);
	$NUM=mysqli_num_rows($RESULT);
	
	if($NUM<>0)
	{
		$DATA=mysqli_fetch_array($RESULT);
		
		$cur_stock=$DATA['p_total'];
		
		if($cur_stock==0)
		{
			?>
			<script language="javascript">
                alert('ขออภัย!!! สินค้าหมดค่ะ');
                window.location.href="index.php";
            </script>
			<?php
			exit;
		}
	}
	
	 //$result_product=select("product","where 1 and pid='$pid'");
	 
	 
	 $sql_product2 = "select * From product Where pid='$pid'";													
 $query_product2 = mysqli_query($con,$sql_product2);
	$result_product=mysqli_fetch_array($query_product2);
	 
	 
	 
	$id_mem=$_SESSION['sess_ID_m'];
	$p_price=$result_product['p_price'];
	$cart_qty=1;
	$cart_date=date("Y-m-d H:i:s"); 
		
	$SQL2="SELECT*FROM cart WHERE pid='$pid' AND id_mem='".$_SESSION['sess_ID_m']."'";
	$RESULT2=mysqli_query($con,$SQL2);
	$NUM2=mysqli_num_rows($RESULT2);
	$DATA2=mysqli_fetch_array($RESULT2);
	
	
		if($NUM2==0)	
		{
	$SQL3="INSERT INTO cart(pid,id_mem,p_price,cart_qty,cart_date)VALUES('$pid','$id_mem','$p_price','$cart_qty','$cart_date')";
			$RESULT3=mysqli_query($con,$SQL3);
			
			?>
<script language="javascript">
						alert("เพิ่มสินค้า ของคุณในตะกร้าสินค้า เรียบร้อย");
						window.location.href="index.php?link=7";
					</script>            
            <?php
		}
		else if($NUM2==1)
		{
		$cart_qty=$DATA2['cart_qty'];		
		$cart_qty++;		
		if($cart_qty<=$cur_stock)
		{
			$SQL4="UPDATE cart SET cart_qty='$cart_qty',cart_date='$cart_date' WHERE pid='$pid' AND id_mem='".$_SESSION['sess_ID_m']."'";
			$RESULT4=mysqli_query($con,$SQL4);		
			
						?>
<script language="javascript">
						alert("คุณได้ทำการเพิ่ม อีก 1 จำนวน ในรายการจากที่มีอยู่เดิม  เรียบร้อย");
						window.location.href="index.php?link=7";
					</script>            
            <?php
			
		}
		}
		else
		{	
					$SQL5="UPDATE cart SET cart_date='$cart_date' WHERE pid='$pid' AND id_mem='".$_SESSION['sess_ID_m']."'";
			$RESULT5=mysqli_query($con,$SQL5);
				?>
					<script language="javascript">
						alert("คุณได้ทำการแก้ไข วันที่ทำรายการ เรียบร้อย");
						window.location.href="index.php?link=7";
					</script>
				<?php
		}
}
			?>