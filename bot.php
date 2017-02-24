<?php
$access_token = 'voX+1uWfuwNRLirGplxETqO0sKRLGpPLGV4zzsUaOhttgg1cUMqQhZbWcFdJdyruBcuqNsTZ8wKpgJUqbQfsZNWYJlBnjqs3iynYSzhWjNnk6Gl/iszzjIaK2Vht4zh+1tXB4b3uHYqy2vJReu9pHQdB04t89/1O/w1cDnyilFU=';

//include_once("function.inc.php");

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			$reply = $text . " คืออะไร";

			if( strcasecmp($text, "สวัสดี")==0 || strcasecmp($text, "hi")==0 || strcasecmp($text, "hello")==0 ||
			    strcasecmp($text, "สบายดี")==0 || strcasecmp($text, "หวัดดี")==0 || strcasecmp($text, "ดีจ้า")==0 )
				$reply = "สวัสดีครับ";
			else if( $text == "สบายดีไหม" )
				$reply = "สบายดีครับ ขอบคุณที่เป็นห่วง";
			else if( $text == "บ้านเว็บไซต์" )
				$reply = "บริษัทนี้ดีนะ เขารับทำเว็บน่ะ ลองดูที่นี่ซิ http://www.baanwebsite.com";
			else if( stristr($text, "อ่านหน่อย") != false )
				$reply = "อ่านเองบ้างซิ";
			else if( stristr($text, "ทวนทำไม") != false )
				$reply = "ก็รู้แค่นี้อ่ะ";
			else if( stristr($text, "เป็นไร") != false || stristr($text, "เป็นใคร") != false )
				$reply = "ผมเป็นบอทครับ";
			else if( $text == "บอท" || $text == "หรอ" || $text == "ครับ" || $text == "ค่ะ" || $text == "คะ" )
				$reply = "ครับ";
			else if( $text == "ดี" || $text == "ดีมาก" || $text == "ดีแล้ว" )
				$reply = "ขอบคุณครับ";
			else if( stristr($text, "อายุ") != false || stristr($text, "น้ำหนัก") != false || 
					   stristr($text, "ส่วนสูง") != false || stristr($text, "ขวบ") != false ||
					   stristr($text, "ไปไหน") != false || stristr($text, "ที่ไหน") != false ||
					   stristr($text, "บ้างมั้ย") != false || stristr($text, "บ้างไหม") != false )
				$reply = "ผมก็ไม่ทราบเหมือนกัน";
			else if( stristr($text, "กิน") != false )
				$reply = "ผมไม่ต้องกินครับ";
			else if( stristr($text, "ทำไร") != false || stristr($text, "ทำอะไร") != false )
				$reply = "คุยกันอยู่ไม่ใช่หรอ";
			else if( stristr($text, "ไม่ได้พูดด้วย") != false || stristr($text, "สำนึก") != false )
				$reply = "ผมต้องขอโทษด้วยครับ";
			else if( stristr($text, "มึง") != false || stristr($text, "มรึง") != false || 
					   stristr($text, "กู") != false || stristr($text, "กรู") != false ||
					   stristr($text, "สัด") != false || stristr($text, "ไอ้") != false )
				$reply = "โปรดใช้คำสุภาพครับ";
			else if( $text == "วันนี้วันอะไร" || $text == "วันนี้เป็นวันอะไร" )
				$reply = 0;//getDay();
			else if( $text == "วันนี้วันที่เท่าไร" || $text == "วันนี้เป็นวันที่เท่าไร" )
				$reply = 1;//getDate();
/*			else if( stristr($text, "กี่โมง") != false )
				$reply = getDate();*/
				
			

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $reply //$text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";

?>