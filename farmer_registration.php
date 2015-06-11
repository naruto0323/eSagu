<?php
session_start();
$_SESSION['service']='3';
include("header_new.php");
?>

<html>
<head>
<title>Farmer Registration</title>
<script type="text/javascript" language="JavaScript1.2">

function farmer_Validate(theForm)
{ 
	
	var val1=document.theForm.name.value;
	if(val1=='')
	{
		// onSubmit='return Validate_val(theForm);
		var sol1=prompt("Please enter the name",val1);
		document.theForm.name.value=sol1;
		document.theForm.name.focus();
		return false;
	}
	var val30=document.theForm.cat.value;
	if(val30=='')
        {
        	// onSubmit='return Validate_val(theForm);
        	alert("Please select the state, Enter the district, Enter the Mandal, Enter the Village"); 
        	document.theForm.cat.focus();
	        return false;
        }
	var val4=document.theForm.subcat.value;
	if(val4=='' && document.getElementById('addDiv1').value=='')
	{
		alert("Please select the district");
		document.theForm.subcat.focus();
		return false;
	}
	var val5=document.theForm.subcatmandal.value;
	if(val5=='' && document.getElementById('addDiv2').value=='')
	{
		alert("Please select the mandal");
		document.theForm.subcatmandal.focus();
		return false;
	}
	var val6=document.theForm.subcatvillage.value;
	if(val6=='' && document.getElementById('addDiv3').value=='')
	{
		alert("Please select the village");
		document.theForm.subcatvillage.focus();
		return false;
	}
	var val7=document.theForm.mphone.value;
	if(val7=='')
	   {
	// onSubmit='return Validate_val(theForm);
	var sol7=prompt("Please enter Mobile phone number",val7);
	document.theForm.mphone.value=sol7;
	document.theForm.mphone.focus();
	return false;
	}
	//            var val11=document.theForm.Mphone.value;
	{
	var re10digit=/^\d{10}$/
	if (document.theForm.mphone.value.search(re10digit)==-1) {
	alert("Please enter a valid 10 digit phone number");
	document.theForm.mphone.focus();
	return false;
	}
	}
}
// end of validations

//  *********   STATE DIST MANDAL VIL  *************

function add2(val)
{
	var element = document.getElementById(val);
	element.style.display = 'table-cell';
}


function AjaxFunction(state_id)
{
	var httpxml;
	try
	{
		// Firefox, Opera 8.0+, Safari
		httpxml=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				httpxml=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}
	function stateck() 
	{
		if(httpxml.readyState==4)
		{
			var myarray=eval(httpxml.responseText);
			// Before adding new we must remove previously loaded elements
			for(j=document.getElementById('2').options.length-1;j>=0;j--)
			{
				document.getElementById('2').remove(j);
			}
			document.getElementById('2').options[0] = new Option ('Select One','',1);
			for (i=0;i<myarray.length;i++)
			{
				document.getElementById('2').options[i+1] = new Option ( myarray[i] , myarray[i] );
				AjaxFunctiondistrict(document.getElementById('2').value);
				AjaxFunctiondistrict(document.getElementById('3').value);

			}
		}
	}
	var url="state.php";
	url=url+"?state_id="+state_id;
	url=url+"&sid="+Math.random();
	httpxml.onreadystatechange=stateck;
	httpxml.open("GET",url,true);
	httpxml.send(null);
}


function AjaxFunctiondistrict(district_id)
{
	var httpxml;
	try
	{
		// Firefox, Opera 8.0+, Safari
		httpxml=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{
			httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				httpxml=new ActiveXObject("Microsoft.XMLHTTP");
			}

			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}

		}
	}

	function stateckdistrict() 
	{
		if(httpxml.readyState==4)
		{
			var myarray=eval(httpxml.responseText);
			// Before adding new we must remove previously loaded elements
			for(j=document.getElementById('3').options.length-1;j>=0;j--)
			{
				document.getElementById('3').remove(j);
			}
			document.getElementById('3').options[0] = new Option ('Select One','',1);
			for (i=0;i<myarray.length;i++)
			{
				document.getElementById('3').options[i+1] = new Option ( myarray[i] , myarray[i] );
				AjaxFunctionmandal(document.getElementById('3').value);
			} 
		}
	}
	//	var url="district.php";
	var url="district.php";
	url=url+"?district_id="+district_id;
	url=url+"&sid="+Math.random();
	httpxml.onreadystatechange=stateckdistrict;
	httpxml.open("GET",url,true);
	httpxml.send(null);
}

