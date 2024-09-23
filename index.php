<?php
include "connect.php";  
if(isset($_SESSION['sess_ID_m']))
$strSQL='';
$strSQL = " SELECT DATE FROM counter LIMIT 0,1";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	if($objResult["DATE"] != date("Y-m-d"))
	{
		//*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
		$strSQL = " INSERT INTO daily (DATE,NUM) SELECT '".date('Y-m-d',strtotime("-1 day"))."',COUNT(*) AS intYesterday FROM  counter WHERE 1 AND DATE = '".date('Y-m-d',strtotime("-1 day"))."'";
		mysqli_query($con,$strSQL);

		//*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
		$strSQL = " DELETE FROM counter WHERE DATE != '".date("Y-m-d")."' ";
		mysqli_query($con,$strSQL);
	}

	//*** Insert Counter ปัจจุบัน ***//
	$strSQL = " INSERT INTO counter (DATE,IP) VALUES ('".date("Y-m-d")."','".$_SERVER["REMOTE_ADDR"]."') ";
	mysqli_query($con,$strSQL);

	//******************** Get Counter ************************//

	// Today //
	$strSQL = " SELECT COUNT(DATE) AS CounterToday FROM counter WHERE DATE = '".date("Y-m-d")."' ";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strToday = $objResult["CounterToday"];

	// Yesterday //
	$strSQL = " SELECT NUM FROM daily WHERE DATE = '".date('Y-m-d',strtotime("-1 day"))."' ";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strYesterday = $objResult["NUM"];

	// This Month //
	$strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '".date('Y-m')."' ";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strThisMonth = $objResult["CountMonth"];

	// Last Month //
	$strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '".date('Y-m',strtotime("-1 month"))."' ";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strLastMonth = $objResult["CountMonth"];

	// This Year //
	$strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '".date('Y')."' ";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strThisYear = $objResult["CountYear"];

	// Last Year //
	$strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '".date('Y',strtotime("-1 year"))."' ";
	$objQuery = mysqli_query($con,$strSQL);
	$objResult = mysqli_fetch_array($objQuery);
	$strLastYear = $objResult["CountYear"];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>sports</title>
	<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="administrator/vendor/datatables/dataTables.bootstrap4.min.css">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<link rel="icon" href="img/logo/logo2.png" type="image/x-icon">
<link rel="shortcut icon" href="img/logo/logo2.png" type="image/x-icon">
    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 064-3430462 , 063-1801527</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> peethanawut47@gmail.com</a></li>
						<li><a href="https://www.google.com/maps/@19.0520886,99.9355585,3a,75y,180.62h,82.59t/data=!3m7!1e1!3m5!1s9MQuHS4ULqUbdSYrnL5v6g!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3D9MQuHS4ULqUbdSYrnL5v6g%26cb_client%3Dsearch.revgeo_and_fetch.gps%26w%3D96%26h%3D64%26yaw%3D248.29208%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192?coh=205409&entry=ttu&g_ep=EgoyMDI0MDkwNC4wIKXMDSoASAFQAw%3D%3D" target="new"><i class="fa fa-map-marker"></i> ม.12 ต.แม่กา อ.เมืองพะเยา จ.พะเยา</a></li>
					</ul>
					<ul class="header-links pull-right">
                    <?php			
				//	echo $ID_m=$_SESSION['sess_ID_m'];	
					//echo $ID_m;
					
