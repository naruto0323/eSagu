<?php
include('dblayer.php');
include_once("header_new.php");
extract($_GET);

$_SESSION['mode'] = 'po';
$db=new sql_db();
$query=$db->sql_query("select ptnr_id from user_registration where user_id='$current_user_id'");
$ro=$db->sql_fetch_array();
$ptnr_id=$ro['ptnr_id'];
$x="partner_coordinator_ceo.php";
$_SESSION['ptnr_id']=$ptnr_id;
include($x);
?>
