<?php 

$_SESSION['sess_ID_m'];
// $result_member=select("member","where 1 and ID_m='".$_SESSION['sess_ID_m']."'");
 
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
                    <li class="active">ยืนยันที่อยู่ที่จัดส่ง</li>
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
                        <table>

                            <tr>
                                <td>
                                    ชื่อผู้รับสินค้า :
                                </td>
                                <td>
                                    <strong> <?php  echo $result_member['name_m'];?></strong>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    เบอร์โทรติดต่อ :
                                </td>
                                <td>
                                    <strong> <?php  echo $result_member['tel_m'];?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    บ้านเลขที่ :
                                </td>
                                <td>
                                    <strong> <?php  echo $result_member['add_m'];?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    ตำบล :
                                </td>
                                <td>
                                    <strong> <?php					    
					   // echo $result_member['add_m2'];
						$sql_add_m2="select * from districts where id='".$result_member['add_m2']."'";
						$query_add_m2=mysqli_query($con,$sql_add_m2);
						$result_add_m2=mysqli_fetch_array($query_add_m2);
						echo $result_add_m2['name_th'];
						
						?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    อำเภอ :
                                </td>
                                <td>
                                    <strong> <?php  
					// echo $result_member['add_m3'];
					 
					 	$sql_add_m3="select * from amphures where id='".$result_member['add_m3']."'";
						$query_add_m3=mysqli_query($con,$sql_add_m3);
						$result_add_m3=mysqli_fetch_array($query_add_m3);
						echo $result_add_m3['name_th'];
						
					 ?></strong>

                                </td>
                            </tr>

                            <tr>
                                <td>
                                    จังหวัด :
                                </td>
                                <td>
                                    <strong> <?php 
					//  echo $result_member['add_m4'];
					  	$sql_add_m4="select * from provinces where id='".$result_member['add_m4']."'";
						$query_add_m4=mysqli_query($con,$sql_add_m4);
						$result_add_m4=mysqli_fetch_array($query_add_m4);
						echo $result_add_m4['name_th'];
					  
					  ?></strong>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    รหัสไปรษณีย์ :
                                </td>
                                <td>
                                    <strong> <?php  echo $result_member['add_m5'];?></strong>
                                </td>
                            </tr>

                        </table>

                    </div>
                </div>
                <!-- /Billing Details -->
            </div>

            <!-- Order Details -->
            <div class="col-md-8 order-details">
                <div class="section-title text-center">
                    <h3 class="title">รายการสั่งซื้อของคุณ</h3>
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
													  
													  $sql_cart = "select * From cart Where id_mem='".$_SESSION['sess_ID_m']."' order by pid ASC";		
														$query_cart = mysqli_query($con,$sql_cart);
														
															/*$result_num = mysqli_query("SELECT * FROM cart where id_mem='".$_SESSION['sess_ID_m']."'"); 
															$num_rows = mysqli_num_rows($result_num);*/
															
															 $sql_cart = "select * From cart Where id_mem='".$_SESSION['sess_ID_m']."'";													
                                                            	$query_cart = mysqli_query($con,$sql_cart);
                                                            	$num_rows = mysqli_num_rows($query_cart);
                                                            	
	                                                            //$result_member=mysqli_fetch_array($query_cart);
															
															
														 while($result_cart=mysqli_fetch_array($query_cart))
														 { 
														 
														 	 	 //$result_product=select("product","where 1 and pid='".$result_cart['pid']."'");	
														 	 	 
														 	 	 
														 	 	 $sql_product = "select * From product Where pid='".$result_cart['pid']."'";													
                                                            	$query_product = mysqli_query($con,$sql_product);
														 	 	$result_product=mysqli_fetch_array($query_product);
														 	 	 
														?>

                        <div class="order-col">
                            <div><?php echo $result_product['p_name'];?> ( <?php  echo $result_cart['cart_qty'];?> x
                                <?php  echo $result_cart['p_price'];?> ฿)</div>
                            <div>฿ <?php echo number_format($result_cart['cart_qty']*$result_cart['p_price'],2);?></div>
                        </div>

                        <?php  
											 $sum=$result_cart['cart_qty']*$result_cart['p_price'];
											 $sum_total=$sum_total+$sum;
											} 
											
											?>
                    </div>
                    <div class="order-col">
                        <div><strong>รวมทั้งสิ้น : </strong></div>
                        <div><strong class="order-total">฿ <?php  echo number_format($sum_total,2);?></strong></div>
                    </div>
                </div>

                <form id="form1" name="form1" method="post" action="index.php?link=12">
                    <input name="order_sum" type="hidden" id="order_sum" value="<?php  echo $sum_total;?>" />
                    <div class="payment-method">
                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment1" value="payment1">
                            <label for="payment1">
                                <span></span>
                                ชำระเงินผ่านบัญชีธนาคาร
                            </label>

                            <div class="caption">

                                <?php 
                                		  $sql_book_bank = "select * From book_bank order by id_book ASC";		
							 $query_book_bank = mysqli_query($con,$sql_book_bank);								
														 while($result_book_bank=mysqli_fetch_array($query_book_bank))
														 { 
								?>
                                <p> <?php echo $result_book_bank['name_bank']." <font color=#FF0000>".$result_book_bank['id_book_bank']."</font> บช.".$result_book_bank['name_book'];?>
                                </p>
                                <?php  }  ?>
                            </div>
                        </div>

                        <div class="input-radio">
                            <input type="radio" name="payment" id="payment2" value="payment2">
                            <label for="payment2">
                                <span></span>
                                เครดิต
                            </label>
                            <div class="caption">
                                <p>กรณีเป็นหน่วยงานราชการ / องค์กรที่ได้รับอนุญาต</p>
                            </div>
                        </div>

                    </div>
                    <div class="input-checkbox">
                        <input type="checkbox" id="terms" name="terms" value="true_s">
                        <label for="terms">
                            <span></span>
                            ฉันยอมรับและขอยืนยันการสั่งซื้อสินค้า หลักจากที่ชำระเงินเรียบร้อย
                            กรุณายืนยันในประวัติการสั่งซื้อด้วยคะ
                        </label>
                    </div>

                    <div class="product-details">
                        <div class="add-to-cart">

                            <button class="add-to-cart-btn"><i class="fa fa-check-square-o"></i> ขั้นตอนสุดท้าย
                                ยืนยันการชำระเงิน</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /Order Details -->
</div>
<!-- /row -->
</div>
<!-- /container -->
</div>
<!-- /SECTION -->