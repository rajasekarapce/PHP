<?php include "header.php";
$upd = isset($upd)?$upd:'0';
$id = isSet($id) ? $id : '' ;
$act  = isSet($act) ? $act : '' ;
$page  = isSet($page) ? $page : '' ;
$Message   = isSet($Message) ? $Message : '' ;
$username  = isSet($username) ? $username : '' ;
$dept_id = isset($dept_id)?$dept_id:'';
$password  = isSet($password) ? $password : '' ;
$name  = isSet($name) ? $name : '' ;
$branch_id = isSet($branch_id) ? $branch_id : '' ;
$sex  = isSet($sex) ? $sex : '' ;
$dob  = isSet($dob) ? $dob : '' ;
$doj  = isSet($doj) ? $doj : '' ;
$mobile_1  = isSet($mobile_1) ? $mobile_1 : '' ;
$phone  = isSet($phone) ? $phone : '' ;
$email_id  = isSet($email_id) ? $email_id : '' ;
$bank_name  = isSet($bank_name) ? $bank_name : '' ;
$acc_no  = isSet($acc_no) ? $acc_no : '' ;
$ifsc_code  = isSet($ifsc_code) ? $ifsc_code : '' ;
$branch_name  = isSet($branch_name) ? $branch_name : '' ;
$qualification  = isSet($qualification) ? $qualification : '' ;
$address_1 = isSet($address_1) ? $address_1 : '' ;
$description = isset($description)?$description:'';
$referedby = isset($referedby)?$referedby:'0';
$acc_type = isset($acc_type)?$acc_type:'0';
$nimg = isset($nimg)?$nimg:'';
$DisplayDeleteImgLink = isset($DisplayDeleteImgLink)?$DisplayDeleteImgLink:''; 
$Img_Ext = isset($Img_Ext)?$Img_Ext:'';
$ShowOldImg = "style='display:none;'";
$psw = isset($psw)?$psw:'';
$salary  = isSet($salary) ? $salary : '' ;
$userimages = isSet($userimages) ? $userimages : '' ;
$resign_date = isset($resign_date)?$resign_date:'';

if($act ==  "del" && $nimg != "") {
    $RemoveImage = "uploads/userimages/$nimg";
    @unlink($RemoveImage);
    $db->insertrec("update gen_user_mst set userimages = 'noimage.jpg' where user_auto_id='$id'");
    header("Location:usermasterupd.php?upd=2&msg=nimgscs&id=$id") ;
    exit ;
}
if($submit) {
    $crcdt = time();
    $name = trim(addslashes($name));
	$password_length = strlen($password);
	$ref_password = $password;
	$password = trim(addslashes(md5($password)));
	$mobile_1 = trim(addslashes($mobile_1));
	$phone = trim(addslashes($phone));
	$email_id = trim(addslashes($email_id));
	$bank_name  = trim(addslashes($bank_name));
	$acc_no  = trim(addslashes($acc_no));
	$ifsc_code  = trim(addslashes($ifsc_code));
	$branch_name  = trim(addslashes($branch_name));
	$qualification = trim(addslashes($qualification));
	$address_1 = trim(addslashes($address_1));
	$description = addslashes($description);
	$salary = trim(addslashes($salary));
	
	if($_FILES['UsrImage']['tmp_name'] != "" && $_FILES['UsrImage']['tmp_name'] != "null") {
		$fpath = $_FILES['UsrImage']['tmp_name'] ;
		$fname = $_FILES['UsrImage']['name'] ;
		$getext = substr(strrchr($fname, '.'), 1);
		$Img_Ext = strtolower($getext); 
	}
	if($Img_Ext == "jpg" || $Img_Ext == "jpeg" || $Img_Ext == "gif" || $Img_Ext == "png" || $Img_Ext == ''){
		if($password_length >= 4){
			$set  = "username = '$username'"; 
			$set  .= ",dept_id = '$dept_id'";  		
			$set  .= ",name = '$name'";
			$set  .= ",branch_id = '$branch_id'";
			$set  .= ",sex = '$sex'";
			$set  .= ",dob = '$dob'";
			$set  .= ",mobile_1 = '$mobile_1'";
			$set  .= ",phone = '$phone'";
			$set  .= ",email_id = '$email_id'";
			$set  .= ",bank_name = '$bank_name'";
			$set  .= ",acc_no = '$acc_no'";
			$set  .= ",ifsc_code = '$ifsc_code'";
			$set  .= ",branch_name = '$branch_name'";
			$set  .= ",qualification = '$qualification'";		
			$set  .= ",address_1 = '$address_1'";
			$set  .= ",description = '$description'";
			$set  .= ",referedby = '$referedby'";
			$set  .= ",salary = '$salary'";
			$set  .= ",doj = '$doj'";
			$set  .= ",resign_date = '$resign_date'";
			if($password !=""){
				$set  .= ",password = '$password'";  		
				$set  .= ",ref_password = '$ref_password'";
			}
			if($upd == 1){
				$set  .= ",credt = '$crcdt'";    
				$set  .= ",active_status = '1'";
				$set  .= ",usercre = '$usrcre_name'";
				$idvalue = $db->insertid("insert into gen_user_mst set $set");
				$act = "add";
			}
			else if($upd == 2){
				$set  .= ",chgdt = '$crcdt'";    
				$set  .= ",userchg = '$usrcre_name'";
				$db->insertrec("update gen_user_mst set $set where user_auto_id='$idvalue'");
				$act = "upd";
			}
			if($_FILES['UsrImage']['tmp_name'] != "" && $_FILES['UsrImage']['tmp_name'] != "null") {
				$fpath = $_FILES['UsrImage']['tmp_name'] ;
				$fname = $_FILES['UsrImage']['name'] ;
				$getext = substr(strrchr($fname, '.'), 1);
				$ext = strtolower($getext);
				$NgImg= $idvalue.".".$ext;
				$set_img = "userimages = '$NgImg'" ;
				$des = "uploads/userimages/$NgImg";
				move_uploaded_file($fpath,$des) ;
				chmod($des,0777);
				$iimg=$db->insertrec("select userimages from gen_user_mst where user_auto_id='$idvalue'");
				if($iimg !="noimage.jpg"){
					$RemoveImage = "uploads/userimages/$nimg";
					@unlink($RemoveImage);
				}
				$db->insertrec("update gen_user_mst set $set_img where user_auto_id='$idvalue'");
			}
			echo "<script>location.href='usermaster.php?act=$act';</script>";
			header("location:usermaster.php?act=$act");
			exit;		
		}
		else {
			header("location:usermasterupd.php?&id=$idvalue&upd=$upd&act=ps");
			exit;
		}
	}
	else{
		header("location:usermasterupd.php?&id=$idvalue&upd=$upd&act=img");
		exit;
	}
} 