function AjaxFunctionmandal(mandal_id)
{
	var httpxml;
	try
	{
		// Firefox, Opera 8.0+, Safari
		httpxml=new XMLHttpRequest();
	}
	catch (e)
	{
		// Internet Explorer
		try
		{		 	
			httpxml=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{  
			try
			{
				httpxml=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				alert("Your browser does not support AJAX!");
				return false;
			}
		}
	}

	function stateck() 
	{
		if(httpxml.readyState==4)
		{
			var myarray=eval(httpxml.responseText);
			// Before adding new we must remove previously loaded elements
			for(j=document.getElementById('4').options.length-1;j>=0;j--)
			{
				document.getElementById('4').remove(j);
			}
			document.getElementById('4').options[0] = new Option ('Select One','',1);
			for (i=0;i<myarray.length;i++)
			{
				document.getElementById('4').options[i+1] = new Option ( myarray[i] , myarray[i] );
			}
		}
	}
	var url="mandal.php";	
	url=url+"?mandal_id="+mandal_id;
	url=url+"&sid="+Math.random();
	httpxml.onreadystatechange=stateck;
	httpxml.open("GET",url,true);
	httpxml.send(null);
}


</script>

	<body>
		<center>
			<style type=text/css>
			body
			{
			font-family:sans-serif;
			}
			</style>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<center>
		<body bgcolor="#667C26">

		<div style="font-size : 20 ; font-color : black ; font-family : verdana"><h2>Farmer Registration</h2></div>

<hr width=70% noshade>
<form name="theForm"  id="theForm" action="farmer_process.php" method="post" enctype="multipart/form-data">
<table width=50% style="border-color : black ; border-style : groove ; border-width : medium" bgcolor="#F2F5A9">



<?php

 $v=is_cord_active($current_user_id);
 if($v==2)
 {
 	echo '<tr><td width=150><font ><b>Login Name</b></font></td>
 	<td>';
	$number=get_nof_farmers2(get_cord_id($current_user_id))+1;
	echo $current_user_id."_".$number;
	echo '</td></tr>';
	echo '<tr><td width=150><b>Password:</b><font color="red"> * </font></td>
	<td><input type="password" name="passwd"></td></tr>';
	echo '<tr><td width=150><b>Re-Enter Password:</b><font color="red"> * </font></td>
	<td><input type="password" name="passwd1"></td></tr>';
}
?>
<tr><td width=150><font ><b>Name</b><font color='red'> * </font></font></td>
<td><input name="name" type="text"  size=25></td></tr>

<!-- <form id="testform" name="testform" method='POST' action='mainck.php'> -->
<form id="testform" name="testform" method='POST'>
<tr><td><b> State </b><font color='red'> * </font></td><td><select id = '1' name="cat" onchange="AjaxFunction(this.value);">
<option value=''>Select One</option>
<?php
//require "config.php";// connection to database
include_once('dblayer.php');
$db=new sql_db();
$q=$db->sql_query("select * from STATE ");
while($n=$db->sql_fetch_array()){
	echo "<option value=$n[state_id]>".$n[state_name]."</option>";
//		echo "<BR>stateids<BR>",$n[state_id];
}
//echo" <input type=hidden value='$n[state_name]' name=\"st\" >";
?> 
</select></td></tr>

<div id = 'divisions1'>
<tr><td>
<b>District</b><font color='red'> * </font></td>
<td><select id = '2' name=subcat onchange="AjaxFunctiondistrict(this.value);">
<option value=''>Select One</option>
<?php
//require "config.php";// connection to database
// include_once('dblayer.php');
$db=new sql_db();
//$q=$db->sql_query("select * from DISTRICT where SID='$n[state_id]>'");
$q=$db->sql_query("select * from DISTRICT where SID='".$n[state_id]."'");
echo $q;
while($m=$db->sql_fetch_array()){
	echo "<option value=$m[district_id]>$m[district_name]</option>";
//	session_start($m[district_id]);
	$db->sql_close();
} 
?>
</select> </td>


<td style=border-style:none align='left'><a href="javascript:add2('addDiv1')">Add New District</a></td><tr><td></td>

<td>
<style type = "text/CSS">
#addDiv1
{display:None}
</style>
<input id = 'addDiv1' type = 'text' name = 'addDistrict' >
</td></tr>
</div>

<div id='divisions2'>
<tr><td><b>
Mandal</b><font color='red'> * </font></td><td><select id = '3' name=subcatmandal onchange="AjaxFunctionmandal(this.value);">

<option value=''>Select One</option>
<?php
$db=new sql_db();
$q=$db->sql_query("select * from  MANDAL where DID='".$m[district_id]."'");
while($o=$db->sql_fetch_array()){
	echo "<option value=$o[mandal_id]>$o[mandal_name]</option>";
	$db->sql_close();
}
?>

</select></td>
<td style=border-style:none ><a href="javascript:add2('addDiv2')">Add New Mandal</a></td><tr><td></td><td>
<style type = "text/CSS">
#addDiv2
{display:None}
</style>
<input id = 'addDiv2' type = 'text' name = 'addMandal' >

</td></tr>
</div>

<div id='divisions3'>
<tr><td><b>
Village</b><font color='red'> * </font></td><td><select id = '4' name=subcatvillage>
<option value=''>Select One</option>
</select>
</td>
<td style=border-style:none align='left'><a href="javascript:add2('addDiv3')">Add New Village</a></td><tr><td></td><td>
<style type = "text/CSS">
#addDiv3
{display:None}
</style>
<input id = 'addDiv3' type = 'text' name = 'addVillage'>
</td></tr>
</form>

<tr><td width=150><font ><b>Mobile Number</b><font color='red'> * </font></font></td>
<td><input name="mphone" type="text"  size=25></td></tr>


<tr><td><p align="center">
<center>
<input type="submit" name="Submit" value="submit"  onclick='return farmer_Validate(theForm);'> 
<td height = 40><input type="reset" name="reset" value="reset"> </td>
</center>
</p></td></tr>


</td>
</tr>
</form>
</table>

<hr width=70% noshade>
<div style="color : black ; font-size : 15 ; font-family : verdana">Copyrights &copy; reserved @eSagu </div>

</center>
</body>
</html>
