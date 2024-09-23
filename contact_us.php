<?php		
 
$sql="SELECT * FROM data_shop"; 
$query=mysqli_query($con,$sql);
$rs=mysqli_fetch_array($query);

$name_shop=$rs['name_shop'];
$tel_s=$rs['tel_s'];
$fax_s=$rs['fax_s'];
$email_s=$rs['email_s'];
$addres_s=$rs['addres_s'];
$pic_logo	=$rs['pic_logo'];

														?>
                                                        
<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="index.php">หน้าแรก</a></li>				
							<li class="active">ติตต่อเรา</li>
							
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
				            
					<div class="col-md-12">      
                                  <table width="100%">
                                  <tr>
                                  <td width="20%">
                                  		<div class="product-details">
                        <h2 class="product-name"><i class="fa fa-building" aria-hidden="true"></i> ชื่อร้าน/บริษัท : </h2>					 
							<div>		  
                                  </td>
                                      <td width="80%">
                                      <div class="product-details">
                        <h2 class="product-name"><?=$name_shop?></h2>					 
							<div>		  
                                  </td>
                                  </tr>
                                     <tr>
                                  <td width="20%">
                                  		<div class="product-details">
                        <h2 class="product-name"><i class="fa fa-phone-square" aria-hidden="true"></i> เบอร์โทรติดต่อ : </h2>					 
							<div>		  
                                  </td>
                                      <td width="80%">
                                      <div class="product-details">
                        <h2 class="product-name"><?=$tel_s?></h2>					 
							<div>		  
                                  </td>
                                  </tr>
                                  
                                  <tr>
                                  <td width="20%">
                                  		<div class="product-details">
                        <h2 class="product-name"><i class="fa fa-fax" aria-hidden="true"></i> Fax : </h2>					 
							<div>		  
                                  </td>
                                      <td width="80%">
                                      <div class="product-details">
                        <h2 class="product-name"><?=$fax_s?></h2>					 
							<div>		  
                                  </td>
                                  </tr>
                                  
                                      <tr>
                                  <td width="20%">
                                  		<div class="product-details">
                        <h2 class="product-name"><i class="fa fa-envelope-o" aria-hidden="true"></i> Email : </h2>					 
							<div>		  
                                  </td>
                                      <td width="80%">
                                      <div class="product-details">
                        <h2 class="product-name"><?=$email_s?></h2>					 
							<div>		  
                                  </td>
                                  </tr>
                                  
                                   
                                      <tr>
                                  <td width="20%">
                                  		<div class="product-details">
                        <h2 class="product-name"><i class="fa fa-address-book" aria-hidden="true"></i> ที่อยู่ : </h2>					 
							<div>		  
                                  </td>
                                      <td width="80%">
                                      <div class="product-details">
                        <h2 class="product-name"><?=$addres_s?></h2>					 
							<div>		  
                                  </td>
                                  </tr>
                                  </table>
                                                                                        											
							</div>
						</div>
					</div>
		

				
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
        <br  />