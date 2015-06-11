<?php
extract($_GET);
extract($_POST);
session_start();
$sid = session_id();
$_POST['sid']=$sid;
include_once("dblayer.php");
include("functions.php");
//include_once("iasp_config.php");
//print_r($_GET);
//print_r($_POST);

$user_id=$_SESSION['user_id'];
$user_mode=$_SESSION['mode'];
$db2=new sql_db();
$ceo_check=1;

$login_code_query="select * from crnt_user_code where user_id='$current_user_id'";
$login_code_result=$db2->sql_query($login_code_query);
$login_code_row=$db2->sql_fetch_array();
$login_code=$login_code_row['login_status'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>eSagu </title>
<!--<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/style2012.css" title="IASP" />

<script language="javascript" type="text/javascript">
</script>
</head>

<div id="container">
<div id="header"><h1>eSagu</h1></div>-->
<ul id="navmenu">

<?php
if($current_user_id=='Guest')
{
	print " <li><a href=\"index.php\">home</a></li>";
	print " <li><a href=\"esagu.php\">esagu</a></li>";
	print " <li><a href=\"ehorti.php\">ehorti</a></li>";
	print " <li><a href=\"QuesAns.php\">QuesAns</a></li>";
	print " <li><a href=\"onetime_index.php\">OneTime</a></li>";
	print " <li><a href=\"loginNew.php\">Login</a></li>";
}

elseif($current_user_id=='iaspadmin')
{
	print " <li><a href=\"iasp_admin_homepage.php\">home</a></li>";
	print "<li><a href=\" \">My Account</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($current_user_id=='sadmin')
{
	print " <li><a href=\"sup_admin_homepage.php\">home</a></li>";
	print " <li><a href=\"esagu.php\">esagu</a></li>";
	print " <li><a href=\"ehorti.php\">ehorti</a></li>";
	print " <li><a href=\"eaqua.php\">eaqua</a></li>";
        print " <li><a href=\"http://$ip:8080/IASPWeatherAdvisorySystem/index.jsp?user_id=$user_id&mode=$user_mode&login_code=$login_code\">Weather</a></li>";
	print " <li><a href=\"http://$ip/IASP/Digital_Mandi/homepage_nov.php?user_id=$user_id&mode=$user_mode&login_status=$login_code&IASP_sid=$sid\">DigMandi</a></li>";
	print " <li><a href=\"Interface/QA/redirect.php\">QuesAns</a></li>";
	print " <li><a href=\"http://agriculture.iiit.ac.in:8055/ontime_2010/firstpage.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">OneTime</a></li>";
	print " <li><a href=\"finance.php\">Finance</a></li>";
	        print " <li><a href=\"input.php\">Input</a></li>";
        	print " <li><a href=\"\">Market</a>
	                 <ul class='subchildren'>
        	         <li class='cat-item'><a href=\"market_index.php\">Market information</a></li>
                	 <li class='cat-item'><a href=\"marketing.php\">Marketing</a></li>
	                 </ul></li>";

	print " <li><a href=\"Logout.php\">Logout</a></li>";
}


elseif($_SESSION['mode']=="ceo")
{
   $ceo_check=0;
   
   print "<li><a href=\"ceo_homepage.php\">Home</a></li>";
   print "<li><a href=\"view_state_list.php\">E-Sagu Places in India</a></li>";
   print "<li><a href=\"\">Esagu Members Database</a> 
    <ul>
       <li><a href=\"experts_list.php\">Experts Database</a></li>
       <li><a href=\" \">Partners Column</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"partners_list.php\">View Partners List</a></li>
		<li class='cat-item'><a href=\"ceo_partner_activate.php\">Activate Partner</a></li>
		<li class='cat-item'><a href=\"ceo_partner_deactivate.php\">De-activate Partner</a></li>
		</ul></li>
	 </ul></li>";
		
   print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">My Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
		
    print "<li><a href=\" \">View Advices</a>
		<ul>
		<li class='cat-item'><a href=\"browse_all_advices.php\">All Advices</a></li>
		<li class='cat-item'><a href=\"browse_all_cluster_advices.php\">Cluster Advices</a></li>
		</ul></li>";		
   print " <li class='children'><a href=\"Logout.php\">Logout</a></li>";
}


elseif($_SESSION['mode']=='baa')
{
        print " <li><a href=\"admin_homepage.php\">home</a></li>";
        print " <li><a href=\"finance.php\">Finance</a></li>";
        print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='vea')
{
        print " <li><a href=\"admin_homepage.php\">home</a></li>";
        print " <li><a href=\"marketing.php\">Marketing</a></li>";
        print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='sua')
{
        print " <li><a href=\"admin_homepage.php\">home</a></li>";
        print " <li><a href=\"input.php\">Input</a></li>";
        print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='aga')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"esagu.php\">esagu</a></li>";
	print " <li><a href=\"http://$ip:8080/online_esagu_sms/firstpage.jsp?login_id=$user_id&mode=$user_mode&login_status=$login_code\">Send SMS</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='aqa')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"eaqua.php\">eaqua</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='hoa')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"ehorti.php\">ehorti</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='ona')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"http://agriculture.iiit.ac.in:8055/ontime_2010/firstpage.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">OneTime</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='wea')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"http://$ip:8080/IASPWeatherAdvisorySystem/admin_root/admin_home.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">Weather</a></li>";
        print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='maa')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"http://$ip:8080/IASP_Market_Advisory_System/index.jsp?user_id=$user_id&mode=$user_mode&login_code=$login_code\">Market</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='dma')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"http://$ip/IASP/Digital_Mandi/cord_hompage.php?user_id=$cord_id&mode=$user_mode&login_status=$login_code&IASP_sid=$sid\">DigMandi</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='qaa')
{
	print " <li><a href=\"admin_homepage.php\">home</a></li>";
	print " <li><a href=\"Interface/QA/redirect.php\">QuesAns</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='am')
{
	print	"<li class='cat-item'><a href=\"agri_manager_homepage.php\">Home</a></li>";
	print	"<li class='cat-item'><a href=\"manager_allocation.php\">Allocation</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print " <li class='children'><a href=\"Logout.php\">Logout</a></li>";
}
elseif($_SESSION['mode']=='aco')
{
	print	"<li class='cat-item'><a href=\"expert_home.php\">Home</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print "<li><a href=\"expert_home.php\">Agri Expert Advices</a>
		<ul class='children'> <li class='cat-item'><a href=\"browse_advice.php\">Browse Advice</a></li>
		<li class='cat-item'><a href=\"browse_all_advices.php\">Browse All Advices</a></li>
		<li class='cat-item'><a href=\"advice_menu.php\">Advice Menu</a></li>
		</ul></li>";
	print " <li class='children'><a href=\"Logout.php\">Logout</ayy></li>";
}
elseif($_SESSION['mode']=='ae' or $_SESSION['mode']=='aje')
{
	print	"<li class='cat-item'><a href=\"expert_home.php\">Home</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print "<li><a href=\" \">Services</a>
		<ul class='children'><li class='cat-item'><a href=\"upload.php\">Upload Data</a></li>
		<li class='cat-item'><a href=\"view_uploaded_data.php\">Uploaded Data</a></li>
		<li class='cat-item'><a href=\"groupcode_registration.php\">ZoneCode register</a></li>
		<li class='cat-item'><a href=\"static_advice.php\">Static Advice</a></li>
		<li class='cat-item'><a href=\"import.php\">Import Advice</a></li>
		<li class='cat-item'><a href=\"databank.php\">Data Bank</a></li>
		</ul></li>";
	print "<li><a href=\"expert_home.php\">Agri Expert Advices</a>
		<ul class='children'> <li class='cat-item'><a href=\"browse_advice.php\">Browse Advice</a></li>
		<li class='cat-item'><a href=\"browse_all_advices.php\">Browse All Advices</a></li>
		<li class='cat-item'><a href=\"browse_all_cluster_advices.php\">Browse Cluster Advices</a></li>
		<li class='cat-item'><a href=\"advice_menu.php\">Advice Menu</a></li>
		</ul></li>";
	print " <li class='children'><a href=\"../IASP/helpdesk/index.php\">Helpdesk</a></li>";
	print " <li class='children'><a href=\"farmer_list.php\">Farmer List</a></li>";
	print " <li class='children'><a href=\"expert_home.php\">Back</a></li>";
	print " <li class='children'><a href=\"Logout.php\">Logout</ayy></li>";
}

elseif($_SESSION['mode']=='he')
{
	print "<li><a href=\"horti_expert_home.php\">home</a></li>";
	print "<li><a href=\" \">Services</a>
		<ul class='children'> <li class='cat-item'><a href=\"upload.php\">Upload Data</a></li>
		<li class='cat-item'><a href=\"view_uploaded_data.php\">Uploaded Data</a></li>
		<li class='cat-item'><a href=\"groupcode_registration.php\">ZoneCode register</a></li>
		<li class='cat-item'><a href=\"static_advice.php\">Static Advice</a></li>
		<li class='cat-item'><a href=\"import.php\">Import Advice</a></li>
		<li class='cat-item'><a href=\"databank.php\">Data Bank</a></li>
		</ul></li>";
	print "<li><a href=\"horti_expert_home.php \">Horti Expert Advices</a>
		<ul class='children'> <li class='cat-item'><a href=\"horti_browse_advice.php\">Browse Advice</a></li>
		<li class='cat-item'><a href=\"horti_browse_all_advices.php\">Browse All Advices</a></li>
		<li class='cat-item'><a href=\"horti_advice_menu.php\">Advice Menu</a></li>
		</ul></li>";
	print " <li class='children'><a href=\"../IASP/helpdesk/index.php\">Helpdesk</a></li>";
	print " <li class='children'><a href=\"expert_homepage.php\">Back</a></li>";
	print " <li class='children'><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='qe')
{
	print " <li><a href=\"eaqua.php\">eaqua</a></li>";
	print " <li><a href=\"Interface/QA/redirect.php\">QuesAns</a></li>";
	print " <li><a href=\"http://agriculture.iiit.ac.in:8055/ontime_2010/firstpage.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">OneTime</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='we')
{
        print " <li><a href=\"http://$ip:8080/IASPWeatherAdvisorySystem/index.jsp?user_id=$user_id&mode=$user_mode&login_code=$login_code\">Weather</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='me')
{
	print " <li><a href=\"http://$ip:8080/IASP_Market_Advisory_System/index.jsp?user_id=$user_id&mode=$user_mode&login_code=$login_code\">Market</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='ase')
{
	print " <li><a href=\"agri_super_expert_homepage.php\">Home</a></li>";
	print " <li><a href=\"experts_list.php\">ExpertsList</a></li>";
	print " <li><a href=\"browse_all_advices.php\">BrowseAdvices</a></li>";
	print " <li><a href=\"browse_all_cluster_advices.php\">ClusterAdvices</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\">Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\">Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='she')
{
	print " <li><a href=\"sup_expert_homepage.php\">Home</a></li>";
	print " <li><a href=\"experts_list.php\">Experts List</a></li>";
	print " <li><a href=\"Interface/QA/redirect.php\">QuesAns</a></li>";
	print " <li><a href=\"http://$ip:8080/ontime_2009/firstpage.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">OneTime</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='sqe')
{
	print " <li><a href=\"experts_list.php\">eaqua</a></li>";
	print " <li><a href=\"Interface/QA/redirect.php\">QuesAns</a></li>";
	print " <li><a href=\"http://$ip:8080/ontime_2009/firstpage.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">OneTime</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='ace')
{
	print " <li><a href=\"cluster_crops.php\">Home</a></li>";
	print " <li><a href=\"browse_all_advices.php\">Browse Advices</a></li>";
	print " <li><a href=\"browse_all_cluster_advices.php\">Cluster Advices</a></li>";
	print "<li><a href=\" \">Profile</a>
		<ul class='subchildren'>
		<li class='cat-item'><a href=\"expert_profile.php\" target='_blank'>Show Profile</a></li>
		<li class='cat-item'><a href=\"edit_expert.php\" target='_blank'>Edit Profile</a></li>
		<li class='cat-item'><a href=\"edit_password.php\">Change Password</a></li>
		</ul></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='swe')
{
	print " <li><a href=\"experts_list.php\">Weather</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($_SESSION['mode']=='sme')
{
	print " <li><a href=\"experts_list.php\">Market</a></li>";
	print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($user_mode=='ve')
{
        print " <li><a href=\"grain_info.php\">Grain Registration</a></li>";
        print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($user_mode=='ba')
{
        print " <li><a href=\"bank_services.php\">Services</a></li>";
        print " <li><a href=\"Logout.php\">Logout</a></li>";
}

elseif($user_mode=='su')
{
        print " <li><a href=\"stock_info.php\">Product Registration</a></li>";
        print " <li><a href=\"Logout.php\">Logout</a></li>";
}

else
{
	$query="select * from user_registration where user_id='$current_user_id'";
	$result=$db2->sql_query($query);
	$row=$db2->sql_fetch_array();
	$farmer_active=trim($row['active_farmer_id']);
	$cord_active=trim($row['active_coord_id']);
	$partner_active=trim($row['active_partner_id']);

        $cord_id=trim($row['cord_id']);

        $db2=new sql_db();

	$login_code_query_1="select * from crnt_user_code where user_id='$cord_id'";
	$login_code_result_1=$db2->sql_query($login_code_query_1);
	$login_code_row_1=$db2->sql_fetch_array();
	$login_code_cord=$login_code_row_1['login_status'];
	if($partner_active=='1')
	{
		print " <li><a href=\"partner_homepage.php\">home</a></li>";
		print " <li><a href=\"esagu.php\">esagu</a></li>";
		print " <li><a href=\"ehorti.php\">ehorti</a></li>";
		print " <li><a href=\" \">New Registration</a>
                        <ul class='children'>
			<li class='cat-item'><a href=\"partner_registration.php\">Partner</a></li> 
			<li class='cat-item'><a href=\"expert_registration.php\">Expert</a></li>
			<li class='cat-item'><a href=\"#\">Stakeholder</a></li>
			<li class='cat-item'><a href=\"#\">Guest</a></li>
                        </ul></li>";
	}
	else if($partner_active=='2') {
		print " <li><a href=\"partner_homepage.php\">Home</a></li>";
		print "<li><a href=\" \">Village-Level eSagu</a>
			<ul class='children'>
			<li><a href=\" \">Registration</a>
			<ul class='subchildren'>
				<li class='cat-item'><a href=\"coordinator_registration.php\">Coordinator Registeration</a></li>
				<li class='cat-item'><a href=\"village_registration.php\">Village Registeration</a></li>
				<li class='cat-item'><a href=\"cluster_registration.php\">Cluster Registeration</a></li>
				</ul></li>

                        </ul></li>";
		print "<li><a href=\" \">View Advices</a>
		       <ul>
		         <li class='cat-item'><a href=\"browse_all_advices.php\">All Advices</a></li>
		         <li class='cat-item'><a href=\"cluster_list.php\">Cluster Advices</a></li>
		       </ul></li>";				
		print " <li><a href=\"esagu.php\">esagu</a></li>";
		print " <li><a href=\"ehorti.php\">ehorti</a></li>";
		print " <li><a href=\"http://agriculture.iiit.ac.in:8055/ontime_2010/firstpage.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">OneTime</a></li>";
		print "<li><a href=\" \">My Account</a>
		        <ul class='subchildren'>
		        <li class='cat-item'><a href=\"partner_profile.php\">Show Profile</a></li>
		        <li class='cat-item'><a href=\"editprofile_partner.php\">Edit Profile</a></li>
				<li class='cat-item'><a href=\"partner_detach_cord.php\">Detach Cordinator</a></li>  
				<li class='cat-item'><a href=\"partner_detach_village.php\">Detach Village</a></li>  
				<li class='cat-item'><a href=\"partner_detach_cluster.php\">Detach Cluster</a></li>  
		        </ul></li>";

	}
 
	if($cord_active=='1')
	{
		print " <li><a href=\"index.php\">home</a></li>";
		print " <li><a href=\"esagu.php\">esagu</a></li>";
		print " <li><a href=\"ehorti.php\">ehorti</a></li>";
		print " <li><a href=\"onetime_index.php\">OneTime</a></li>";
		if(!$farmer_active and !$partner_active)
		{
			print "<li><a href=\" \">New Registration</a>
				<ul class='children'>
				<li class='cat-item'><a href=\"partner_registration.php\">Partner</a></li> 
				<li class='cat-item'><a href=\"expert_registration.php\">Expert</a></li>
				<li class='cat-item'><a href=\"#\">Stakeholder</a></li>
				<li class='cat-item'><a href=\"#\">Guest</a></li>
				</ul></li>";
		}
		else if($farmer_active)
		{
			print " <li><a href=\"farmer_homepage.php\">farmer_home</a></li>";
			print "<li><a href=\" \">New Registration</a>
				<ul class='children'>
				<li class='cat-item'><a href=\"partner_registration.php\">Partner Registration</a></li>
				</ul></li>";
		}
		else if($partner_active)
		{
			print " <li><a href=\"partner_homepage.php\">Partner home</a></li>";
			print "<li><a href=\" \">New Registration</a>
				<ul class='children'>
				<li class='cat-item'><a href=\"cluster_registration.php\">Cluster</a></li>
				<li class='cat-item'><a href=\"farmer_registration.php\">Farmer Registration</a></li>
				</ul></li>";
		}
	}
	elseif($cord_active=='2')
	{
		$user_id = $_SESSION['user_id'];
		$user_mode = $_SESSION['mode'];
		$farmer_id = get_farmer_id($user_id);
		$_SESSION['farmer_id'] = $farmer_id;
		$active_status = active_status($user_id,1);
		
		print " <li><a href=\"coordinator_homepage.php\">Home</a></li>";
		print "<li><a href=\" \">Village-Level eSagu</a>
			<ul class='children'>  
			<li><a href=\" \">Registration</a>
			<ul class='subchildren'>  
			<li class='cat-item'><a href=\"farmer_registration.php\">Farmer Registeration</a></li>
			<li class='cat-item'><a href=\"farm_registration.php\">Farm Registeration</a></li>
			<li class='cat-item'><a href=\"farm_soil_test.php\">Farm Soil Registeration</a></li>
			<li class='cat-item'><a href=\"previous_year_crops.php\">Previous Year Crop Registeration</a></li>
			<li class='cat-item'><a href=\"mobile_farmer_registration.php\">Farmer Mobile Registeration</a></li>
			<li class='cat-item'><a href=\"notice_board_registration.php\">Notice Board Registeration</a></li>
			
			</ul></li>";
	//	if($_SESSION['current_cluster_id'])
	//	{
   		        print "<li class='cat-item'><a href=\"obs.php\">Submit Observations</a></li>"; ///change back to obs.php////  
	//	}
			print"<li class='cat-item'><a href=\"noticeboard.php\">Noticeboard</a></li>  
			<li class='cat-item'><a href=\"send_sms.php\">Send SMS</a></li>
			<li class='cat-item'><a href=\"coord_adv_download.php\">Advice Download</a></li>  
			<li class='cat-item'><a href=\"feedback.php\">Feedback</a></li>  
			</ul></li> "; 
		print " <li><a href=\"esagu.php\">esagu</a></li>";
		print " <li><a href=\"ehorti.php\">ehorti</a></li>";
		print " <li><a href=\"http://agriculture.iiit.ac.in:8055/ontime_2010/firstpage.jsp?user_id=$user_id&mode=$user_mode&login_status=$login_code\">OneTime</a></li>";
		print "<li><a href=\" \">My Account</a>
		        <ul class='subchildren'>
		        <li class='cat-item'><a href=\"coordinator_profile.php\">Show Profile</a></li>
		        <li class='cat-item'><a href=\"editprofile_coordinator.php\">Edit Profile</a></li>
				<li class='cat-item'><a href=\"cord_detach_farmer.php\">Detach Farmer</a></li>  
				<li class='cat-item'><a href=\"cord_detach_farm.php\">Detach Farm</a></li> 
		        </ul></li>";

	}
	
	elseif($cord_active=='-1')
	{
		print "<li class='cat-item'><a href=\"coordinator_registration.php\">Coordinator Registration</a></li>
			</ul></li>";
	}
	
	elseif (($farmer_active=='0') && ($cord_active=='0') && ($partner_active=='0'))
	{
		print " <li><a href=\" \">New Registration</a>
                        <ul class='children'>
			<li class='cat-item'><a href=\"partner_registration.php\">Partner</a></li> 
			<li class='cat-item'><a href=\"expert_registration.php\">Expert</a></li>
			<li class='cat-item'><a href=\"#\">Stakeholder</a></li>
			<li class='cat-item'><a href=\"#\">Guest</a></li>
                        </ul></li>";
	}
	print " <li><a href=\"Logout.php\">Logout</a></li>
		</ul></li>";
}
?>
</ul>

<div id="subheader"><font color="green" align="left">

<?php

  

print "<br><font color=\"green\"><i><b>Hello, Mr.".$current_user_id."</i></b></font>&nbsp&nbsp&nbsp&nbsp&nbsp";
if($ceo_check==1)
{
print "<i><font color=\"green\" >Logged in Users :".$no_active_online_users."</font>&nbsp;&nbsp;";
print "<font color=\"green\">Guests :".$no_active_guest_users."</font></i>"; 
}
print "<font color=\"blue\">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href=\"http://download.mozilla.org?product=firefox-30.0&os=win&lang=en-US\">"." Download Mozilla</a>";

?>
</font> </div>

<div id="subheader">

</div>

<div id="top">
<?php
?>
</div>
