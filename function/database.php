<?php
function begin()
{
global $db_link;
$db_link->autocommit(FALSE);;
}

function commit()
{	
global $db_link;
$db_link->commit(); 
}
function rollback()
{
global $db_link;
$db_link->rollback();
}


// Open an DB connection
function connectDB($db_host=null,$db_user=null,$db_password=null,$db_name=null)
{
// $db_link;
/*global $db_host;
global $db_user;
global $db_password;
global $db_name;*/
if(is_null($db_host)){
	$db_link = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
	//echo "custom database";
}
else
{
	//echo "custom database";
	$db_link = new mysqli($db_host,$db_user,$db_password,$db_name);
}
if($db_link->connect_errno > 0){
    die('Unable to connect to database [' . $db_link->connect_error . ']');
}

return $db_link;
}

//Close an existing DB Link
function closeDB($db_link)
{
//global $db_link;
if(is_resource($db_link))
{
$db_link->close();	
return true;
}
return false;
}
?>