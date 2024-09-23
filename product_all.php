		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
						
					<!-- STORE -->
					<div id="store" class="col-md-12">                        
                         <div class="row"><!-- row 2 -->                    
                            <div class="col-md-12"> <!-- ตำแหน่ง -->
                                         		                                            
                                                      <?php 		
													  echo"<table align=center><tr>";																														 
														 $sql = "select * from product ";
														 	 $text_search='';															 
														 	if(isset($_GET["Action"]))
															{																
													if($_GET["Action"]=="Search")		
														{
															//echo "Search";													
														if(isset($_POST['text_search']))
															{
															//echo $text_search=$_POST['text_search'];															
															$sql .= "  Where p_name like '".$_POST['text_search']."%' order by pid ASC";	
															}	
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
												<img src="administrator/fileUpload/<?php  echo $result['p_img'];?>" alt="<?php  echo $result['p_name'];?>" width="90" height="240">											
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
									
																						echo"</td>";
																		if(($i)%4==0)
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
									echo "<strong><center><font color=red>ยังไม่มีสินค้า</font></center></strong>";
									}
									?>
                                
                        </div>                        
                            </div><!-- stop row 2 -->				
					</div>
					<!-- /STORE -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->