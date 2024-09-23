<?php
require_once("../export_pdf/setPDF.php");
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->AddPage();
require_once("../connect.php");


function ThaiBahtConversion($amount_number)
{
    $amount_number = number_format($amount_number, 2, ".","");
    //echo "<br/>amount = " . $amount_number . "<br/>";
    $pt = strpos($amount_number , ".");
    $number = $fraction = "";
    if ($pt === false)
        $number = $amount_number;
    else
    {
        $number = substr($amount_number, 0, $pt);
        $fraction = substr($amount_number, $pt + 1);
    }
   
    //list($number, $fraction) = explode(".", $number);
    $ret = "";
    $baht = ReadNumber ($number);
    if ($baht != "")
        $ret .= $baht . "บาท";
   
    $satang = ReadNumber($fraction);
    if ($satang != "")
        $ret .=  $satang . "สตางค์";
    else
        $ret .= "ถ้วน";
    //return iconv("UTF-8", "TIS-620", $ret);
    return $ret;
}

function ReadNumber($number)
{
    $position_call = array("แสน", "หมื่น", "พัน", "ร้อย", "สิบ", "");
    $number_call = array("", "หนึ่ง", "สอง", "สาม", "สี่", "ห้า", "หก", "เจ็ด", "แปด", "เก้า");
    $number = $number + 0;
    $ret = "";
    if ($number == 0) return $ret;
    if ($number > 1000000)
    {
        $ret .= ReadNumber(intval($number / 1000000)) . "ล้าน";
        $number = intval(fmod($number, 1000000));
    }
   
    $divider = 100000;
    $pos = 0;
    while($number > 0)
    {
        $d = intval($number / $divider);
        $ret .= (($divider == 10) && ($d == 2)) ? "ยี่" :
            ((($divider == 10) && ($d == 1)) ? "" :
            ((($divider == 1) && ($d == 1) && ($ret != "")) ? "เอ็ด" : $number_call[$d]));
        $ret .= ($d ? $position_call[$pos] : "");
        $number = $number % $divider;
        $divider = $divider / 10;
        $pos++;
    }
    return $ret;
}

function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
	
$order_id=$_SESSION['sess_order_id'];
$htmlcontent1='<h6> รหัสการสั่งซื้อ &nbsp;&nbsp;'.$order_id.'</h6>';


$sql_order_d="SELECT*FROM order_d Where order_id='".$order_id."'"; 
$query_order_d=mysqli_query($con,$sql_order_d);
$result_order_d=mysqli_fetch_array($query_order_d);

$order_date=$result_order_d['order_date'];
$order_idmem=$result_order_d['order_idmem'];
$order_sum=$result_order_d['order_sum'];
$order_type_pay=$result_order_d['order_type_pay'];
$order_status=$result_order_d['order_status'];


		if($result_order_d['order_type_pay']=="pay")
																{
																	$order_type_pay="<strong>ชำระเงินสด</strong>";
																	}	
																else if($result_order_d['order_type_pay']=="credit")
																{
																	$order_type_pay="<strong>เครดิต</strong>";
																	}	
															


$sql_member="SELECT*FROM member where ID_m='".$order_idmem."'"; 
$query_member=mysqli_query($con,$sql_member);
$result_member=mysqli_fetch_array($query_member);
$name_m=$result_member['name_m'];
$tel_m=$result_member['tel_m'];
$add_m=$result_member['add_m'];
$add_m2=$result_member['add_m2'];
$add_m3=$result_member['add_m3'];
$add_m4=$result_member['add_m4'];
$add_m5=$result_member['add_m5'];

$sql_data_shop="SELECT*FROM data_shop"; 
$query_data_shop=mysqli_query($con,$sql_data_shop);
$result_data_shop=mysqli_fetch_array($query_data_shop);
$id_tax=$result_data_shop['id_tax'];
$name_shop=$result_data_shop['name_shop'];
$tel_s=$result_data_shop['tel_s'];
$fax_s=$result_data_shop['fax_s'];
$email_s=$result_data_shop['email_s'];
$addres_s=$result_data_shop['addres_s'];
$name_manager=$result_data_shop['name_manager'];
$pic_logo=$result_data_shop['pic_logo'];



$html1 ='<table width="100%" border="0">';
$html1 .= '<tr>';

$html1 .= '<td width="70%">';
$html1 .= '<div align="left"><strong><font size="24"> '.$name_shop.'<br></font></strong>';
$html1 .= '&nbsp;&nbsp;&nbsp;&nbsp;E-mail : '.$email_s.' Tel. : '.$tel_s.' Fax. :'.$fax_s.'<br>';
$html1 .= '&nbsp;&nbsp;&nbsp;&nbsp;เลขประจำตัวผู้เสียภาษี  : '.$id_tax.'<br>';
$html1 .= '&nbsp;&nbsp;&nbsp;&nbsp;ที่อยู่  : '.$addres_s.'<br>';
$html1 .= '</div>';
$html1 .= '</td>';
$html1 .= '<td width="30%"><div align="center"><img src="../administrator/fileUpload/'.$pic_logo.'" width="100" height="100" /></div></td>';
$html1 .= '</tr>';
$html1 .= '<tr>';
$html1 .= '<td width="100%"><div align="center"><font size="29"><strong>ใบเสนอราคา</strong></font></div></td>';
$html1 .= '</tr>';
$html1 .= '</table>';
$pdf->writeHTML($html1);

