<?php
session_start();
//include_once ('functions.php');
include_once ('header_new.php');
include_once ('dblayer.php');
include_once ('ruhela_check_functions.php');
include_once 'iasp_config.php';

$service='3';
extract($_POST);
extract($_GET);
$db1 = new sql_db();


$number=get_nof_farmers2(get_cord_id($current_user_id))+1;
$user_id=$current_user_id."_".$number;
//print $current_user_id;
echo " CURRENT USER is : $current_user_id <br> ";

$name = $_POST['name'];
echo "<h2>name :   $name</h2>";

$date1= date("Y-m-d");
echo "<h2>Date :  $date1</h2>";


$village=$_POST['subcatvillage'];
echo "<h2>Village : $village</h2>";

$tlq_mndl=$_POST['subcatmandal'];
echo "<h2>Taluq/Mandal :   $tlq_mndl</h2>";

$dist=$_POST['subcat'];
echo "<h2>District :   $dist</h2>";

$state_id=$_REQUEST['cat'];
echo "<h2>State :   $state_id</h2>";

$mphone=$_POST['mphone'];
echo "<h2> mphone :   $mphone</h2>";

$addDistrict=$_POST['addDistrict'];
echo "<h2> addDistrict :   $addDistrict</h2>";

$addMandal=$_POST['addMandal'];
echo "<h2> addMandal :   $addMandal</h2>";

$addVillage=$_POST['addVillage'];
echo "<h2> addVillage :   $addVillage</h2>";

if($dist=='Select One' || $dist=='')
{
	$dist=$addDistrict;
}
if($tlq_mndl=='Select One' || $tlq_mndl=='')
{
	$tlq_mndl=$addMandal;
}
if($village=='Select One' || $village=='')
{
	$village=$addVillage;
}

$state_qu="select state_name from STATE where state_id='$state_id'";
$state_res=$db1->sql_query($state_qu);
$state_row=$db1->sql_fetch_array();
$state=$state_row['state_name'];

$dist_q=" select district_id  from DISTRICT  where district_name='$dist' and SID='$state_id'";
$dist_r=$db1->sql_query($dist_q);
$dist_row=$db1->sql_fetch_array();
$dist_id=$dist_row['district_id'];
$t_dist_id=chk_dist($dist_id);

if($t_dist_id!=1)
{
	if($dist!='')
	{
        	$dist_id=substr("$dist",0,3);
		$dist_id=strtolower($dist_id);
		$dist_qu="insert into DISTRICT(district_id,district_name,SID) values('$dist_id','$dist','$state_id')";
		$dist_res=$db1->sql_query($dist_qu);
	}

}


$mandal_q=" select mandal_id  from MANDAL where mandal_name='$tlq_mndl' and DID='$dist_id' and SID='$state_id'";
$mandal_r=$db1->sql_query($mandal_q);
$mandal_row=$db1->sql_fetch_array();
$mandal_id=$mandal_row['mandal_id'];
$t_mandal_id=chk_mandal($mandal_id);

if($t_mandal_id!=1)
{
	if($tlq_mndl!='')
	{
		$mandal_id=substr("$tlq_mndl",0,3);
		$mandal_id=strtolower($mandal_id);
		$mandal_qu="insert into MANDAL(mandal_id,mandal_name,DID,SID) values('$mandal_id','$tlq_mndl','$dist_id','$state_id')";
		$mandal_res=$db1->sql_query($mandal_qu);
	}
}

$db1 = new sql_db();
$village_q=" select vil_id  from VILLAGE where vil_name='$village' and MID='$mandal_id' and DID='$dist_id' and SID='$state_id'";
$village_r=$db1->sql_query($village_q);
$village_row=$db1->sql_fetch_array();
$vil_id=$village_row['village_id'];
$t_vil_id=chk_village($village_id);
if($t_vil_id!=1)
{
	if($village!='')
	{
		$vil_id=substr("$village",0,3);
		$vil_id=strtolower($village_id);
		$village_qu="insert into VILLAGE(vil_id,vil_name,MID,DID,SID) values('$village_id','$village','$mandal_id','$dist_id','$state_id')";
		$village_res=$db1->sql_query($village_qu);
	}
}


$vil_id=$state_id."_".$dist_id."_".$mandal_id."_".$vil_id;
$far_qu1="select count(farmer_id) from farmer where vil_name='".$village."'";
$db1 = new sql_db();
$far_re1=$db1->sql_query($far_qu1);
$far_row=$db1->sql_fetch_array();
$cnt1=$far_row['count(farmer_id)'];
$cnt=$cnt1+1;

$a='0';
$b='00';
$c='000';

	if($cnt>0 && $cnt<=9)
	{ 
		$count="$c"."$cnt";
	}	
	if($cnt>9 && $cnt<=99)
	{
		$count="$b"."$cnt";
	}
	if($cnt>99 && $cnt<=999)
	{
		$count="$a"."$cnt";
	}

