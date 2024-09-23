<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->                    
                       <?php						
													  $i=0;
													  if(isset($_POST['catagory']) or isset($_POST['text_search']))
													  {
													  $catagory=$_POST['catagory'];
													 $text_search=$_POST['text_search'];				
													  }
													  $sql = "select * From catagory";
													  
													
													  if(isset($_GET["Action"])=="Search")			
													{															
															if($catagory=="0" and $text_search=="")
															{
																$sql .= "  Where 1 order by cat_id ASC";	
																}																
																else if($catagory<>"0")
																{
																	$sql .= "  Where cat_id='".$catagory."' order by cat_id ASC";		
																	}
																	else if( $text_search<>"")
																{
																		$sql .= "  Where cat_name like '%".$text_search."%' order by cat_id ASC";
																}
															}		
															else
															{
																$sql .= "  Where 1 order by cat_id ASC";		
																}									
														 $query = mysqli_query($con,$sql);
														 while($result=mysqli_fetch_array($query))
														 { 												
														?>
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="" width="" height="" alt="">
							  <?PHP echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['p_img'] ).'" width="200" height="200"/>';  ?>
							</div>
							<div class="shop-body">
								<h3>หมวดหมู่ <br><?=$result['cat_name'];?></h3>
								<a href="index.php?link=5&Action=select&cat_id=<?=$result['cat_id']?>" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
<?php
 }
								  
  ?>
				
				</div>
				<!-- /row -->
			</div>
            
            <?php 	
				 	if(isset($_GET["Action"]))
															{																
													if($_GET["Action"]=="Search")		
														{
															//echo "Search";													
														if($text_search<>"")
															{
																//echo $_POST['text_search'];
			include "product_all.php";		
															}
														}
															}
			
			?>