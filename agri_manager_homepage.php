<?php
include("header_new.php");
print"<p class='mid'>";
include_once("dblayer.php");
import_request_variables( "PG" );
echo $_SESSION['mode'];
?>
<html>
<head> 
<script type='text/javascript'>


function ChangeOptionSer(val)
{
        var service=val.value;
	var url=location.href;
	var newurl="agri_manager_homepage.php?service="+service;
	location.href=newurl;
}

function ChangeOptioncrop(val)
{

         var crop=val.value;
	 var url = location.href
	 var service = url.slice(url.search(/service/));
	 var serv = document.getElementById('service').options[document.getElementById('service').selectedIndex].value;
	 var index = url.indexOf('service=');
	 if(index != -1)
	 {         
		var newurl="agri_manager_homepage.php?service="+ serv + "&crop="+ crop;
		location.href=newurl;
	}
}

function ChangeOptioncrop_rev(val)
{

         var crop=val.value;
	 var url = location.href
	 var service = url.slice(url.search(/service/));
	 var serv = document.getElementById('service').options[document.getElementById('service').selectedIndex].value;
	 var index = url.indexOf('service=');
	 if(index != -1)
	 {         
		var newurl="agri_manager_homepage.php?service="+ serv + "&crop="+ crop;
		location.href=newurl;
	}
}



</script>
</head>
<body> 

<?php
if($_SESSION['mode']=='am')
{        
		if($_GET['service'])
		{	
			echo $_GET['service'];
			echo "\n";
		}

?> 
	<tr>
	<td   width="300"> <center><br/> Select Service <font color=red></font> : </td>
	<td> 
	<?php 

		$ser=array('Regular','Village Level','One Time');
		echo "<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<select name='service' id='service' onchange='ChangeOptionSer(this)'>";
		echo "<option >--------Select--------</option>";
		foreach ($ser as $key)
		{
			if($_GET['service'])
			{
				if($_GET['service']==$key)
					print "<option selected > $key </option>";
				else
					print "<option> $key </option>";
			}
			else
				print "<option> $key </option>";
		}
	echo "</select></td>"; 
	
	?>
</center>
</tr>

<tr>
<td  width="300"> <br/><center> Crops <font color=red></font> : </td>
<td> 

<?php 

print "<select name ='crop' id='crop' onchange='ChangeOptioncrop(this)'>";
print "<option selected> None </option>"; 
if($_GET['service'])
{  
	
	if($_GET['service']=='Regular')
		$serv='1';
	else if($_GET['service']=='Village Level')
		$serv='3';
	else if($_GET['service']=='One Time')
		$serv='2';

	echo $serv;
	$db = new sql_db();
	$crop1 = array();
	$query = "select distinct(o.original_crop_name) from observation as o,farmer as f where o.status='0' or o.status='2' and o.active_status='' and o.farmer_id=f.farmer_id and f.service=$serv and o.observation_id not in (select obs_id from observation_allocation where active=1) ";
	$result = $db->sql_query($query);
	while($result = $db->sql_fetch_array())
		$crop1[] = $result['original_crop_name'];
	$counter=1;
	foreach($crop1 as $key)
	{
			if($_GET['crop'])
			{
		 		if( $_GET['crop'] == $key )
					print "<option selected> $key </option>";
				else
					print "<option> $key </option>";
			}
			else
				print "<option> $key </option>";
			
			$counter++;
	}
	print "</select>";
}

if($_GET['crop'])
{

	$db = new sql_db();
	$query= "select o.original_crop_name,count(*) from observation as o,farmer as f where o.status='0' and o.active_status='' and o.farmer_id=f.farmer_id and f.service='$serv' and o.observation_id not in(select obs_id from observation_allocation where active=1)";
	$db->sql_query( $query );
	$rows = $db->sql_fetch_row_set();
	print " </br> </br>
		<table cellpadding='5' cellspacing='5'>
		<tr>
		<td>
		<b >Pending Observations</b> </td>
		</tr>";

	 foreach( $rows as $row )
	 {
		                    $crop_name = $row[0];
				    $db1=new sql_db();
				    $qq="select crop_type from CropCode_CropName where original_crop_name='$crop_name'";
				    $db1->sql_query($qq);
				    $ress=$db1->sql_fetch_array();
				    if ( $ress['crop_type']=='agri' || $ress['crop_type']=='horti')
				    {
				    	print "<tr>
					<td >".$row[0]."</td>";
					print " <td ><a href='experts_list.php?crop_name=$crop_name & service=$serv'>" . $row[1] . "</a></td> 	                                    	</tr>\n";
				    }
	}

	print "</table>"; 
	
	$db = new sql_db();
	$query= "select o.original_crop_name,count(*) from observation as o,farmer as f where o.status='2' and o.farmer_id=f.farmer_id and f.service='$serv'";
	$db->sql_query( $query );
	$rows = $db->sql_fetch_row_set();
	print " </br> </br>
		<table cellpadding='5' cellspacing='5' >
		<tr>
		<td>
		<b >Observations to Super_expert</b> </td>
		</tr>\n";

	 foreach( $rows as $row )
	 {
		                    $crop_name = $row[0];
				    $db1=new sql_db();
				    $qq="select crop_type from CropCode_CropName where original_crop_name='$crop_name'";
				    $db1->sql_query($qq);
				    $ress=$db1->sql_fetch_array();
				    if ( $ress['crop_type']=='agri' || $ress['crop_type']=='horti')
				    {
				    	print "<tr>
					<td >".$row[0]."</td>";
					print " <td ><a href='super_expert_list.php?crop_name=$crop_name &service=$serv'>" . $row[1] . "</a></td> 	                                    	</tr>\n";
				    }
	}

	print "</table>"; 
	if($serv=='3')
	{	
	
	$db = new sql_db();
	$query= "select o.original_crop_name,count(*) from observation as o,farmer as f where o.status='4' and o.farmer_id=f.farmer_id and f.service='$serv'";
	$db->sql_query( $query );
	$rows = $db->sql_fetch_row_set();
	print " </br> </br>
		<table cellpadding='5' cellspacing='5' >
		<tr>
		<td>
		<b >Observations to Cluster_expert</b> </td>
		</tr>\n";

	 foreach( $rows as $row )
	 {
		                    $crop_name = $row[0];
				    $db1=new sql_db();
				    $qq="select crop_type from CropCode_CropName where original_crop_name='$crop_name'";
				    $db1->sql_query($qq);
				    $ress=$db1->sql_fetch_array();
				    if ( $ress['crop_type']=='agri' || $ress['crop_type']=='horti')
				    {
				    	print "<tr>
					<td >".$row[0]."</td>";
					print " <td ><a href='cluster_expert_list.php?crop_name=$crop_name &service=$serv'>" . $row[1] . "</a></td> 	                                    	</tr>\n";
				    }
	}

	print "</table>"; 
		

	}




} 
/*
print "<input type = 'hidden' id = 'ff' name = 'ser' value = ".$ser." />";
*/

?>

</tr>
</center>

	<?php
	include("footer.php");
 }
else 
{
	print "You don't have permission to access this page";
	print "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3; URL=\"index.php\">";
}

?>
</body>
</html>
