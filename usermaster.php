<?php include "header.php"; ?>
            <!--===================================================-->
            <!--END NAVBAR-->
            <div class="boxed">
                <!--CONTENT CONTAINER-->
                <!--===================================================-->
                <div id="content-container">
                    <?php include "header_nav.php"; ?>
                    <div class="pageheader">
                        <h3><i class="fa fa-home"></i> Staff </h3>
                        <div class="breadcrumb-wrapper">
                            <span class="label">You are here:</span>
                            <ol class="breadcrumb">
                                <li> <a href="welcome.php"> Home </a> </li>
                                <li class="active">Staff </li>
                            </ol>
                        </div>
                    </div>
<?php
$act = isSet($act) ? $act : '' ; 
$id = isSet($id) ? $id : '' ;
$upd = isSet($upd) ? $upd : '' ;
$status = isSet($status) ? $status : '' ;
$Message = isSet($Message) ? $Message : '' ;

if($act == "del") {
	if($img !="noimage.jpg"){
		$RemoveImage = "uploads/userimages/$img";
		@unlink($RemoveImage);
	}
    $db->insertrec("delete from gen_user_mst where user_auto_id='$id'");
    header("location:usermaster.php?act='del'");
    exit ;
}
if($status == "1") {
    $db->insertrec("update gen_user_mst set active_status='0' where user_auto_id='$id'");
    header("location:usermaster.php?act=sts");
    exit ;
}
else if($status == "0") {
    $db->insertrec("update gen_user_mst set active_status='1' where user_auto_id='$id'");
    header("location:usermaster.php?act=sts");
    exit ;
}

$GetRecord=$db->get_all("select * from gen_user_mst where user_auto_id !=0 and user_level='0' order by user_auto_id desc");
if(count($GetRecord)==0)
    $Message="No Record found";
$disp = "";
for($i = 0 ; $i < count($GetRecord) ; $i++) {
   @extract($GetRecord[$i]);
    $idvalue = $user_auto_id;
	$crcdt=$GetRecord[$i]['credt'];
	$created=date("d/m/y",$crcdt);
	$slno = $i + 1 ;
    if($active_status == '0'){
        $DisplayStatus = $GT_InActive;
		$Title = "Active";
		$status_active = "Deactive";
		$EditLink = "<a class='btn btn-default' ><i class='fa ><font color='red'>--</font></i></a>";
	}	
    else if($active_status == '1'){
        $DisplayStatus = $GT_Active;
		$Title = "Deactive";
		$status_active = "Active";
		$EditLink = "<a href='usermasterupd.php?upd=2&id=$idvalue' title='Edit' class='btn btn-default' ><i class='fa fa-edit'></i></a>";
	}
    $disp .="<tr>
				<td><img src='uploads/userimages/$userimages' width='30px'></td>
				<td  align='left'>$name</td>
				<td  align='left'>$username</td>
				<td  align='left'>$email_id</td>
				<td  align='center'>$mobile_1</td>
				<td  align='left'>$usercre</td>
				<td width='20%'>
				<div class='btn-group btn-group-xs'>
				<a href='usermasterview.php?id=$idvalue&status=$active_status' title='View User Details' class='btn btn-default' data-toggle='tooltip'>$GT_View</a>
					<a href='usermaster.php?id=$idvalue&status=$active_status' title='$Title' class='btn btn-default' data-toggle='tooltip'>$DisplayStatus</a>
					$EditLink
					<a href='usermaster.php?id=$idvalue&act=del&img=$userimages' class='btn btn-default' title='Delete' data-toggle='tooltip' onclick='confirm();'>$GT_Delete</a>
				</div>
				</td>
			</tr>";
}
if($act == "'del'")
    $Message = "<font color='green'><b>Deleted Successfully</b></font>" ;
else if($act == "upd")
    $Message = "<font color='green'><b>Updated Successfully</b></font>" ;
else if($act == "add")
    $Message = "<font color='green'><b>Added Successfully</b></font>" ;
else if($act == "sts")
    $Message = "<font color='green'><b>Status Changed Successfully</b></font>" ;
?>
                    <!--Page content-->
                    <!--===================================================-->
                    <div id="page-content">
                        <!-- Basic Data Tables -->
                        <!--===================================================-->
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo $Message;?></h3>
                            </div>
                            <div class="panel-body">
							<div class="col-sm-12 text-right"><a class="btn btn-info" href="usermasterupd.php?upd=1">Add New</a></div>
                                <table id="demo-dt-basic" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
											<th></th>
											<th>Name</th>
											<th>Username</th>
											<th>Email Id</th>
											<th>Mobile</th>
											<th>Created by</th>
											<th class='cntrhid'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody><?php echo $disp; ?></tbody>
                                </table>
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