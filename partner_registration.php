<?php
include("header_new.php");
include_once("dblayer.php");
$db=new sql_db();
?>

<html>
<head>
<title>Partner Registration</title>
<script type="text/javascript" language="JavaScript1.2">

function test_email(val)
{
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(val))
		{
			return true;
		}
		else
		{
			return false;
		}

}
function test_mobile(val)
{
	var re10digit=/^\d{10}$/; 
	if (val.search(re10digit)==-1) { 
		return false; 
	}
	else
		return true; 
}
function ptnr_Validate(theForm)
{
	var val=document.theForm.name.value;
	if(val=='')
	{
		var sol=prompt("Please enter the name",val);
		document.theForm.name.value=sol;
		document.theForm.name.focus();
		return false;
	}

	var val1=document.theForm.Cperiod.value;
	if(val1=='')
	{
		var sol1=prompt("Please enter Contract Period",val1);
		document.theForm.Cperiod.value=sol1;
		document.theForm.Cperiod.focus();
		return false;
	}
	var re_integer=/\d+/
		if (document.theForm.Cperiod.value.search(re_integer)==-1) 
		{
			alert("Please enter integer value");
			document.theForm.Cperiod.focus();
			return false;
		}
	var val2=document.theForm.Otype.value;
	if(val2=='')
	{
		var sol2=prompt("Please enter type of Organisation",val2);
		document.theForm.Otype.value=sol2;
		document.theForm.Otype.focus();
		return false;
	}

	var val9=document.theForm.Oregions.value;
	if(val9=='')
	{
		var sol3=prompt("Please enter Organisational region",val9);
		document.theForm.Oregions.value=sol3;
		document.theForm.Oregions.focus();
		return false;
	}
	var val3=document.theForm.cat.value;
	if(val3=='')
	{
		alert("Please select the State,District,Village and Mandal");
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
	var val10=document.theForm.street.value;
	if(val10=='')
	{
		var sol10=prompt("Please enter Street",val10);
		document.theForm.street.value=sol10;
		document.theForm.street.focus();
		return false;
	}
	var val7=document.theForm.pin.value;
	if(val7=='')
	{
		var sol7=prompt("Please enter the pin code",val7);
		document.theForm.pin.value=sol7;
		document.theForm.pin.focus();
		return false;
	}
	var re6digit=/^\d{6}$/
		if (document.theForm.pin.value.search(re6digit)==-1) 
		{
			alert("Please enter a valid 6 digit pin code number");
			document.theForm.pin.focus();
			return false;
		}
	var val8=document.theForm.email.value;
	if(val8=='')
	{
		var sol8=prompt("Please enter the Email",val8);
		document.theForm.email.value=sol8;
		document.theForm.email.focus();
		return false;
	}   
		if (test_email(document.theForm.email.value)){
			document.theForm.email.focus();
		}
		else
		{
			alert("Invalid E-mail Address! Please re-enter.")
			document.theForm.email.focus();
			return false;
		}
	

	var val11=document.theForm.Mphone.value;
	if(val11=='')
	{
		var sol11=prompt("Please enter the Mobile phone number",val11);
		document.theForm.Mphone.value=sol11;
		document.theForm.Mphone.focus();
		return false;
	}                


	/*var re10digit=/^\d{10}$/ 
		if (document.theForm.Mphone.value.search(re10digit)==-1) { 
			alert("Please enter a valid 10 digit phone number"); 
			document.theForm.Mphone.focus(); 
			return false; 
		}*/
	if(!test_mobile(val11))
	{
		alert("Please enter a valid 10 digit phone number"); 
		document.theForm.Mphone.focus(); 
		return false; 
	} 
	var val12=document.theForm.Ftype.value;
	if(val12=='')
	{
		var sol12=prompt("Please enter type of Farming",val12);
		document.theForm.Ftype.value=sol12;
		document.theForm.Ftype.focus();
		return false;
	}                
	var val13=document.theForm.Imob.value;
	if(val13!='' && !test_mobile(val13))
	{
		alert("Please enter a valid 10 digit phone number"); 
		document.theForm.Imob.focus();
		return false;
	} 
	var val14=document.theForm.Iemail.value;
	if(val14!='' && !test_email(val14))
	{
		alert("Invalid E-mail Address! Please re-enter.");
		document.theForm.Iemail.focus();
		return false;
	}
	var val15=document.theForm.Cmob.value;
	if(val15!='' && !test_mobile(val15))
	{
		alert("Please enter a valid 10 digit phone number"); 
		document.theForm.Cmob.focus();
		return false;
	}
	var val16=document.theForm.Cemail.value;
	if(val16!='' && !test_email(val16))
	{
		alert("Invalid E-mail Address! Please re-enter.");
		document.theForm.Cemail.focus();
		return false;
	}
}
// end of validations

//  STATE DIST MANDAL VILLAGE CHECK*******************

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
				AjaxFunctiondistrict(document.getElementById('4').value);

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
				AjaxFunctionmandal(document.getElementById('4').value);
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
				document.getElementById('4').value;
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
</head>
<body>
<center>
<style type=text/css>
body
{
	font-family:sans-serif;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><center>

<body bgcolor="green">

<?php

if($_SESSION['mode'] && $_SESSION['mode']!='ceo')
{
	echo "<font color='red'>You are already registered</font>";
	return;
}
else if ($current_user_id=='Guest')
{
	echo "<font color='red'>Acess Denied</font>";
	return;
}
?>

<div style="font-size : 20 ; font-color : black ; font-family : verdana"><h2>Partner Registration</h2></div>

<hr width=70% noshade>
<form name="theForm" action="partner_process.php" method="POST" onsubmit='return ptnr_Validate(theForm);'>
<table width=50% style="border-color : black ; border-style : groove ; border-width : medium" bgcolor="#F2F5A9">

<tr>
<td width=100% bgcolor="" valign="top">
<p>
<table width="500" border="0" align="center">

<tr><td width=150><font ><b>Name</b></font><font color='red'> * </font></td>
<td><input name="name" type="text"  size=25></td></tr>

<p><tr><td><font ><b>Date of Joining</b></font><font color='red'> * </font></td>
<td><select name="Jday" id="Jday" size="1">

<?php
for ($counter =1; $counter <= 31; $counter += 1)
{
	if($counter==date('d'))
		echo "<option selected>".$counter."</option>";
	else
		echo "<option>".$counter."</option>";
			
}
echo "</select>";
?>

<select name="Jday1" id="Jday1" size="1">

<?php
for ($counter =1; $counter <= 12; $counter += 1)
{
	if($counter==date('m'))
		echo "<option selected>".$counter."</option>";
	else
		echo "<option>".$counter."</option>";
			
}
echo "</select>";
?>

<select name="Jday2" id="day" size="1">
<option >2011</option>
<option selected ><?php echo date("Y")?></option>
<?php
for ($counter = date("Y")+1; $counter <= 2015; $counter += 1) {
	echo "<option>".$counter."</option>";
}
echo "</select>";
?>
</td></tr></p>


<tr><td width=155><font ><b>Contract Period(yrs)</b></font><font color='red'> * </font></td>
<td><input name="Cperiod" type="text"  size=25></td></tr>


<tr><td width=150><font ><b>Organisation Type</b></font><font color='red'> * </font></td>
<td><input name="Otype" type="text"  size=25></td></tr>


<tr><td width=150><font ><b>Operational Regions</b></font><font color='red'> * </font></td>
<td><input name="Oregions" type="text"  size=25></td></tr>

<form id="testform" name="testform" method='POST' action='mainck.php'>
<tr><td><b> State</b> <font color='red'> * </font></td><td><select id = '1' name=cat onchange="AjaxFunction(this.value);">
<option value=''>Select One</option>
<?php
$q=$db->sql_query("select * from STATE ");
while($n=$db->sql_fetch_array()){
	echo "<option value=$n[state_id]>$n[state_name]</option>";
}
?> 

</select> </td></tr>
<div id = 'divisions1'>
<tr><td><b>
District</b><font color='red'> * </font></td><td><select id = '2' name=subcat onchange="AjaxFunctiondistrict(this.value);">
<option value=''>Select One</option>
<?php
$q=$db->sql_query("select * from DISTRICT where  SID='".$n[state_id]."'");
while($m=$db->sql_fetch_array()){
	echo "<option value=$m[district_id]>$m[district_name]</option>";
	session_start($m[district_id]);
} 
?>
</select></td>
<td style=border-style:none align='left'><a href="javascript:add2('addDiv1')">Add New District</a></td><tr><td></td><td>
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
$q=$db->sql_query("select * from  MANDAL where DID='".$m[district_id]."'");
while($o=$db->sql_fetch_array()){
	echo "<option value=$o[mandal_id]>$o[mandal_name]</option>";
//	$temp=$o[mandal_id];
	session_start($o[mandal_id]);
}
?>

</select> </td>
<td style=border-style:none ><a href="javascript:add2('addDiv2')">Add New Mandal</a></td><tr><td></td><td>
<style type = "text/CSS">
#addDiv2
{display:None}
</style>
<input id = 'addDiv2' type = 'text' name = 'addMandal' >
</td></tr>
</div>

<div id='divisions3'>
<tr><td>
<b>Village</b><font color='red'> * </font></td><td><select id = '4' name=subcatvillage>
<option value=''>Select One</option>
<?php
$q=$db->sql_query("select * from  VILLAGE where MID='".$o[mandal_id]."'");
while($l=$db->sql_fetch_array())
		{
	        echo "<option value=$l[vil_id]>$l[vil_name]</option>";
		}
	     $db->sql_close();
?>
</select>
</td>
<td style=border-style:none align='left'><a href="javascript:add2('addDiv3')">Add New Village</a></td><tr><td></td><td>
<style type = "text/CSS">
#addDiv3
{display:None}
</style>
<input id = 'addDiv3' type = 'text' name = 'addVillage' >
</td></tr>
</form>

<tr><td width=150><font ><b>Street</b></font><font color='red'> * </font></td>
<td><input name="street" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Pin code</b></font><font color='red'> * </font></td>
<td><input name="pin" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Email</b></font><font color='red'> * </font></td>
<td><input name="email" type="text"  size=25></td></tr>	      

<tr><td width=150><font ><b>Homepage</b></font></td>
<td><input name="Hpage" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Land phone</b></font></td>
<td><input name="Lphone" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Mobile phone</b></font><font color='red'> * </font></td>
<td><input name="Mphone" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Farming Type </b></font><font color='red'> * </font></td>
<td><input name="Ftype" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Incharge Name </b></td>
<td><input name="Iname" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Incharge Mobile</b></td>
<td><input name="Imob" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Incharge Email </b></td>
<td><input name="Iemail" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Contact Name </b></td>
<td><input name="Cname" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Contact Mobile </b></td>
<td><input name="Cmob" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Contact Email </b></td>
<td><input name="Cemail" type="text"  size=25></td></tr>

</td></tr>         
<br>

<tr>
<td><p align="center"><input type="submit" name="Submit" value="submit"  onclick='return ptnr_Validate(theForm);'> &nbsp;&nbsp; </p></td><td><p align='left'><input type="reset" name="reset" value="reset"> </p></td>
</tr>

</form>
</table>

<hr width=70% noshade>
<div style="color : black ; font-size : 15 ; font-family : verdana">Copyrights &copy; reserved @eSagu </div>

</center>
</body>
</html>