if(isset($_SESSION['sess_ID_m']))
{
	$ID_m=$_SESSION['sess_ID_m'];
?>
                    
                    	<li><i class="fa fa-user-o" aria-hidden="true"></i> <?php echo " ".$ID_m;?></li>
                           <li><a href="index.php?link=2"><i class="fa fa-pencil" aria-hidden="true"></i>แก้ไขข้อมูล</a></li>
                            <li><a href="index.php?link=13"><i class="fa fa-history" aria-hidden="true"></i>ประวัติการสั่งซื้อ</a></li>
                         <li><a href="index.php?link=3"><i class="fa fa-sign-out" aria-hidden="true"></i><strong>ออกจากระบบ</strong></a></li>
                        <?php
                        	}
							else
							{
					?>
                    	<form action="login_user.php" name="login" method="post" enctype="multipart/form-data">
      
                    <li><input class="input" type="text" name="u_name" placeholder="ชื่อผู้ใช้งาน"></li>
                        <li><input class="input" type="password" name="p_word" placeholder="รหัสผ่าน"></li>				
                        <button class="primary-btn order-submit" type="submit"><i class="fa fa-sign-in"> Login</i>
          </button>  		
          </form>
          <?php } ?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img//logo/logo1.png" alt="Image" height="120" width="120">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="index.php?Action=Search" method="post" enctype="multipart/form-data">          
									<select class="input-select" name="catagory" id="catagory">                                  
										<option value="0">หมวดค้นหา</option>
                                           <?php												  
													  $sql_cata = "select * From catagory order by cat_id ASC";		
														$query_cata = mysqli_query($con,$sql_cata);												
														 while($result_cata=mysqli_fetch_array($query_cata))
														 { 						
														?>
										<option value="<?php echo $result_cata['cat_id'];?>"><?php echo $result_cata['cat_name'];?></option>
								
                                        <?php } ?>
									</select>
									<input class="input" id="text_search" name="text_search" placeholder="Search here">
									<button class="search-btn" type="submit">Search</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-2 clearfix">
							<div class="header-ctn">							
								<!-- Cart -->
								<div class="dropdown">
                             <?php
                               /*$result_num = mysqli_query("SELECT * FROM cart where id_mem='".$_SESSION['sess_ID_m']."'"); 
								$num_rows = mysqli_num_rows($result_num);*/
								//	$ID_m=isset($_SESSION['sess_ID_m']);	
								$ID_m='';
								if(isset($_SESSION['sess_ID_m']))
								{
										$ID_m=$_SESSION['sess_ID_m'];
									}								
								$sql_cart = "select * From cart Where id_mem='".$ID_m."'";													
								 $query_cart = mysqli_query($con,$sql_cart);
									$num_rows = mysqli_num_rows($query_cart);															
							 ?>
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
										<div class="qty"><?php echo $num_rows; ?></div>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">											                                           
									 <?php		
													  $i=0;												
													  $sum=0;
													  $sum_total=0;	
													  if(isset($_SESSION['sess_ID_m']))
{												  
													  $sql_cart = "select * From cart Where id_mem='".$_SESSION['sess_ID_m']."' order by pid ASC";		
																		 $query_cart = mysqli_query($con,$sql_cart);																		 
														//	$result_num = mysqli_query("SELECT * FROM cart where id_mem='".$_SESSION['sess_ID_m']."'"); 
														//	$num_rows = mysqli_num_rows($result_num);															
																 $sql_cart = "select * From cart Where id_mem='".$_SESSION['sess_ID_m']."'";													
														 $query_cart = mysqli_query($con,$sql_cart);
														 	$num_rows = mysqli_num_rows($query_cart);														 	
														 //$result_cat=mysqli_fetch_array($query_catagory);
														 while($result_cart=mysqli_fetch_array($query_cart))
														 { 
													// $result_product=select("product","where 1 and pid='".$result_cart['pid']."'");														 	 	 
														 	 $sql_product = "select * From product Where pid='".$result_cart['pid']."'";													
														 $query_product = mysqli_query($con,$sql_product);
														 $result_product=mysqli_fetch_array($query_product);														 	 	 
														?>                                                        
											<div class="product-widget">
												<div class="product-img">											
                                                    <img src="administrator/fileUpload/<?php echo $result_product['p_img'];?>">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#"><?php echo $result_product['p_name'];?></a></h3>
													<h4 class="product-price"><span class="qty"><?php echo $result_cart['cart_qty'];?> x </span>฿ <?php echo $result_cart['p_price'];?></h4>
												</div>											
											</div>
                                            <?php 
											 $sum=$result_cart['cart_qty']*$result_cart['p_price'];
											 $sum_total=$sum_total+$sum;
											} 		
}
											?>
										</div>                                        
										<div class="cart-summary">
											<small><?php echo $num_rows?> รายการ ที่คุณเลือก</small>
											<h5>ราคารวมทั้งสิ้น  :  ฿ <?php echo number_format($sum_total,2)?></h5>
										</div>
										<div class="cart-btns">
											<a href="index.php?link=7">View Cart</a>
											<a href="index.php?link=3">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>   
								</div>                                
								<!-- /Cart -->
                                
								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
                        
                        <div class="col-md-1">
							<div class="header-logo">
								 <?php							
								$sql_member="select * from member where ID_m='".$ID_m."'";
								$query_member=mysqli_query($con,$sql_member);
								$result_member=mysqli_fetch_array($query_member);		
								if($result_member<>'')		
								{				
								 ?>
                                 <img src="fileupload/<?php echo $result_member['pic_s'];?>" class="img-circle" width="60" height="70">
                                 <?php
								}
								else
								{
								 ?>
                                  <img src="img/user.png" class="img-circle" width="60" height="70">
                                 <?php
								}
								?>
							</div>
						</div>
                        
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php"><i class="fa fa-home" aria-hidden="true"></i> หน้าแรก</a></li>
						<li><a href="index.php?link=5"><i class="fa fa-object-group" aria-hidden="true"></i> หมวดหมู่รองเท้า</a></li>
						<li><a href="index.php?link=6"><i class="fa fa-product-hunt" aria-hidden="true"></i> รายการรองเท้า</a></li>						
						<li><a href="index.php?link=17"><i class="fa fa-compress" aria-hidden="true"></i> ติดต่อเรา</a></li>	             
                        <?php
						if(isset($_SESSION['sess_ID_m'])=='')
{	
                        ?>      
						<li><a href="index.php?link=1"><i class="fa fa-user-o"></i> สมัครสมาชิก</a></li>
                        <?php } else  {?>
                        <li><a href="index.php?link=18"><i class="fa fa-university"></i> บัญชีธนาคาร</a></li>
                           <li><a href="index.php?link=19"><i class="fa fa-question"></i> กระทู้ถามตอบ</a></li>
                        <?php } ?>
                        <li><a href="administrator/login.php" target="new"><i class="fa fa-lock" aria-hidden="true"></i> ผู้ดูแลระบบ</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->


	<!-- SECTION -->
		<div class="section">
			<!-- container -->			
    <?php include "body.php"; ?>   
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>sports</p>
								<ul class="footer-links">
									<li><a href="https://www.google.com/maps/@19.0520886,99.9355585,3a,75y,180.62h,82.59t/data=!3m7!1e1!3m5!1s9MQuHS4ULqUbdSYrnL5v6g!2e0!6shttps:%2F%2Fstreetviewpixels-pa.googleapis.com%2Fv1%2Fthumbnail%3Fpanoid%3D9MQuHS4ULqUbdSYrnL5v6g%26cb_client%3Dsearch.revgeo_and_fetch.gps%26w%3D96%26h%3D64%26yaw%3D248.29208%26pitch%3D0%26thumbfov%3D100!7i16384!8i8192?coh=205409&entry=ttu&g_ep=EgoyMDI0MDkwNC4wIKXMDSoASAFQAw%3D%3D" target="new"><i class="fa fa-map-marker"></i> ม.12 ต.แม่กา อ.เมืองพะเยา จ.พะเยา</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>0631801527,0643430462</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>peethanawut47@gmail.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="index.php?link=5">หมวดหมู่สินค้า</a></li>
									<li><a href="index.php?link=6">รายการสินค้า</a></li>								
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">									
									<li><a href="index.php?link=17">ติดต่อเรา</a></li>				
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">ETC.</h3>
								<ul class="footer-links">
									<li><a href="https://www.facebook.com/thanawut.srivichai.9?locale=th_TH" target="new">Facebook</a></li>
									<li><a href="#">ID Line</a></li>										
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">				
							<span class="copyright">
                            <table width="100%" border="0">
  <tr>
    <td width="20%"><div align="center"> Statistics Today :  <font color="#FF0000"><strong><?php echo number_format($strToday,0);?></strong></font></div></td>
        <td width="20%"><div align="center"> Yesterday :  <font color="#FF0000"><strong><?php echo number_format($strYesterday,0);?></strong></font></div></td>
        <td width="15%"><div align="center">This Month : <font color="#FF0000"><strong> <?php echo number_format($strThisMonth,0);?></strong></font></div></td>
         <td width="15%"><div align="center"> Last Month :  <font color="#FF0000"><strong><?php echo number_format($strLastMonth,0);?></strong></font></div></td>
         <td width="15%"><div align="center"> This Year :  <font color="#FF0000"><strong><?php echo number_format($strThisYear,0);?></strong></font></div></td>         
         <td width="15%"><div align="center"> Last Year :  <font color="#FF0000"><strong><?php echo number_format($strLastYear,0);?></strong></font></div></td>  
  </tr>  
</table>
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> <i class="fa fa-heart-o" aria-hidden="true"></i> by Mr.pea 
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>
  <!-- Page level plugins -->
  <script src="administrator/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="administrator/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- <script type="text/javascript" src="js/bootstrap-select.js.map"></script>-->
  <!-- Page level custom scripts -->
  <script src="administrator/js/demo/datatables-demo.js"></script>
   <!--  <script src="js/bootstrap-select.min.js"></script>-->
	  <script src="assets/script.js"></script>
	</body>
</html>