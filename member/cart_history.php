<?php 
if(isset($_SESSION['sess_ID_m']))
{
$_SESSION['sess_ID_m'];
}
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
							<li><a href="index.php?link=2">ประวัติส่วนตัว</a></li>
							<li class="active">ประวัติการสั่งซื้อสินค้า</li>					
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">ประวัติการสั่งซื้อสินค้า :</h3>
							<div class="checkbox-filter">

        <?php 		
												  $ii=0;
													  $sum_total=0;	
													  	  $sql_order = "select * From order_d Where order_idmem='".$_SESSION['sess_ID_m']."'";	
														$query_order = mysqli_query($con,$sql_order);
														 while($result_order=mysqli_fetch_array($query_order))
														 { 
															$sum_total=$sum_total+$result_order['order_sum'];								
														?>

								
									
		<div class="product-body">
						<h5 class="product-name"><i class="fa fa-chevron-circle-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $result_order['order_date'];?> <strong><font color="#FF0000"> (<?php echo number_format($result_order['order_sum'],2);?>) ฿</font></strong></i></h5>
                                </div>                     
                                <br>          
                                
<?php 
 } 
echo "<font color=#FF0000><strong>ยอดเงินรวม : ".number_format($sum_total,2)." บาท</strong></font>";
?>
			 
                            		
							</div>
						</div>							
					</div>


         
                        
                         <div class="row"><!-- row 2 -->         
                    
                        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>                                    
                 <th><div align="center">รหัสการสั่งซื้อ</div></th>
                     <th><div align="center">วันที่ / เวลา</div></th>
                       <th><div align="center">ยอดเงิน</div></th>
                         <th><div align="center">รูปแบบการชำระเงิน</div></th>                     
                             <th><div align="center">สถานะ</div></th>                            
                              <th><div align="center">รายละเอียด</div></th>      
                                <th><div align="center">ดำเนินการ</div></th>      
                                   <th><div align="center">พิมพ์ใบเสนอราคา</div></th>                 
                                
                  </tr>
                </thead>             
                <tbody>
                
                   <?php 		
											
													  $sql_ord = "select * From order_d Where order_idmem='".$_SESSION['sess_ID_m']."' order by order_id ASC";		
														$query_ord= mysqli_query($con,$sql_ord);
														 while($result_ord=mysqli_fetch_array($query_ord))
														 { 
														 
														 	 	// $result_product=select("product","where 1 and pid='".$result_cart['pid']."'");		
													// $result_product=select("product","where 1 and pid='".$result_cart['pid']."'");		
													
													
																if($result_ord['order_type_pay']=="pay")
																{
																	$order_type_pay="<strong>ชำระเงินค่าสินค้า</strong>";
																	}	
																else if($result_ord['order_type_pay']=="credit")
																{
																	$order_type_pay="<strong>เครดติ / รอการอนุมัติ</strong>";
																	}	
																	if($result_ord['order_status']=="Order")
																	{
																		$order_status="<strong><font color=#FF0000>สั่งซื้อสินค้า</font></strong>";
																		}
																		else if($result_ord['order_status']=="pay")
																		{
																			$order_status="<strong><font color=#FF6600>แจ้งชำระเงินเรียบร้อย <br>รอการตรวจสอบ</font></strong>";
																			}
																			else if($result_ord['order_status']=="know")
																		{
																			$order_status="<strong><font color=#FF6600>ตอบรับการสั่งซื้อ</font></strong>";
																			}
																			else if($result_ord['order_status']=="send")
																		{
																			$order_status="<strong><font color=#FF6600>จัดส่งสินค้า</font></strong>";
																			}
																				else if($result_ord['order_status']=="cancle")
																		{
																			$order_status="<strong><font color=#FF0000>ปฏิเสธการสั่งซื้อ</font></strong>";
																			}
																				else if($result_ord['order_status']=="success")
																		{
																			$order_status="<strong><font color=#009900>ส่งมอบสินค้าเรียบร้อย</font></strong>";
																			}
																			else if($result_ord['order_status']=="reject")
																		{
																			$order_status="<strong><font color=#FF0000>ปฏิเสธการส่งมอบ</font></strong>";
																			}
														?>
                
                  <tr>            
             
                     <td><div align="center"><strong><?php  echo $result_ord['order_id'];?></strong></div></td>
                      <td><div align="center"><strong><?php  echo $result_ord['order_date'];?></strong></div></td>
                       <td><div align="center"><strong><?php echo number_format($result_ord['order_sum'],2);?></strong></div></td>
                        <td><div align="center"><?php echo $order_type_pay;?></div></td>
                           
                             <td>
                             <div align="center">
							 <?php echo $order_status;?>
                           
                             </div>
                             </td>        
                                
                         <td>
                         <div align="center">               
                      <div class="product-details">
        	<div class="add-to-cart">							
								<a href="index.php?link=14&order_id=<?php  echo $result_ord['order_id'];?>"><button class="add-to-cart-btn" type="button"><i class="fa fa-info-circle"></i> Detail</button>  </a> 
                                </div>
							</div>
                            </div>      
                         </td>
                         
                              <td>
                         <div align="center"> 
                         <?php 
                         if($result_ord['order_status']=="know")
																		{
																			echo $order_status="<strong><font color=#FF6600>ดำเนินการจัดส่งสินค้า</font></strong>";
																			}		
                              else if($result_ord['order_status']=="send")
																		{	
																		echo "<strong>ข้อมูลการส่งสินค้า</strong><br>";																
																	// $result_shipping=select("shipping","where 1 and order_id='".$result_ord['order_id']."'");		
																	 $sql_shipping="select * from shipping where order_id='".$result_ord['order_id']."'";
																	 $query_shipping=mysqli_query($con,$sql_shipping);
																	 $result_shipping=mysqli_fetch_array($query_shipping);
																	 
																	echo $result_shipping['id_RB']."<br>";
																	echo  $result_shipping['date_RB']."<br>";
																	 echo  $result_shipping['time_RB']." น. <br>";
																			}				
																				else if($result_ord['order_status']=="cancle")
																		{
																			echo $order_status="<strong><font color=#FF0000>ปฏิเสธการสั่งซื้อ</font></strong>";
																			}		
																		else if($result_ord['order_status']=="success")
																		{
																			echo $order_status="<strong><font color=#009900>ส่งมอบสินค้าเรียบร้อย</font></strong>";
																			}
																			else
																			{
						 ?>              
                      <div class="product-details">
        	<div class="add-to-cart">							
								<a href="index.php?link=15&Action=payment&order_id=<?php  echo $result_ord['order_id'];?>"><button class="add-to-cart-btn" type="button"><i class="fa fa-bell"></i> แจ้ง</button>  </a> 
                                </div>
							</div>
                            
                            <?php 
																			}
							?>
                            </div>      
                         </td>
                         <td>
                         
                              <div align="center">               
                      <div class="product-details">
        	<div class="add-to-cart">							
								<a href="index.php?link=16&order_id=<?php  echo $result_ord['order_id'];?>&Action=PrintPDF" target="_blank">
                                        <button class="add-to-cart-btn" type="button"><i class="fa fa-print"></i> พิมพ์</button> 
          </button>
          </a>
                                </div>
							</div>
                            </div>      
                         
                         
                             
                         </td>
                  </tr>                       
                  <?php 			
				  
				   }
				    ?>             
                </tbody>
              </table>            
          </div>
          
          
          
          <div class="card-footer small text-muted"></div>
          
        </div>                    
        
                            </div><!-- stop row 2 -->                      
                            <div class="row"> 
                            
                            
                                                       
                            </div>
					</div>
					<!-- /STORE -->
                    
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
            	
		</div>
		<!-- /SECTION -->