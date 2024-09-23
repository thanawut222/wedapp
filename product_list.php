
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
														      $sql_cata = "SELECT * FROM product where cat_id='".$result_cata['cat_id']."'";	
														  $result_num = mysqli_query($con,$sql_cata); 
															$num_rows = mysqli_num_rows($result_num);
														?>
		<div class="product-body">
						<h5 class="product-name"><a href="index.php?link=6&Action=select&cat_id=<?php  echo $result_cata['cat_id']?>"><i class="fa fa-chevron-circle-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $result_cata['cat_name'];?> <small> (<?php echo $num_rows;?>) </small></i></a></h5>
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
						<h5 class="product-name"><a href="index.php?link=6&Action=select_sub&cat_parent_id=<?php  echo $result_catagory_sub['cat_parent_id']?>"><i class="fa fa-chevron-circle-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;<?php  echo $result_catagory_sub['name_sub'];?> <small> (<?php echo $num_rows_sub;?>) </small></i></a></h5>
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
								<li><a href="index.php?link=5"><i class="fa fa-th"></i></a></li>
								<li class="active"><i class="fa fa-th-list"></i></li>
							</ul>
						</div>
						<!-- /store top filter -->

						
                        
                        
                         <div class="row"><!-- row 2 -->                    
                    
                    
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
                  </tr>
                </thead>
                <tfoot>
                  <tr>           
                           <th><div align="center">รหัสสินค้า</div></th>
                     <th><div align="center">ชื่อสินค้า</div></th>
                       <th><div align="center">ราคา</div></th>
                         <th><div align="center">หน่วย</div></th>                     
                             <th><div align="center">ภาพประกอบ</div></th>      
                              <th><div align="center">ดำเนินการ</div></th>                
                  </tr>
                </tfoot>
                <tbody>
                
                   <?php 		
													  $i=0;
													  $sql = "select * From product";													
												
															 
														 	if(isset($_GET["Action"]))
															{	
															if($_GET["Action"]=="select")		
																	{																				
																		$sql .= "  Where cat_id='".$_GET['cat_id']."' order by pid ASC";								
																		}	
																		
														if($_GET["Action"]=="select_sub")		
														{																
															$sql .= "  Where cat_sub_id='".$_GET['cat_parent_id']."' order by pid ASC";								
															}	
															}
														$query = mysqli_query($con,$sql);
														 while($result=mysqli_fetch_array($query))
														 { 
														?>
                
                  <tr>            
                
                     <td><div align="center"><?php  echo $result['pid'];?></div></td>
                      <td><?php  echo $result['p_name'];?></td>
                       <td><div align="center"><?php  echo $result['p_price'];?></div></td>
                        <td><div align="center"><?php  echo $result['unit_name'];?></div></td>
                         <td>   
                         <div align="center">
                         <div class="product">
                        	<div class="product-body">
                         	<div class="product-btns">
							 <?PHP echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['p_img'] ).'" width="200" height="200"/>';  ?>
                         	<button class="quick-view"><a href="index.php?link=4&pid=<?=$result['pid'];?>"><i class="fa fa-eye"></i><span class="tooltipp">รายละเอียดสินค้า</span></a></button>
												</div>
                                                </div>
                                                </div>
                         </div>
                         </td>    
          
                                                 <td>    
                     <div align="center">  
                     
                                           	<div class="product-details">      
											<div class="add-to-cart">	
									<button class="add-to-cart-btn"><a href="index.php?link=8&pid=<?php  echo $result['pid'];?>"><i class="fa fa-shopping-cart"></i> add to cart</a></button>
							</div>
									</div>
                                    
                                    
                   </div>
                     </td>
                  </tr>
                  
                  <?php  } ?>
             
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted"></div>
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