if($dist=='' && $tlq_mndl=='' && $village=='')
{
	$farmer_id1=substr("$state_id",0,2).'_'.substr("$addDistrict_id",0,3).'_'.substr("$addMandal_id",0,3).'_'.substr("$addVillage_id",0,3).'_'."$count"; 
}

elseif($dist!='' && $tlq_mndl=='' || $village=='')
{
	$farmer_id1=substr("$state_id",0,2).'_'.substr("$dist",0,3).'_'.substr("$addMandal_id",0,3).'_'.substr("$addVillage_id",0,3).'_'."$count";
}

elseif($dist!='' && $tlq_mndl!='' && $village=='')
{
	$farmer_id1=substr("$state_id",0,2).'_'.substr("$dist",0,3).'_'.substr("$tlq_mndl",0,3).'_'.substr("$addVillage_id",0,3).'_'."$count";
}

else
{
	$farmer_id1=substr("$state_id",0,2).'_'.substr("$dist",0,3).'_'.substr("$tlq_mndl",0,3).'_'.substr("$village",0,3).'_'."$count";
} 

$farmer_id=strtolower($farmer_id1);
echo "<h2>Farmer_id :   $farmer_id</h2>";
echo "<h2>Village_id :   $vil_id</h2>";


$login_code=rand(1000000000,9999999999);

//$regn_type="null";
//$prev_farmer_id="null";

//2012-06-01 : cord registers farmer
$db = new sql_db();
$query="select cord_id from user_registration where user_id='$current_user_id'";
$result = $db->sql_query($query);
while($result = $db->sql_fetch_array())
{
	$cord_id = $result['cord_id'];
}
echo"<h2>coordinator_id :  $cord_id</h2>";

/*  
$t_vil_id = chk_vil($village_id);
if($t_vil_id!=1)
{
	$db1 = new sql_db();
	$sql4="INSERT INTO v_village(vil_id,vil_name,tlq_mndl,dist,state) values ('$vil_id','$village','$tlq_mndl','$dist','$state')";
	$db1->sql_query($sql4);
}
*/


$act='1';
if(is_cord_active($current_user_id)==2)
{
        $act='2';
	$qu1="insert into user_registration(user_id,passwd,farmer_id,active_farmer_id) values('$user_id','$passwd','$farmer_id','2')";
	$re1=$db1->sql_query($qu1);
	$c_id=get_cord_id($current_user_id);
	echo $c_id;
}
else
{
	/* $db1=new sql_db();
	$ran_qu="insert into crnt_user_code values('$farmer_name','$login_code')";
	$db1->sql_query($ran_qu); */
//	$db1=new sql_db();
//	$ran_qu_1="insert into crnt_user_code values('$farmer_id','$login_code')";
//	$db1->sql_query($ran_qu_1);
	$db2=new sql_db();
	$query="UPDATE user_registration set active_farmer_id='1' , farmer_id='$farmer_id'  where user_id='$current_user_id'";
	$db2->sql_query($query);
	$system_id=$farmer_id;
	 $db1=new sql_db();
	 $q1="select cord_id from user_registration where user_id='global_cord'";
	 $db1->sql_query($q1);
	 while($result=$db1->sql_fetch_array()){
	 	$c_id = $result['cord_id'];
		}
}
$db1 = new sql_db();
$qu2="insert into farmer_cord(cord_id,farmer_id,service) values('$c_id','$farmer_id',$service)";
$re2=$db1->sql_query($qu2);
$db1 = new sql_db();
$query="INSERT INTO farmer(farmer_id,name,vil_name,regn_date,mob_phn,service) values('$farmer_id','$name','$village','$date1','$mphone',$service)";
$db1->sql_query($query);

/*
$query="INSERT INTO farmer_cord(farmer_id,cord_id)values('$farmer_id','$cord_id')";
$db1->sql_query($query);
*/

// 2012-06-01 | Cord registers farmer.
/*$farmer_qu12="update user_registration set farmer_id='$farmer_id' where user_id='$current_user_id'";
// Updating active_partner_id and active_coord_id removed.
$db1->sql_query($farmer_qu12);*/



/* $db1=new sql_db();
$ran_qu="insert into crnt_user_code values('$farmer_name','$login_code')";
$db1->sql_query($ran_qu); */

$db1=new sql_db();
$ran_qu_1="insert into crnt_user_code values('$farmer_id','$login_code')";
$db1->sql_query($ran_qu_1);


$system_id=$farmer_id;

if(!mysql_error())
	echo "<h1> Successfully Registered as a Farmer <h1>";

echo "<h1> $current_user_id's Home page   <a href='coordinator_homepage.php'>CLICK</a></h1>";
//print "<meta http-equiv=\"REFRESH\" content=\"2;url=http://$ip/esagu2012/farmer_homepage.php\">";
?>
