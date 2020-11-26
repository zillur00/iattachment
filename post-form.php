<?php
require_once("config/rmns_config.php");
require_once("function/ia_general_fn.php");
require_once("function/database.php");
$time=date('Y-m-d H:i:s');
//$raw_data = file_get_contents("php://input");
//$raw_data='{"phone":"11111","name":"polas","rating":23}';


//////////isert attachment


function insertIattachment($coursename,$uniname,$email,$plantname,$contactno,$address,$noofparticipant,$file,$applicantname){
$return=false;
//global $power_plants_t;
//echo "hello";die();
$db=connectDB(); 
$coursename       =$db->escape_string($coursename);
$uniname         =$db->escape_string($uniname);
$email           =$db->escape_string($email);
$plantname       =$db->escape_string($plantname);
$contactno       =$db->escape_string($contactno);
$address         =$db->escape_string($address);
$noofparticipant =$db->escape_string($noofparticipant);
$file           =$db->escape_string($file);
$sql = "insert into ia_industrial(coursename,uniname,email,plantname,contactno,address,noofparticipant,file,applicant_name) values
('$coursename','$uniname','$email','$plantname','$contactno','$address','$noofparticipant','$file','$applicantname');";

//echo $sql;die();
if(!$result=$db->query($sql))
	{
		
		die("Database Error".$db->error);
		
	}
else{
	
	$insert_id=$db->insert_id;  
	$tracking_id='T'.date('YmdHis').str_pad($db->insert_id,6,'0',STR_PAD_LEFT);
	 $sql1="update ia_industrial set tracking_id='$tracking_id' where id='".$db->insert_id."'";
	 
	 if(!$result=$db->query($sql1))
	{
		
		die("Database Error".$db->error);
		
	}
	
	$sql1="update ia_industrial set status_id=( select id from ia_status where status_name='SUBMITTED') where   tracking_id='$tracking_id'";
	if(!$result=$db->query($sql1))
	{
		
		die("Database Error".$db->error);
		
	}
	
	
	$return=$tracking_id;
}	
closeDB($db);
//return  $plant_info; 
return $return;
	
}

//
function checkStatus($trackingid){
$return=false;
//global $power_plants_t;
//echo "hello";die();
$db=connectDB(); 
$trackingid       =$db->escape_string($trackingid);
$sql = "select a.status_name,a.status_desc,b.reason,b.remark,b.submission_time from ia_status a,ia_industrial b where a.id=b.status_id and  b.tracking_id='$trackingid'";

//echo $sql;die();
if(!$result=$db->query($sql))
	{
		
		die("Database Error".$db->error);
		
	}
	
	if($result->num_rows > 0){
	$get_info=$result->fetch_assoc();
	$status_name=$get_info["status_name"];
	$status_desc=$get_info["status_desc"];
	$reason=$get_info["reason"];
	$remark=$get_info["remark"];
	$submission_time=$get_info["submission_time"];
	//$return=$status_info;
	
	$return='<table class="table table-striped">';
	//$return.='<tr>';
	$return.='<thead><tr><th scope="col">Tracking ID</th><th scope="col">Submission Time</th><th scope="col">Status</th><th scope="col">Reason</th><th scope="col">Remark</th></tr></thead>';
	$return.='<tbody><tr><td>'.$trackingid.'</td><td>'.$submission_time.'</td><td>'.$status_name.'</td><td>'.$reason.'</td><td>'.$remark.'</td></tr></tbody>';
	$return.='</table>';
	
	}
	else
	{
		$return='<div><p><font color="red">Tracking ID is not found in the system.</font></p></div>';
	}
	//$get_info=$result->fetch_assoc();

	
closeDB($db);
//return  $plant_info; 
return $return;
	
}

function makeProgressBar($trackingid){
$return=false;
//global $power_plants_t;
//echo "hello";die();
$db=connectDB(); 
$trackingid       =$db->escape_string($trackingid);
$sql = "select a.status_name,a.status_desc,b.reason,b.remark,b.submission_time from ia_status a,ia_industrial b where a.id=b.status_id and  b.tracking_id='$trackingid'";

//echo $sql;die();
if(!$result=$db->query($sql))
	{
		
		die("Database Error".$db->error);
		
	}
	
	if($result->num_rows > 0){
	$get_info=$result->fetch_assoc();
	$status_name=$get_info["status_name"];
	$status_desc=$get_info["status_desc"];
	$reason=$get_info["reason"];
	$remark=$get_info["remark"];
	$submission_time=$get_info["submission_time"];
	//$return=$status_info;
	
	$progress=meauserProgress($status_name);
	$return='<div class="progress" style="height: 30px;" id="progress" >';
	 
	$return.='<div class="progress-bar bg-success" id="progressbar" role="progressbar" style="width: '.$progress.'%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$progress.'%</div>';
	$return.='</div>'; 
	//$return.='<tr>';
	
	}
	else
	{
		$return='';
	}
	//$get_info=$result->fetch_assoc();

	
closeDB($db);
//return  $plant_info; 
return $return;
	
}

