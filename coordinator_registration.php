<?php
include_once("header_new.php");
include_once("dblayer.php");
$db=new sql_db();
?>

<html>
<head>
<title>Coordinator Registration</title>
<script type="text/javascript" language="JavaScript1.2">
function enableOther(selObj)
{
	//Create reference to text field
	textObj = document.getElementById('spouse');
	//Test select field value
	if(selObj.options[selObj.selectedIndex].value=='Married')
	{
		//Enable text field
		textObj.disabled = false;
	}
	else
	{
		//Disable text field & clear value
		textObj.disabled = true;
		textObj.value    = '';
	}
	return;
}

function cord_Validate(theForm)
{
	var val0=document.theForm.passwd.value;
	if(val0=='')
	{
		var sol=prompt("Please enter the password",val);
		document.theForm.passwd.value=sol;
		document.theForm.passwd.focus();
		return false;
	}
	var val01=document.theForm.passwd1.value;
	if(val01=='')
	{
		var sol=prompt("Please re-enter the password",val);
		document.theForm.passwd1.value=sol;
		document.theForm.passwd1.focus();
		return false;
	}
	if(val01!=val0)
	{
		alert("Passwords are not matched");
		document.theForm.passwd1.focus();
		return false;
	}
	
	var val=document.theForm.Userid.value;
	if(val=='')
	{
		var sol=prompt("Please enter the name",val);
		document.theForm.Userid.value=sol;
		document.theForm.Userid.focus();
		return false;
	}

	var val2=document.theForm.file.value;
	if(val2=='')
	{
		alert("Please upload your photo");
		document.theForm.file.focus();
		return false;
	}

	var val3=document.theForm.cat.value;
	if(val3=='')
	{
		alert("Please select the state,district,mandal and Village");
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
	var val9=document.theForm.street.value;
	if(val9=='')
	{
		var sol9=prompt("Please enter the street",val9);
		document.theForm.street.value=sol9;
		return false;
	}
	
   
	var val7=document.theForm.pincode.value;
	/*if(val7=='')
	{
		// onSubmit='return Validate_val(theForm);
		var sol7=prompt("Please enter the pin code",val7);
		document.theForm.pincode.value=sol7;
		document.theForm.pincode.focus();
		return false;
	}
	*/
	if(val7!='')
	{
		var re6digit=/^\d{6}$/
			if (document.theForm.pincode.value.search(re6digit)==-1)
			{
				alert("Please enter a valid 6 digit pin code number");
				document.theForm.pincode.focus();
				return false;
			}
	}


	var val8=document.theForm.email.value;
	if(val8=='')
	{
		var sol8=prompt("Please enter the Email",val8);
		document.theForm.email.value=sol8;
		document.theForm.email.focus();
		return false;
	}
	{
		// var filter=/^.+@.+\..{2,3}$/;
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.theForm.email.value)) 
		{
			//       return (true)
			document.theForm.email.focus();
			//alert("ok");
		}
		else
		{
			alert("Invalid E-mail Address! Please re-enter.")
				document.theForm.email.focus();
			return (false)
		}
	}


	var val11=document.theForm.mphone.value;
	if(val11=='')
	{
		var sol11=prompt("Please enter the Mobile phone number",val11);
		document.theForm.mphone.value=sol11;
		document.theForm.mphone.focus();
		return false;
	}
	{
		var re10digit=/^\d{10}$/
			if (document.theForm.mphone.value.search(re10digit)==-1) {
				alert("Please enter a valid 10 digit phone number");
				document.theForm.mphone.focus();
				return false;
			}
	}

	var val13=document.theForm.age.value;

	if((isNaN(val13) || val13==""))
	{
		alert("Please enter your age,The age must be a number between 15 and 100");
		document.theForm.age.focus();
		return false;
	}

	var val14=document.theForm.gender.value;
	if(val14=='')
	{
		var sol14=prompt("Please select the gender",val14);
		document.theForm.gender.value=sol14;
		document.theForm.gender.focus();
		return false;
	}


	var val15=document.theForm.Edu.value;
	if(val15=='')
	{
		alert("Please select educational qualification");
		document.theForm.Edu.focus();
		return false;
	}

	var val16=document.theForm.mainoccu.value;
	if(val16=='')
	{
		var sol16=prompt("Please enter your main occupation",val16);
		document.theForm.mainoccu.value=sol16;
		document.theForm.mainoccu.focus();
		return false;
	}


	var val17=document.theForm.mainoccu1.value;
	if(val17=='')
	{
		var sol17=prompt("Please enter your Skills",val17);
		document.theForm.mainoccu1.value=sol17;
		document.theForm.mainoccu1.focus();
		return false;
	}

}

