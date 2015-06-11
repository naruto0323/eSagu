<?php
include("header_new.php");
include_once("dblayer.php");
$db=new sql_db();
?>

<html>
<head>
<title>Expert Registration</title>
<script type="text/javascript" language="JavaScript1.2">
function expert_Validate(theForm)
{
	var val0=document.theForm.type.value;
	if(val0=="")
	{
		alert("Please select the type of user");
		document.theForm.type.focus();
		return false;
	}
	var val=document.theForm.name.value;
	if(val=='')
	{
		var sol=prompt("Please enter the name",val);
		document.theForm.name.value=sol;
		document.theForm.name.focus();
		return false;
	}
	var val1=document.theForm.special.value;
	if(val1=='')
	{
		var sol1=prompt("Please enter the Specialization",val1);
		document.theForm.special.value=sol1;
		document.theForm.special.focus();
		return false;
	}
	<?php
	/*
	var val2=document.theForm.file.value;
	if(val2=='')
	{
		alert("Please upload the file");
		document.theForm.file.focus();
		return false;
	} */ ?>
	var val3=document.theForm.add.value;
	if(val3=='')
	{
		var sol3=prompt("Please enter the Address",val3);
		document.theForm.add.value=sol3;
		document.theForm.add.focus();
		return false;
	}

	var val4=document.theForm.pin.value;
	if(val4=='')
	{
		var sol4=prompt("Please enter the pin code",val4);
		document.theForm.pin.value=sol4;
		document.theForm.pin.focus();
		return false;
	}
	var re6digit=/^\d{6}$/;
	if (document.theForm.pin.value.search(re6digit)==-1) 
	{
		alert("Please enter a valid 6 digit pin code number");
		document.theForm.pin.focus();
		return false;
	}
	var val5=document.theForm.Mphone.value;
	if(val5=='')
	{
		var sol5=prompt("Please enter the Mobile phone number",val5);
		document.theForm.Mphone.value=sol5;
		document.theForm.Mphone.focus();
		return false;
	}                
	var re10digit=/^\d{10}$/; 
	if (document.theForm.Mphone.value.search(re10digit)==-1) { 
		alert("Please enter a valid 10 digit phone number"); 
		document.theForm.Mphone.focus(); 
		return false; 
	} 


	var val6=document.theForm.gender.value;
	if(val6=="")
	{
		alert("Please select the gender");
		document.theForm.gender.focus();
		return false;
	}
	var val7=document.theForm.Edu.value;
	if(val7=="")
	{
		alert("Please select the Education");
		document.theForm.Edu.focus();
		return false;
	}
	var val8=document.theForm.main_occ.value;
	if(val8=='')
	{
		var sol8=prompt("Please enter the Main Occupation",val8);
		document.theForm.main_occ.value=sol8;
		document.theForm.main_occ.focus();
		return false;
	}                

	var val9=document.theForm.email.value;
	if(val9=='')
	{
		var sol9=prompt("Please enter the Email",val9);
		document.theForm.email.value=sol9;
		document.theForm.email.focus();
		return false;
	}   
	{
		if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.theForm.email.value)){
			document.theForm.email.focus();
		}
		else
		{
			alert("Invalid E-mail Address! Please re-enter.")
				document.theForm.email.focus();
			return (false)
		}
	}
	var val10=document.theForm.dob.value;
	if(val10=='')
	{
		var sol10=prompt("Please enter the Date of Birth",val10);
		document.theForm.dob.value=sol10;
		document.theForm.dob.focus();
		return false;
	}

	var validformat=/^\d{4}-\d{1,2}-\d{1,2}$/; //Basic check for format validity
	var returnval=false;
	if (!validformat.test(val10))
	{
		alert("Invalid Date Format. Please correct and submit again.");
		document.theForm.dob.focus();
		return false;
	}
	else
	{ //Detailed check for valid date ranges
		var yearfield=val10.split("-")[0];
		var monthfield=val10.split("-")[1];
		var datefield=val10.split("-")[2];
		var dayobj = new Date(yearfield, monthfield-1, dayfield);
		if ((dayobj.getMonth()+1!=monthfield)||(dayobj.getDate()!=dayfield)||(dayobj.getFullYear()!=yearfield))
		{
			alert("Invalid Day, Month, or Year range detected. Please correct and submit again.");
			return false;
		}
	}

}
// end of validations

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
if($_SESSION['mode'])
{
    echo "You are already registered";
	return; 
}
else if ($current_user_id=='Guest')
{
	echo "Acess Denied";
	return; 
}
?>

<div style="font-size : 20 ; font-color : black ; font-family : verdana"><h2>Expert Registration</h2></div>

<hr width=70% noshade>

<form name="theForm" action="expert_process.php" method="POST" enctype="multipart/form-data" onsubmit='return expert_Validate(theForm);'>
<table width=50% style="border-color : black ; border-style : groove ; border-width : medium" bgcolor="#F2F5A9">

