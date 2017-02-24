<?php

date_default_timezone_set("Asia/Bangkok");
$date_m=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค","พ.ย.","ธ.ค.");
$date_w=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์");
/*
function getDay()
{
	return 0;
//	global $date_w;
	$date_w=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์");
	$week = date("w");
	return $date_w[$week];
}

function getDate()
{
	global $date_m;
	$today = date("Y-m-d");
	$buffer = explode("-", $today);
	$buffer[0] += 543;
	$mon = $buffer[1]-1;
	$reply = "$buffer[2] $date_m[$mon] $buffer[0]";
}

function getTime()
{
	$today = date("Y-m-d H:i:s");
	
}
*/
?>