// end of validations

//  STATE DIST MANDAL VIL CHECK*******************

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
				//document.write(myarray[i]);
				//var optn = document.createElement("OPTION");
				//optn.text = myarray[i];
				//optn.value = myarray[i];
				//document.testform.getElementById('2').options.add(optn);
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
				//	AjaxFunctiondistrict(document.getElementById('2').value);
				//	AjaxFunctionmandal(document.getElementById('3').value);
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

			<body bgcolor="">
<?php 
	//echo $_SESSION['mode'];
	//if($_SESSION['mode']=='po' && is_partner_active($current_user_id)==2)
//	{
	echo	'<div style="font-size : 20 ; font-color : black ; font-family : verdana"><h2>Coordinator Registration</h2></div>

	<hr width=70% noshade>';


 	echo '<form name="theForm" action="coordinator_process.php" method="post" onsubmit="return cord_Validate(theForm);" enctype="multipart/form-data">
		<table width=50% style="border-color : black ; border-style : groove ; border-width : medium"  bgcolor="#F2F5A9"><tr>
		<td width=100% bgcolor="" valign="top">
		<p>
		<table width="500" border="0" align="center">
		<p>';
		 $v=is_partner_active($current_user_id);
		 if($v==2)
		 {
		 	echo '<tr><td width=150><font ><b>Login Name</b></font></td>
		 	<td>';
       			$number=get_nof_cords(get_partner_id($current_user_id))+1;
			echo $current_user_id."_".$number;
			echo '</td></tr>';
			 
			echo '<tr><td width=150><b>Password:</b><font color="red"> * </font></td>
			<td><input type="password" name="passwd"></td></tr>';
		 
			echo '<tr><td width=150><b>Re-Enter Password:</b><font color="red"> * </font></td>
			<td><input type="password" name="passwd1"></td></tr>';
		}
		
		
                  
		 echo '<tr><td width=150><font ><b>Name</b></font><font color="red"> * </font></td>
		 <td><input name="Userid" type="text"  size=25></td></tr>';
	echo '<tr><td width=150><font ><b>Date of Join</b></font><font color="red"> * </font></td>
		 <td><select name="Jday" id="Jday" size="1">';

for ($counter =1; $counter <= 31; $counter += 1)
{
	if($counter==date('d'))
		echo "<option selected>".$counter."</option>";
	else
		echo "<option>".$counter."</option>";
			
}
echo "</select>";

echo '<select name="Jmonth" id="Jmonth" size="1">';


for ($counter =1; $counter <= 12; $counter += 1)
{
	if($counter==date('m'))
		echo "<option selected>".$counter."</option>";
	else
		echo "<option>".$counter."</option>";
			
}

echo "</select>";
echo '<select name="Jyear" id="Jyear" size="1">';
echo '<option >2011</option>';
echo '<option selected >';
echo date("Y");
echo '</option>';
for ($counter = date("Y")+1; $counter <= 2015; $counter += 1) {
	echo "<option>".$counter."</option>";
}
echo "</select>";
echo "</td></tr></p>";

/*	echo '<tr><td><font ><b>Date of Leaving</b></font><font color="red"> * </font></td>
		 <td><select name="Lday" id="Lday" size="1">';

for ($counter = 1; $counter <= 31; $counter += 1)
{
	echo "<option>".$counter."</option>";	
}
echo "</select>";

echo '<select name="Lmonth" id="Lmonth" size="1">';

for ($counter = 1; $counter <= 12; $counter += 1) {
	echo "<option>".$counter."</option>";
}
echo "</select>";
echo '<select name="Lyear" id="Lyear" size="1">';
for ($counter = 2012; $counter <= 2015; $counter += 1) {
	echo "<option>".$counter."</option>";
}
echo "</select>";
echo "</td></tr></p>";*/

echo '
<tr>
    <td><font><b>Photo to upload</b></font><font color="red"> * </font></td>
<td><input type="file" name="file">
</td>
</tr>

<form id="testform" name="testform" method="POST" action="mainck.php">
<tr><td><b> State</b> <font color="red"> * </font></td><td><select id = "1" name=cat onchange="AjaxFunction(this.value);">
<option value="">Select One</option>';
$q=$db->sql_query("select * from STATE ");
while($n=$db->sql_fetch_array()){
	echo "<option value=$n[state_id]>$n[state_name]</option>";
} 

