   <?php
 	if(isset($_POST['Company_name']) or isset($_POST['id_card']) or isset($_POST['u_name']) or isset($_POST['p_word']) or isset($_POST['p_word_s']) or isset($_POST['name_m']) or isset($_POST['email_m']) or isset($_POST['tel_m']) or isset($_POST['add_m']) or isset($_POST['district_id']) or isset($_POST['amphure_id']) or isset($_POST['province_id']) or isset($_POST['add_m5']))
	{
	echo $Company_name=$_POST['Company_name'];	
	echo $id_card=$_POST['id_card'];	
	echo $u_name=$_POST['u_name'];
	echo $p_word=$_POST['p_word'];
	echo $p_word_s=$_POST['p_word_s'];	
	echo $name_m=$_POST['name_m'];
	$email_m=$_POST['email_m'];
	$tel_m=$_POST['tel_m'];	
	$add_m=$_POST['add_m'];
	$district_id=$_POST['district_id'];
	$amphure_id=$_POST['amphure_id'];
	$province_id=$_POST['province'];
	$add_m5=$_POST['add_m5'];
	}


	if(isset($_GET["Action"]))
	{
	if($_GET["Action"]=="Save")
	{
	
	if($p_word<>$p_word_s)
	{
		?>
   <script language="javascript">
alert("ยืนยันรหัสผ่านไม่ถูกต้อง");
window.location.href = "index.php?link=1";
   </script>
   <?php
	}else{	
	$SQL="SELECT * FROM member WHERE u_name='$u_name'";
	$RESULT=mysqli_query($con,$SQL);
	$NUM=mysqli_num_rows($RESULT);
		if($NUM<>0)	
		{
			?>
   <script language="javascript">
alert("ชื่อผู้ใช้งานซ้ำ");
window.location.href = "index.php?link=1";
   </script>
   <?php
		}else{
		
		
			if(copy($_FILES["fileUpload"]["tmp_name"],"fileupload/".$_FILES["fileUpload"]["name"]))
	{
	?>
   <script language="javascript">
alert("เพิ่มรูปและรายการข้อมูลเรียบร้อย");
window.location.href = "index.php?link=1";
   </script>
   <?php

			$SQL1="INSERT INTO member (Company_name,id_card,u_name,p_word,name_m,email_m,tel_m,add_m,add_m2,add_m3,add_m4,add_m5,status_m,pic_s)VALUES('$Company_name','$id_card','$u_name','$p_word','$name_m','$email_m','$tel_m','$add_m','district_id','$amphure_id','$province_id','$add_m5','','".$_FILES["fileUpload"]["name"]."')";
			move_uploaded_file($_FILES["fileUpload"]["tmp_name"],"fileupload/".$_FILES["fileUpload"]["name"]);	
			$RESULT1=mysqli_query($con,$SQL1);
											 }
			if(!$RESULT1)
			{
				?>
   <script language="javascript">
alert("ระบบผิดพลาด!! ไม่สามารถสมัครสมาชิกได้");
window.location.href = "index.php?link=1";
   </script>
   <?php
			}
			else
			{		
				$sql="SELECT * FROM member WHERE u_name ='$u_name' and p_word ='$p_word'"; 
				$query=mysqli_query($con,$sql);
				$rs=mysqli_fetch_array($query);
				$ID_m=$rs['ID_m'];
				$Company_name=$rs['Company_name'];
				$id_card=$rs['id_card'];
				$name_m=$rs['name_m'];
				
					session_start();
					if (isset($id_card)){
					$_SESSION['sess_ID_m']=$ID_m; 
					$_SESSION['sess_Company_name']=$Company_name; 
					$_SESSION['sess_id_card']=$id_card;
					$_SESSION['sess_name_m']=$name_m; 
					
					
						
				?>
   <script language="javascript">
alert("คุณได้สมัครสมาชิกเรียบร้อยแล้ว");
window.location.href = "index.php";
   </script>
   <?php
					}				
			}
		}
	}
	}
	}
