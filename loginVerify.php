<?php
ob_start();
include("nav.php");
include_once("dblayer.php");

extract($_POST);
$db = new sql_db();
$userid=$_POST['user_id'];
$password=$_POST['user_passwd'];
echo $userid;
$srun=$db->sql_query("select user_type from logins where login='$current_user_id'");
$val=$db->sql_fetch_array($srun);
$sol=$val['user_type'];
//echo $val['user_type'];
if($userid == null || $password == null)
{
	print "<font color='red'><center>Enter both username and password</center></font>";
	print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2; URL=loginNew.php\">";
}

else
{
	try 
	{ 
		$result=mysql_query("select user_id, passwd from user_registration");
	}
	catch (Exception $e){
		print $e->getMessage();
	};

	$flag=0;
	while($row=mysql_fetch_array($result))
	{
		if(($row['user_id']==$userid) and ($row['passwd']==$password))
		{
			echo $row['passwd'];
			$flag=1;
			break;
		}
	}

	$result1=mysql_query("select user_type, login, passwd from logins where login='$userid'");

	while($row_2=mysql_fetch_array($result1))
	{
		echo "entered in logins";
		if (! $row_2['login'])
		{
			if($flag==1) { $flag=1; }
			else { $flag=0; };
			break;
		}
		else
		{
			if($row_2['login']==$userid) 
			{
				if($row_2['passwd']==$password)
				{	
					$flag=1;
					break;	
				}
				else
				{
					$flag=0;
					break;
				}
			}
			else
			{
				$flag=1;
				echo "Not Present in Logins Table";
			}
		}
	}

	if($flag==0)
	{
		print "<font color='red'><center>wrong username or password</center></font>";
		print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3; URL=loginNew.php\">";
	}

	if($flag==1)
	{
		session_start();
		$db2=new sql_db();
		$sid=session_id();
		$_POST['sid']=$sid;
		$_SESSION['user_id']=$userid;
		$_SESSION['sid']=$sid;


		$query="select * from user_registration where user_id='$userid'";
		$res1=$db2->sql_query($query);
		$row=$db2->sql_fetch_array();
		$cord_id=$row['cord_id'];
		print $cord_id;

		$login_code=rand(1000000000,9999999999);
		$query="select * from crnt_user_code where user_id='".$cord_id."'";
		$result=$db2->sql_query($query);
		if($row=$db2->sql_fetch_array())
		{
			$db1=new sql_db();
			$ran_qu_1="update crnt_user_code set login_status='$login_code' where user_id='$cord_id'";
			$db1->sql_query($ran_qu_1);
		}
		else
		{
			$db1=new sql_db();
			$ran_qu_1="insert into crnt_user_code values('$cord_id','$login_code')";
			$db1->sql_query($ran_qu_1);
		}

		$query="select * from login_temp where login='$userid'";/////login_temp doesn't exist
		$result2=$db->sql_query($query);
		$row_3=$db->sql_fetch_array();

		$que="select * from user_registration where user_id='$userid'";
		$res=mysql_query($que);

		$row1=mysql_fetch_array($res);
		if(($row1['active_partner_id']!=0))
		{
			$_SESSION['mode']='pa';
			header("Location: partner_homepage.php");
		}
		else if($row1['active_coord_id']!=0)
		{	
			$_SESSION['mode']='co';
			header("Location: coordinator_homepage.php");
		}
		else if ($row1['active_farmer_id']!=0)
		{
			$_SESSION['mode']='fa';
			header("Location: farmer_homepage.php");
		}

		else if($row_2['login']=='esagu2012admin')
		{
			$_SESSION['mode']='ea';
			header("Location:esagu_admin_homepage.php");
		}

		else if($row_2['login']=='admin') 
		{
			$_SESSION['mode']='ad';
			header("Location: admin_homepage.php");

			$db2=new sql_db();
			$que_exp="select * from logins where login='$userid'";
			$res_exp=$db2->sql_query($que_exp);

			$row_exp_1=$db2->sql_fetch_array(); 

			$exp_login_id=$row_exp_1['login'];
			echo   $exp_login_id;
			if($exp_login_id==$userid)
			{
				print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3; URL=expert_home.php\">";	 
			}
			else
			{
				print "<font color='red'><center>wrong username or password</center></font>";
				print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3; URL=loginNew.php\">";	 
			} 
		}
		else if($row_2['login']=='sadmin')
		{

			$_SESSION['mode']='sa';  
			header("Location:sup_admin_homepage.php");
		}
		else if($row_2['user_type']=='aga')
		{
			$_SESSION['mode']='aga';
			header("Location:admin_homepage.php");
		}

		else if($row_2['user_type']=='baa')
		{
			$_SESSION['mode']='baa';
			header("Location:admin_homepage.php");
		}

		else if($row_2['user_type']=='vea')
		{
			$_SESSION['mode']='vea';
			header("Location:admin_homepage.php");
		}

		else if($row_2['user_type']=='sua')
		{
			$_SESSION['mode']='sua';
			header("Location:admin_homepage.php");
		}

		else if($row_2['user_type']=='aqa')
		{
			$_SESSION['mode']='aqa';
			header("Location:admin_homepage.php");
		}
		else if($row_2['user_type']=='hoa')
		{
			$_SESSION['mode']='hoa';
			header("Location:admin_homepage.php");
		}
		else if($row_2['user_type']=='ona')
		{
			$_SESSION['mode']='ona';
			header("Location:admin_homepage.php");
		}
		else if($row_2['user_type']=='wea')
		{
			$_SESSION['mode']='wea';
			header("Location:admin_homepage.php");
		}
		else if($row_2['user_type']=='maa')
		{
			$_SESSION['mode']='maa';
			header("Location:admin_homepage.php");
		}
		else if($row_2['user_type']=='dma')
		{
			$_SESSION['imode']='dma';
			header("Location:admin_homepage.php");
		}
		else if($row_2['user_type']=='qaa')
		{
			$_SESSION['mode']='qaa';
			header("Location:admin_homepage.php");
		}
		else if($row_2['user_type']=='am')
		{
			$_SESSION['mode']='am';
			header("Location:agri_manager_homepage.php");
		}
		else if($row_2['user_type']=='ase')
		{
			$_SESSION['mode']='ase';
			header("Location:agri_super_expert_homepage.php");             
		}
		else if($row_2['user_type']=='ace')
		{
			$_SESSION['mode']='ace';
			header("Location:agri_cluster_expert_homepage.php");            
		}
		else if($row_2['user_type']=='ae')
		{
			$_SESSION['mode']='ae';
			header("Location:expert_homepage.php");
		}
		else if($row_2['user_type']=='aje')
		{
			$_SESSION['mode']='aje';
			header("Location:expert_homepage.php");             //
		}
		else if($row_2['user_type']=='aco')
		{
			$_SESSION['mode']='aco';
			header("Location:expert_homepage.php");             //
		}
		else if($row_2['user_type']=='she')
		{
			$_SESSION['mode']='she';
			header("Location:sup_expert_homepage.php");
		}
		else if($row_2['user_type']=='sqe')
		{
			$_SESSION['mode']='sqe';
			header("Location:sup_expert_homepage.php");           
		}
		else if($row_2['user_type']=='swe')
		{
			$_SESSION['mode']='swe';
			header("Location:sup_expert_homepage.php");
		}

		else if($row_2['user_type']=='sme')
		{
			$_SESSION['mode']='sme';
			header("Location:sup_expert_homepage.php");
		}
		else if($row_2['user_type']=='he')
		{
			$_SESSION['mode']='he';
			header("Location:expert_homepage.php");
		}

		else if($row_2['user_type']=='qe')
		{
			$_SESSION['mode']='qe';
			header("Location:expert_homepage.php");
		}

		else if($row_2['user_type']=='we')
		{
			$_SESSION['mode']='we';
			header("Location:expert_homepage.php");
		}

		else if($row_2['user_type']=='me')
		{
			$_SESSION['mode']='me';
			header("Location:expert_homepage.php");
		}

		else if($row_3['type']=='ve')
		{
			$_SESSION['mode']='ve';
			header("Location:BSM_view_accept.php");
		}

		else if($row_3['type']=='ba')
		{
			$_SESSION['mode']='ba';
			header("Location:BSM_view_accept.php");
		}

		else if($row_3['type']=='su')
		{
			$_SESSION['mode']='su';
			header("Location:BSM_view_accept.php");
		}
		else if($row_2['login']=='esagu2012ceo')
	    {
			$_SESSION['mode']='ceo';
			header("Location:ceo_homepage.php");
		}
		else
		{
		header("Location:index.php");
		}
	}
}
//print_r($_SESSION);
ob_flush();
?>
