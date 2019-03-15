<?php
@session_start();

include("connect.php");

//Configuration
$answer_normal = "Hey... just say 'Hello'!";
$answer_rude = "Hey... don't be so rude!";
//

define("TEXT_DEFAULT", "ขออภัยความรู้น้อย");
date_default_timezone_set("Asia/Bangkok");
$date_m=array("ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
$date_mfull=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
$date_w=array("วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์");
$adwords_ID = array(
			array("1054400177", "akt-transport.com"),
			array("5197552855", "baanrecycle.com"),
			array("6906576243", "balloonthonglor.com"),
			array("9210924942", "brsacc.com"),
			array("3373931866", "goldsultant.com"),
			array("5418735899", "grandsteps.com"),
			array("6900588062", "iflybooking.com"),
			array("6321923602", "jinbothai.com"),
			array("1069568039", "KinKanJung"),
			array("6416984254", "krit88.com"),
			array("2551183957", "lampko.com"),
			array("2551807942", "larpthaksininterpack.com"),
			array("9353101552", "le-rose.com"),
			array("2653782827", "money-pipe.com"),
			array("4910951474", "ohmslawtutor.com"),
			array("3385748391", "onetreehill.co.th"),
			array("5160637205", "ooytransportcarsrenteldrivers.com"),
			array("3585893607", "pb.engineeringdecoration.com"),
			array("8272744853", "psbconstruction1997.com"),
			array("7311207675", "punboonbook.com"),
			array("3158355889", "rayamantra.com"),
			array("4566358302", "sengineeringsystem.com"),
			array("3277963359", "siamtech-intertrade.com"),
			array("2892926837", "sl-hammer.com"),
			array("6477020338", "smile-interpreter.com"),
			array("2701247767", "sorsuchartdriving.com"),
			array("2771228659", "speaking-club.com"),
			array("9953956149", "sunnykids.co.th"),
			array("4808883487", "Thailand Campaigns"),
			array("9413942249", "thewatourism.com"),
			array("4397016422", "tjminthailand.com"),
			array("7972670086", "กระเป๋าสัมมนาวิชาการ.com"),
			array("1564664946", "งานพาร์ทไทม์"),
			array("8588086822", "บ้านเว็บไซต์"),
			array("5873661342", "ประดิษฐ์ค้าของเก่า.com"),
			array("2062772017", "เมทัลชีทถูกเร็วดี.com"),
			array("8859160276", "premier-view.com"),
			array("7018496101", "ทินกรรับซื้อแอร์เก่า.com"),
			array("6993652546", "essepremium.com"),
			array("8366261176", "ติวเตอร์ประเทศไทย.com")
				);

function getDayWeek()
{
	global $date_w;
	return $date_w[date("w")];
}

function getDateThai()
{
	global $date_m;
	$today = date("Y-m-d");
	$buffer = explode("-", $today);
	$buffer[0] += 543;
	$mon = $buffer[1]-1;
	$reply = "$buffer[2] $date_m[$mon] $buffer[0]";
	return $reply;
}

function getTimeNow()
{
	return date("H:i");
}

function findStrPartInNoCase($text, $find)
{
	if( stristr($text, $find) != false )
		return true;
	return false;
}

function findStrEqualNoCase($text, $find)
{
	if( strcasecmp($text, $find)==0 )
		return true;
	return false;
}

function partTime($text)
{
	return getTimeNow();
}

function partDate($text)
{
	if( findStrPartInNoCase($text, "วันที่") == true )
		return getDateThai();
	else
		return getDayWeek();
}

function partDateSpec($text)
{
	global $date_w, $date_mfull;

	$text2=preg_replace('/\s+/', '', $text); //ตัด space ทั้งหมด

	$resDay = 0;
	$resMonth = 0;
	$resYear = 0;

	if( findStrPartInNoCase($text2, "วานนี้") == true )
	{
		$needDate = date("Y-m-d",  mktime(0, 0, 0, date("m"), date("d")-1, date("Y")));
		$buffer = explode("-", $needDate);
		$resYear = $buffer[0];
		$resMonth = $buffer[1];
		$resDay = $buffer[2];
	}
	else if( findStrPartInNoCase($text2, "วานซืน") == true )
	{
		$needDate = date("Y-m-d",  mktime(0, 0, 0, date("m"), date("d")-2, date("Y")));
		$buffer = explode("-", $needDate);
		$resYear = $buffer[0];
		$resMonth = $buffer[1];
		$resDay = $buffer[2];
	}
	else if( findStrPartInNoCase($text2, "พรุ่งนี้") == true )
	{
		$needDate = date("Y-m-d",  mktime(0, 0, 0, date("m"), date("d")+1, date("Y")));
		$buffer = explode("-", $needDate);
		$resYear = $buffer[0];
		$resMonth = $buffer[1];
		$resDay = $buffer[2];
	}
	else if( findStrPartInNoCase($text2, "มะรืน") == true )
	{
		$needDate = date("Y-m-d",  mktime(0, 0, 0, date("m"), date("d")+2, date("Y")));
		$buffer = explode("-", $needDate);
		$resYear = $buffer[0];
		$resMonth = $buffer[1];
		$resDay = $buffer[2];
	}
	else
	{
		$count = 1;
		foreach ($date_mfull as $month)
		{
			$pos = strpos($text2, $month);
			if( $pos )
			{
				//เดือน
				$resMonth = sprintf("%02d", $count);
				
				//หาวัน
				$rest = substr($text2, $pos-2, -2);
				if( $rest )
				{
					$resDay = substr($rest, 0, 2);
				}
				else
				{
					$rest = substr($text2, $pos-1, -2);
					$resDay = substr($rest, 0, 1);
				}
				$resDay = sprintf("%02d", $resDay);
		
				//หาปี
				$rest = substr($text2, $pos+strlen($month), -2);
				$resYear = substr($rest, 0, 4);
				
				if( $resYear == 0 )
					$resYear = date("Y");
				
				if( $resYear > 2500 )
					$resYear -= 543;
				break;
			}
			$count++;
		}
	}

	$ret = TEXT_DEFAULT;
	if( $resDay > 0 && $resMonth > 0 && 	$resYear > 0 )
	{
		$date = "$resYear-$resMonth-$resDay";
		$date_stamp = strtotime(date('Y-m-d', strtotime($date)));
		$ret = $date_w[date("w", $date_stamp)];
	}
	return $ret;
}

function findStrHail($text, &$backword)
{
	if( strcasecmp($text, "สวัสดี")==0 || strcasecmp($text, "hi")==0 || strcasecmp($text, "hello")==0 ||
		strcasecmp($text, "สบายดี")==0 || strcasecmp($text, "หวัดดี")==0 || strcasecmp($text, "ดีจ้า")==0 ||
		strcasecmp($text, "เป็นไง")==0 )
	{
		$backword = "สวัสดีครับ";
		return true;
	}
	return false;
}

function findStrDone($text, &$backword)
{
	if( $text == "อ๋อ" || $text == "ใช่" || $text == "เออ" || $text == "ตกลง" || $text == "ได้" || $text == "ครับ" || $text == "ค่ะ" || $text == "คะ" ||
  	    $text == "เคร" || $text == "จ๊ะ" || $text == "จ้า"|| $text == "หรอ" )
	{
		$backword = $text;
		return true;
	}
	return false;
}

function findStrSpecial($text, &$backword)
{
	if( $text == "บ้านเว็บไซต์" )
	{
		$backword = "บริษัทนี้ดีนะ เขารับทำเว็บน่ะ ลองดูที่นี่ซิ http://www.baanwebsite.com";
		return true;
	}
	return false;
}

function findStrHowRU($text, &$backword)
{
	if( stristr($text, "เป็นไร") != false || stristr($text, "เป็นใคร") != false )
	{
		$backword = "ผมเป็นบอทครับ";
		return true;
	}
	return false;
}

function findStrGood($text, &$backword)
{
	if( $text == "ดี" || $text == "ดีมาก" || $text == "ดีแล้ว" || $text == "เก่งมาก" || $text == "เยี่ยมมาก" )
	{
		$backword = "ขอบคุณครับ";
		return true;
	}
	return false;
}

function findStrRudeWord($text, &$backword)
{
	if( stristr($text, "มึง") != false || stristr($text, "มรึง") != false || 
		   stristr($text, "กู") != false || stristr($text, "กรู") != false ||
		   stristr($text, "สัด") != false || stristr($text, "ไอ้") != false ||
		   stristr($text, "วะ") != false || stristr($text, "ว่ะ") != false )
	{
		$backword = "โปรดใช้คำสุภาพครับ";
		return true;
	}
	return false;
}

function adwordsName($text)
{
	global $adwords_ID;

	foreach ($adwords_ID as $adword)
	{
		if( $text == $adword[0] )
		{
			return "Adwords: " . $adword[1];
		}
	}
	return TEXT_DEFAULT; 	
}






function KeepLog($question, $answer, $qid)
{
	global $cn;

	$today = date("Y-m-d H:i:s");
	$session = session_id();
	if (getenv(HTTP_X_FORWARDED_FOR))
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	else
		$ip = getenv('REMOTE_ADDR');

	$sql = "INSERT INTO tb_chat_log(id,text,date,session,ip,question,answer) VALUES('','$question','$today','$session','$ip','$qid','$answer')";
	mysql_queryx($sql);
}

//Banned word
function CheckBanned($text, &$bid)
{
	global $cn;

	$bannedArr = array();
	$sql = "SELECT * FROM tb_chat_banned";
	$result = mysql_queryx($sql);
	while( $result && $r=mysql_fetch_arrayx($result) )
	{
		$id = sprintf("%d",$r['id']);
		$bannedArr[] = $r['text'];
	}
	foreach($bannedArr as $word)
	{
		if( stripos($text, $word) !== false )
			return true;
	}

	return false;
}

//ตัดคำที่ไม่เกี่ยวข้องออก
function cutSomeWord($text)
{
	$text = strtolower($text);
	
	//ตัด คับ ครับ ค่ะ คะ
	$find = array("คับ","ครับ","ค่ะ","คะ");
	$text = str_replace($find, "", $text);
	return $text;
}

//ข้อความทักทาย
function findStrHail($text, &$backword)
{
	if( strcasecmp($text, "สวัสดี")==0 || strcasecmp($text, "hi")==0 || strcasecmp($text, "hello")==0 ||
		strcasecmp($text, "สบายดี")==0 || strcasecmp($text, "หวัดดี")==0 || strcasecmp($text, "ดีจ้า")==0 ||
		strcasecmp($text, "เป็นไง")==0 )
	{
		$backword = "สวัสดีครับ";
		return true;
	}
	return false;
}

function CheckQinDB($text, &$backword, &$qid)
{
	global $cn;
	
	$queswordArr = array();
	$sql = "SELECT * FROM tb_chat_question";
	$result = mysql_queryx($sql);
	while( $result && $r=mysql_fetch_arrayx($result) )
	{
		$qid = sprintf("%d",$r['id']);
		$queswordArr[] = $r['text'];

		foreach($queswordArr as $words)
		{
			$count = 0;
			$wordArr = explode(",", $words);
			foreach($wordArr as $word)
			{
				if( stripos($text, $word) !== false )
					$count++;
			}

			if( $count >= count($wordArr))
			{
				$sqlans = "SELECT * FROM tb_chat_answer WHERE questionid='$qid' ORDER BY RAND() LIMIT 1";
				$resultans = mysql_queryx($sqlans);
				if( $resultans && $rans=mysql_fetch_arrayx($resultans) )
				{
					//$aid=sprintf("%d",$rans['id']);
					$backword = $rans['text'];
					return true;
				}
			}
		}
	}

	return false;
}

function analyzeMain($question)
{
	return TEXT_DEFAULT;

	$log_que = addslashes($question);
	$question = cutSomeWord($question);
	$qid = 0;

	//banned words
	if(CheckBanned($question, $bid) == true )
	{
		$backword = $answer_rude;
		$log_ans = addslashes($backword);
		KeepLog($log_que, $log_ans, $bid);

		return $backword;
	}

	if( CheckQinDB($question, $backword, $qid) == true )
	{
		$log_ans = addslashes($backword);
		KeepLog($log_que, $log_ans, $qid);

		return $backword;
	}

	//Log
	KeepLog($log_que, TEXT_DEFAULT, $qid);

/*
	if( findStrHail($question, $backword) == true )
		return $backword;
	if( findStrDone($question, $backword) == true )
		return $backword;
	if( findStrSpecial($question, $backword) == true )
		return $backword;
	if( findStrHowRU($question, $backword) == true )
		return $backword;
	if( findStrGood($question, $backword) == true )
		return $backword;
	if( findStrRudeWord($question, $backword) == true )
		return $backword;
		
	if( strlen($question) == 12 )		
		$question = str_replace("-", "", $question);
	if( strlen($question) == 10 )
		return adwordsName($question);

	if( findStrPartInNoCase($question, "วันนี้") )
		return partDate($question);

	if( findStrPartInNoCase($question, "กี่โมง") )
		return partTime($question);

	if( findStrPartInNoCase($question, "วันอะไร") )
		return partDateSpec($question);
*/

	return TEXT_DEFAULT;
}

?>


