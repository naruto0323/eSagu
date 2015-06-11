<?php
include_once("dblayer.php");

function chk_regn_cen($reg)
{	
       	$db = new sql_db();	
	$query = "select count(*) as count from regl_cen where regl_cen_id = '$reg'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function chk_ptnr($ptr)
{
       	$db = new sql_db();	
	$query = "select count(*) as count from ptnr where ptnr_id = '$ptr'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function chk_loc_cen($loc)
{
       	$db = new sql_db();	
	$query = "select count(*) as count from loc_cen where loc_cen_id = '$loc'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function chk_vil($vil)
{
       	$db = new sql_db();	
	$query = "select count(*) as count from v_village where vil_id = '$vil'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function chk_cord($cord)
{
       	$db = new sql_db();	
	$query = "select count(*) as count from cord where cord_id = '$cord'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function chk_farmer($farmer)
{
       	$db = new sql_db();	
	$query = "select count(*) as count from farmer where farmer_id = '$farmer'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function chk_user($user_id)
{
	$db = new sql_db();
	$query = "select count(*) as count from user_registration where user_id = '$user_id'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}

function chk_dist($dist_id){

  $db = new sql_db();
  $query = "select count(*) as count from DISTRICT  where district_id = '$dist_id'";
  $result = $db->sql_query($query);
  $row = $db->sql_fetch_array();
   return $row['count'];
  
   }

 function chk_mandal($mandal_id){

 $db = new sql_db();
 $query = "select count(*) as count from MANDAL where mandal_id = '$mandal_id'";
 $result = $db->sql_query($query);
 $row = $db->sql_fetch_array();
 return $row['count'];
 
  }

  function chk_village($village_id){

  $db = new sql_db();
  $query = "select count(*) as count from VILLAGE where village_id = '$village_id'";
  $result = $db->sql_query($query);
  $row = $db->sql_fetch_array();
  return $row['count'];

  }

 // added by trinath
  function chk_register_village($village_id){

  $db = new sql_db();
  $query = "select count(*) as count from v_village where vil_id = '$village_id'";
  $result = $db->sql_query($query);
  $row = $db->sql_fetch_array();
  return $row['count'];

  }


function chk_farm($farm_id){

	$db = new sql_db();
	$query = "select count(*) as count from farm where farm_id ='$farm_id'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];

}
function chk_farm_status($farm_id){
            $db = new sql_db();
            $query = "select status from farm where farm_id ='$farm_id'";
            $result = $db->sql_query($query);
            $row = $db->sql_fetch_array();
            return $row['status'];
}


function chk_farm_hist($farm_id){

	$db = new sql_db();
	$query = "select count(*) as count from farm_hist where farm_id ='$farm_id'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['count'];
}


function chk_farm_main_info($farm_id){

            $db = new sql_db();
            $query = "select count(*) as count from farm_sow_main_info where farm_id ='$farm_id'";
            $result = $db->sql_query($query);
            $row = $db->sql_fetch_array();
            return $row['count'];
             }

function chk_farm_soil($farm_id){
            $db = new sql_db();
            $query = "select count(*) as count from farm_soil where farm_id ='$farm_id'";
            $result = $db->sql_query($query);
            $row = $db->sql_fetch_array();
            return $row['count'];
              }

function chk_orch($orch_id){
            $db = new sql_db();
	    $query = "select count(*) as count from orch where orch_id ='$orch_id'";
            $result = $db->sql_query($query);
            $row = $db->sql_fetch_array();
            return $row['count'];
}
function chk_orch_status($orch_id){
	$db = new sql_db();
	$query = "select status from orch where orch_id ='$orch_id'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['status'];
}


function chk_orch_hist($orch_id){
           $db = new sql_db();
           $query = "select count(*) as count from orch_hist_season where orch_id ='$orch_id'";
           $result = $db->sql_query($query);
           $row = $db->sql_fetch_array();
           return $row['count'];
          }

function chk_orch_soil($orch_id){
           $db = new sql_db();
           $query = "select count(*) as count from orch_soil_info where orch_id ='$orch_id'";
           $result = $db->sql_query($query);
           $row = $db->sql_fetch_array();
           return $row['count'];
          }

function chk_orch_leaf_anly($orch_id){
           $db = new sql_db();
           $query = "select count(*) as count from orch_leaf_analysis where orch_id ='$orch_id'";
           $result = $db->sql_query($query);
           $row = $db->sql_fetch_array();
           return $row['count'];
           }

function chk_orch_watr_info($orch_id){
           $db = new sql_db();
           $query = "select count(*) as count from orch_watr_info where orch_id ='$orch_id'";
           $result = $db->sql_query($query);
           $row = $db->sql_fetch_array();
           return $row['count'];
          }


function chk_orch_nutr($orch_id){
           $db = new sql_db();
           $query = "select count(*) as count from orch_nutr_details where orch_id ='$orch_id'";
           $result = $db->sql_query($query);
           $row = $db->sql_fetch_array();
           return $row['count'];
           }

function chk_bank_status($bid){
	$db = new sql_db();
	$query = "select status from bank_info where bank_id ='$bid'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['status'];
}

function chk_vendor_status($vid){
	$db = new sql_db();
	$query = "select status from vendor_info where vend_id ='$vid'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['status'];
}

function chk_supplier_status($sid){
	$db = new sql_db();
	$query = "select status from supplier_info where supp_id ='$sid'";
	$result = $db->sql_query($query);
	$row = $db->sql_fetch_array();
	return $row['status'];
}

?>
