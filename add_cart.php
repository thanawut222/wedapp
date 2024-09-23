<?php 

  if(isset($_SESSION['sess_ID_m'])=='')
{
	?>
    <script language="javascript">
				alert("กรุณา Login เข้าใช้งานระบบด้วยนะคะ");
				window.location.href="index.php";
			</script>	
    
    <?php 
	
}
if(isset($_GET["Action"])=="Delete")
{
		$SQL="DELETE FROM cart WHERE pid='".$_GET['pid']."'";
	$RESULT=mysqli_query($con,$SQL);
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
							<li class="active">ตะกร้าสินค้าของคุณ</li>
					
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
							<h3 class="aside-title">สินค้าของคุณ :</h3>
							<div class="checkbox-filter">

        <?php 		
													  $ii=0;
													  $sum_total=0;
													  $sql_cata = "select * From cart Where id_mem='".$_SESSION['sess_ID_m']."' ORDER BY cart_id ASC";													
														 $query_cata = mysqli_query($con,$sql_cata);
														 while($result_cata=mysqli_fetch_array($query_cata))
														 { 		
														 	 //$result_product=select("product","where 1 and pid='".$result_cata['pid']."'");																																								
														  /*$result_num = mysqli_query("SELECT * FROM cart where id_mem='".$result_cata['cat_id']."'"); 
															$num_rows = mysqli_num_rows($result_num);*/
															
														$sql_product3 = "select * From product Where pid='".$result_cata['pid']."'";													
														 $query_product3 = mysqli_query($con,$sql_product3);
														 $result_product=mysqli_fetch_array($query_product3);
															
															
															
															 $result_cata['p_price'];
															 $result_cata['cart_qty'];
															 $sum=$result_cata['p_price']*$result_cata['cart_qty'];	
															 $sum_total=$sum_total+$sum;									
														?>

								
									
		<div class="product-body">
						<h5 class="product-name"><a href="index.php?link=7&Action=select&cat_id=<?php  echo $result_cata['cart_id']?>"><i class="fa fa-chevron-circle-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $result_product['p_name'];?> <small> (<?php  echo $result_cata['cart_qty'];?>) </small></i></a></h5>
                                </div>                               
                                
<?php 
 } 
echo "<font color=#FF0000><strong>ยอดเงินรวม : ".number_format($sum_total,2)." บาท</strong></font>";
?>

				      <div class="product-details">
        	<div class="add-to-cart">
             <form id="form1" name="form1" method="post" action="index.php?link=11">		
                                	<button class="add-to-cart-btn"><i class="fa fa-check-square-o"></i> ยืนยันการสั่งซื้อ</button>
                                    </form>
							</div>
                            </div>      
                            
                            		
							</div>
						</div>							
					</div>


                 <form id="add_cart" name="add_cart" method="post" action="index.php?link=9" enctype="multipart/form-data">           
                        
                         <div class="row"><!-- row 2 -->                    
                     <div class="product-details">
        	<div class="add-to-cart">							
								<button class="add-to-cart-btn"><i class="fa fa-pencil-square-o"></i> แก้ไขจำนวนการสั่งซื้อ</button>                           
                         
							</div>
                            </div>      
                    
                        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>                                    
                 <th><div align="center">รหัสสินค้า</div></th>
                     <th><div align="center">ชื่อสินค้า</div></th>
                       <th><div align="center">ราคา</div></th>
                         <th><div align="center">หน่วย</div></th>                     
                             <th><div align="center">ภาพประกอบ</div></th>     
                              <th><div align="center">ดำเนินการ</div></th>      
                              <th><div align="center">รวม</div></th>          
                              <th><div align="center">ดำเนินการ</div></th>               
                  </tr>
                </thead>             
                <tbody>
                
                   <?php 		
											 $sum_totalb=0;
													  $sql_cart = "select * From cart Where id_mem='".$_SESSION['sess_ID_m']."' order by pid ASC";		
														$query_cart = mysqli_query($con,$sql_cart);
														 while($result_cart=mysqli_fetch_array($query_cart))
														 { 
														 
													
														 $sql_product3 = "select * From product Where pid='".$result_cart['pid']."'";													
														 $query_product3 = mysqli_query($con,$sql_product3);
														 $result_product=mysqli_fetch_array($query_product3);
															
														 	 	 
														 	 	 
														 	 	 
														?>
                
                  <tr>            
                
                     <td><div align="center"><?php  echo $result_cart['pid'];?></div></td>
                      <td><?php echo $result_product['p_name'];?></td>
                       <td><div align="center"><?php  echo $result_product['p_price'];?></div></td>
                        <td><div align="center"><?php echo $result_product['unit_name'];?></div></td>
                         <td><div align="center">
												 <?PHP echo '<img src="data:image/jpeg;base64,'.base64_encode( $result_product['p_img'] ).'" width="200" height="200"/>';  ?>
							</div></td>    
          
                                                 <td>    
                     <div align="center">               
                                           	<div class="product-details">      
											<div class="add-to-cart">
								<div class="qty-label">									
									<div class="input-number">
										<input type="number" id="cart_qty[]" name="cart_qty[]" value="<?php  echo $result_cart['cart_qty'];?>">
                                            <input name="id_mem" type="hidden" id="id_mem" value="<?php echo $_SESSION['sess_ID_m'];?>" />
			<input name="cart_id[]" type="hidden" id="cart_id[]" value="<?php  echo $result_cart['cart_id'];?>" />
			<input name="pid[]" type="hidden" id="pid[]" value="<?php  echo $result_cart['pid'];?>" />
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								
							</div>
									</div>
                   </div>
                     </td>
                         <td>
                         <div align="center"><?php echo number_format($sumb=$result_product['p_price']*$result_cart['cart_qty'],2);?></div>
                     
                         
                         </td>
                         <td>
                         
                         <script language="JavaScript">
																	function Conf<?php  echo $result_cart["pid"]; ?>(object) {
																	if (confirm("ยืนยันการลบ [ <?php echo $result_product['p_name']; ?> ] ") ==true) {
																	return true;
																	}
																	return false;
																	}																	
															</script>
                                                            
                      <div class="product-details">
        	<div class="add-to-cart">							
								<a href="index.php?link=7&Action=Delete&pid=<?php  echo $result_cart['pid'];?>" onClick="return Conf<?php  echo $result_cart["pid"]; ?>(this)"><button class="add-to-cart-btn" type="button"><i class="fa fa-ban"></i> ลบรายการ</button>  </a> 
							</div>
                            </div>      
                         
                         </td>
                     
                     
                  </tr>
                  <tr>
                  
                  </tr>
                  
                  <?php 
				  
				  $sum_totalb=$sum_totalb+$sumb;
				   }
				    ?>
                    <td></td>
                     <td></td>
                      <td></td>
                       <td></td>
                        <td></td>
                         <td><div align="center"><font color="#FF0000"><strong> รวมเป็นเงินทั้งสิ้น : ฿ </strong></font></div></td>
                 <td><div align="center"><font color="#FF0000"><strong><?php  echo number_format($sum_totalb,2);?></strong></font></div></td>
                 <td></td>
                </tbody>
              </table>
                
                     <div class="product-details">
        	<div class="add-to-cart">							
								<a href="index.php?link=10"><button class="add-to-cart-btn" type="button"><i class="fa fa-ban"></i> ยกเลิกการสั่งซื้อ</button>  </a> 
							</div>
                            </div>      
      
            
          </div>
          
          
          
          <div class="card-footer small text-muted"></div>
          
        </div>                    
        
                            </div><!-- stop row 2 -->   
                            </form>
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