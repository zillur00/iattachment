<?php
require_once("config/rmns_config.php");
require_once("function/database.php"); 



function getApplicationInfo($tracking_id=null,$user_level=null){
$return=false;
//global $power_plants_t;
//echo "hello";die();
$db=connectDB(); 
$sql = "select a.*,b.* from ia_status a,ia_industrial b where a.id=b.status_id and  1=1";

/*if(! is_null($user_level)){
	if($user_level=="HR_REVIEW")
	{
		$sql.="  and  (a.status_name='REVIEW_PENDING' or  a.status_name='SUBMITTED')";
	}
}*/

if(! is_null($tracking_id))
{
	$sql.=" and tracking_id='$tracking_id'";
}
//echo $sql;die();
if(!$result=$db->query($sql))
	{
		
		die("Database Error".$db->error);
		
	}
	
	$application_info=array();
	if($result->num_rows > 0){
	while($get_info=$result->fetch_assoc()){
		$application_info[]=$get_info;
		/*$application_info[]["tracking_id"]=$get_info["tracking_id"];
		$application_info[]["status_name"]=$get_info["status_name"];
		$application_info[]["status_desc"]=$get_info["status_desc"];
		$application_info[]["reason"]=$get_info["reason"];
		$application_info[]["remark"]=$get_info["remark"];
		$application_info[]["submission_time"]=$get_info["submission_time"];*/
	}
	
	//var_dump($application_info);
	$return=$application_info;
	
	
	}
	else
	{
		$return=false;;
	}
	//$get_info=$result->fetch_assoc();

	
closeDB($db);
//return  $plant_info; 
return $return;
	
}


function updateStatus($tracking_id,$new_status,$reason=null,$remark=null){
$return=false;
//global $power_plants_t;
//echo "hello";die();
$db=connectDB(); 

$reason=is_null($reason)?'':$reason;
$remark=is_null($remark)?'':$remark;

$sql="update ia_industrial set status_id=( select id from ia_status where status_name='$new_status'),reason='$reason',remark='$remark' where   tracking_id='$tracking_id'";


	if(!$result=$db->query($sql))
	{
		
		die("Database Error".$db->error);
		
	}
	
	//var_dump($application_info);
	$return=$db->insert_id;
	
	
	
	
closeDB($db);
//return  $plant_info; 
return $return;
	
}

function authenticateUser($user_email,$user_pass)
{
$return=false;	
$db=connectDB(); 
$sql = "select * from ia_users  where user_email='$user_email' and user_pass='$user_pass'";
if(!$result=$db->query($sql))
	{
		die("Database Error".$db->error);
	}
	
	$info=array();
	if($result->num_rows > 0){
		$info=$result->fetch_assoc();
	    return $info;
	}

return $return;	
}
// page access according role
function authenticateUserToAccessPage($user_email,$page_name)
{
$return=false;	
$db=connectDB(); 
$sql = "SELECT b.role_id  FROM `ia_users` a, ia_user_role b where a.id=b.user_id and a.user_email='$user_email'";
if(!$result=$db->query($sql))
	{
		die("Database Error".$db->error);
	}
	
	$user_role=array();
	if($result->num_rows > 0){
		while($get_info=$result->fetch_assoc()){
		  $user_role[]=$get_info["role_id"];		
	}
	}
	
	var_dump($user_role);
	
	$sql = "SELECT b.role_id  FROM `ia_pages` a, ia_page_role b where a.id=b.page_id and a.page_name='$page_name'";
	if(!$result=$db->query($sql))
	{
		die("Database Error".$db->error);
	}
	$page_role=array();
	if($result->num_rows > 0){
		while($get_info=$result->fetch_assoc()){
		  $page_role[]=$get_info["role_id"];		
	}
	}
	
	var_dump($page_role);
	
	for($i=0;$i<count($user_role);$i++){
		if(in_array($user_role[$i],$page_role)){
			return true;
		}
	}



return $return;	
}
?>