?>

   <form action="index.php?link=1&Action=Save" name="add_member" method="post" enctype="multipart/form-data">
       <!-- SECTION -->
       <div class="section">
           <!-- container -->
           <div class="container">
               <!-- row -->
               <div class="row">
                   <div class="col-md-7 order-details">
                       <div class="section-title bg-info">
                           <h3 class="title"><i class="fa fa-registered" aria-hidden="true"></i> สมัครสมาชิก : </h3>
                       </div>
                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>ชื่อหน่วยงาน (ถ้ามี) : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="text" name="Company_name" placeholder="ชื่อหน่วยงาน ถ้ามี">
                           </div>
                       </div>

                       <script language="javascript">
                       //เมื่อมีการคลิกฟังก์ชัน
                       $(function() {
                           $('#btn_sub').click(function() {


                               if ($('#id_card').val().trim() == '') {
                                   $('#msg').text('กรุณากรอกเลขประจำตัว');
                                   $('#id_card').focus();
                               } else {

                                   //checkID($('#txtID').val() จะไปเรียกฟังก์ชัน  checkID(id)
                                   if (!checkID($('#id_card').val().trim())) {
                                       alert('รหัสประชาชนไม่ถูกต้อง');
                                   } else {
                                       alert('รหัสประชาชนถูกต้อง');
                                       $('#msg').text($('#id_card').val().trim());
                                   }
                               }
                           });
                       });

                       //ตรวจสอบเลข ปปช ว่ามีจริงหรือไม่
                       function checkID(id) {

                           //ตัดข้อความ - ออก
                           var zid = id;
                           var zids = zid.split("-");
                           for (var i = 0; i < zids.length; i++) {
                               zids[i];
                           }
                           var id_val = zids[0] + zids[1] + zids[2] + zids[3] + zids[4];

                           if (id_val.length != 13) return false;
                           for (i = 0, sum = 0; i < 12; i++)
                               sum += parseFloat(id_val.charAt(i)) * (13 - i);
                           if ((11 - sum % 11) % 10 != parseFloat(id_val.charAt(12)))
                               return false;
                           return true;
                       }

                       //ฟังก์ชัน รูปแบบ
                       function autoTab(obj) {
                           /* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย
                           หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น  รูปแบบเลขที่บัตรประชาชน
                           4-2215-54125-6-12 ก็สามารถกำหนดเป็น  _-____-_____-_-__
                           รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____
                           หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__
                           ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน
                           */
                           var pattern = new String("_-____-_____-_-__"); // กำหนดรูปแบบในนี้
                           var pattern_ex = new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้
                           var returnText = new String("");
                           var obj_l = obj.value.length;
                           var obj_l2 = obj_l - 1;
                           for (i = 0; i < pattern.length; i++) {
                               if (obj_l2 == i && pattern.charAt(i + 1) == pattern_ex) {
                                   returnText += obj.value + pattern_ex;
                                   obj.value = returnText;
                               }
                           }
                           if (obj_l >= pattern.length) {
                               obj.value = obj.value.substr(0, pattern.length);
                           }
                       }
                       </script>


                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>รหัสบัตรประชาชน : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="text" id="id_card" name="id_card"
                                   placeholder="รหัสบัตรประชาชน" onkeyup="autoTab(this)">
                               <span id="msg" style="color:red"></span>
                           </div>
                       </div>



                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>Username / ชื่อในการใช้งานระบบ : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="text" name="u_name" placeholder="Username">
                           </div>
                       </div>


                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>Password / รหัสผ่าน : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="password" name="p_word" placeholder="Password">
                           </div>
                       </div>

                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>ยืนยัน Password : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="password" name="p_word_s" placeholder="ยืนยัน Password">
                           </div>
                       </div>


                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>ชื่อผู้ใช้งาน : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="text" name="name_m" placeholder="ชื่อผู้ใช้งาน">
                           </div>
                       </div>


                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>E-mail : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="text" name="email_m" placeholder="E-mail">
                           </div>
                       </div>


                       <div class="form-group row">
                           <div class="col-sm-4 mb-3 mb-sm-0">
                               <div align="right">
                                   <strong>เบอร์โทรติดต่อ : </strong>
                               </div>
                           </div>
                           <div class="col-sm-8">
                               <input class="input" type="text" name="tel_m" placeholder="เบอร์โทรติดต่อ">
                           </div>
                       </div>


                       <div class="billing-details">
                           <div class="section-title bg-info">
                               <h3 class="title"><i class="fa fa-address-book-o" aria-hidden="true"></i> ที่อยู่ : </h3>
                           </div>

                           <div class="form-group row">
                               <div class="col-sm-4 mb-3 mb-sm-0">
                                   <div align="right">
                                       <strong>ที่อยู่ บ้านเลขที่/หมู่ที่: </strong>
                                   </div>
                               </div>
                               <div class="col-sm-8">
                                   <input class="input" type="text" name="add_m" placeholder="ตัวอย่าง ( 11 หมู่ 13 )">

                               </div>
                           </div>


                           <div class="form-group row">
                               <div class="col-sm-4 mb-3 mb-sm-0">
                                   <div align="right">
                                       <strong>จังหวัด : </strong>
                                   </div>
                               </div>
                               <div class="col-sm-8">

                                   <select name="province_ID" id="province" class="form-control">
                                       <option value="">เลือกจังหวัด</option>
                                       <?php 
							$sql_province = "SELECT * FROM province";
							$query = mysqli_query($con, $sql_province);
							while($result = mysqli_fetch_assoc($query))
							{ 
							?>
                                       <option value="<?php echo $result['province_ID']?>"><?php echo $result['province_name']?>
                                       </option>
                                       <?php } ?>
                                   </select>
                               </div>
                           </div>

                           <div class="form-group row">
                               <div class="col-sm-4 mb-3 mb-sm-0">
                                   <div align="right">
                                       <strong>อำเภอ : </strong>
                                   </div>
                               </div>
                               <div class="col-sm-8">
                                   <select name="prefecture_ID" id="prefecture" class="form-control">
                                       <option value="">เลือกอำเภอ</option>
                                   </select>
                               </div>
                           </div>


                           <div class="form-group row">
                               <div class="col-sm-4 mb-3 mb-sm-0">
                                   <div align="right">
                                       <strong>ตำบล : </strong>
                                   </div>
                               </div>
                               <div class="col-sm-8">
                                   <select name="district_id" id="district" class="form-control">
                                       <option value="">เลือกตำบล</option>
                                   </select>
                               </div>
                           </div>
                           <div class="form-group row">
                               <div class="col-sm-4 mb-3 mb-sm-0">
                                   <div align="right">
                                       <strong>รหัสไปรษณีย์ : </strong>
                                   </div>
                               </div>
                               <div class="col-sm-8">
                                   <input class="input" type="text" name="add_m5" placeholder="รหัสไปรษณีย์">
                               </div>
                           </div>
                       </div>
                   </div>

                   <div class="col-md-5 order-details">
                       <div class="section-title text-center">
                           <h3 class="title">รูปภาพผู้ใช้งาน</h3>
                       </div>

                       <div align="center">
                           <img src="img/user_s.png" width="180" height="180" class="img-circle"> <br>
                           <div class="form-group">
                               <label for="exampleInputFile">Image : </label>
                               <input type="file" name="fileUpload">
                           </div>
                       </div>
                       <button class="primary-btn order-submit" type="submit" value="CLICK" id="btn_sub">
                           <i class="fa fa-floppy-o"> ลงทะเบียน</i>
                       </button>
                   </div>

               </div>

               <!-- /row -->
           </div>
           <!-- /container -->
       </div>
       <!-- /SECTION -->
   </form>