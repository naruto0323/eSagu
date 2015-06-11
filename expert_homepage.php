<?php
include("header_expert.php");
$db=new sql_db();
extract($_POST);
extract($_GET);
/*
   $login_code=rand(1000000000,9999999999);
   $db1=new sql_db();

   if(check_user_code_login($current_user_id)==1)
   {
   $ran_qu_1="insert into crnt_user_code values('$current_user_id','$login_code')";
   $db1->sql_query($ran_qu_1);
   }
 */
$expert_id = $_SESSION['user_id'];
if($_SESSION['mode']=='ase')
{
	//pending
	$query="select count(*) as cnt from advice where status=1 and expert_id='$expert_id'";
	$result=$db->sql_query($query);
	$row=$db->sql_fetch_array();
	$esagu_pending=$row['cnt'];
     
	//ques and pending
	/*$query="select count(*) as cnt from ques_details where ques_stat=1 and expert_id='$expert_id'";
	$result=$db->sql_query($query);
	$row=$db->sql_fetch_array();
	$ques_ans_pending=$row['cnt'];*/

	//one time peding
	/*$query="select count(*) as cnt from advice where status=1 and expert_id='$expert_id'";
	$result=$db->sql_query($query);
	$row=$db->sql_fetch_array();
	$one_time_pending=$row['cnt'];
*/
}
else
{
	$query="select count(*) as cnt from observation as v,observation_allocation as vo,farmer as f where v.observation_id=vo.obs_id and vo.active=1 and vo.expert_id='$expert_id' and f.farmer_id=v.farmer_id and f.service=3";
	$result=$db->sql_query($query);
	$row=$db->sql_fetch_array();
	$vesagu_pending=$row['cnt'];

	$query="select count(*) as cnt from observation as v,observation_allocation as vo,farmer as f where v.observation_id=vo.obs_id and vo.active=1 and vo.expert_id='$expert_id' and f.farmer_id=v.farmer_id and f.service=1";
	$result=$db->sql_query($query);
	$row=$db->sql_fetch_array();
	$esagu_pending=$row['cnt'];
	
	/*$query="select count(*) as cnt from ques_details where ques_stat!=1;
	$result=$db->sql_query($query);
	$row=$db->sql_fetch_array();
	$ques_ans_pending=$row['cnt'];*/

	$query="select count(*) as cnt from observation as v,observation_allocation as vo,farmer as f where v.observation_id=vo.obs_id and vo.active=1 and vo.expert_id='$expert_id' and f.farmer_id=v.farmer_id and f.service=2";
	$result=$db->sql_query($query);
	$row=$db->sql_fetch_array();
	$one_time_pending=$row['cnt'];
}
?>



<html>
<body>
<center>
<table border=0 cellspacing='5'>
<?php

if($_SESSION['mode']=='sae' || ($_SESSION['mode']=='ae') || 
		($_SESSION['mode']=='she') || ($_SESSION['mode']=='he') || ($_SESSION['mode']=='aje') || ($_SESSION['mode']=='aco'))
{
	echo "<h2>Pending:</h2>";
	print "<tr>";
	print "<td>Village level eSagu: </td><td><a href='pending_observations.php?service=3'>".$vesagu_pending."</a></td>";
	print "</tr>";
	print "<tr>";
	
	print "<td>Regular eSagu: </td><td><a href='pending_observations.php?service=1'>".$esagu_pending."</a></td>";
	//print "<td>Regular eSagu: </td><td><b>".$esagu_pending."</b></td>";
	print "</tr>";
	/*print "<tr>";
	print "<td>Question Answering System: </td><td><b>".$ques_ans_pending."</b></td>";
	print "</tr>";*/
	print "<tr>";
	print "<td>One Time: </td> <td> <a href='pending_observations.php?service=2 '>".$one_time_pending."</a></td>";
	//print "<td>One Time: </td><td><b>".$one_time_pending."</b></td>";
	print "</tr>";
}
?>
</table>
</center>
</body>
</html>	