echo '
</select> </td></tr>
<div id = "divisions1">
<tr><td><b>
District</b><font color="red"> * </font></td><td><select id = "2" name=subcat onchange="AjaxFunctiondistrict(this.value);">
<option value="">Select One</option>';

$q=$db->sql_query("select * from DISTRICT where SID=\'".$n[state_id]."\'");
while($m=$db->sql_fetch_array()){
	echo "<option value=$m[district_id]>$m[district_name]</option>";
	session_start($m[district_id]);
} 
echo '
</select></td>
<td style=border-style:none align="left"><a href="javascript:add2(\'addDiv1\')">Add New District</a></td><tr><td></td><td>
<style type = "text/CSS">
#addDiv1
{display:None}
</style>
<input id = "addDiv1" type = "text" name = "addDistrict" >
</td></tr>
</div>

<div id="divisions2">
<tr><td><b>
Mandal</b><font color="red"> * </font></td><td><select id = "3" name=subcatmandal onchange="AjaxFunctionmandal(this.value);">
<option value="">Select One</option>';

$q=$db->sql_query("select * from  MANDAL where DID=\'".$m[district_id]."\'");
while($o=$db->sql_fetch_array()){
	echo "<option value=$o[mandal_id]>$o[mandal_name]</option>";
	$db->sql_close();
}

echo '
</select> </td>
<td style=border-style:none ><a href="javascript:add2(\'addDiv2\')">Add New Mandal</a></td><tr><td></td><td>
<style type = "text/CSS">
#addDiv2
{display:None}
</style>
<input id = "addDiv2" type = "text" name = "addMandal">
</td></tr>
</div>

<div id="divisions3">
<tr><td>
<b>Village</b><font color="red"> * </font></td><td><select id = "4" name=subcatvillage>
<option value="">Select One</option>
</select>
</td>
<td style=border-style:none align="left"><a href="javascript:add2(\'addDiv3\')">Add New Village</a></td><tr><td></td><td>
<style type = "text/CSS">
#addDiv3
{display:None}
</style>
<input id = "addDiv3" type = "text" name = "addVillage" >
</td></tr>
</form>

<tr><td width=150><font ><b>Locality/Street</b></font><font color="red"> * </font></td>
	<td><input name="street" type="text" size=25></td></tr>

<tr><td width=150><font ><b>Pin code</b></font></td>
	<td><input name="pincode" type="text" size=25></td></tr>

<tr><td width=150><font ><b>Email</b></font><font color="red"> * </font></td>
	<td><input name="email" type="text" size=25></td></tr> 

<tr><td width=150><font ><b>Mobile Phone </b></font><font color="red"> * </font></td>
	<td><input name="mphone" type="text" size=25></td></tr> 

<tr><td width=150><font ><b>Age </b></font><font color="red"> * </font></td>
	<td><input name="age" type="text" size=25></td></tr>

<tr><td><font color><b>Gender</b></font><font color="red"> * </font></td>
<td><select name="gender" id="gender"><option value="Male" selected>Male</option>
<option value="Female">Female</option>
</select></td></tr>

<tr><td><font color><b>Education</b></font><font color="red"> * </font></td>
		<td><select name="Edu"><option value=""  selected>select</option>
		<option value="Illeterate">Illeterate</option>
		<option value="Primary School(1 to 5)">Primary School(1 to 5)</option>
		<option value="Upper Primary(6 to 9)">Upper Primary(6 to 9)</option>
		<option value="Secondary School(10th)">Secondary School(10th)</option>
		<option value="Intermediate(10+2)">Intermediate(10+2)</option>
		<option value="Graduate">Graduate</option>
		<option value="Graduate Discontinued">Graduate Discontinued</option>
		<option value="Post Graduate">Post Graduate</option>
		 </select></td></tr>        


<tr><td width=150><font ><b>Occupation</b></font><font color="red"> * </font></td>
	<td><input name="mainoccu" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Skills</b></font><font color="red"> * </font></td>
	<td><input name="mainoccu1" type="text"  size=25></td></tr> 

<tr>
<td width=150><p align="center"><input type="submit" name="Submit" value="Submit" onclick="return cord_Validate(theForm);"> </p> </td> 
<td><p align="left"><input type="reset" name="reset" value="Reset"></p></td>
</tr>

</td>
</tr>
</table>
</form>';
/*}
else
{
	echo "Access Denied";
}*/
?>
<hr width=70% noshade>
<div style="color : black ; font-size : 15 ; font-family : verdana">Copyrights &copy; reserved @eSagu </div>

</center>
</body>
</html>
