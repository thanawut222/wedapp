<?php

$user_wb=$_SESSION['sess_ID_m'];
 //$result_member=select("member","where 1 and ID_m='".$_SESSION['sess_ID_m']."'");
 
 
    $sql_member = "select * From member Where ID_m='".$_SESSION['sess_ID_m']."'";													
	$query_member = mysqli_query($con,$sql_member);
	$result_member=mysqli_fetch_array($query_member);
 
 if(isset($_POST ['topic_wb']))
 {
	$topic_wb=$_POST ['topic_wb']; 
	 }
	
	 if(isset($_POST ['post_wb'])) 
	 {
		  $post_wb=$_POST ['post_wb'];
		 }



 $date_wb=date("Y-m-d H:i:s");	


if(isset($_GET["Action"]))
{
	if($_GET["Action"]=="Save")
	{
	if($topic_wb=="" or $post_wb=="")
	{
						?>
    <script language="javascript">
				alert("กรุณา กรอกข้อมูลให้ครบคะ");	
			</script>	
                     <?php
	}else
	{
		
		
			$sql = "insert into webboard (user_wb,topic_wb,post_wb,date_wb) Values ('$user_wb','$topic_wb','$post_wb','$date_wb')";	
			$dbquery = mysqli_query($con,$sql);														 
			
				   	?>
                  <script language="javascript">
				alert("สำเร็จ บันทึกข้อมูลเรียบร้อยคะ");		
			</script>	
                     <?php
			}
	}
}
	
	
	 if(isset($_POST ['post_ans'])) 
	 {
		  $post_ans=$_POST ['post_ans'];
		 }	
	
	if(isset($_GET["Action"]))
{
	if($_GET["Action"]=="Send")
	{
	if($post_ans=="")
	{
	    ?>
                  <script language="javascript">
				alert("กรุณากรอกข้อมูล");			
			</script>	
                   <?php
				
	}else
	{
		
			$id_wb=$_GET['id_wb'];
		
			$sql_web_ans = "insert into webboard_ans (id_wb,post_ans,date_ans,user_ans) Values ('$id_wb','$post_ans','$date_wb','$user_wb')";	
			$dbquery2 = mysqli_query($con,$sql_web_ans);														 
							
			}
	}
}
	
	if(isset($_GET["Action"]))
{
	if($_GET["Action"]=="Delete")
	{
	
			$id_wb=isset($_GET['id_wb']);
				$del_ans="Del";		
		$SQL4="UPDATE webboard SET del_ans='".$del_ans."' WHERE id_wb='".$id_wb."'";
		$RESULT4=mysqli_query($con,$SQL4);
		   	?>
                  <script language="javascript">
				alert("แจ้งลบกระทู้เรียบร้อยแล้วคะ");			
			</script>	
                        <?php
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
							<li><a href="index.php?link=19">กระทู้ถามตอบ</a></li>		
							<li class="active">กระดานสนทนา</li>
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

					<div class="col-md-12">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">ตั้งกระทู้ / ข้อคำถาม </h3>
							</div>
						
                        <form action="index.php?link=19&Action=Save" method="post" enctype="multipart/form-data">
                           <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                  <div align="right">
                   <strong>  ชื่อหัวข้อ : </strong>
                    </div>
                  </div>
                  <div class="col-sm-9">
     			<input class="input" type="text" name="topic_wb" id="topic_wb">                                
                  </div>
                </div>            
                
                  <div class="form-group row">
                  <div class="col-sm-3 mb-3 mb-sm-0">
                  <div align="right">
                   <strong>  ข้อความอธิบาย : </strong>
                    </div>
                  </div>
                  <div class="col-sm-9">
                  <textarea id="post_wb" name="post_wb" rows="4" cols="40" ></textarea>     
                  	   
                     <div class="product-details">
        	<div class="add-to-cart">
                                	<button class="add-to-cart-btn" type="submit"><i class="fa fa-question"></i> ตั้งกระทู้</button>
							</div>
                            </div>     
                                                   
                  </div>
                </div>             
              
                        </form>                                                   
								</div>
						<!-- /Billing Details -->
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
             
         	<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
                                        
            <div class="section-title">
								<h3 class="title">กระทู้ของคุณ </h3>
							</div>
                        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>                                    
                 <th><div align="center">หัวข้อกระทู้</div></th>
                     <th><div align="center">รายละเอียด</div></th>                             
                              <th><div align="center">ดำเนินการ</div></th>                   
                  </tr>
                </thead>
                <tfoot>
                  <tr>           
                          <th><div align="center">หัวข้อกระทู้</div></th>
                     <th><div align="center">รายละเอียด</div></th>                            
                              <th><div align="center">ดำเนินการ</div></th> 
                  </tr>
                </tfoot>
                <tbody>
                
                   <?php		
													  $i=0;
													  $sql_web = "select * From webboard Where user_wb='".$user_wb."' order by id_wb DESC";		
														$query_web = mysqli_query($con,$sql_web);
														 while($result=mysqli_fetch_array($query_web))
														 { 
														?>
                
                  <tr>            
                
                     <td>
                     <div align="center"><strong><?=$result['topic_wb'];?></strong></div>
                     <div align="center"><?=$result['date_wb'];?></div>
                     </td>                     
                       <td>
                       <div align="left"><?=$result['post_wb'];?></div><br />            
                          <?php															 
													  $sql_web_ans = "select * From webboard_ans Where id_wb='".$result['id_wb']."' order by id_ans ASC";		
														$query_web_ans = mysqli_query($con,$sql_web_ans);
														 while($result_web_ans=mysqli_fetch_array($query_web_ans))
														 { 
														 
														 ?>
                                                         <div class="form-group row">                          
                  <div class="col-sm-2 mb-2 mb-sm-0">
                  <div align="right">
               
                    </div>
                  </div>
                  <div class="col-sm-7">
     <?php
		if($result_web_ans['user_ans']=="admin")
		{
				echo "<strong>  Admin : </strong> ".$result_web_ans['post_ans']."&nbsp;&nbsp;&nbsp;<br>"; 
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$result_web_ans['date_ans'];      
		}
		else
		{
			echo "<strong>  ลูกค้า : </strong> ".$result_web_ans['post_ans']."&nbsp;&nbsp;&nbsp;<br>"; 
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$result_web_ans['date_ans'];      
			}
		
		
		
		?>                            
                  </div>
                  
                    <div class="col-sm-3">
     		    <div class="product-details">
        	<div class="add-to-cart">
                               
							</div>
                            </div>                     
                  </div>
                </div>     		             
                                                         
                                                     <?php
														 
														 
													                                                  
														 }
														?>
             <form action="index.php?link=19&Action=Send&id_wb=<?=$result['id_wb'];?>" name"web_ans" id="web_ans" method="post" enctype="multipart/form-data">                                           
         
         <div class="form-group row">                          
                  <div class="col-sm-2 mb-2 mb-sm-0">
                  <div align="right">
                         <strong>   ตอบกลับ : </strong>
                    </div>
                  </div>
                  <div class="col-sm-7">
     		<input class="input" type="text" name="post_ans" id="post_ans">                             
                  </div>
                  
                    <div class="col-sm-3">
     		    <div class="product-details">
        	<div class="add-to-cart">
                                	<button class="add-to-cart-btn" type="submit"><i class="fa fa-paper-plane"></i> ตอบ</button>
							</div>
                            </div>                     
                  </div>
                </div>     
                
                      </form>
                            
                            
                       </td>
         
                             
                                                 <td>    
                     <div align="center">           
                         
                                           	<div class="product-details">      
											<div class="add-to-cart">
                                                 
                         <script language="JavaScript">
																	function Conf<?=$result["id_wb"]; ?>(object) {
																	if (confirm("ยืนยันการลบ [ <?=$result['topic_wb']; ?> ] ") ==true) {
																	return true;
																	}
																	return false;
																	}																	
															</script>	
                                      	
									<a href="index.php?link=19&Action=Delete&id_wb=<?=$result['id_wb'];?>" onClick="return Conf<?=$id_wb["id_wb"]; ?>(this)"><i class="fa fa-trash"></i> แจ้งลบ </a>
                        
                                    
							</div>
									</div>
                                    
                   </div>
                     </td>
                  </tr>
                  
                  <?php } ?>
             
                </tbody>
              </table>
            </div>
          </div>
          <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>                    
                  
                            
                            
                            
                    				</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->