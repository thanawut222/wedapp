<?php 

$_SESSION['sess_ID_m'];
//$result_order=select("order_d","where 1 and order_id='".$_GET['order_id']."'");	

	$sql_order_d = "select * From order_d Where order_id='".$_GET['order_id']."'";													
	$query_order_d = mysqli_query($con,$sql_order_d);
	$result_order=mysqli_fetch_array($query_order_d);



//$result_member=select("member","where 1 and ID_m='".$result_order['order_idmem']."'");	

	$sql_member = "select * From member Where ID_m='".$result_order['order_idmem']."'";													
	$query_member = mysqli_query($con,$sql_member);
	$result_member=mysqli_fetch_array($query_member);

$order_id=$_GET['order_id'];
$pay_idm=$result_order['order_idmem'];
$order_total=$result_order['order_sum'];
$date_submit=date("Y-m-d H:i:s"); 

if($_GET["Action"]=="Save")
{
	$SQL="SELECT * FROM payment WHERE order_id='".$_GET['order_id']."'";
	$RESULT=mysqli_query($con,$SQL);
	$NUM=mysqli_num_rows($RESULT);
		if($NUM<>0)	
		{
			?>
			<script language="javascript">
				alert("คุณได้แจ้งทำรายการนี้แล้ว ขอบคุณคะ");
				window.location.href="index.php?link=13";
			</script>
			<?php 
		}else{
		
			//แทรกฟิลด์สถานะ member
				if(empty($fileUpload)<>'')
                                             {		
			$SQL1="INSERT INTO payment (order_id,pay_idm,order_total,pic_s,date_submit)VALUES('$order_id','$pay_idm','$order_total','".$_FILES["fileUpload"]["name"]."','$date_submit')";
			move_uploaded_file($_FILES["fileUpload"]["tmp_name"],"fileupload/".$_FILES["fileUpload"]["name"]);	
			$RESULT1=mysqli_query($con,$SQL1);
			
			
			$order_status="pay";			
				$SQL2="UPDATE order_d SET order_status='$order_status' WHERE order_id='".$_GET['order_id']."'";
			$RESULT2=mysqli_query($con,$SQL2);		
			
			?>
			<script language="javascript">
				alert("คุณได้แจ้งทำรายการนี้แล้ว ขอบคุณคะ");
				window.location.href="index.php?link=13";
			</script>
			<?php 
											 }
		}
	
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
							<li><a href="index.php?link=13">ประวัติการสั่งซื้อสินค้า</a></li>                          
							<li class="active">แจ้งชำระเงินค่าสินค้า</li>					
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
        
        
    <form action="index.php?link=15&order_id=<?php echo $result_order['order_id'];?>&Action=Save" name="add_member" method="post" enctype="multipart/form-data">      
    <!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title" >
								<h3 class="title"><i class="fa fa-registered" aria-hidden="true"></i> ชำระเงินผ่านบัญชีธนาคาร โอนเงิน เอทีเอ็ม อื่นๆ  : </h3>
							</div>
                            
                               <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <div align="right">
                       <strong>เลขที่ใบสั่งซื้อ : </strong>
                    </div>
                  </div>
                  <div class="col-sm-8">
     		<label><?php echo $result_order['order_id'];?></label>      
                  </div>
                </div>     		      
                
                  <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <div align="right">
                       <strong>สั่งซื้อวันที่ : </strong>
                    </div>
                  </div>
                  <div class="col-sm-8">
     		<label><?php echo $result_order['order_date'];?></label>     
                  </div>
                </div>     		      
                            

                            
                                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <div align="right">
                       <strong>ชื่อ-นามสกุล ลูกค้า : </strong>
                    </div>
                  </div>
                  <div class="col-sm-8">
     		<label><?php echo $result_member['name_m'];?></label>     
                  </div>
                </div>     		      
                
                                   

                      <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <div align="right">
                       <strong>เบอร์โทรติดต่อผู้สั่งซื้อ : </strong>
                    </div>
                  </div>
                  <div class="col-sm-8">
     		<label><?php echo $result_member['tel_m'];?></label>     
                  </div>
                </div>     		      
                
                
                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <div align="right">
                       <strong>ยอดการสั่งซื้อ : </strong>
                    </div>
                  </div>
                  <div class="col-sm-8">
     		<font color="#FF0000" size="6"><label><?php echo number_format($result_order['order_sum'],2);?>  บาท</label></font>      
                  </div>
                </div>     		  
                  
                
                
                <div class="form-group row">
                  <div class="col-sm-4 mb-3 mb-sm-0">
                  <div align="right">
                       <strong> รูปภาพหลักฐานการชำระเงิน : </strong>
                    </div>
                  </div>
                  <div class="col-sm-8">
  <div align="center">                  
                                     <img src="img/reciptcom.png" width="180" height="180" class="img-circle"> <br>
                   
                                  <div class="form-group">
    <label for="exampleInputFile">Image : </label>
    <input type="file" name="fileUpload"> 
  </div>                     

  <button class="primary-btn order-submit" type="submit">
            <i class="fa fa-paypal"> ยืนยันการชำระเงิน</i>
          </button>  	
		</div>
                    
                    
                  </div>
                </div>     		
                                
					                       <!-- /Billing Details -->
					<!-- Order Details -->
								
				
                        
					<!-- /Order Details -->
					</div>				
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
</form>