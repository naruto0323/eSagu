<?php
// To include permissions
include_once("header_new.php");
include_once("dblayer.php");

$farmer_id1=get_farmer_id($current_user_id);
echo $farmer_id1;
if( $farmer_id1!=null || $_SESSION['permission'] == 'true'){
extract($_GET);
$farmer_id = $_SESSION['current_farmer_id'];
$db=new sql_db();
$query=$db->sql_query("select * from farmer where farmer_id='$farmer_id1'"); //$query=> details of farmer	


echo "<font align='left' size='6' color='green'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp DETAILS OF FARMER </font>";



$sno=0;
print "<table border = 5px cellpadding=100><tr>";
echo "<td width = 5% height = '60'><b>S.No.</b></td><td width = 15%><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspName </b></td><td width = 20%><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspFarmer ID</b></td><td width = 15%><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspVillage ID</b></td><td width = 15%><b>Registration Date</b></td><td width = 20%><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMobile no</b></td><td width = 20%><b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspService</b></td></tr>";
$row = $db->sql_fetch_array();
$name=$row['name'];
$farmer_id=$row['farmer_id'];
$village_id=$row['vil_id'];
$regn_date=$row['regn_date'];
$mob_no=$row['mob_phn'];
$service=$row['service'];

$sno=$sno+1;
if($service=='2')
$ser="Regular Level";
else
$ser="One Time";

echo "<tr height ='30'><td>$sno</td><td>$name</td><td>$farmer_id</td><td>$village_id</td><td>$regn_date</td><td>$mob_no</td><td>$ser</td></tr></table>";
 
 print "<li class='cat-item'><a href=\"farmer_adv_download.php\">Delivered Advices</a></li>";

}
include("footer.php");
?>
