<?PHP
 if($_GET["Action"]=="PrintPDF")
	 {
		 $order_id=$_GET['order_id'];
			if (isset($_GET['order_id'])){
				$_SESSION['sess_order_id']=$order_id; 
				 	echo"<script language='JavaScript'>";								
									echo"window.location='pdf/Quotation_pdf.php';";
									echo"</script>";							
			}		
	 }
	?>