// percentage of progress
function meauserProgress($status_name){
	if($status_name=="SUBMITTED")
		return 10;
	elseif($status_name=="REVIEW_PENDING")
		return 20;
	elseif($status_name=="RECOMMENDED")
		return 60;
	elseif($status_name=="APPROVAL_PENDING")
		return 70;
    elseif($status_name=="APPROVED")
		return 100;
   else 
       return 0;	   
		
		
	
	
	
}

function uploadAttachment(){
	
	
$file_time=date('YmdHis');
$ok_file=0;
$target_file = "../data/attachments/";
$file_name=$_FILES['file']['name'];
$base_name=basename( $_FILES['file']['name']);

//$target_table = $login_id."_g";
$target_file = $target_file."_".$base_name; 
$file_uploaded_type=$_FILES["file"]["type"];
$file_size=$_FILES["file"]["size"] / 1024;
$file_size=$file_size / 1024;

$tmp_name=$_FILES['file']['tmp_name'];
//echo "Base Name: $base_name,$file_uploaded_type.,$file_size,$target_file,$tmp_name.";

if((strpos($base_name,".pdf")!==false) ) {
    //echo "CSV/TXT file allowed. File Type:". $file_uploaded_type;
	$ok_file=1;	
}

if ($ok_file==1)
{
 if(move_uploaded_file($_FILES['cont_file']['tmp_name'], $target_file))
 {
	 
 }
 else{
	 
	 echo "file upload error";
 }
 
}
else{
	
	echo "Filetype is not correct";
}
	
}


//html/textResponse
function giveResponse($response){
	die($response);

}

//JSON Response
function jsonResponse($response){
	header('Content-Type: application/json');
	echo json_encode($response);
	die();
}

// Main Progam Coding Start Here
// 


 //echo "success";
//$a=[];
//isset($_REQUEST["operation"])?$operation=$_POST["operation"]:giveResponse("No operation is found");

$operation=$_REQUEST["operation"];
//echo $operation;exit();



