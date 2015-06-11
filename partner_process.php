<?php
session_start();
include("header_new.php");
include_once("dblayer.php");
include_once ('ruhela_check_functions.php');
$db1=new sql_db();


extract($_POST);

$name=$_POST['name'];
echo "<h2>Name :   $name</h2>";

$Jday=$_POST['Jday'];
echo "<h2>Join Day :   $Jday</h2>";

$Jmonth=$_POST['Jday1'];
echo "<h2>Join Month :   $Jday1</h2>";

$Jyear=$_POST['Jday2'];
echo "<h2>Join Year :   $Jyear</h2>";

$ptnr_join=$Jyear.-$Jmonth.-$Jday;

$Cperiod=$_POST['Cperiod'];
echo "<h2>Contract Period :   $Cperiod</h2>";

$Otype=$_POST['Otype'];
echo "<h2>Type of Organisation :   $Otype</h2>";

$Oregions=$_POST['Oregions'];
echo "<h2>Operational Regions :   $Oregions</h2>";

$addrs=$_POST['street'];
echo "<h2>Street :   $addrs</h2>";

$Vil=$_REQUEST['subcatvillage'];
echo "<h2>village name :   $Vil</h2>";

$Mndl=$_REQUEST['subcatmandal'];
echo "<h2>Mandal/Talq :   $Mndl</h2>";

$Dist=$_REQUEST['subcat'];
echo "<h2>District :   $Dist</h2>";

$state_id=$_REQUEST['cat'];
echo "<h2>State :   $state_id</h2>";

$Pin=$_POST['pin'];
echo "<h2>Pincode:   $Pin</h2>";

$hpage=$_POST['Hpage'];
echo "<h2>Home page :   $hpage</h2>";

$lphone=$_POST['Lphone'];
echo "<h2>Land Phone Number :   $lphone</h2>";

$mphone=$_POST['Mphone'];
echo "<h2>Mobile Phone Number :   $mphone</h2>";

$email=$_POST['email'];
echo "<h2>Email :   $email</h2>";

$Ftype=$_POST['Ftype'];
echo "<h2>Type of farming :   $Ftype</h2>";

$Ftype=$_POST['Ftype'];
echo "<h2>Type of farming :   $Ftype</h2>";

$Iname=$_POST['Iname'];
echo "<h2> Incharge Name:   $Iname</h2>";

$Imob=$_POST['Imob'];
echo "<h2>Incharge Person Phone Number :   $Imob</h2>";

$Iemail=$_POST['Iemail'];
echo "<h2>Incharge Email :   $Iemail</h2>";

$Cname=$_POST['Cname'];
echo "<h2> Contact Person Name:   $Cname</h2>";

$Cmob=$_POST['Cmob'];
echo "<h2>Contact Person Phone Number :   $Cmob</h2>";

$Cemail=$_POST['Cemail'];
echo "<h2>Contact Email :   $Cemail</h2>";

$addDistrict=$_POST['addDistrict'];
echo "<h2> addDistrict :   $addDistrict</h2>";

$addMandal=$_POST['addMandal'];
echo "<h2> addMandal :   $addMandal</h2>";

$addVillage=$_POST['addVillage'];
echo "<h2> addVillage :   $addVillage</h2>";

if($Dist=='Select One' || $Dist=='')
{
	$Dist=$addDistrict;
}

if($Mndl=='Select One' || $Mndl=='')
{
	$Mndl=$addMandal;
}
if($Vil=='Select One' || $Vil=='')
{
	$Vil=$addVillage;
}

$state_qu="select state_name from STATE where state_id='$state_id'";
$state_res=$db1->sql_query($state_qu);
$state_row=$db1->sql_fetch_array();
$state=$state_row['state_name'];

$dist_q=" select district_id  from DISTRICT  where district_name='$Dist' and SID='$state_id'";
$dist_r=$db1->sql_query($dist_q);
$dist_row=$db1->sql_fetch_array();
$dist_id=$dist_row['district_id'];
$t_dist_id=chk_dist($dist_id);

