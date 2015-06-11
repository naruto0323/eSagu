<?php
include_once("header_new.php");
include_once("dblayer.php");

extract($_GET);
$sno = $_GET['sno'];
echo $sno;
$var = "'" . $sno . "'";
echo $_SESSION[$var];
//direct coordinator
$db=new sql_db();
$abc = get_cord_id($current_user_id);
$query1=$db->sql_query("select cord_id from cord where cord_id='$abc'");
$row1=$db->sql_fetch_array();
if($row1!=NULL){
	$_SESSION['mode']='co';
}
$_SESSION['current_user_id1']=$abc;
$coordinator_id=$abc;
//----------------
//through partner
$ro = null;
if($_SESSION['mode']=='po'){
	$partner_id = null;

	$url = $_SESSION[$var];
//	echo $url;
	if($url !=null){
		$db5=new sql_db();

		$query=$db5->sql_query("select * from cord where cord_id='$url'");//'$current_user_id'");
		global $ro;
		$ro = $db5->sql_fetch_array();
		$coordinator_id=$ro['cord_id'];
		$db6=new sql_db();
		$query=$db6->sql_query("select ptnr_id from cord where cord_id='$coordinator_id'");
		$row12=$db6->sql_fetch_array();
		$partner_id=$row12['ptnr_id'];

	}
	$_SESSION['current_user_id1'] = get_partner_id($current_user_id);
}

//------------------
//$current_user_id = "ap_Kar_p_2";

//echo $_SESSION['current_user_id1'];
//echo $partner_id;

if((($_SESSION['current_user_id1']!= null) && ($partner_id == $_SESSION['current_user_id1'])) || ($row1!= null)){
	//echo "mkc";
	$db1=new sql_db();
	global $ro;
//	echo $coordinator_id;
	$_SESSION['permission'] = 'true';
	$result=("select * from cluster where cord_id ='$coordinator_id'");    

	$result1=$db1->sql_query($result); 		//list of all clusters
	echo "<font align='left' size='5' color='green'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp LIST OF CLUSTERS</font>";
	if($_SESSION['mode'] == "co"){
//	echo "<font size='4' color='green'><a href='farmer_registration.php'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ADD NEW FARMER </a></font>";


	}
	elseif ($_SESSION['mode'] == "po") {
//	echo "<font size='4' color='green'><a href='village_registration.php'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ADD NEW VILLAGE </a></font>";

	echo "<font size='4' color='green'><a href='cluster_registration.php'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp ADD NEW CLUSTER </a></font>";
	}
	else {}


	$val=$db1->sql_num_rows($result1);				//number of clusters
	$sno=0;
	print "<table border = 5px cellpadding=100><tr>";
	echo "<td width = 10% height = '60'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>S.No.</b></td><td width = 40%>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Cluster Name</b></td><td width = 40%>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b>Cluster ID</b></td><td width = 10%><b>No. of Villages</b></td></tr>";
	while($row = $db1->sql_fetch_array())
	{
		$x=$row['cluster_name'];
		$sol2 = $row['no_vil'];
		if($sol2 == null)
			$sol2 = 0;
		$cluster_id1 = $row['cluster_id'];           //cord id
		$sno=$sno+1;
//		$_SESSION['current_cluster_id']=$cluster_id1;				
		echo "<tr height ='30'><td width='50'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $sno</td><td width='300'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $x</td><td width='300'><a href = 'farm_farmer.php?id=$cluster_id1'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $cluster_id1</a></td><td width = '50'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp $sol2</td></tr>";

	}
	echo "</table>";

	print "<li class='cat-item'><a href=\"obs.php\">Submit Observations</a></li>";
	
	print "<li class='cat-item'><a href=\"coord_adv_download.php\">Delivered Cluster Advices</a></li>";
	
	print "<li class='cat-item'><a href=\"coord_adv_download1.php\">Delivered Advices</a></li>";

	

}

include("footer.php");
?>
