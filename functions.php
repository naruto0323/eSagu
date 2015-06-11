<?php
include_once("dblayer.php");

function get_farmer_id($session_user_id)
{
	$db = new sql_db();
	$query = "select farmer_id from user_registration where user_id = '$session_user_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$farmer_id = $result['farmer_id'];
	$db->sql_close();
	return $farmer_id;
}

function get_cord_id($session_user_id)
{
	$db = new sql_db();
	$query = "select cord_id from user_registration where user_id = '$session_user_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$cord_id = $result['cord_id'];
	$db->sql_close();
	return $cord_id;
}

function get_cluster_id($cord_id)
{
	$db = new sql_db();
	$query = "select cluster_id from v_cluster where cord_id = '$cord_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$cluster_id = $result['cluster_id'];
	$db->sql_close();
	return $cluster_id;
}

function get_coord_info($current_user_id)
{
	$db = new sql_db();
	$coord_info = array();
	$query = "select v_cord.* from v_cord , user_registration where user_registration.user_id = '$current_user_id' and user_registration.cord_id = v_cord.cord_id";
	$result1 = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
	{
		$coord_info['name'] = $result['name'];
		$coord_info['id'] = $result['cord_id'];
		$coord_info['state'] = $result['state'];
		$coord_info['district'] = $result['dist'];
		$coord_info['mandal'] = $result['tlq_mndl'];
		$coord_info['village'] = $result['vil_name'];
	}
	return $coord_info;
}

function get_coord_info2($fid)
{
	$db = new sql_db();
	$coord_info = array();
	$query = "select * from cord as c,farmer_cord as fc where fc.cord_id = c.cord_id and fc.farmer_id = '".$fid."'";
	$result1 = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
	{
		$coord_info['name'] = $result['name'];
		$coord_info['id'] = $result['cord_id'];
		$coord_info['center'] = $result['loc_cen_id'];
	}
	$query = "select * from farmer as f where f.farmer_id = '".$fid."'";
	$result1 = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
	{
		$coord_info['state'] = $result['state'];
		$coord_info['district'] = $result['dist'];
		$coord_info['mandal'] = $result['tlq_mndl'];
		$coord_info['village'] = $result['vil_name'];
	}
	$db->sql_close();
	return $coord_info;
}

function get_prop_crop($farmerid,$fid)
{
	$db = new sql_db();
	$query="select prop_crop_var from v_observation where farm_id='$fid'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$prop_crop = $result['prop_crop_var'];
	$db->sql_close();
	return $prop_crop;
}

function get_all_crop()
{
	$db = new sql_db();
	$query="select distinct original_crop_name from CropCode_CropName'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$prop_crop = $result['original_crop_name'];
	$db->sql_close();
	return $prop_crop;
}

function get_farmer_name($current_user_id)
{
	$db = new sql_db();
	$query = "select name from farmer as f, user_registration as ur where  f.farmer_id = ur.farmer_id and ur.user_id = '$current_user_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$farmer_name = $result['name'];
	$db->sql_close();
	return $farmer_name;
}
// added by trinath
function get_partner_id($current_user_id)
{
	$db = new sql_db();
	$query = "select ptnr_id from user_registration as ur where ur.user_id = '$current_user_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$ptnr_id = $result['ptnr_id'];
	$db->sql_close();
	return $ptnr_id;
}

//added by trinath
function get_nof_cords($partner_id)
{
	$db = new sql_db();
	$query = "select count(*) from v_cord as vc where vc.ptnr_id = '$partner_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$number = $result['count(*)'];
	$db->sql_close();
	return $number;
}

//added by trinath
function get_user_type($type_id)
{
	$db = new sql_db();
	$query = "select * from v_expert_type as vet where vet.type_id = '$type_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$type = $result['type'];
	$db->sql_close();
	return $type;
}
//added by trinath
function is_partner_active($user_id)
{
	$db = new sql_db();
	$query = "select active_partner_id from user_registration as ur where ur.user_id = '$user_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$number = $result['active_partner_id'];
	$db->sql_close();
	return $number;
}
//added by shubhank
function get_farms_from_village($village_id)
{
	$farmid = array();
	$db = new sql_db();
        $query="select farm_id from v_farm_reg_type1, v_farmer_reg_type1 where v_farm_reg_type1.farmer_id = v_farmer_reg_type1.farmer_id and vil_id='$village_id'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$farmid[] = $result['farm_id'];
	return $farmid;
	
}
//added by shubhank
function get_villages()
{
	$village_id = array();
	$db = new sql_db();
	$query="select v_village.vil_id from v_village, v_cluster,v_cluster_vil where v_cluster.cluster_id=v_cluster_vil.cluster_id and v_cluster_vil.vil_id=v_village.vil_id;";
	$result=$db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$village_id[] = $result['vil_id'];
	return $village_id;
}

