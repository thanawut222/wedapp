	<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">หน้าแรก</a></li>
							<li><a href="index.php?link=">บัญชีธนาคาร</a></li>
							<li class="active">บัญชีธนาคาร</li>
					
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
														     
														     
														     $sql_product = "select * From product where cat_id='".$result_cata['cat_id']."'";													
														 $query_product = mysqli_query($con,$sql_product);
															$num_rows = mysqli_num_rows($query_product);
															
																													
														?>

								
									
		<div class="product-body">
						<h5 class="product-name"><a href="index.php?link=6&Action=select&cat_id=<?=$result_cata['cat_id']?>"><i class="fa fa-chevron-circle-right" aria-hidden="true">&nbsp;&nbsp;&nbsp;&nbsp;<?=$result_cata['cat_name'];?> <small> (<?=$num_rows;?>) </small></i></a></h5>
                                </div>
<?php } ?>

						
							</div>
						</div>							
					</div>


					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
				
						<!-- /store top filter -->
                         <div class="row"><!-- row 2 -->                    
                    
                    
                        <div class="card-body">
            <div class="table-responsive">
   <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>                
               
                      <th><div align="center">5230434430</div></th>      
                 <th><div align="center">นายธนวุฒิ ศรีวิชัย</div></th>
                     <th><div align="center">ธกรุงไหย </div></th>      
                  </tr>
                </thead>
                <tfoot>
                  <tr>           
                             <th><div align="center">เลขบัญชีธนาคาร</div></th>      
                 <th><div align="center">ชื่อบัญชี</div></th>
                     <th><div align="center">ธนาคาร </div></th>  
                  
                  </tr>
                </tfoot>
                <tbody>
                
                   <?php		
													  $i=0;
													  $sql_book = "select * From book_bank ORDER BY id_book ASC";													
														 $query_book= mysqli_query($con,$sql_book);
														 while($result=mysqli_fetch_array($query_book))
														 { 
														?>
                
                  <tr>               
             
                      <td><div  align="center"><?=$result['id_book_bank'];?></div></td>
                       <td><div  align="center"><?=$result['name_book'];?></div></td>
                        <td><div  align="center"><?=$result['name_bank'];?></div></td>       
                                 
   
                  </tr>
                  
                  <?php } ?>
             
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
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