$GetRecord = $db->singlerec("select * from gen_user_mst where user_auto_id='$id'");
@extract($GetRecord);
$user_type_auto_id = $dept_id;
//code for gender
$GenderList = "<option value=''>--Select-</option>";
for($i=1; $i<count($GT_Gender); $i++){
	if($i == $sex)
		$GenderList .= "<option value='$i' selected>$GT_Gender[$i]</option>";
	else	
		$GenderList .= "<option value='$i'>$GT_Gender[$i]</option>";
}
//code for Dept
$DeptList = "<option value=''>--Select Department--</option>";
for($dp=1; $dp<count($PS_Dept); $dp++){
	if($dp == $dept_id)
		$DeptList .= "<option value='$dp' selected>$PS_Dept[$dp]</option>";
	else	
		$DeptList .= "<option value='$dp'>$PS_Dept[$dp]</option>";
}

//code for images 
if($userimages == "noimage.jpg") {
        $ShowOldImg = "";
   $DisplayDeleteImgLink = '';
    }
else if($userimages != "") {
        $ShowOldImg = "";
   $DisplayDeleteImgLink = '<a href="usermasterupd.php?upd=2&act=del&nimg='.$userimages.'&id='.$id.'">Delete</a>';
    }
//code for refered by
$RefList = "<option value=''>- - Select Refered By- -</option>";
$GetEmp = $db->get_all("select user_auto_id,name,username from  gen_user_mst where active_status='1' order by name");
for($g=0;$g<count($GetEmp);$g++){
	$rfid = $GetEmp[$g]['user_auto_id'];
	$rfname = ucwords($GetEmp[$g]['name']);
	$rfuname = $GetEmp[$g]['username'];
	if($referedby == $rfid)
		$RefList .= "<option value='$rfid' selected>$rfname - $rfuname</option>";
	else
		$RefList .= "<option value='$rfid'>$rfname - $rfuname</option>";
}
if($upd==2){
	$TextChange = "Edit";
	$imghid = "";
	if($psw == 1){$passshow = "<b><font color='green'>Your password is : $ref_password</font></b>";}
else{$passshow = "<span><a href='usermasterupd.php?upd=$upd&id=$id&page=$page&psw=1'>Get Password</a></span>";}
}
else{
	$TextChange = "Creat";
	$imghid = "style='display:none;'";
	$passshow = "";
}

if($act == "ps")
	$Message = "<b><font color='red'>atleast 4 minimum character need!!!...</font></b>";
else if($act == "img")
	$Message = "<b><font color='red'>Please Upload in this type of Image png & jpg & jpeg & gif</font></b>" ;

