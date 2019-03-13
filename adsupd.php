<?php include"header.php"; ?>
<div class="boxed">
	<!--CONTENT CONTAINER-->
	<!--===================================================-->
	<div id="content-container">
		<?php include "header_nav.php"; ?>
		<div class="pageheader">
			<h3><i class="fa fa-home"></i>Ads </h3>
			<div class="breadcrumb-wrapper">
				<span class="label">You are here:</span>
				<ol class="breadcrumb">
					<li> <a href="welcome.php"> Home </a> </li>
					<li class="active"> Ads </li>
				</ol>
			</div>
		</div>
<?php
$upd = isset($upd)?$upd:'';
$id = isSet($id) ? $id : '' ;
$act = isSet($act) ? $act : '' ;
$page = isSet($page) ? $page : '' ;
$Message = isSet($Message) ? $Message : '' ;
$name = isSet($name) ? $name : '' ;
$comment = isSet($comment) ? $comment : '' ;
$img = isSet($img) ? $img : '' ;
$ImgExt = isSet($ImgExt) ? $ImgExt : '' ;
$DisplayDeleteImgLink = isSet($DisplayDeleteImgLink) ? $DisplayDeleteImgLink : '' ;
$UsrImg = isSet($UsrImg) ? $UsrImg : '' ;

if($act ==  "del" && $nimg != "") {
    $RemoveImage = "uploads/icon/$nimg";
    @unlink($RemoveImage);
    $db->insertrec("update ads set img='noimage.jpg' where id='$id'");
    header("Location:adsupd.php?upd=2&msg=nimgscs&id=$id") ;
    exit ;
}

if($submit) {
    $crcdt = time();
	$name = trim(addslashes($name));
	$comment = trim(addslashes($comment));
		$checkStatus = $db->check1column("ads","name",$name);
		if($upd == 2)
			$checkStatus = 0;
		
	if($_FILES['UsrImg']['tmp_name'] != "" && $_FILES['UsrImg']['tmp_name'] != "null") {
		$fpath = $_FILES['UsrImg']['tmp_name'] ;
		$fname = $_FILES['UsrImg']['name'] ;
		$getext = substr(strrchr($fname, '.'), 1);
		$ImgExt = strtolower($getext); 
	}
	if($ImgExt=="jpg" || $ImgExt == "jpeg" || $ImgExt == "gif" || $ImgExt == "png" || $ImgExt == ''){	
		if($checkStatus == 0){
			$set  = "name = '$name'";
			$set  .= ",comment = '$comment'";
			$set  .= ",ipaddr = '$ipaddress'";		
			if($upd == 1){
				$set  .= ",crcdt = '$crcdt'";    
				$set  .= ",active_status = '1'";
				$set  .= ",usercre = '$usrcre_name'";
				$idvalue = $db->insertid("insert into ads set $set");
				$act = "add";
			}
			else if($upd == 2){
				$set  .= ",chngdt = '$crcdt'";    
				$set  .= ",userchng = '$usrcre_name'";
				$db->insertrec("update ads set $set where id='$idvalue'");
				$act = "upd";
			}
			
			if($_FILES['UsrImg']['tmp_name'] != "" && $_FILES['UsrImg']['tmp_name'] != "null") {
					$fpath = $_FILES['UsrImg']['tmp_name'] ;
					$fname = $_FILES['UsrImg']['name'] ;
					$getext = substr(strrchr($fname, '.'), 1);
					$ext = strtolower($getext);
					$NgImg= $idvalue.".".$ext;
					$set_img = "img = '$NgImg'" ;
					$des = "uploads/icon/$NgImg";
					
					move_uploaded_file($fpath,$des) ;
					chmod($des,0777);
					$iimg=$db->insertrec("select img from ads where id='$idvalue'");
					if($iimg!= "noimage.jpg") {
						$RemoveImage = "uploads/icon/$nimg";
						@unlink($RemoveImage);
					}
					$db->insertrec("update ads set $set_img where id='$idvalue'");
				}
			header("location:ads.php?page=$pg&act=$act");
			exit;
		}	
		 else {
			 $id = $idvalue;
			$Message = "<font color='red'>$name Already Exit's</font>";
		}
	}
	else{
		$id = $idvalue;
		$Message = "<font color='red'>kindly upload jpg,gif,png image format only</font>";
	}
}
if($upd == 1){
	$hidimg = "style='display:none;'";
	$TextChange = "Add";
}
else if($upd == 2){
	$hidimg = "";
	$TextChange = "Edit";
}
	
$GetRecord = $db->singlerec("select * from ads where id='$id'");
@extract($GetRecord);
$name = stripslashes($name);
$comment = stripslashes($comment);

//code for images 
if($img == "noimage.jpg") {
        $ShowOldImg = "";
   $DisplayDeleteImgLink = '';
    }
else if($img != "") {
        $ShowOldImg = "";
   $DisplayDeleteImgLink = '<a href="adsupd.php?upd=2&act=del&nimg='.$img.'&id='.$id.'">Delete</a>';
    }
	
?>
		<!--Page content-->
		<!--===================================================-->
		<div id="page-content">
			<div class="row">
			  <div class="eq-height">
				 <div class="col-sm-6 eq-box-sm">
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><?php echo $TextChange;?> Ads</h3>
						</div>
						<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
							<input type="hidden" name="idvalue" value="<?php echo $id;?>" />
							<input type="hidden" name="upd" value="<?php echo $upd;?>" />							
							<div class="panel-body">
								<table style="padding:25px;">
									<tr>
										<td>Name <font color="red">*</font></td>
										<td><input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control">
										</td>
									</tr>
									<tr>
										<td>Comments <font color="red">*</font></td>
										<td><input type="text" name="comment" id="comment" value="<?php echo $comment; ?>" class="form-control">
										</td>
									</tr>
									<tr>
										<td>Image</td>
										<td><img src="uploads/icon/<?php echo $img; ?>" width="120px" height="120px" <?php echo $hidimg;?>> <br><?php echo $DisplayDeleteImgLink; ?>
										<input name="UsrImg" type="file"></td>
									</tr>
								</table>
							</div>
							<div class="panel-footer text-left">
								<div class="col-md-4  text-right"><input class="btn btn-info" type="submit" name="submit" value="Submit"></div>
								<a class="btn btn-info" href="ads.php">Cancel</a>
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