function get_farmer_farms($cid)
{
	$farmid = array();
	$db = new sql_db();
	$query = "select fm.farm_id from v_farm_reg_type1 as fm where fm.farmer_id = '".$cid."'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$farmid[] = $result['farm_id'];
	return $farmid;
}
function get_cord_farms($cid)
{
	 $farmid = array();
	 $db = new sql_db();
	 $query = "select fm.farm_id from v_farmer_reg_type1 as f, v_coordinator_farmer as cf, v_farm_reg_type1 as fm where fm.farmer_id = f.farmer_id and f.farmer_id = cf.farmer_id and cf.cord_id = '".$cid."'";
	 $result = $db->sql_query($query);
	 while($result = $db->sql_fetch_array())
		$farmid[] = $result['farm_id'];
	 return $farmid;
}

function get_farmer_name2($fid)
{
	$db = new sql_db();
	$query = "select name from v_farmer_reg_type1 where farmer_id= '$fid'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$farmer_name = $result['name'];
	$db->sql_close();
	return $farmer_name;
}

function get_orch_id($fid)
{
	$db = new sql_db();
	$orch_ids = array();
	$query = "select orch_id from orch where farmer_id ='".$fid."'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$orch_ids[] = $result['orch_id'];
	$db->sql_close();
	return $orch_ids;
}

function get_orch_id2($session_user_id)
{
	$db = new sql_db();
	$orch_ids = array();
	$query = "select orch_id from orch as f, user_registration as ur where f.farmer_id = ur.farmer_id and ur. user_id = '$session_user_id'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$orch_ids[] = $result['orch_id'];
	$db->sql_close();
	return $orch_ids;
}

function get_crop_code($crpname)
{
	$db = new sql_db();
	$query = "select crop_code from  CropCode_CropName where original_crop_name = '$crpname'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$crpcode = $result['crop_code'];
	$db->sql_close();
	return $crpcode;
}
function get_crop_name($crpcode)
{
	$db = new sql_db();
	$query = "select original_crop_name from  CropCode_CropName where crop_code = '$crpcode'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$crpcode = $result['original_crop_name'];
	$db->sql_close();
	return $crpcode;
}


function active_status($session_user_id,$role_identifier)
{
	if($role_identifier ==1)
	{
		$active_status_for = "active_farmer_id";
	}
	else if($role_identifier ==2)
	{
		$active_status_for = "active_coord_id";
	}
	else if($role_identifier ==3)
	{
		$active_status_for = "active_partner_id";
	}
	$db = new sql_db();
	$query = "select $active_status_for as status from user_registration where user_id = '$session_user_id'";
	$result = $db->sql_query($query);
	$result = $db->sql_fetch_array();
	$status = $result['status'];
	$db->sql_close();
	return $status;
}

