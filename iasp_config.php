<?php

$command="/sbin/ifconfig eth1 | grep 'inet addr:' | cut -d: -f2 | awk '{print $1}'";
$ip=shell_exec($command);
//$ip="10.4.81.130";
$ip="192.168.36.147";
$ip=chop(trim($ip));


// if ip is not captured please enter the ip



$databank_path_1="http://$ip:8080/databank/Browser2.jsp";
$databank_path_2="http://$ip:8080/databank/Browser3.jsp";
$mobile_gis_path="http://172.16.19.137/esagugis/htdocs/esaguGIS_main.html";
$mobile_sms_path="http://172.16.19.139:8080/BlackBoxSMS_web/sendSMSAdvice.html";
$config_advices = "/var/www/html/esagu2008/advices/";
$config_pages = "/var/www/html/esagu2008/new_pages/";
$config_photos = "/var/www/html/esagu2008/photos/";

$config_uploads = "/var/www/html/";
$config_esagu2008_path = "/var/www/html/esagu2008/";
$config_photo_path = "/esagu2008/photos/";
// Used in project_statistics.php
//=================================
$server1 = $ip;
$username1 = "root";
$password1 = "";
$database1 = "esagu2008_horti";
$persistency1 = true;
$debug1 = false;
//===================================


############### Settings for Agri Server of eSagu ###############################
$__database_Server_agri = "localhost";
$__database_Name_agri = "esagu2008_agri";
$__database_User_agri = "cd";
$__database_Passwd_agri = "iiit123";
#################################################################################


############### Settings for Horti Server of eSagu ###############################
$__database_Server_horti = "localhost";
$__database_Name_horti = "esagu2008_horti";
$__database_User_horti = "cd";
$__database_Passwd_horti = "iiit123";
#################################################################################

$ipaddress= $server1;
$username = 'root';
$server_ip = $ipaddress;

if(!file_exists($config_photos))
	system("mkdir -p $config_photos");

$default_soil_photos_path='/var/www/html/esagu2008/soil_photos/' ;
if(!file_exists($default_soil_photos_path))
	system("mkdir -p $default_soil_photos_path");

$default_farmer_photos_path='/var/www/html/esagu2008/farmer_photos/' ;
if(!file_exists($default_farmer_photos_path))
	system("mkdir -p $default_farmer_photos_path");	

$default_coord_photos_path='/var/www/html/esagu2008/coord_photos/' ;
if(!file_exists($default_coord_photos_path))
	system("mkdir -p $default_coord_photos_path");

$default_emp_photos_path='/var/www/html/esagu2008/emp/photos/' ;
if(!file_exists($default_emp_photos_path))
	 system("mkdir -p $default_emp_photos_path");

$default_emp_cv_path='/var/www/html/esagu2008/emp/cv/' ;
if(!file_exists($default_emp_cv_path))
	system("mkdir -p $default_emp_cv_path");

$default_farmer_feedback_path='/var/www/html/esagu2008/feedback/' ;
if(!file_exists($default_farmer_feedback_path))
	system("mkdir -p $default_farmer_feedback_path");

$default_orch_reg_path='/var/www/html/esagu2008/orchard_registration/' ;
if(!file_exists($default_orch_reg_path))
	 system("mkdir -p $default_orch_reg_path");

$path = exec("pwd");

$common_path = "/root/cd_uploading_2008" ;
$common_path1 = "/root/cd_uploading_2008" ;
//$common_path1 = $path ;


