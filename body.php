 <?php
  $id_link='';
  $Search='';
if(isset($_SESSION['sess_ID_m'])=='')
{
	$id_link=='';
}
		if(isset($_GET['link']))
	{
		 $id_link=$_GET['link'];
	}

	
	if($id_link=='')
	{
		  include_once 'content.php'; 
		 /* include_once 'New_Products.php';
		   include_once 'Product_sh.php';
		   include_once 'Product_normal.php'; */
		   	include_once 'product_list.php'; 
    }
	else if($id_link==1)
	{
		include_once 'Register_add.php'; 
	}
	else if($id_link==2)
	{
			include_once 'Show_member.php'; 
	}
	else if($id_link==3)
	{
			include_once 'logout.php'; 
	}
	else if($id_link==4)
	{
			include_once 'product_detail.php'; 
	}
	else if($id_link==5)
	{
		include_once 'product_catagory.php'; 
	}
	
		else if($id_link==6)
	{
			include_once 'product_list.php'; 
	}
	else if($id_link==7)
	{
			include_once 'add_cart.php'; 
	}
		else if($id_link==8)
	{
		include_once 'cart_action.php'; 
	}
		else if($id_link==9)
	{
		include_once 'cart_update.php'; 
	}
	else if($id_link==10)
	{
		include_once 'cart_clear.php'; 
	}
	
		else if($id_link==11)
	{
		include_once 'member/confirm_address.php'; 
	}
		else if($id_link==12)
	{
		include_once 'member/confirm_order.php'; 
	}
	else if($id_link==13)
	{
		include_once 'member/cart_history.php'; 
			
	}
		else if($id_link==14)
	{
		include_once 'member/cart_history_detail.php'; 
	}
		else if($id_link==15)
	{
		include_once 'member/payment.php'; 
	}
	
		else if($id_link==16)
	{
		include_once 'pdf/Quotation_action_pdf.php'; 
	}
	
	else if($id_link==17)
	{
		include_once 'contact_us.php'; 
	}
	
		else if($id_link==18)
	{
		include_once 'book_bank.php'; 
	}
			else if($id_link==19)
	{
		include_once 'member/webboard.php'; 
	}
	



?>
	</body>
    </html>