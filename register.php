<?php
include('config.php');
//include("header_new.php");
//include("adduser.php");
//include "common.php";
//include_once "fbconnect.php";
?>
<!DOCTYPE html >
<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>E-Sagu</title>

	<!--File(CSS) includes for the webpage-->
	<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="looper-master/css/looper.css">
	<script src="./jquery/jq.js"></script>
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap-theme.min.css">
	<link href="css/jquery.ennui.contentslider.css" rel="stylesheet" type="text/css" media="screen,projection" />
	<link rel="stylesheet" type="text/css" href="./css/main.css">

	<!--File(JS) includes for the webpage-->
	<script src="./bootstrap/js/bootstrap.js"></script>
	<script src="./bootstrap/js/bootstrap.min.js"></script>
	<script src="./js/main.js"></script>

</head>
<script>
function validate_login()
{
	var name=document.theForm.user_id.value;
	if(name=='')
	{
		alert("please enter the login name");
		document.theForm.user_id.focus();
		return false;
	}

	var name1=document.theForm.passwd.value;
	if(name1=='')
	{
		alert("please enter the password");
		document.theForm.passwd.focus();
		return false;
	}

	var name2=document.theForm.passwd2.value;
	if(name2=='')
	{
		alert("please enter confirm password");
		document.theForm.passwd2.focus();
		return false;
	}
	if(name1!=name2)
	{
		alert("please check password and conform password are not matched");
		document.theForm.passwd.focus();
		return false;
	}
}

</script>
<body>
	<div id="templatemo_header_wrapper" >

	<!-- Just for Some space on the top -->

	</div> <!-- end of header wrapper -->

	<div id="templatemo_menu_wrapper" >   
		
		<div id="templatemo_menu" >
			<ul>
			<?php
include('nav.php');

?>		
			</ul>    	
		</div> <!-- end of menu -->
	</div> <!-- end of menu wrapper -->

	<div id="complete_page" class="col-md-12">

		
			

			<?php echo "hello" ?>
<form  action="adduser.php"  method="POST" >
<table border=0>
<tr>
	<td>Login Name:<font color='red'> * </font></td>
	<td><input type="text" name="user_id"></td>
</tr>
<tr>
	<td>Password:<font color='red'> * </font></td>
	<td><input type="password" name="passwd"></td>
</tr>
<tr>
	<td>Confirm Password:<font color='red'> * </font></td>
	<td><input type="password" name="passwd2"></td>
</tr>
<tr>
	<td><input type="reset" name="reset" value="reset"></td>
	<td><input type="submit" name="submit" value="register"></td>
</tr>
</table>
</form>
</body>
<?php echo "hello" ?>
						

				
				 
			</div>
			
				
				<div class="cleaner"></div>
				
			</div> <!-- end of content panel -->
			
			<div class="cleaner"></div>
		</div> <!-- end of content -->
		


	<script src="looper-master/src/looper.js"></script>
</body>
</html>
