<?php
/* if( isset($_POST['user_id']) || isset($_POST['passwd']) || isset($_POST['passwd2'])  ){
        if( !isset($_POST['user_id']) || !isset($_POST['passwd']) || !isset($_POST['passwd2'])  ) {
            echo "Please Fill In All The Fields";
        }
        else
        {
		echo $_POST['user_id'];
        	$user=$_POST['user_id'];
$pass=$_POST['passwd'];
$pass2=$_POST['passwd2'];

        	echo $user;
        }
 }
	echo "jhadcvkhdfbkz";*/
include("dblayer.php");
extract($_POST);
$user=$_POST['user_id'];
$pass=$_POST['passwd'];
$pass2=$_POST['passwd2'];

//include("header_new.php");
$db=new sql_db();
include_once ('ruhela_check_functions.php');
//include_once 'iasp_config.php';

$val=chk_user($user);
if($_POST['user_id']=='sadmin')
{
	$db=new sql_db();
	$que="insert into logins(login,passwd) values('$user','$pass')";
	$db->sql_query($que);
}

if($_POST['user_id']=='iaspadmin')
{
	$db=new sql_db();
	$que="insert into logins(login,passwd) values('$user','$pass')";
	$db->sql_query($que);
}

if($val=='0')
{
	if($pass==$pass2)
	{
		$query="insert into user_registration (user_id, passwd) values ('$user','$pass')";
		if($db->sql_query($query))
		{
			include("header_new.php");
			echo "<h2>You have successfully registered PPPPPP</h2>";
			print "<meta http-equiv=\"REFRESH\" content=\"2;url=loginNew.php\">";
		}
		else
		{
			include("header_new.php");
			echo "<h2>Registration failed, please register again.</h2>";
			print "<meta http-equiv=\"REFRESH\" content=\"5;url=register.php\">";
		}
	}
	else
	{
		include("header_new.php");
		echo "<h3>Passwords don't match, please register again.</h3>";
		print "<meta http-equiv=\"REFRESH\" content=\"5;url=register.php\">";
//
	}
}
else
{
	echo "<h3><font color='red'>user already exists. Please try with another userid</font></h3>";
	print "<meta http-equiv=\"REFRESH\" content=\"5;url=register.php\">";

} 
?>
