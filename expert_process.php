<?php
session_start();
include("header_new.php");
include_once("dblayer.php");
include_once("functions.php");
include_once ('ruhela_check_functions.php');
$db=new sql_db();

extract($_POST);
extract($_GET);

$expert_id=$current_user_id;
echo "<h2>Expert id :   $current_user_id</h2>";

$type=$_POST['type'];
echo "<h2>Type of User :   $type</h2>";

$name=$_POST['name'];
echo "<h2>Name :   $name</h2>";

/*$service=$_POST['service'];
echo "<h2>Service :   $service</h2>";*/

$Jday=$_POST['Jday'];
echo "<h2>Join Day :   $Jday</h2>";

$Jmonth=$_POST['Jday1'];
echo "<h2>Join Month :   $Jday1</h2>";

$Jyear=$_POST['Jday2'];
echo "<h2>Join Year :   $Jyear</h2>";

$expert_join=$Jyear.-$Jmonth.-$Jday;
print "$ptnr_join";

/*
$lday=$_POST['Lday'];
echo "<h2>Leaving Day :   $lday</h2>";

$lmonth=$_POST['Lday1'];
echo "<h2>Leaving Month :   $lmonth</h2>";

$lyear=$_POST['Lday2'];
echo "<h2>Leaving Year :   $lyear</h2>";

$expert_leav=$lyear.-$lmonth.-$lday;
*/
$add=$_POST['add'];
echo "<h2>Address:   $add</h2>";

$pin=$_POST['pin'];
echo "<h2>Pin code :   $pin</h2>";

$lphone=$_POST['Lphone'];
echo "<h2>Land Phone Number :   $lphone</h2>";

$mphone=$_POST['Mphone'];
echo "<h2>Mobile Phone Number :   $mphone</h2>";

$dob=$_POST['dob'];
echo "<h2>Date of Birth :   $dob</h2>";

$gender=$_POST['gender'];
echo "<h2>Gender:   $gender</h2>";

$Edu=$_POST['Edu'];
echo "<h2>Education :   $Edu</h2>";

$main_occ=$_POST['main_occ'];
echo "<h2>Main Occupation :   $main_occ</h2>";

$sub_occ=$_POST['sub_occ'];
echo "<h2>Sub Occupation :   $sub_occ</h2>";

$email=$_POST['email'];
echo "<h2>Email :   $email</h2>";

$specialization=$_POST['special'];
echo "<h2>Specialization :   $specialization</h2>";

if($type=='aco' or $type=='aje' )
{
$crops=$_POST['crops'];
$cp=implode(", ",$crops);				
echo "<h2>Selected Crops  :</h2>";
foreach($_POST['crops'] as $crop )
{echo "<h2>$crop</h2>";}
}
/*
if($type=='am')
{
	$type_id=2;
}
if($type=='ace')
{
	$type_id=3;
}
else if($type=='ase')
{
	$type_id=4;
}
else if($type=='ae')
{
	$type_id=5;
}
else if($type=='aje')
{
	$type_id=6;
}
else if($type=='aco')
{
	$type_id=7;
}
*/


$photo="/Expert_Photos/";

//print_r($_FILES['file']);

if ((($_FILES["file"]["type"] == "image/jpeg") || ($_FILES["file"]["type"] == "image/pjpeg")) && ($_FILES["file"]["size"] > 1000000))
{
//	print "<b>File should be .jpg or .jpeg and max permitted size is 1MB</b>";
//	print "<br/><b>upload once again !!</b>";
	return;
}

if ($_FILES['file']['error'] > 0)
{
//	print "Return Code: " . $_FILES['file']['error'] . "<br />";
}
else
{
	$upload_dir = $upload_dir_expert_photos;
	if (! file_exists($upload_dir)){}
		//mkdir( $upload_dir , 0777 );
	$actual_Photo_name = $_FILES['file']['name'];
//	echo "Actual photo name is:".$actual_Photo_name;
//	echo "<br/>";
	$Stored_Photo_name = $expert_id.".jpg";
//	print "upload dir is :-- ".$upload_dir."<br>";
//	print "Stored file name is :-- ".$Stored_Photo_name."<br>";
	if (file_exists("$upload_dir".$Stored_Photo_name))
	{
		print $Stored_Photo_name."already exists.";
		return ( false );
	}
	else
	{	
		echo is_uploaded_file($_FILES['file']['tmp_name']);
		//echo "Upload: " . $_FILES["file"]["tmp_name"] . "<br>";
		//echo "Type: " . $_FILES["file"]["type"] . "<br>";
		//echo "Error" . $_FILES["file"]["error"] . "<br>";
		if(move_uploaded_file($_FILES['file']['tmp_name'], "C:/xampp/htdocs/esagu2012/Expert_Photos".$Stored_Photo_name))
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
				

$query="select * from user_registration where user_id='$current_user_id'";
$result=$db->sql_query($query);
$row=$db->sql_fetch_array();
$passwd=$row['passwd'];

//$crp=mysql_query("select original_crop_name from cropcode_cropname");

//inserting into logins table
$query="insert into logins(login,passwd,doj,photo,name,address,pin,land_phn,mob_phn,dob,gender,edu_qua,main_occ,sub_occ,email,creator_id,user_type,active) values('$expert_id','$passwd','$expert_join','$photo','$name','$add','$pin','$Lphone','$Mphone','$dob','$gender','$Edu','$main_occ','$sub_occ','$email','$expert_id','$type',1)";
$result=$db->sql_query($query);


/*
/// -------------- after inserting into logins delete from user_registration
$query="delete from user_registration where user_id='$current_user_id'";
$result=$db->sql_query($query);
*/

//inserting into expert table
$query="insert into expert(expert_id,expert_name,expert_type,specialization) values('$expert_id','$name','$type','$specialization')";
$result=$db->sql_query($query);


if($type=='aco' or $type=='aje')
{
$query="INSERT INTO read_permissions (user_id,crop,state,district) VALUES('$expert_id','$cp',' ',' ')";
$result=$db->sql_query($query);
$query1="INSERT INTO write_permissions (user_id,crop,state,district) VALUES('$expert_id','$cp',' ',' ')";
$result1=$db->sql_query($query1);
}

/*else if($type=='ase')
{
$query="INSERT INTO read_permissions (user_id,crop,state,district) VALUES('$expert_id','$crp',' ',' ')";
$result=$db->sql_query($query);
$query1="INSERT INTO write_permissions (user_id,state,district,crop,duration) VALUES('$expert_id',' ',' ','$crp',' ')";
$result1=$db->sql_query($query1);
}*/
echo "<h1> Successfully Registered as '$type'</h1>";
?>
