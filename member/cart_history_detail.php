<?php 
$_SESSION['sess_ID_m'];
 //$result_member=select("member","where 1 and ID_m='".$_SESSION['sess_ID_m']."'");
 
  $sql_member = "select * From member Where ID_m='".$_SESSION['sess_ID_m']."'";													
	$query_member = mysqli_query($con,$sql_member);
	 $result_member=mysqli_fetch_array($query_member);
														 
 
?>
   <!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>						
							<li><a href="index.php?link=7">ตะกร้าสินค้าของคุณ</a></li>	
                            	<li><a href="index.php?link=13">ประวัติการสั่งซื้อ</a></li>		
							<li class="active">รายละเอียดการสั่งซื้อ</li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
        
        	<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-4">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">ที่อยู่สำหรับการจัดส่ง</h3>
							</div>
							<div class="form-group">
								<label><font color="#999999"> ชื่อผู้รับสินค้า :</font> <?php  echo $result_member['name_m'];?></label><br>
                                <label><font color="#999999"> เบอร์โทรติดต่อ :</font><?php  echo $result_member['tel_m'];?></label><br>
                     <label><font color="#999999"> บ้านเลขที่ : </font><?php  echo $result_member['add_m'];?></label><br>
                     <label><font color="#999999"> ตำบล : </font><?php  echo $result_member['add_m2'];?></label><br>
                     <label><font color="#999999"> อำเภอ : </font><?php  echo $result_member['add_m3'];?></label><br>
                     <label><font color="#999999"> จังหวัด : </font> <?php  echo $result_member['add_m4'];?></label><br>
                     <label><font color="#999999"> รหัสไปรษณีย์ : </font><?php  echo $result_member['add_m5'];?></label><br>
							</div>
								</div>
						<!-- /Billing Details -->
					</div>

					<!-- Order Details -->
					<div class="col-md-8 order-details">
						<div class="section-title text-center">
							<h3 class="title">ประวัติรายการสั่งซื้อของคุณ</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>รายการสินค้า</strong></div>
								<div><strong>จำนวนเงิน</strong></div>
							</div>
							<div class="order-products">
                            
                             <?php 		
													  $i=0;												
													  $sum=0;
													  $sum_total=0;												
													  $sql_order_desc = "select * From order_desc Where order_id='".$_GET['order_id']."' order by id_item ASC";		
													$query_order_desc = mysqli_query($con,$sql_order_desc);													
													$num_order_desc = mysqli_num_rows($query_order_desc);
														 while($result_order_desc=mysqli_fetch_array($query_order_desc))
														 { 
														 
														 	 	 	
														 	 	 
														 $sql_product3 = "select * From product Where pid='".$result_order_desc['order_pid']."'";													
														 $query_product3 = mysqli_query($con,$sql_product3);
														 $result_product=mysqli_fetch_array($query_product3);
														?>
                            
								<div class="order-col">
									<div><?php echo $result_product['p_name'];?> ( จำนวน <?php echo $result_order_desc['order_qty'];?> x <?php echo $result_order_desc['p_price'];?> ฿)</div>
									<div>฿ <?php echo number_format($result_order_desc['order_qty']*$result_order_desc['p_price'],2);?></div>
								</div>
                                
						        <?php  
											 $sum=$result_order_desc['order_qty']*$result_order_desc['p_price'];
											 $sum_total=$sum_total+$sum;
											} 
											
											?>
							</div>
							<div class="order-col">
								<div><strong>รวมทั้งสิ้น : </strong></div>
								<div><strong class="order-total">฿ <?php echo number_format($sum_total,2);?></strong></div>
							</div>
						</div>      
                           
                           
                           <?php 
                           // $result_order_d=select("order_d","where 1 and order_id='".$_GET['order_id']."'");
                            
                            
                            	$sql_order_d = "select * From order_d Where order_id='".$_GET['order_id']."'";													
								$query_order_d = mysqli_query($con,$sql_order_d);
								$result_order_d=mysqli_fetch_array($query_order_d);
														 
                            
							$result_order_d['order_type_pay'];	
							if($result_order_d['order_type_pay']=="pay")
							{
								
							
						   ?>
                          <div class="product-details">
        						<div class="add-to-cart">
                                <a href="index.php?link=15&Action=payment&order_id=<?php echo $_GET['order_id'];?>"><button class="add-to-cart-btn" type="button"><i class="fa fa-bell"></i> แจ้งชำระเงิน</button>  </a> 
                      
     							</div>
                          </div>    
                            
							<?php 
							}
							else if($result_order_d['order_type_pay']=="credit")
							{
								
								echo "<font color=#FF0000><strong>รอการตรวจสอบ/อนุมัติการสั่งซื้อสินค้า</strong></font>";
								}
							?>
                            
                                
                            
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->