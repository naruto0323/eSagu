<?php
session_start();
include("header_new.php");
include_once("dblayer.php");
include_once("functions.php");
include_once("ruhela_check_functions.php");
$db1=new sql_db();
extract($_POST);
extract($_GET);

$partner_id=get_partner_id($current_user_id);
$number=get_nof_cords(get_partner_id($current_user_id))+1;
$user_id=$current_user_id."_".$number;
echo "<h2>Login Name :   $user_id</h2>";

$name=$_POST['Userid'];
echo "<h2>Name :   $name</h2>";

$Jday=$_POST['Jday'];
echo "<h2>Join Day :   $Jday</h2>";

$Jmonth=$_POST['Jmonth'];
echo "<h2>Join Month :   $Jmonth</h2>";

$Jyear=$_POST['Jyear'];
echo "<h2>Join Year :   $Jyear</h2>";

$cord_join=$Jyear.-$Jmonth.-$Jday;

/*$Lday=$_POST['Lday'];
echo "<h2>Leaving Day :   $Lday</h2>";

$Lmonth=$_POST['Lmonth'];
echo "<h2>Leaving Month :   $Lmonth</h2>";

$Lyear=$_POST['Lyear'];
echo "<h2>Join Year :   $Lyear</h2>";

$cord_leav=$Lyear.-$Lmonth.-$Lday;
*/
$state_id=$_REQUEST['cat'];
echo "<h2>State :   $state_id</h2>";

$dist=$_REQUEST['subcat'];
echo "<h2>District:   $dist</h2>";

$vil_name=$_REQUEST['subcatvillage'];
echo "<h2>Village: $vil_name</h2>";

$tlqmndl=$_REQUEST['subcatmandal'];
echo "<h2>Mandal:  $tlqmndl</h2>";	

$street=$_POST['street'];
echo "<h2> Street:   $street</h2>";

$pincode=$_POST['pincode'];
echo "<h2> Pin code:   $pincode</h2>";

$email=$_POST['email'];
echo "<h2> Email:   $email</h2>";

$mphone=$_POST['mphone'];
echo "<h2> Mobile Phone:   $mphone</h2>";

$age=$_POST['age'];
echo "<h2> Age:   $age</h2>";

$gender=$_POST['gender'];
echo "<h2> Gender:   $gender</h2>";

$Edu=$_POST['Edu'];
echo "<h2> Education:   $Edu</h2>";

$mainoccu=$_POST['mainoccu'];
echo "<h2> Main occupation:   $mainoccu</h2>";

$mainoccu1=$_POST['mainoccu1'];
echo "<h2> Skills:   $mainoccu1</h2>";

//echo "  CURRENT USER is :$current_user_id <br/> ";

$login_code=rand(1000000000,9999999999);
//echo "<br/>Login Code = ".$login_code;  


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

if($tlqmndl=='Select One' || $tlqmndl=='')
{
	$tlqmndl=$addMandal;
}
if($vil_name=='Select One' || $vil_name=='')
{
	$vil_name=$addVillage;
}


$state_q="select state_name from STATE where state_id='$state_id'";
$state_r=$db1->sql_query($state_q);
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
$mandal_q=" select mandal_id  from MANDAL where mandal_name='$tlqmndl' and DID='$dist_id' and SID='$state_id'";
$mandal_r=$db1->sql_query($mandal_q);
$mandal_row=$db1->sql_fetch_array();
$mandal_id=$mandal_row['mandal_id'];
$t_mandal_id=chk_mandal($mandal_id);

if($t_mandal_id!=1)
{
	if($tlqmndl!='')
	{
		$mandal_id=substr("$tlqmndl",0,3);
		$mandal_id=strtolower($mandal_id);
		$mandal_qu="insert into MANDAL(mandal_id,mandal_name,DID,SID) values('$mandal_id','$tlqmndl','$dist_id','$state_id')";
		$mandal_res=$db1->sql_query($mandal_qu);

	}
}

$vil_q=" select vil_id  from VILLAGE where vil_name='$vil_name' and MID='$mandal_id' and DID='$dist_id' and SID='$state_id'";
$vil_r=$db1->sql_query($vil_q);
$vil_row=$db1->sql_fetch_array();
$vil_id=$vil_row['vil_id'];
$t_vil_id=chk_village($vil_id);


if($t_vil_id!=1)
{
	if($vil_name!='')
	{
		$vil_id=substr("$vil_name",0,3);
		$vil_id=strtolower($vil_id);
		$vil_qu="insert into VILLAGE(vil_id,vil_name,MID,DID,SID) values('$vil_id','$vil_name','$mandal_id','$dist_id','$state_id')";
		$vil_res=$db1->sql_query($vil_qu);

	}
}

// Caculating Coordinator id