if($t_dist_id!=1)
{
	if($Dist!='')
	{
        	$dist_id=substr("$Dist",0,3);
		$dist_id=strtolower($dist_id);
		$dist_qu="insert into DISTRICT(district_id,district_name,SID) values('$dist_id','$Dist','$state_id')";
		$dist_res=$db1->sql_query($dist_qu);
	}

}

$mandal_q=" select mandal_id  from MANDAL where mandal_name='$Mndl' and DID='$dist_id' and SID='$state_id'";
$mandal_r=$db1->sql_query($mandal_q);
$mandal_row=$db1->sql_fetch_array();
$mandal_id=$mandal_row['mandal_id'];
$t_mandal_id=chk_mandal($mandal_id);

if($t_mandal_id!=1)
{
	if($Mndl!='')
	{
		$mandal_id=substr("$Mndl",0,3);
		$mandal_id=strtolower($mandal_id);
		$mandal_qu="insert into MANDAL(mandal_id,mandal_name,DID,SID) values('$mandal_id','$Mndl','$dist_id','$state_id')";
		$mandal_res=$db1->sql_query($mandal_qu);

	}
}
$village_q=" select vil_id  from VILLAGE where vil_name='$Vil' and MID='$mandal_id' and DID='$dist_id' and SID='$state_id'";
$village_r=$db1->sql_query($village_q);
$village_row=$db1->sql_fetch_array();
$village_id=$village_row['vil_id'];
$t_village_id=chk_village($village_id);



if($t_village_id!=1)
{
	if($Vil!='')
	{
		$village_id=substr("$Vil",0,3);
		$village_id=strtolower($village_id);
		$village_qu="insert into VILLAGE(vil_id,vil_name,MID,DID,SID) values('$village_id','$Vil','$mandal_id','$dist_id','$state_id')";
		$village_res=$db1->sql_query($village_qu);
	}
}


$squ=$db1->sql_query("select count(*) from partner");
$nurow=$db1->sql_fetch_array();
$num2=$nurow['count(*)'];
$num2=$num2+1;

$partner_id=$state_id."_".$dist_id."_p_".$num2;
$db=new sql_db();

$query="select active_partner_id from user_registration where user_id='$current_user_id'";
$result=$db->sql_query($query);
$row=$db->sql_fetch_array($result);

if($row['active_partner_id']==0)
{             
//	echo "inactive state";
	$sql12="update user_registration set active_partner_id='1' where user_id='$current_user_id'";
	$res=$db->sql_query($sql12);
}
else
{
	echo "active state";
}

$sql1="INSERT INTO partner(ptnr_id,name,ptnr_joining,url,land_phn,mob_phn,email,active,street,vil_name,tlq_mndl,dist,pin,state,type,contact_period,org_type,operational_regions,inch_name,inch_mob,inch_email,cont_name,cont_mob,cont_email) VALUES ('$partner_id','$name','$ptnr_join','$hpage','$lphone','$mphone','$email','1','$addrs','$Vil','$Mndl','$Dist','$Pin','$state','$Ftype','$Cperiod','$Otype','$Oregions','$Iname','$Imob','$Iemail','$Cname','$Cmob','$Cemail')";

$res=$db->sql_query($sql1);

$sql123="update user_registration set ptnr_id='$partner_id',active_partner_id='1' where user_id='$current_user_id'";
$res1=$db->sql_query($sql123);

// Login Status.
$login_code=rand(1000000000,9999999999);

$ran_qu_1="insert into crnt_user_code values('$partner_id','$login_code')";
$db1->sql_query($ran_qu_1);


echo "<h1> Successfully Registered as a Partner <h1>";
echo "<h1> If you want to goto your homepage click  <a href='partner_homepage.php'>Home page</a></h1>";
?>