function check_reg_cen()
{
	$db = new sql_db();
	$query = "select count(*) as count from regl_cen where regl_cen_id = '$reg'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function check_ptnr()
{
	$db = new sql_db();
	$query = "select count(*) as count from ptnr where ptnr_id = '$ptr'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function check_loc_cen()
{
	$db = new sql_db();
	$query = "select count(*) as count from loc_cen where loc_cen_id = '$loc'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function check_vil()
{
	$db = new sql_db();
	$query = "select count(*) as count from vil where vil_id = '$vil'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function check_cord()
{
	$db = new sql_db();
	$query = "select count(*) as count from cord where cord_id = '$cord'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function check_farmer()
{
	$db = new sql_db();
	$query = "select count(*) as count from farmer where farmer_id = '$farmer'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function is_logged()
{
	if(isset($_SESSION['user_id']))

	{return true;
	//	 echo $_SESSION['user_id'];
	}	 
	else
		return false;
}

function logout()
{
	unset($_SESSION);
	session_destroy();
}

function del_crnt_users($current_user_id)
{
	$db = new sql_db();
	try {
		$query="select * from user_registration where user_id='$current_user_id'";
		$res1=$db->sql_query($query);
		$row=$db->sql_fetch_array();
		$cord_id=$row['cord_id'];

		$query="select * from crnt_user_code where user_id='$cord_id'";
		$result=$db->sql_query($query);
		while($row=$db->sql_fetch_array())
		{
			$del_q=$db->sql_query("delete from crnt_user_code where user_id='$cord_id'");
		}
	}
	catch (Exception $e){
		print $e->getMessage();
	};
	$db->sql_close();
}

function check_user_code($current_user_id)
{
	$db = new sql_db();
	$query = "select count(*) as count from crnt_user_code where user_id = '$current_user_id'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}


function check_user_code_login($current_user_id)
{
	$db = new sql_db();
	$query = "select count(*) as count from logins where login = '$current_user_id'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];


}

function redirect($redirect_page)
{
	print "<META http-equiv=\"refresh\" content=\"2;url=$redirect_page\">";
	print "<P>If your browser supports Refresh,you'll be transported to our
		<A href=\"$redirect_page\">$redirect_page</A>
		in 2 seconds, otherwise, select the link manually.";
	include("footer.php");
}

function noheader_redirect($redirect_page)
{
	print "<META http-equiv=\"refresh\" content=\"2;url=$redirect_page\">";
	print "<P>If your browser supports Refresh,you'll be transported to our
		<A href=\"$redirect_page\">$redirect_page</A>
		in 2 seconds, otherwise, select the link manually.";
}




function delete_session_info($sid)
{
	$db = new sql_db();
	try {
		$result=$db->sql_query("delete from online_users where sid='$sid'");
	}
	catch (Exception $e){
		print $e->getMessage();
	};
	$db->sql_close();
}

function DeleteSessionID($sessionid)
{
	$path=session_save_path();
	if(file_exists($path.'/sess_'.$sessionid))
	{
		// Delete it here
		unlink($path.'/sess_'.$sessionid);
	}
	else
	{
		// File not found
	}
}

function store_session_info()
{
	global $current_sid;
	global $current_user_id;
	global $current_grp_id;
	global $no_active_guest_users;
	global $no_active_online_users;
	$ip_address=$_SERVER['REMOTE_ADDR'];
	$tm=date("Y-m-d H:i:s");
	$status=1;

	if(!isset($_SESSION['sid']))
	{
		$_SESSION['sid']=$current_sid;
		try {
			$result=$db->sql_query("insert into online_users values('$current_sid','$current_user_id','$ip_address','$tm',$status)");
		}
		catch (Exception $e){
			print $e->getMessage();
		};
	}

	if(isset($_SESSION['sid']))
	{
		$tm=date("Y-m-d H:i:s");

		try {
			$result=$db->sql_query("update online_users set status=1,logging_time='$tm' where sid='$current_sid'");
		}
		catch (Exception $e){
			print $e->getMessage();
		};
	}

	$gap=10; // change this to change the time in minutes, This is the time for which active users are collected. 
	$tm=date ("Y-m-d H:i:s", mktime (date("H"),date("i")-$gap,date("s"),date("m"),date("d"),date("Y")));
	//// Let us update the table and set the status to OFF 
	////for the users who have not interacted with 
	////pages in last 10 minutes ( set by $gap variable above ) ///
	try {
		$result=$db->sql_query("update online_users set status=0 where logging_time < '$tm'");
	}
	catch (Exception $e){
		print $e->getMessage();
	};
	// Now let us collect the userids from table who are online
	// $qt=mysql_query("select userid from plus_login where tm > '$tm' and status='ON'");
	// echo mysql_error();

	try {
		$result_guest=$db->sql_query("select count(*) from online_users where status=1 and user_id='Guest'");
	}
	catch (Exception $e){
		print $e->getMessage();
	};

	try {
		$result_non_guest=$db->sql_query("select count(*) from online_users where status=1 and user_id!='Guest'");
	}
	catch (Exception $e){
		print $e->getMessage();
	};

	while($row=$db->sql_fetch_array($result_guest))
	{
		$no_active_guest_users=$row['count(*)'];
	}

	while($row=$db->sql_fetch_array($result_non_guest))
	{
		$no_active_online_users=$row['count(*)'];
	}

	$session_timed_out=58;
	// change this to time in minutes, this is the time for which active users are collected.
	$tm=date ("Y-m-d H:i:s", mktime (date("H"),date("i")-$session_timed_out,date("s"),date("m"),date("d"),date("Y")));
	// Let us update the table and set the status to OFF for the users who have not interacted with
	// pages in last 10 minutes (set by $gap variable above)
	try {
		$result=$db->sql_query("delete from online_users where status=0 and logging_time < '$tm'");
	}
	catch (Exception $e){
		print $e->getMessage();
	};
	$db->sql_close($link);
}

function upload_file($photoName,$form)
{ 
	$cfile=$_FILES[$photoName]['name'];
	$ext=strtolower(end(explode(".", $cfile)));
	$filepath = $form;
	if(!file_exists($filepath))
		mkdir($filepath,0777);
	if ((!strcmp(strtolower($ext),"jpg") || !strcmp(strtolower($ext),"jpeg")))
	{
		if ($_FILES[$photoName]["error"] > 0)
		{
			echo "Return Code: " . $_FILES[$photoName]["error"] . "<br />";
			echo "<br>";
		}
		else
		{

			echo "<br>Upload: " . $_FILES[$photoName]["name"];
			if (file_exists("".$filepath."/" . $_FILES[$photoName]["name"]))
			{
				echo "<br>";
				echo $_FILES[$photoName]["name"] . " already exists. ";
				echo "<br>";
			}
			else
			{
				move_uploaded_file($_FILES[$photoName]["tmp_name"],
					"".$filepath."/" . $_FILES[$photoName]["name"]);
				echo "<br>Stored in: " . $filepath."/" . $_FILES[$photoName]["name"];
				echo "<br>";
			}
		}
	}
	else
	{
		echo "Invalid file";
	}
}

function get_agri_crops()
{
	$db = new sql_db();
	$agri_crops = array();
	$query = "select original_crop_name from CropCode_CropName where crop_type = 'agri'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$agri_crops[] = $result['original_crop_name'];
	$db->sql_close();
	return $agri_crops;
}

function get_horti_crops()
{
	$db = new sql_db();
	$horti_crops = array();
	$query = "select original_crop_name from CropCode_CropName where crop_type = 'horti'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$horti_crops[] = $result['original_crop_name'];
	$db->sql_close();
	return $horti_crops;
}

function get_all_crops()
{
	$db = new sql_db();
	$all_crops = array();
	$query = "select distinct original_crop_name from CropCode_CropName ";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$all_crops[] = $result['original_crop_name'];
	$db->sql_close();
	return $all_crops;
}

function get_farm_id($fid)
{
	$db = new sql_db();
	$farm_ids = array();
	$query = "select farm_id from v_farm_reg_type1 where farmer_id = '".$fid."'";
	$result = $db->sql_query($query);

	while($result = $db->sql_fetch_array())
		$farm_ids[] = $result['farm_id'];

	$db->sql_close();
	return $farm_ids;
}
//added by trinath
function get_farmers($cord_id)
{
	$db = new sql_db();
	$farmer_ids = array();
	$query = "select farmer_id from v_coordinator_farmer where cord_id = '".$cord_id."'";
	$result = $db->sql_query($query);

	while($result = $db->sql_fetch_array())
		$farmer_ids[] = $result['farmer_id'];

	$db->sql_close();
	return $farmer_ids;
	
}
function get_pond_id($fid)
{
	$db = new sql_db();
	$pond_ids = array();
	$query = "select pond_id from pond where farmer_id = '".$fid."'";
	$result = $db->sql_query($query);

	while($result = $db->sql_fetch_array())
		$pond_ids[] = $result['pond_id'];

	$db->sql_close();
	return $pond_ids;
}


function get_user_id($id) {
	$cord_id = null;
	$db = new sql_db();
	$query = "select cord_id from user_registration where user_id = '$id'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array()) {
		$cord_id = $result['cord_id'];
	}
	return $cord_id;
}

function getFarmers($cid)
{
	$farmid = array();
	$db = new sql_db();
	$query = "select * from v_farmer_reg_type1 as f, v_coordinator_farmer as cf where f.farmer_id = cf.farmer_id and cf.cord_id = '".$cid."'";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$farmid[] = $result['farmer_id'];
	return $farmid;
}

function get_farm_count($fid)
{
	$db = new sql_db();
	$query = "select * from v_farm_reg_type1 as f where f.farmer_id = '".$fid."'";
	$farmcount = -1;
	$result1 = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$farmid[] = $result['farm_id'];
	foreach($farmid as $val)
	{
		$tmp = explode("_",$val);
		$tmp_fc = $tmp[7];
		if($tmp_fc > $farmcount)
			$farmcount = $tmp_fc;
	}
	$db->sql_close();
	return $farmcount + 1;
}




function get_farm_id2($current_user_id)
{
	$db = new sql_db();
	$farm_ids = array();
	$query = "select farm_id from farm as f, user_registration as ur where f.farmer_id = ur.farmer_id and ur. user_id = '$current_user_id'";
	$result = $db->sql_query($query);

	while($result = $db->sql_fetch_array())
		$farm_ids[] = $result['farm_id'];

	$db->sql_close();
	return $farm_ids;
}

$current_user_id='Guest';
$current_sid=session_id();
$no_active_online_users=0;
$no_active_guest_users=0;
if(is_logged())
	$current_user_id=$_SESSION['user_id'];
?>