$cord_qu1="select count(cord_id) from cord where vil_name='".$vil_name."' and tlq_mndl='".$tlqmndl."' and dist='".$dist."'";
$cord_re1=$db1->sql_query($cord_qu1);
$cord_row=$db1->sql_fetch_array();
$cnt1=$cord_row['count(cord_id)'];

$cnt=$cnt1+1;

$a='0';
$b='00';

if($cnt>0 && $cnt<=9)
{
	$count="$b"."$cnt";
}
if($cnt>9 && $cnt<=99)
{
	$count="$a"."$cnt";
}
if($cnt>99)
{
	$count=$cnt;
}

if($dist=='' && $tlqmndl=='' && $vil_name=='')
{

	$cord_id1=substr("$state_id",0,2).'_'.substr("$addDistrict_id",0,3).'_'.substr("$addMandal_id",0,3).'_'.substr("$addVillage_id",0,3).'_c_'."$count";

}
elseif($dist!='' && $tlqmndl=='' || $vil_name=='')
{

	$cord_id1=substr("$state_id",0,2).'_'.substr("$dist",0,3).'_'.substr("$addMandal_id",0,3).'_'.substr("$addVillage_id",0,3).'_c_'."$count";

}

elseif($dist!='' && $tlqmndl!='' && $vil_name=='')
{

	$cord_id1=substr("$state_id",0,2).'_'.substr("$dist",0,3).'_'.substr("$tlqmndl",0,3).'_'.substr("$addVillage_id",0,3).'_c_'."$count";

}
else
{
	$cord_id1=substr("$state_id",0,2).'_'.substr("$dist",0,3).'_'.substr("$tlqmndl",0,3).'_'.substr("$vil_name",0,3).'_c_'."$count";
}


$cord_id=strtolower($cord_id1);
$photo="hi";
/*
$photo="/Cordinator_Photos/";
if ( ((!strcmp(strtolower($ext),"jpg")) && (!strcmp(strtolower($ext),"jpeg"))))
{
	print "File should be .jpg or .jpeg and '<br>' max permitted size is 20KB";
	print "upload once again !!";
	return;
}

if ($_FILES['file']['error'] > 0)
{
	print "Return Code: " . $_FILES['file']['error'] . "<br />";
}
else
{
	$upload_dir = $upload_dir_cord_photos;
	if (! file_exists($upload_dir))
		mkdir( $upload_dir , 0777 );
	$actual_Photo_name = $_FILES['file']['name'];
	$Stored_Photo_name = $cord_id.".jpg";
//	print_r($_FILES['file']);
	print "upload dir is :-- ".$upload_dir."<br>";
	print "Stored file name is :-- ".$Stored_Photo_name."<br>";
	if (file_exists("$upload_dir".$Stored_Photo_name))
	{
		print $Stored_Photo_name."already exists.";
		return ( true ); //actualy false :P
	} 
	else
	{*/
	 /* echo $_FILES['file']['tmp_name'];
		echo '<br>';
		echo "$_upload_dir".$Stored_Photo_name;
		echo '<br>';*/
	/*	if(move_uploaded_file($_FILES['file']['tmp_name'], "$upload_dir".$Stored_Photo_name))
		{
			print "The file ". basename( $_FILES['file']['name']). " has been uploaded";
			$PhotoName = $Stored_Photo_name;
		}
		else
		{
			print "There was an error uploading the file, please try again!";
			return ( false );
		}
	}// inner else ends
} // else ended
*/
$act='1';
if(is_partner_active($current_user_id)==2)
{

	$db1=new sql_db();
	$act='2';
	$qu1="insert into user_registration(user_id,passwd,cord_id,active_coord_id) values('$user_id','$passwd','$cord_id','2')";
	$re1=$db1->sql_query($qu1);
}
else
{
	$db=new sql_db();
	echo $cord_id;
	echo $current_user_id;
	$sql173="update user_registration set cord_id='$cord_id',active_coord_id='1' where user_id='$current_user_id'";
	
	$res1=$db->sql_query($sql173);

	$db1=new sql_db();
	$q1="select ptnr_id from user_registration where user_id='global_partnr'";
	$db1->sql_query($q1);
	while($result=$db1->sql_fetch_array()){
			 	$partner_id = $result['ptnr_id'];
			 }
}

$db1=new sql_db();
$sql5="INSERT INTO cord (cord_id,doj,ptnr_id,vil_name,photo,name,tlq_mndl,dist,state,pin,mob_phn,dob,gender,edu_qua,main_occ,active,street,other_exp,email) VALUES ('$cord_id','$cord_join','$partner_id','$vil_name','$photo','$name','$tlqmndl','$dist','$state','$pincode','$mphone','$age','$gender','$Edu','$mainoccu','$act','$street','$mainoccu1','$email')";

$res5=$db1->sql_query($sql5);

echo "<h1> '$name' is successfully registered as Coordinator <h1>";
//print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3; URL=partner_homepage.php\">";
echo "<h1> $user_id's Home page<a href='coordinator_homepage.php'>CLICK</a></h1>";
?>
