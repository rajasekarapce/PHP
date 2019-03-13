<?php
include "AMframe/config.php"; ob_start();

$getval=$_REQUEST['getval'];
$row=$db->get_all("select id,name from category where active_status='1' and cat_id='$getval' and parent_id='0' AND child_id='0'"); 
$disp="<option value='0'>--select--</option>";
for($i=0;$i<count($row);$i++){
	$id=$row[$i]['id'];
	$name=$row[$i]['name'];
	$disp .="<option value='$id'>$name</option>";
}
echo $disp;
?>