<tr>
<td width=100% bgcolor="" valign="top">
<p>
<table width="500" border="0" align="center">

 <tr><td><font color=""><b>Type of User</b></font><font color='red'> * </font></td>
	      <td><select name="type" id="type"><option value="" selected>select</option>
	 <option value='am'>Manager</option>
	 <option value='ace'>Cluster Expert</option>
	   <option value='ase'>Super Expert</option>
       <option value='ae'>Expert</option>
       <option value='aje'>Junior Expert</option>
      <option value='aco'>Consultant</option>
	  </select></td></tr>

<tr><td width=150><font ><b>Name</b></font><font color='red'> * </font></td>
<td><input name="name" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Specialization</b></font><font color='red'> * </font></td>
<td><input name="special" type="text"  size=25></td></tr> 

<!--<tr><td width=150><font ><b>Service</b></font></td>
<td><input name="service" type="text"  size=25></td></tr>-->



<!--tr><td><font ><b>Select Crops</b></font><font color='red'></font></td>
<td><select name="crops[]" id="crops" multiple size="3">-->


<?php 
/*
$db=new sql_db();

$q=$db->sql_query("SELECT DISTINCT original_crop_name FROM  `cropcode_cropname` ");
echo $q;
while($m=$db->sql_fetch_array())
{
	echo "<option value=\"$m[original_crop_name]\">$m[original_crop_name]</option>";
	session_start($m[cropcode_cropname]);
} */
?>

<tr><td><font><b>Photo to upload</b></font><font color='red'> * </font></td>
<td><input type="file" name="file" id="file">
</td>
</tr>

<tr><td width=150><font ><b>Address</b></font><font color='red'> * </font></td>
<td><input name="add" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Pin code</b></font><font color='red'> * </font></td>
<td><input name="pin" type="text"  size=25></td></tr>


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

<!--<p><tr><td><font ><b>Date of Leaving</b></font><font color='red'> * </font></td>
<td><select name="Lday" id="Lday" size="1"> -->

<?php
/*for ($counter = 1; $counter <= 31; $counter += 1) {
	echo "<option>".$counter."</option>";
}
echo "</select>";*/
?>

<!--<select name="Lday1" id="Lday1" size="1"> -->

<?php
/*
for ($counter = 1; $counter <= 12; $counter += 1) {
	echo "<option>".$counter."</option>";
}
echo "</select>";
*/
?>

<!--<select name="Lday2" id="day" size="1"><option selected ><?php echo date("Y")?></option>-->
<?php
/*
for ($counter = date("Y")+1; $counter <= 2015; $counter += 1) {
	echo "<option>".$counter."</option>";
}
echo "</select>";
*/
?>
<!--</td></tr></p>-->


<tr><td width=150><font ><b>Land phone</b></font></td>
<td><input name="Lphone" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Mobile phone</b></font><font color='red'> * </font></td>
<td><input name="Mphone" type="text"  size=25></td></tr>


<tr><td><font color><b>Gender</b></font><font color='red'> * </font></td>
   <td><select name="gender" id="gender"><option value="" selected>select</option>
  <option value='Male'>Male</option>
  <option value='Female'>Female</option> </td> </tr>

 <tr><td><font color=""><b>Education</b></font><font color='red'> * </font></td>
              <td><select name="Edu" id="Edu"><option value=""  selected>select</option>
         <option value='Illiterate'>Illiterate</option>
           <option value='Primary School(1 to 5)'>Primary School(1 to 5)</option>
       <option value='Upper Primary(6 to 9)'>Upper Primary(6 to 9)</option>
       <option value='Secondary School(10th)'>Secondary School(10th)</option>
      <option value='Intermediate(10+2)'>Intermediate(10+2)</option>
       <option value='Graduate'>Graduate</option>
   <option value='Graduate Discontinued'>Graduate Discontinued</option>
    <option value='Post Graduate'>Post Graduate</option>
          </select></td></tr>
  
<tr><td width=150><font ><b>Main occupation </b></font><font color='red'> * </font></td>
    <td><input name="main_occ" type="text" size=25></td></tr>

<tr><td width=150><font ><b>Sub occupation </b></font></td>
    <td><input name="sub_occ" type="text"  size=25></td></tr>

<tr><td width=150><font ><b>Email  </b></font><font color='red'> * </font></td>
 <td><input name="email" type="text" size=25></td></tr>

<tr><td width=210><font ><b>Date of Birth</b>(YYYY-MM-DD)</font><font color='red'> * </font></td>
<td><input name="dob" type="date"  size=25></td></tr>

<br><tr><td><p align="center"> 
<input type="submit" name="Submit" value="submit"  onclick='return expert_Validate(theForm);'>
<input type="reset" name="reset" value="reset">
</p></td></tr>

</td>
</tr>
</form>
</table>

<hr width=70% noshade>
<div style="color : black ; font-size : 15 ; font-family : verdana">Copyrights &copy; reserved @IASP </div>

</center>
</body>
</html>
