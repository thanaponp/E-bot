<?php
$cn = "";/////// PHP7 ////////
if( $_SERVER['HTTP_HOST'] == 'localhost' || strncmp($_SERVER['HTTP_HOST'], "192.168.", 8)==0 )
{
	$ServerName = "localhost";
	$User = "root";
	$Password = "abc123";
	$dbname = "chatbot_db";
	$server_web = "http://".$_SERVER['HTTP_HOST']."/baanwebsite/E-bot";
	$server_name = $server_web."/admin";
	$server_file = $server_web."/album";
}
else
{
	$ServerName = "52.200.81.157";
	$User = "baanwebs_ebot";
	$Password = "ykO0Ll875K";
	$dbname = "baanwebs_ebot";

	$server_web = "https://".$_SERVER['HTTP_HOST']."/E-bot";
	$server_name = $server_web."/admin";
	$server_file = $server_web."/album";
}

$cn = mysql_connectx( $ServerName, $User, $Password );
mysql_select_dbx($dbname, $cn);
mysql_queryx("SET NAMES UTF8"); 
if(!$cn)
{
	echo "<h3>ERROR : ไม่สามารถติดต่อฐานข้อมูลได้</h3>";
	exit();
}
	
date_default_timezone_set("Asia/Bangkok");
$paths = array(
	'./',
	'../',
	'../../' ,
 ); 

set_include_path( PATH_SEPARATOR . implode(PATH_SEPARATOR, $paths));

/////// PHP7 ////////
function mysql_connectx($ServerName, $User, $Password){
	global $dbname;
	if(function_exists('mysql_connect'))
		return mysql_connect($ServerName, $User, $Password);
	else
		return mysqli_connect($ServerName, $User, $Password, $dbname);
}

function mysql_select_dbx($dbname, $cn){
	if(function_exists('mysql_select_db'))
		return mysql_select_db($dbname, $cn); 
	else
		return true;
}

function mysql_queryx($query){
	global $cn;
	if(function_exists('mysql_query'))
		return mysql_query($query);
	else
		return mysqli_query($cn, $query);
}

function mysql_fetch_arrayx($result){
	if(function_exists('mysql_fetch_array'))
		return mysql_fetch_array($result);
	else
		return mysqli_fetch_array($result);
}

function mysql_num_rowsx($result){
	if(function_exists('mysql_num_rows'))
		return mysql_num_rows($result);
	else
		return mysqli_num_rows($result);
}

function mysql_insert_idx(){
	global $cn;
	if(function_exists('mysql_insert_id'))
		return mysql_insert_id();
	else
		return mysqli_insert_id($cn);
}

function mysql_closex($conn){
	if(function_exists('mysql_close'))
		return mysql_close($conn);
	else
		return mysqli_close($conn);
}

function mysql_real_escape_stringx($value)
{
	global $cn;
	$value = str_replace(' ', '', $value);

	if( function_exists('mysql_real_escape_string') )
		return mysql_real_escape_string($value);
	else
		return mysqli_real_escape_string($cn, $value);
}
/////// PHP7 ////////

