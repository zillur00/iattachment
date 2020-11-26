<?php 
session_start();
require_once("function/ia_general_fn.php");


$user_email=$_POST['email'];
$user_pass=$_POST['password'];

if(!authenticateUser($user_email,$user_pass)){
$message="Wrong Username/Password";
header("Location:login.php?login=$message");
}
else{
	$_SESSION["login"]=$user_email;
	header("Location:hr-dashboard.php");
}


/*$user_login=$_POST["user_login"];
		  $user_pass=$_POST["user_pass"];
		  $return=authenticateUser($user_login,$user_pass);
	      if($return===true){
		  $response["status"]=true;	  
		  $_SESSION["login"]=true;
		  $_SESSION["user_login"]=$user_login;
		  
		  
	      $response["redirect_url"]="index.php";
		 // header("location:index.php");
	//exit();
	      }
		  else{
			  $response["status"]=false;
		  }*/
?>