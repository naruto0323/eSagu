<?php
//include "common.php";
//include_once "fbconnect.php";
?>
<!DOCTYPE html >
<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>eSagu</title>

	<!--File(CSS) includes for the webpage-->
	<link href="templatemo_style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="looper-master/css/looper.css">
	<script src="./jquery/jq.js"></script>
	<link rel="stylesheet" type="text/css" href="./bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./main.css">
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
	<div  class="col-lg-10">

		<div id="templatemo_content">
		
			<div class="recent_projects" >
			
				<div class="project_slideshow">

					<div data-looper="go" class="looper slide">

						<div class="looper-inner">

							<div class="item" >
								<img src="http://upload.wikimedia.org/wikipedia/commons/thumb/e/ee/The_VLT%C2%B4s_Laser_Guide_Star.jpg/1024px-The_VLT%C2%B4s_Laser_Guide_Star.jpg" alt="" id="img_1" class="img-responsive">
							</div>

							<div class="item">
								<img src="images/2.jpg" alt="" id="img_2" class="img-responsive">
							</div>

							<div class="item">
								<img src="images/3.jpg" alt="" id="img_3" class="img-responsive">
							</div>

						</div>

				   </div>

				
				</div>
				 
			</div>
	
			
			<div id="content_panel">
				
				<div id="column_w610">
				
					<div class="header_01">Welcome to E-sagu official website</div>
					<p>One time payment description
					</p>
						  
					
					
				
				</div> <!-- end of column w610 -->

				
				<div class="cleaner"></div>
				
			</div> <!-- end of content panel -->
			
			<div class="cleaner"></div>
		</div> <!-- end of content -->
		
	</div> <!-- end of content wrapper -->
			<div id="login" class="col-lg-2">
				<br>
				<form id="form1" name="form1" method="post" action="loginVerify.php">
	<table border="0" cellspacing="5" cellpadding="5">
	<tr>
		<td>User : </td>
		<td><input name="user_id" type="text" id="user_id" /></td>
	</tr>
	<tr>
		<td>Password : </td>
		<td><input name="user_passwd" type="password" id="user_passwd" /></td>
	</tr>
	<tr>
		
		<td><input name="Reset" type="reset" id="Reset" value="Reset" /></td>
		<td><input name="Login" type="submit" id="Login" value="Login" />&nbsp;&nbsp;&nbsp;
			<button type="submit" class="btn btn-primary"formaction="register.php">New User</button></td>
	</tr>
	</table>
</form>
</div>

	</div> <!-- end of complete_page -->

	<script src="looper-master/src/looper.js"></script>
</body>
</html>
