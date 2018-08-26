<?php

// Pull messages (for push messages please go to settings of the number)
$my_apikey = "TM6WR0XD4GU54EP2O3D1";
$number = "5213141182618";

/*
$type = "[TYPE OF MESSAGE: IN or OUT]";
$markaspulled = "[1 or 0]";
$getnotpulledonly = "[1 or 0]";
$api_url  = "http://panel.apiwha.com/get_messages.php";
$api_url .= "?apikey=". urlencode ($my_apikey);
$api_url .= "&number=". urlencode ($number);
$api_url .= "&type=". urlencode ($type);
$api_url .= "&markaspulled=". urlencode ($markaspulled);
$api_url .= "&getnotpulledonly=". urlencode ($getnotpulledonly);
$my_json_result = file_get_contents($api_url, false);
$my_php_arr = json_decode($my_json_result);
foreach($my_php_arr as $item)
{
  $from_temp = $item->from;
  $to_temp = $item->to;
  $text_temp = $item->text;
  $type_temp = $item->type;
  echo "<br>". $from_temp ." -> ". $to_temp ." (". $type_temp ."): ". $text_temp;
  // Do something
}
*/
// Send Message
$destination = "5213141182618";
$message = "Funciona desde mi lap";
$api_url = "http://panel.apiwha.com/send_message.php";
$api_url .= "?apikey=". urlencode ($my_apikey);
$api_url .= "&number=". urlencode ($destination);
$api_url .= "&text=". urlencode ($message);
$my_result_object = json_decode(file_get_contents($api_url, false));
echo "<br>Result: ". $my_result_object->success;
echo "<br>Description: ". $my_result_object->description;
echo "<br>Code: ". $my_result_object->result_code;

































/*
https://www.twilio.com/console/api/api-explorer/messages/create?Format=json&AccountSid=AC46f33ea3362e521534d758937494407b&To=whatsapp:+5213143520972&From=whatsapp:+14155238886&Body=Ejemplo&Method=post&Location=/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json&__referrer=sms-mms
*/

/*
	ini_set('display_errors', 1);
	error_reporting(-1);	
	
	
#	https://timberwolf-mastiff-9776.twil.io/demo-reply
	
	$url			="https://api.twilio.com/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json";
	#$url			="https://timberwolf-mastiff-9776.twil.io/demo-reply";
	$username		="AC46f33ea3362e521534d758937494407b";
	$password		="31ad51fd021cf3c89ea07c100f5d4113";

	$postvars = array( 
		'to'			=>'whatsapp:+5213143520972', 
		'From'			=>'whatsapp:+14155238886',
		'Body'			=>'SolesGPS Lalo desde lap',
	);


	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	$output = curl_exec($ch);
	$info = curl_getinfo($ch);
	curl_close($ch);
	
	echo "entra <pre>";
	
	print_r($info);
	echo "FIn </pre>";
*/
?>
