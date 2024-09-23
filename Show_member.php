<?php
if(isset($_GET["Action"]))
{
if($_GET["Action"]=="Edit")
{
  $Company_name=$_POST['Company_name'];	
	$id_card=$_POST['id_card'];	
	$u_name=$_POST['u_name'];
	$p_word=$_POST['p_word'];
	$p_word_s=$_POST['p_word_s'];	
	$name_m=$_POST['name_m'];
	$email_m=$_POST['email_m'];	
	$tel_m=$_POST['tel_m'];	
	$add_m=$_POST['add_m'];
	$district_id=$_POST['district_id'];
	$amphure_id=$_POST['amphure_id'];
	$province_id=$_POST['province_id'];
	$add_m5=$_POST['add_m5'];
	if($Company_name=="" or $id_card=="" or $u_name=="" or $p_word=="" or $p_word_s==""  or $name_m=="" or $email_m=="" or $tel_m=="" or $add_m=="" or $district_id=="" or $amphure_id=="" or $province_id=="" or $add_m5=="") 
	{
						?>
<script language="javascript">
alert("กรุณากรอกข้อมูลให้ครบ");
</script>
<?php 
	}else
	{			 				
			$sql_menber = "Update member Set Company_name='$Company_name',id_card='$id_card',u_name='$u_name',p_word='$p_word',name_m='$name_m',email_m='$email_m',tel_m='$tel_m',add_m='$add_m',add_m2='$district_id',add_m3='$amphure_id',add_m4='$province_id',add_m5='$add_m5' Where ID_m='".$_SESSION['sess_ID_m']."'";				
			$dbquery = mysqli_query($con,$sql_menber);	
			
			if($_FILES["fileUpload"]["name"] != "")
	{
		if(copy($_FILES["fileUpload"]["tmp_name"],"fileupload/".$_FILES["fileUpload"]["name"]))
		{	
			@unlink("fileupload/".$_POST["fileUpload"]);
							$sql_menber1 = "Update member Set pic_s='".$_FILES["fileUpload"]["name"]."' Where ID_m='".$_SESSION['sess_ID_m']."'";		
							move_uploaded_file($_FILES["fileUpload"]["tmp_name"],"fileupload/".$_FILES["fileUpload"]["name"]);	
								$dbquery1 = mysqli_query($con,$sql_menber1);	
											 }											 
	}
			
				   	?>
<script language="javascript">
alert("แก้ไขข้อมูลเรียบร้อย");
</script>
<?php 
			}}

}



//$result=select("member","where 1=1 and ID_m='".$_SESSION['sess_ID_m']."'");


	$sql_member = "select * From member Where ID_m='".$_SESSION['sess_ID_m']."'";													
	$query_member = mysqli_query($con,$sql_member);
	$result=mysqli_fetch_array($query_member);


if($result=='')
{


	?>
<script language="javascript">
window.location.href = "index.php";
</script>

<?php 

}

?>

<form action="index.php?link=2&Action=Edit&ID_m=<?php echo $_SESSION['sess_ID_m'];?> name=" add_member" method="post"
    enctype="multipart/form-data">

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-7">
                    <!-- Billing Details -->
                    <div class="billing-details">
                        <div class="section-title">
                            <h3 class="title">ข้อมูลสมาชิก</h3>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <div align="right">
                                    <h3 class="title">รูปภาพผู้ใช้งาน</h3>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div align="center">
                                    <img src="fileupload/<?php echo $result['pic_s'];?>" width="170" height="180"
                                        class="img-circle"> <br>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image : </label>
                                        <input type="file" name="fileUpload">
                                    </div>
                                    <button class="primary-btn order-submit" type="submit">
                                        <i class="fa fa-pencil" aria-hidden="true"> แก้ไขข้อมูล</i>
                                    </button>
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
                                    <input class="input" type="text" name="id_card" id="id_card"
                                        value="<?php echo $result['id_card'];?>" onkeyup="autoTab(this)">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div align="right">
                                        <strong> ชื่อใช้งานระบบ : </strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="text" name="u_name"
                                        value="<?php echo $result['u_name'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div align="right">
                                        <strong> รหัสผ่าน :</strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="password" name="p_word"
                                        value="<?php echo $result['p_word'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div align="right">
                                        <strong> ยืนยันรหัสผ่าน : </strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="password" name="p_word_s" placeholder="ยืนยัน Password"
                                        value="<?php echo $result['p_word'];?>">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div align="right">
                                        <strong> ชื่อผู้ใช้ : </strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="text" name="name_m"
                                        value="<?php echo $result['name_m'];?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div align="right">
                                        <strong> E-mail :</strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="text" name="email_m"
                                        value="<?php echo $result['email_m'];?>">
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div align="right">
                                        <strong> เบอร์โทร : </strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="text" name="tel_m"
                                        value="<?php echo $result['tel_m'];?>">
                                </div>
                            </div>





                            <div class="form-group row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div align="right">
                                        <strong> ที่อยู่ : เลขที่</strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="text" name="add_m"
                                        value="<?php echo $result['add_m'];?>">
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
                                        <?php 
							$sql_provinces = "SELECT * FROM province";
							$query = mysqli_query($con, $sql_provinces);
							while($result_pro = mysqli_fetch_assoc($query))
							{ 
							?>
                                        <option value="<?php echo $result_pro['province_ID']?>">
                                            <?php echo $result_pro['province_name']?>
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
                                        <strong>ที่อยู่ : รหัสไปรษณีย์</strong>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <input class="input" type="text" name="add_m5" id="add_m5"
                                        value="<?php echo $result['zip_code'];?>">
                                </div>
                            </div>
                        </div>

                        <!-- /Billing Details -->
                        <!-- Order Details -->
                    </div>
                    <!-- /Order Details -->
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
</form>