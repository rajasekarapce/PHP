function mcatfn(getval){
	if (window.XMLHttpRequest)
	  {
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("prod_cateid").innerHTML = xmlhttp.responseText;
		}
	  }
	var url = "ajaxcat.php?getval="+getval;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}
function subcatfn(getval){
	if (window.XMLHttpRequest)
	  {
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("prod_subcatid").innerHTML = xmlhttp.responseText;
		}
	  }
	var url = "ajaxcat1.php?getval="+getval;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}