$html2 ='<table width="100%" border="1">';
$html2 .= '<tr>';
$html2 .= '<td width="70%">';
$html2 .= '&nbsp;&nbsp;&nbsp;<strong>ข้อมูลผู้ทำรายการ</strong>   :  '.$name_m.'<br>';
$html2 .= '&nbsp;&nbsp;&nbsp;<strong>เบอร์โทรติดต่อ</strong>   :  '.$tel_m.'<br>';
$html2 .= '&nbsp;&nbsp;&nbsp;<strong>ที่อยู่</strong>   :  '.$add_m." ".$add_m2." ".$add_m3." ".$add_m4." ".$add_m5.'';
$html2 .= '</td>';
$html2 .= '<td width="30%">';
$html2 .= '&nbsp;&nbsp; เลขที่สั่งซื้อ : '.$order_id.'<br>';
$html2 .= '&nbsp;&nbsp; '.$order_date.'<br>';
$html2 .= '&nbsp;&nbsp; '.$order_type_pay.'';

$html2 .= '</td>';
$html2 .= '</tr>';
$html2 .= '</table>';
$pdf->writeHTML($html2);




$htm4 ='<table width="100%" border="1">';
$htm4 .= '<tr>';
$htm4 .= '<td width="10%" height="35">';
$htm4 .= '<div align="center"><strong>ลำดับ</strong></div>';
$htm4 .= '</td>';
$htm4 .= '<td width="40%" height="35">';
$htm4 .= '<div align="center"><strong> รายการสินค้า </strong></div>';
$htm4 .= '</td>';
$htm4 .= '<td width="15%" height="35">';
$htm4 .= '<div align="center"><strong>จำนวน / หน่วย</strong></div>';
$htm4 .= '</td>';
$htm4 .= '<td width="15%" height="35">';
$htm4 .= '<div align="center"><strong>ราคา</strong></div>';
$htm4 .= '</td>';
$htm4 .= '<td width="20%" height="35">';
$htm4 .= '<div align="center"><strong>รวมราคา</strong></div>';
$htm4 .= '</td>';
$htm4 .= '</tr>';
$sum = 0;	
$i=0;
$sql_order_desc = "select * From order_desc where order_id='".$order_id."' ORDER BY id_item ASC";													
		 $query_order_desc = mysqli_query($con,$sql_order_desc);
		 while($result_order_desc=mysqli_fetch_array($query_order_desc))
		 { 		 
		  $sql_product = "select * From product Where pid='".$result_order_desc['order_pid']."'";													
		 $query_product = mysqli_query($con,$sql_product);
		 $result_product=mysqli_fetch_array($query_product);
				$p_name=$result_product['p_name'];
				$unit_name=$result_product['unit_name'];
		 $i++;	  
$htm4 .= '<tr>';
$htm4 .= '<td width="10%" height="30">';
$htm4 .= '<div align="center">'.$i.'</div>';
$htm4 .= '</td>';
$htm4 .= '<td width="40%" height="30">';
$htm4 .= '<div align="left">&nbsp;'.$p_name.'</div>';
$htm4 .= '</td>';
$htm4 .= '<td width="15%" height="30">';
$htm4 .= '<div align="center">'.$result_order_desc['order_qty']."   ".$unit_name.'</div>';
$htm4 .= '</td>';
$htm4 .= '<td width="15%" height="30">';
$htm4 .= '<div align="center">'.$result_order_desc['p_price'].'</div>';
$htm4 .= '</td>';
$htm4 .= '<td width="20%" height="30">';
$htm4 .= '<div align="right">'.number_format($result_order_desc['order_qty']*$result_order_desc['p_price'],2).'&nbsp;</div>';
$htm4 .= '</td>';
$htm4 .= '</tr>';			
$sum=$sum+($result_order_desc['order_qty']*$result_order_desc['p_price']);
		}
$htm4 .= '<tr>';
$htm4 .= '<td width="30%" height="30">';
$htm4 .= '<div align="right"><strong>&nbsp;รวมเป็นเงินทั้งสิ้น : </strong>&nbsp;&nbsp;</div>';
$htm4 .= '</td>';
$htm4 .= '<td width="50%" height="30">';
$htm4 .= '<div align="center"><strong>&nbsp; ('.ThaiBahtConversion($sum).')</strong></div>';
$htm4 .= '</td>';
$htm4 .= '<td width="20%" height="30">';
$htm4 .= '<div align="right"><strong>&nbsp; '.number_format($sum,2).' &nbsp;&nbsp;</strong></div>';
$htm4 .= '</td>';
$htm4 .= '</tr>';		
$htm4 .= '</table>';
$pdf->writeHTML($htm4);


$html3 ='<table width="100%" border="0">';
$html3 .= '<tr>';
$html3 .= '<td width="35%">';
$html3 .= '<div align="center">........................................<br>';
$html3 .= '(........................................)<br>';
$html3 .= '<strong>ผู้รับบริการ</strong><br>';
$html3 .= 'วันที่.........../............../................</div>';
$html3 .= '</td>';

$html3 .= '<td width="30%">';
$html3 .= '<div align="center"><p><strong>ประทับตรา</strong></p></div>';
$html3 .= '</td>';
$html3 .= '<td width="35%">';
$html3 .= '<div align="center">........................................<br>';
$html3 .= '<strong>'.$name_manager.'</strong><br>';
$html3 .= '<strong>ผู้จัดการ</strong><br>';
$html3 .= 'วันที่.........../............../................</div><br>';
$html3 .= '</td>';



$html3 .= '</tr>';
$html3 .= '</table>';
$pdf->writeHTML($html3);

$pdf->writeHTML($htmlcontent1);


$pdf->lastPage();
$pdf->Output('test.pdf', 'I');
?>