switch($operation){
	
	  
	
		
	
	case "insert_industrial" :
	     // echo "success";exit();
	    //   echo "hello";die();
		  
			$file_time=date('YmdHis');
			$ok_file=0;
			$target_file = "data/attachments/";
			$file_name=$_FILES['file']['name'];
			$base_name=basename( $_FILES['file']['name']);
			
			//$target_table = $login_id."_g";
			$target_file = $target_file.$base_name; 
			$file_uploaded_type=$_FILES["file"]["type"];
			$file_size=$_FILES["file"]["size"] / 1024;
			$file_size=$file_size / 1024;
			
			$tmp_name=$_FILES['file']['tmp_name'];
			//echo "Base Name: $base_name,$file_uploaded_type.,$file_size,$target_file,$tmp_name.";
			
			if((strpos($base_name,".pdf")!==false) ) {
				//echo "CSV/TXT file allowed. File Type:". $file_uploaded_type;
				$ok_file=1;	
			}
			
			if ($ok_file==1)
			{
			if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file))
			{
				
			}
			else{
				
				echo "file upload error";
			}
			
			}
			else{
				
				echo "Filetype is not correct";
			}
		  
		  $coursename=$_REQUEST["coursename"];
		  $uniname=$_REQUEST["uniname"];
		 // echo $coursename;die();	  
		  $email=$_REQUEST["email"];
		  $plantname=$_REQUEST["plantname"];
		  $contactno=$_REQUEST["contactno"];
		  $address=$_REQUEST["address"];
		  $noofparticipant=$_REQUEST["noofparticipant"];
		  $applicantname=$_REQUEST["applicantname"];
		 // $file=$_REQUEST["file"];
		  
		 // echo $noofparticipient;die();
		   $return=insertIattachment($coursename,$uniname,$email,$plantname,$contactno,$address,$noofparticipant,$target_file,$applicantname);
	     
		// echo $return;
		 if($return !== FALSE){
		  $response="Data successfully inserted";
		  $tracking_id=$return; 
		  header("Location:submission-redirect.php?success=1&tracking_id=$tracking_id");
		  exit;
	      }
		 else{
		 $response="Data insertion error";
		 header('Location:submission_redirect.php?success=0');	  
		 exit;
		 }
		  //var_dump($response);
	      //giveResponse($response);
	break;	
	case "check_status":
	$trackingid=$_REQUEST["trackingid"];
	 $return=checkStatus($trackingid);
	 
	 
	     
		// echo $return;
		 if($return !== FALSE){
		  $response=$return;
	      }
		 else{
		 $response="System Error. Please try again";
		 //header('Location:submission_redirect.php?success=0');	  
		 //exit;
		 }
		 giveResponse($response);
	
	break;
	case "make_progress_bar":
	$trackingid=$_REQUEST["trackingid"];
	 $return=makeProgressBar($trackingid);
	 
	 
	     
		// echo $return;
		 if($return !== FALSE){
		  $response=$return;
	      }
		 else{
		 $response="System Error. Please try again";
		 //header('Location:submission_redirect.php?success=0');	  
		 //exit;
		 }
		 giveResponse($response);
	
	break;
	case "update_status_hr":
	
	 $tracking_id=$_POST["tracking-id"];
	 $status=$_POST["status"];
	//$status="recommend";
	//$tracking_id="null";
	if($status=="RECOMMENDED"){
		
		
		if(! $insert_id=updateStatus($tracking_id,"RECOMMENDED"))
		{
			
			
		  $response["status"]=true;
	      $response["message"]="Status Changed Successfully";
	      $response["insert-id"]=$insert_id;
	      
		  //$response["xkey"]='consumption_date';
		//	header("Location:hr-dashboard.php?redirectfrom=hr-review&insert-id=$insert_id");
		//	exit;
		}
		else{
			
		  $response["status"]=false;
	      $response["message"]="System Error";

		}
		
		//updateStatus();
		
			
	}
	elseif($status=="REJECTED"){
		$reason=$_POST["reason"];
		$remark=$_POST["remark"];
		
		if(! $insert_id=updateStatus($tracking_id,"REJECTED",$reason,$remark))
		{
			
			
		  $response["status"]=true;
	      $response["message"]="Status Changed Successfully";
	      $response["insert-id"]=$insert_id;
	      
		  //$response["xkey"]='consumption_date';
		//	header("Location:hr-dashboard.php?redirectfrom=hr-review&insert-id=$insert_id");
		//	exit;
		}
		else{
			
		  $response["status"]=false;
	      $response["message"]="System Error";

		}
		
		
		
		
	}
	else{
		$response["status"]=false;
		$response["message"]="No action found";
	}
	jsonResponse($response);	

	
	break;
	case "update_status_md_office":
	
	 $tracking_id=$_POST["tracking-id"];
	 $status=$_POST["status"];
	//$status="recommend";
	//$tracking_id="null";
	if($status=="APPROVED"){
		
		
		if(! $insert_id=updateStatus($tracking_id,"APPROVED"))
		{
			
			
		  $response["status"]=true;
	      $response["message"]="Status Changed Successfully";
	      $response["insert-id"]=$insert_id;
	      
		  //$response["xkey"]='consumption_date';
		//	header("Location:hr-dashboard.php?redirectfrom=hr-review&insert-id=$insert_id");
		//	exit;
		}
		else{
			
		  $response["status"]=false;
	      $response["message"]="System Error";

		}
		
		//updateStatus();
		
			
	}
	elseif($status=="NOT APPROVED"){
		$reason=$_POST["reason"];
		$remark=$_POST["remark"];
		
		if(! $insert_id=updateStatus($tracking_id,$status,$reason,$remark))
		{
			
			
		  $response["status"]=true;
	      $response["message"]="Status Changed Successfully";
	      $response["insert-id"]=$insert_id;
	      
		  //$response["xkey"]='consumption_date';
		//	header("Location:hr-dashboard.php?redirectfrom=hr-review&insert-id=$insert_id");
		//	exit;
		}
		else{
			
		  $response["status"]=false;
	      $response["message"]="System Error";

		}
		
		
		
	}
	else{
		$response["status"]=false;
		$response["message"]="No action found";
	}
	jsonResponse($response);	

	
	break;
	default: break;	
} 
?>
