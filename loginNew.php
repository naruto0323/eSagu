<?php
include("header_new.php");
?>
<html>
<?php
if($current_user_id!='Guest')
{
	echo "You are already logged in";
	return;
}
?>
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
		<td><input name="Login" type="submit" id="Login" value="Login" />&nbsp;&nbsp;&nbsp;<a href='register.php'>New User</a></td>
	</tr>
	</table>
</form>
</center>
</html>
<?php
include("footer.php");
?>
