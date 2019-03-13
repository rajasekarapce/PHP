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
		document.getElementById("cat1_id").innerHTML = xmlhttp.responseText;
		}
	  }
	var url = "ajaxcat.php?getval="+getval;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}
function maincatfn(getval){
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
		document.getElementById("cat2_id").innerHTML = xmlhttp.responseText;
		document.getElementById("cat3_id").innerHTML = "<option>--select--</option>";
		}
	  }
	var url = "ajaxcat1.php?getval="+getval;
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
} 
function subcatfn(getval){
	var getval2 = document.getElementById("cat1_id").value;
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
		document.getElementById("cat3_id").innerHTML = xmlhttp.responseText;
		}
	  }
	var url = "ajaxcat2.php?getval="+getval+"&getval2="+getval2+'';
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
} 
