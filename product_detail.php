<?php		
	
 
    $sql_product = "select * From product Where pid='".$_GET['pid']."'";													
	$query_product = mysqli_query($con,$sql_product);
    $result_product=mysqli_fetch_array($query_product);
  
  
if($result_product=="")
{
header('Location: index.php');
exit;
	
}				


     $sql_catagory = "select * From catagory Where cat_id='".$result_product['cat_id']."'";													
	$query_catagory = mysqli_query($con,$sql_catagory);
    $result_cat=mysqli_fetch_array($query_catagory);
  
 
 
 
  						
														  
	$sql_catagory_sub = "select * From catagory_sub Where cat_parent_id='".$result_product['cat_sub_id']."'";													
	$query_catagory_sub = mysqli_query($con,$sql_catagory_sub);
    $result_catsub=mysqli_fetch_array($query_catagory_sub);
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
							<li><a href="#"><?=$result_cat['cat_name'];?></a></li>
							<li><a href="#"><?=$result_catsub['name_sub'];?></a></li>
							<li class="active"><?=$result_product['p_name'];?></li>
							
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
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
                    	<div id="product-main-img">
                        
							<div class="product-preview">
									  <?PHP echo '<img src="data:image/jpeg;base64,'.base64_encode( $result_product['p_img'] ).'"/>';  ?>								  
							</div>            
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
                        
							<div class="product-preview">							
								   <?PHP echo '<img src="data:image/jpeg;base64,'.base64_encode( $result_product['p_img'] ).'"/>';  ?>
							</div>					

						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
                    
						<div class="product-details">
                        <h2 class="product-name">รหัสสินค้า : <?=$result_product['pid'];?></h2>
							<h2 class="product-name"><?=$result_product['p_name'];?></h2>
							<div>														
							</div>
                            
							<div>
								<h3 class="product-price">฿ <?=$result_product['p_price'];?> บาท  </h3>
								<span class="product-available">สินค้าคงเหลือ <?=$result_product['p_total']."  ".$result_product['unit_name'];?> </span>
							</div>
							<p><?=$result_product['p_desc'];?></p>

							<div class="add-to-cart">
														<button class="add-to-cart-btn"><a href="index.php?link=8&pid=<?php  echo $result_product['pid'];?>"><i class="fa fa-shopping-cart"></i> add to cart</a></button>
							</div>
							
                            <ul class="product-links">
								<li>Category:</li>
						<li><a href="#"><?=$result_cat['cat_name'];?></a></li>
							<li><a href="#"><?=$result_catsub['name_sub'];?></a></li>
							</ul>
						
						</div>
					</div>
		

				
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
        <br  />
        <?
        include 'product_group.php';
		?>