?>
<div class="boxed">
	<!--CONTENT CONTAINER-->
	<!--===================================================-->
	<div id="content-container">
		<?php include "header_nav.php"; ?>
		<div class="pageheader">
			<h3><i class="fa fa-home"></i>Staff </h3>
			<div class="breadcrumb-wrapper">
				<span class="label">You are here:</span>
				<ol class="breadcrumb">
					<li> <a href="welcome.php"> Home </a> </li>
					<li class="active"> Staff </li>
				</ol>
			</div>
		</div>
		<!--Page content-->
		<!--===================================================-->
		<div id="page-content">
			<div class="row">
			  <div class="eq-height">
				 <div class="col-sm-6 eq-box-sm">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $TextChange;?> Staff <?php echo $Message;?></h3>
						</div>
						<form class="form-horizontal" method="post" action="usermasterupd.php" enctype="multipart/form-data">
							<input type="hidden" name="idvalue" value="<?php echo $id;?>" />
							<input type="hidden" name="upd" value="<?php echo $upd;?>" />
							<div class="panel-body">
								<table style="padding:25px;">
									<tr>
										<td>Username <font color="red">*</font></td>
										<td><input type="text" name="username" class="form-control" id="username" value="<?php echo $username; ?>" >
										</td>
										<td>Password <font color="red">*</font></td>
										<td><input type="password" class="form-control" id="password" name="password" size="40"  value="" placeholder="*****" >
										<?php echo $passshow; ?>
										</td>
									</tr>
									<tr>
										<td>Name <font color="red">*</font></td>
										<td><input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control">
										</td>
										<td>Gender <font color="red">*</font></td>
										<td><select style="width: 160px;" class="form-control" id="sex" name="sex"><?php echo $GenderList; ?></select>
										</td>
									</tr>
									<tr>
										<td>Mobile No <font color="red">*</font></td>
										<td><input type="text" class="form-control" id="mobile_1" name="mobile_1" value="<?php echo $mobile_1; ?>" maxlength="10" onkeypress = "return InpOnlyNumbers(event)"></td>
										<td>Phone</td>
									<td><input type="text" name="phone" id="phone" value="<?php echo $phone; ?>" class="form-control" maxlength="10" onkeypress = "return InpOnlyNumbers(event)"/></td>
									</tr>
									<tr>
										<td>Email Id <font color="red">*</font></td>
										<td><input type="text" class="form-control" id="email_id" name="email_id" value="<?php echo $email_id; ?>"></td>
										<td>Date Of Birth</td>
										<td><input type="text" name="dob" id="dob" value="<?php echo $dob; ?>" class="form-control" Placeholder="Select Date Of Birth"></td>
									</tr>
								<!--	<tr>
										<td>Bank Name </td>
										<td><input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo $bank_name; ?>"></td>
										<td>Account No </td>
										<td><input type="text" class="form-control" id="acc_no" name="acc_no" value="<?php echo $acc_no; ?>" ></td>
									</tr>
									<tr>
										<td>Ifsc Code </td>
										<td><input type="text" class="form-control" id="ifsc_code" name="ifsc_code" value="<?php echo $ifsc_code; ?>"></td>
										<td>Branch Name </td>
										<td><input type="text" class="form-control" id="branch_name" name="branch_name" value="<?php echo $branch_name; ?>" ></td>
									</tr>-->
									<!--<tr>
										<td>Department<font color="red">*</font></td>
										<td><select class="form-control" name="dept_id"><?php echo $DeptList; ?></select></td><td></td><td><input type="text" name="doj" id="doj" value="<?php echo $doj; ?>"  placeholder="Date Of Joining"/></td>
									</tr>-->
									<tr>
										<!-- <td>Qualification <font color="red">*</font></td>
										<td><input type="text" class="form-control" id="qualification" name="qualification" value="<?php echo $qualification; ?>" ></td> -->
										<td>Image</td>
										<td><span <?php echo $imghid;?>><img src="uploads/userimages/<?php echo $userimages; ?>" width="120px" height="120px"><br><?php echo $DisplayDeleteImgLink; ?></span>
										<input name="UsrImage" type="file"></td>
									</tr>
									<!-- <tr>
										<td valign="top">Address <font color="red">*</font></td>
										<td><textarea name="address_1" id="address_1" class="form-control" cols="40" rows="4"><?php echo $address_1; ?></textarea></td>
										<td valign="top">Description </td>
										<td><textarea name="description" id="description" class="form-control" cols="40" rows="4"><?php echo $description; ?></textarea></td>
									</tr> -->
									
									<tr>
										<!--<td valign="top">Refered By <font color="red">*</font></td>
										<td><select style="width:344px;" id="referedby" name="referedby" class="form-control"><?php echo $RefList; ?></select></td>
									<td>Salary</td><td><input type="text" id="salary" name="salary" value="<?php echo $salary; ?>" maxlength="10" onkeypress = "return InpOnlyNumbers(event)"></td>-->
									
									</tr>
									<tr>
										<td></td><td colspan="3"><span id="DispResign"></span></td>
									</tr>
								</table>
							</div>
							<div class="panel-footer text-left">
								<div class="col-md-4  text-right"><input class="btn btn-info" type="submit" name="submit" value="Sign in"></div>
								<a class="btn btn-info" href="usermaster.php">Cancel</a>
							</div>
						</form>
						<!--===================================================-->
						<!--End Horizontal Form-->
					</div>
				</div>
			  </div>
			</div>
		</div>
		<!--===================================================-->
		<!--End page content-->
	</div>
	<!--===================================================-->
	<!--END CONTENT CONTAINER-->
	<?php include "leftmenu.php"; ?>
</div>
<?php include "footer.php"; ?>