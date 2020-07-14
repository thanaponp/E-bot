<?php
function send_line_notify($params, $token)
{
  $message_data = array(
    'message' => $params["message"],
    'stickerPackageId' => $params["stickerPkg"],
    'stickerId' => $params["stickerId"],
  );

  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
  curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt( $ch, CURLOPT_POST, 1);
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $message_data);
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
  //$headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", );
  $headers = array("Content-type: multipart/form-data", "Authorization: Bearer $token");
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec( $ch );
  curl_close( $ch );

  return $result;
}

$token = 'aSpQER9FfNwwUTe6YznvRCJy9Xs3WlorMFrDP2nbSWH';
$message = '';
 
$monitorFriendlyName = $_GET['monitorFriendlyName'];
$alertTypeFriendlyName = $_GET['alertTypeFriendlyName'];
$alertDetails = $_GET['alertDetails'];

if( $monitorFriendlyName != "" )
  $message = "$monitorFriendlyName $alertTypeFriendlyName ($alertDetails)";
else
  $message = "OK";

if( $alertTypeFriendlyName == "Up" )
{
  $stickerPkg = 3;
  $stickerId = 184;
} 
else
{
  $stickerPkg = 3;
  $stickerId = 188;
}

$params = array(
  "message"        => $message, //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
  "stickerPkg"     => $stickerPkg, //stickerPackageId
  "stickerId"      => $stickerId, //stickerId
);
send_line_notify($params, $token);

?>
