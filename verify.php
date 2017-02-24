<?php
$access_token = 'voX+1uWfuwNRLirGplxETqO0sKRLGpPLGV4zzsUaOhttgg1cUMqQhZbWcFdJdyruBcuqNsTZ8wKpgJUqbQfsZNWYJlBnjqs3iynYSzhWjNnk6Gl/iszzjIaK2Vht4zh+1tXB4b3uHYqy2vJReu9pHQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;


?>


