<?php
include "framedb.php";
include "global.php";
include "routing.php";
include "dropdownelement.php";
include "common.php"; 
include "devices.php";
include "numtostr.php"; 
include "resize-class.php";

$db=new database();
$com_obj=new common();
$drop = new dropdown;

$GetSite = $db->singlerec("select * from general_setting where active_status='1'");
$sitelogo = $GetSite['img'];
$sitetitle = ucwords($GetSite['website_title']);
$siteurl = $GetSite['website_url'];
$siteemail = $GetSite['admin_email'];
$sitepaypalemil = $GetSite['paypal_email'];
$adminphone = $GetSite['adminphone'];
$GetSiteAbt = $db->singlerec("select aboutus,terms,privacy from cms where active_status='1'");
$siteaboutus = ucfirst($GetSiteAbt['aboutus']);
$terms = $GetSiteAbt['terms'];
$privacy = $GetSiteAbt['privacy'];

function textwatermark($src, $watermark, $save=NULL) { 
	$getext = substr(strrchr($src, '.'), 1);
	$ext = strtolower($getext);
	list($width, $height) = getimagesize($src);
	$image_p = imagecreatetruecolor($width, $height);
	if($ext == "png")
		$image = imagecreatefrompng($src);
	else if($ext == "jpeg" || $ext == "jpg")
		$image = imagecreatefromjpeg($src);
	else if($ext == "gif")
		$image = imagecreatefromgif($src);
	
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height); 
	$txtcolor = imagecolorallocate($image_p, 255, 255, 255);
	$font = 'monofont.ttf';
	$font_size = 14;
	imagettftext($image_p, $font_size, 0, 50, 150, $txtcolor, $font, $watermark);
	if ($save<>'') {
		imagejpeg ($image_p, $save, 100); 
	}
	else {
		header('Content-Type: image/jpeg');
		imagejpeg($image_p, null, 100);
	}
	imagedestroy($image); 
	imagedestroy($image_p); 
}
function currency($from  ,$to,$amount) {
	$url = "http://www.google.com/finance/converter?a=$amount&from=$from&to=$to"; 
	 
	    $request = curl_init(); 
	    $timeOut = 0; 
	    curl_setopt ($request, CURLOPT_URL, $url); 
	    curl_setopt ($request, CURLOPT_RETURNTRANSFER, 1); 
	 
	    curl_setopt ($request, CURLOPT_USERAGENT,"Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)"); 
	    curl_setopt ($request, CURLOPT_CONNECTTIMEOUT, $timeOut); 
	    $response = curl_exec($request); 
	    curl_close($request); 
	 
	    return $response;
}
?>