<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">หน้าแรก</a></li>
							<li><a href="index.php?link=5">หมวดหมู่สินค้า</a></li>
							<li class="active">สินค้า</li>
					
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
							<h3 class="aside-title">หมวดหมู่สินค้าหลัก</h3>
							<div class="checkbox-filter">
        <?php 		
													  $ii=0;
													  $sql_cata = "select * From catagory ORDER BY cat_id ASC";															  											
														 $query_cata = mysqli_query($con,$sql_cata);
														 while($result_cata=mysqli_fetch_array($query_cata))
														 { 																																						
														 $sql_product = "select * From product Where cat_id='".$result_cata['cat_id']."'";													
														 $query_product = mysqli_query($con,$sql_product);
														$num_rows = mysqli_num_rows($query_product);																														
														?>									
		<div class="product-body">
						<h5 class="product-name"><a href="index.php?link=5&Action=select&cat_id=<?php  echo $result_cata['cat_id']?>"><i class="fa fa-chevron-circle-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $result_cata['cat_name'];?> <small> (<?php echo $num_rows;?>) </small></i></a></h5>
                        
                                </div>
<?php  } ?>

						
							</div>
						</div>					
                        
                        
                        <div class="aside">
							<h3 class="aside-title">หมวดหมู่สินค้าย่อย</h3>
							<div class="checkbox-filter">
        <?php 		
													
													  $sql_catagory_sub = "select * From catagory_sub ORDER BY cat_parent_id  ASC";			
														 $query_catagory_sub = mysqli_query($con,$sql_catagory_sub);
														 while($result_catagory_sub=mysqli_fetch_array($query_catagory_sub))
														 { 																																						
														 $sql_product_sub = "select * From product Where cat_sub_id='".$result_catagory_sub['cat_parent_id']."'";													
														 $query_product_sub = mysqli_query($con,$sql_product_sub);
														$num_rows_sub = mysqli_num_rows($query_product_sub);																														
														?>
		<div class="product-body">
						<h5 class="product-name"><a href="index.php?link=5&Action=select_sub&cat_parent_id=<?php  echo $result_catagory_sub['cat_parent_id']?>"><i class="fa fa-chevron-circle-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $result_catagory_sub['name_sub'];?> <small> (<?php echo $num_rows_sub;?>) </small></i></a></h5>
                                </div>
<?php  } ?>						
							</div>
						</div>		
                        						
					</div>


					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">									
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="index.php?link=6"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						
                        
                        
                         <div class="row"><!-- row 2 -->                    
                            <div class="col-md-12"> <!-- ตำแหน่ง -->
                                         		                                            
                                                      <?php 		
													  	
													  
													  
													  echo"<table align=center><tr>";	
													  //$i=0;
													  //$sql = "select * From product";
													   $perpage = 21;
														 if (isset($_GET['page'])) {
														 $page = $_GET['page'];
														 } else {
														 $page = 1;
														 }														 
														 $start = ($page - 1) * $perpage;														 
														 $sql = "select * from product ";
														 
														 	 $text_search='';															 
														 	if(isset($_GET["Action"]))
															{	
															if($_GET["Action"]=="select")		
																	{																				
																		$sql .= "  Where cat_id='".$_GET['cat_id']."' order by pid ASC limit {$start} , {$perpage}";								
																		}	
																		
														if($_GET["Action"]=="select_sub")		
														{																
															$sql .= "  Where cat_sub_id='".$_GET['cat_parent_id']."' order by pid ASC limit {$start} , {$perpage}";								
															}	
															}
															
														
													
														
													
															
																 $query = mysqli_query($con, $sql);
															 while($result=mysqli_fetch_array($query))	
														 { 
														 
														 
														 
														 	 //$result_cat=select("catagory","where 1 and cat_id='".$result['cat_id']."'");		
														 $sql_catagory = "select * From catagory Where cat_id='".$result['cat_id']."'";													
														 $query_catagory = mysqli_query($con,$sql_catagory);
														 $result_cat=mysqli_fetch_array($query_catagory);
															 												  
														  // $result_cat_sub=select("catagory_sub","where 1 and cat_parent_id='".$result['cat_sub_id']."'");		
														 $sql_catagory_sub = "select * From catagory_sub Where cat_parent_id='".$result['cat_sub_id']."'";													
														 $query_catagory_sub = mysqli_query($con,$sql_catagory_sub);
														 $result_cat_sub=mysqli_fetch_array($query_catagory_sub);
														   
														 $i++;
														 	echo "<td>";
														?>
                                                        <table>     
                                                        <tr>
                                                        <td>
                                                        <div align="center">
                                                        	<div class="col-md-12">                                                            				                                        
                                                        	<div class="product">
											<div class="product-img">
											<?PHP echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['p_img'] ).'" width="200" height="200"/>';  ?>
											</div>
											<div class="product-body">
												<p class="product-category"><?php  echo $result_cat['cat_name'];?></p>
                                                <p class="product-category"><?php  echo $result_cat_sub['name_sub'];?></p>                                                
												<h3 class="product-name"><a href="#"><?php  echo $result['p_name'];?></a></h3>
												<h4 class="product-price">฿ <?php  echo number_format($result['p_price'],2);?></h4>
												<div class="product-rating">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
												</div>
												<div class="product-btns">
																																					<button class="quick-view"><a href="index.php?link=4&pid=<?php  echo $result['pid'];?>"><i class="fa fa-eye"></i><span class="tooltipp">รายละเอียดสินค้า</span></a></button>
												</div>
											</div>
											<div class="add-to-cart">
											<button class="add-to-cart-btn"><a href="index.php?link=8&pid=<?php  echo $result['pid'];?>"><i class="fa fa-shopping-cart"></i> add to cart</a></button>
											</div>
										</div>
										<!-- /product -->
                                                          				</div>		
                                                          </div></td>                                                     
                                                        </tr>      
                           </table>                                             
												  <?php 
										//============ แสดงแถวละ สอง
																						echo"</td>";
																		if(($i)%3==0)
																		{
																		echo"</tr>";
																		}
																		else
																		{
																		echo "<td>";
																			}							  
									}
									echo"</tr></table>";
									
									if($i==0)
									{
									echo "<strong><center><font color=red>ยังไม่มีสมาชิก</font></center></strong>";
									}
									?>
                                
                        </div>                        
                            </div><!-- stop row 2 -->
                            
                                                    
						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">หน้าสินค้าทั้งหมด</span>
							<ul class="store-pagination">
                               <?php 
							   $sql2 = "select * from product ";
							   	 	 $text_search='';															 
														 	if(isset($_GET["Action"]))
															{	
												if($_GET["Action"]=="select")		
														{
															
															$sql2 .= "  Where cat_id='".$_GET['cat_id']."'";								
																   
 $query2 = mysqli_query($con, $sql2);
 $total_record = mysqli_num_rows($query2);
 $total_page = ceil($total_record / $perpage);
																			
																				?>     
													<?php for($i=1;$i<=$total_page;$i++){ ?>
 <li><a href="index.php?link=5&Action=select&cat_id=<?php echo $_GET['cat_id'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 <?php } ?>
 <li>
 <a href="index.php?link=5index.php?link=5&Action=select&cat_id=<?php echo $_GET['cat_id'];?>&page=<?php echo $total_page;?>" aria-label="Next">
 <span aria-hidden="true">&raquo;</span>
 <?php } }?>
 
 
     <?php 
	 
							   $sql3 = "select * from product ";
							   	 	 $text_search='';															 
														 	if(isset($_GET["Action"]))
															{	
												if($_GET["Action"]=="select_sub")		
														{																
															$sql3 .= "  Where cat_sub_id='".$_GET['cat_parent_id']."'";								
																	
																   
 $query3 = mysqli_query($con, $sql3);
 $total_record3 = mysqli_num_rows($query3);
 $total_page3 = ceil($total_record3 / $perpage);
																			
																				?>     
													<?php for($i=1;$i<=$total_page3;$i++){ ?>
 <li><a href="index.php?link=5&Action=select_sub&cat_parent_id=<?php echo $_GET['cat_parent_id'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
 <?php } ?>
 <li>
 <a href="index.php?link=5index.php?link=5&Action=select_sub&cat_parent_id=<?php echo $_GET['cat_parent_id'];?>&page=<?php echo $total_page;?>" aria-label="Next">
 <span aria-hidden="true">&raquo;</span>
 <?php } }?>
 
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->