$register_regl_cen="$common_path/cd_data_agri/RegionalCenterRegistration";
$register_ptnr="$common_path/cd_data_agri/PartnerRegistration";
$register_loc_cen="$common_path/cd_data_agri/LocalCenterRegistration";
$register_vil = "$common_path/cd_data_agri/VillageRegistration";
$register_coord="$common_path/cd_data_agri/CoordinatorRegistration";
$coord_photos="$common_path/cd_data_agri/CoordinatorRegistration/Photos/";
$register_farmer = "$common_path/cd_data_agri/Farmer_Registrations";
$farmer_photos="$common_path/cd_data_agri/Farmer_Registrations/Photos/";
$register_farm = "$common_path/cd_data_agri/FarmRegistration";
$farm_hist = "$common_path/cd_data_agri/FarmHistory";
$farm_dlst = "$common_path/cd_data_agri/FarmDelisting";
$dlst_feedback = "$common_path/cd_data_agri/FarmDelisting/Multimedia/";
$register_emp ="$common_path/cd_data_agri/PersonnelRegistration";
$emp_photos ="$common_path/cd_data_agri/PersonnelRegistration/Photos/";
$emp_cv ="$common_path/cd_data_agri/PersonnelRegistration/CVs/";
$weather_details="$common_path/cd_data_agri/WeatherInformation";
$observations = "$common_path/cd_data_agri/Crop_Observations";
$move_images = "$common_path/cd_data_agri/Crop_Photos/";
$soil_images = "$common_path/cd_data_agri/FarmSoil/Photos/";
$farm_sowing = "$common_path/cd_data_agri/FarmSowingRegistration";
$farm_soil = "$common_path/cd_data_agri/FarmSoil";
$coordinator_schedule ="$common_path/cd_data_agri/CoordinatorSchedule";
$coordinator_revised_schedule ="$common_path/cd_data_agri/CoordinatorRevisedSchedule";
$printout = "$common_path/cd_data_agri/PrintoutTaken";
$advice_delivery = "$common_path/cd_data_agri/AdviceDeliveryToFarmers";


$orch_registration="$common_path/cd_data_horti/OrchardRegistration";
$register_farmer_horti = "$common_path/cd_data_horti/Farmer_Registrations";
$farmer_photos_horti="$common_path/cd_data_horti/Farmer_Registrations/Photos/";
$register_coord_horti="$common_path/cd_data_horti/CoordinatorRegistration";
$coord_photos_horti="$common_path/cd_data_horti/CoordinatorRegistration/Photos/";
$orch_reg_photos ="$common_path/cd_data_horti/OrchardRegistration/Photos/";
$var_leaf_info="$common_path/cd_data_horti/OrchardVarietyWiseLeafAnalysis";
$farm_dlst_horti="$common_path/cd_data_horti/OrchardDelisting";
$observations_horti = "$common_path/cd_data_horti/Crop_Observations";
$move_images_horti = "$common_path/cd_data_horti/Crop_Photos/";
$register_vil_horti = "$common_path/cd_data_horti/VillageRegistration";


//********************** SUBAHAN **********************************


$upload_dir_cord_photos = "/var/www/html/esagu2012/Cordinator_Photos/";
if(!file_exists($upload_dir_cord_photos))
        system("mkdir -p $upload_dir_cord_photos");

$upload_dir_expert_photos = "/var/www/html/esagu2012/Expert_Photos/";
if(!file_exists($upload_dir_expert_photos))
        system("mkdir -p $upload_dir_expert_photos");

$upload_dir_farmer_photos = "/var/www/html/esagu2012/Farmer_Photos/";
if(!file_exists($upload_dir_farmer_photos)) {
        system("mkdir -p $upload_dir_farmer_photos");
}

$upload_observation_photos = "/var/www/html/esagu2012/photos";
if(!file_exists($upload_observation_photos)){
	system("mkdir -p $upload_observation_photos" , $retval);
}

$upload_advices = "/var/www/html/esagu2012/advices/";
if(!file_exists($upload_advices)){
	system("mkdir -p $upload_advices" , $retval);
}
//****************************************************************


#  Sushanta 
#FarmSoil.php
$default_FarmSoil_photograph_path='/var/www/html/esagu2012/Photos/Agri/';
if(!file_exists($default_FarmSoil_photograph_path))
        system("mkdir -p $default_FarmSoil_photograph_path");


//****************************************************************

#grant all privileges on esagu2007_agri.* to 'cd'@'%' identified by 'iiit123';
#grant all privileges on esagu2007_horti.* to 'cd'@'%' identified by 'iiit123';


/*function is_local_machine()
{
	global $ipaddress ;
	$command="/sbin/ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{print $1}'";
	$ip=shell_exec($command);
	$ip=chop(trim($ip));

	if($ip==$ipaddress)
		return 1;
	else
		return 0;

}*/
?>
