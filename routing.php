<?php
$GT_Active = "<img src='img/yes.gif'>";
$GT_InActive = "<img src='img/no.gif'>";
$GT_Edit = "<img src='img/envelope--minus.png'>";
$GT_Delete = "<img src='img/cross-white.png'>";
$GT_Rec = "<img src='img/report--plus.png'>";
$GT_View = "<img src='img/blue_view.gif'>";
$GT_Family = "<img src='img/users.png'>";
$GT_Back = "<img src='img/arrow-skip-180.png'>";
$GT_photo = "<img src='img/photos.png'>";
$GT_Reply = "<img src='img/arrow-curve-000-left.png'>";
$GT_LeftSign = "<img src='img/left.png'>";
$GT_RightSign = "<img src='img/right.png'>";
$GT_Make_app = "<img src='img/appmticon.gif'>";
$GT_Visit_app = "<img src='img/visit_icon.png'>";
$GT_Pdficon = "<img src='img/pdficon.png'>";
$Sky_pdf = "<img src='img/pdf.png'>";
$Sky_tick = "<img src='img/tick.png'>";
$GT_Delet = "<img src='img/cross-white.png'>";
$GT_Bus = "<img src='img/business.png'>";
$GT_Event = "<img src='img/event.png'>";
$GT_Blog = "<img src='img/blog.png'>";
$GT_Ads = "<img src='img/ads.png'>";
$GT_Xl = "<img src='img/xl.png' width='18'>";

$GT_DateFmt1 = "d-m-Y"; // date-month-year (04-08-1981)
$GT_DateFmt2 = "d/m/Y"; // date-month-year (04/08/1981)

$livepage = $_SERVER["PHP_SELF"];
$livepage = substr(strrchr($livepage, '/'), 1);
$GetUrl = $_SERVER["REQUEST_URI"];
$RemoveStr = substr($GetUrl,0,7);
$SetUrl = "http://easytoselect.com".$RemoveStr ;
$hostlink = $_SERVER['SERVER_NAME'];
$file_with_path = $hostlink.$GetUrl;
$webUrl="http://easytoselect.com/";

$crcdate=date("Y-m-d");

//google capchakey details
$captchasitekey = "6Ld5qCYTAAAAAIgd-nrbWgRXloSaTDKquFFIgWhb";
$captchasecretkey = "6Ld5qCYTAAAAAAd-ZRDK0qGa2cbzGHo1xdvISbbf";
$Adminusrtype = 1; //Admin Id for accessing all 
$ipaddress = $_SERVER['REMOTE_ADDR'];
$browser_name = $_SERVER['HTTP_USER_AGENT'];
$ES_Crncy="$";
?>