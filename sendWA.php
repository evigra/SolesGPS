<?php
	$my_apikey 		= "6AOOUTB9WG20HRXMTYOW";
	$number 		= "5213141182618";
	$login 			= 'evigra@gmail.com';
	$password 		= 'EvG30JiC06';

	$url			="https://panel.apiwha.com/";
	$postvars		="email=$login&password=$password";
#/*
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"grant_type\":\"http://auth0.com/oauth/grant-type/password-realm\",\"username\": \"$login\",\"password\": \"$password\",\"audience\": \"https://someapi.com/api\", \"scope\": \"read:sample\", \"client_id\": \"YOUR_CLIENT_ID\", \"client_secret\": \"YOUR_CLIENT_SECRET\", \"realm\": \"employees\"}",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
#*/




/*
	define("COOKIE_FILE", "cookie.txt");

// Login the user
	$ch = curl_init($url);
	curl_setopt ($ch, CURLOPT_COOKIEJAR, COOKIE_FILE); 
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);

	curl_setopt($ch, CURLOPT_HEADER, true);
	echo curl_exec ($ch);

// Read the session saved in the cookie file

	$file = fopen("cookie.txt", 'r');
	$datos=fread($file, 100000000);
	echo "<pre>";
	print_r($datos   );
	echo "</pre>";
	*/
/*
// Get the users details
$ch = curl_init('http://api.example.com/user');
curl_setopt ($ch, CURLOPT_COOKIEJAR, COOKIE_FILE); 
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
echo curl_exec ($ch);

#*/











/*






$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://panel.apiwha.com/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"grant_type\":\"client_credentials\",\"client_id\": \"evigra@gmail.com\",\"client_secret\": \"EvG30JiC06\",\"audience\": \"6AOOUTB9WG20HRXMTYOW\"}",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}




	$ch = curl_init();







/*	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
#	curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
#	curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
#	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
#	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

	$output = curl_exec($ch);
	$info = curl_getinfo($ch);

	echo "<pre>";
	print_r($output);
	print_r($info);
	echo "</pre>";


#*/
	/////////////

	#$postvars		="email=evigra@gmail.com&password=EvG30JiC06";


/*
	$url			="https://apiwha.auth0.com/login?state=R9VCu-mA0-xDaBxANCth2c3yWCG9dGLq&client=ZR1otGY15VyNEGlZW4n6BAGhu1XDY6Uu&protocol=oauth2&audience=https%3A%2F%2Fapiwha.auth0.com%2Fuserinfo&scope=openid%20email%20name%20picture%20profile&response_mode=query&response_type=code&redirect_uri=https%3A%2F%2Fpanel.apiwha.com%2Fauth0_callback.php";
	$url			="https://apiwha.auth0.com/login";		
	$postvars		="?email=evigra@gmail.com&password=EvG30JiC06";
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	#curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	#curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	$output = curl_exec($ch);
	$info = curl_getinfo($ch);

	echo "<pre>";
	print_r($output);
	print_r($info);
	echo "</pre>";

	/////////////

/*


	$url			="https://panel.apiwha.com/save_channel_state.php?channel=5213143520972&state=ONLINE";	
	#$postvars		="channel=5213143520972&state=ONLINE";
	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
	#curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
	#curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	#curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	#curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	$output = curl_exec($ch);
	$info = curl_getinfo($ch);
	
	
	curl_close($ch);
	
	echo "<pre>";
	print_r($output);
	print_r($info);
	echo "</pre>";

*/

/*
$url			="https://panel.apiwha.com/save_channel_state.php?channel=5213143520972&state=ONLINE";	
$api_url 		= $url;
#$api_url 		.= "?apikey=". urlencode ($my_apikey);
#$api_url 		.= "&number=". urlencode ($destination);
#$api_url 		.= "&text=". urlencode ($message);
$my_result_object = file_get_contents($api_url);

echo $my_result_object;
#*/


##########################################################
# ENVIA MENSAJE CUANDO LA API ESTA ACTIVA
##########################################################
/*
$destination = $number;
$message = "Funciona desde mi lap";
$api_url = "http://panel.apiwha.com/send_message.php";
$api_url .= "?apikey=". urlencode ($my_apikey);
$api_url .= "&number=". urlencode ($destination);
$api_url .= "&text=". urlencode ($message);
$my_result_object = json_decode(file_get_contents($api_url, false));
echo "<br>Result: ". $my_result_object->success;
echo "<br>Description: ". $my_result_object->description;
echo "<br>Code: ". $my_result_object->result_code;

#*/

##################################################################
# CAPTURA LOS MENSAJES CUANDO ESTABA ACTIVA LA API
##################################################################
/*
$type = "IN"; #"[TYPE OF MESSAGE: IN or OUT]";
$markaspulled = "[1]"; #"[1 or 0]";
$getnotpulledonly = "[1]"; #"[1 or 0]";
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
}
#*/
































/*
https://www.twilio.com/console/api/api-explorer/messages/create?Format=json&AccountSid=AC46f33ea3362e521534d758937494407b&To=whatsapp:+5213143520972&From=whatsapp:+14155238886&Body=Ejemplo&Method=post&Location=/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json&__referrer=sms-mms
*/

/*
	ini_set('display_errors', 1);
	error_reporting(-1);	
	
curl 'https://api.twilio.com/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json' -X POST \
--data-urlencode 'To=whatsapp:+5213143520972' \
--data-urlencode 'From=whatsapp:+14155238886' \
--data-urlencode 'Body=Mensaje desde web' \
-u AC46f33ea3362e521534d758937494407b:31ad51fd021cf3c89ea07c100f5d4113	
	
#	https://timberwolf-mastiff-9776.twil.io/demo-reply
*/	
/*
__referrer	sms-mms
AccountSid	AC46f33ea3362e521534d758937494407b
Body	NUEVO MENSAJE
Format	json
From	whatsapp:+14155238886
Location	/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json
Method	post
To	whatsapp:+5213143520972



&__referrer=sms-mms&AccountSid=AC46f33ea3362e521534d758937494407b&Body=NUEVO MENSAJE&Format=json&From=whatsapp:+14155238886&Location=/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json&Method=post&To=whatsapp:+5213143520972

*/

/*
	$url			="https://api.twilio.com/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json";
	$url			="https://api.twilio.com/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json";
	
#	$url			="https://timberwolf-mastiff-9776.twil.io/demo-reply";
	
	#$url			="https://timberwolf-mastiff-9776.twil.io/demo-reply";
	$username		="AC46f33ea3362e521534d758937494407b";
	$password		="31ad51fd021cf3c89ea07c100f5d4113";
	
	
	
	$username		="AC46f33ea3362e521534d758937494407b";
	$password		="31ad51fd021cf3c89ea07c100f5d4113";
	

	$postvars = array( 
		'to'			=>'whatsapp:+5213143520972', 
		'From'			=>'whatsapp:+14155238886',
		'Body'			=>'SolesGPS Lalo desde lap',
	);

	$postvars="To=whatsapp:+5213143520972&__referrer=sms-mms&AccountSid=AC46f33ea3362e521534d758937494407b&Body=NUEVO MENSAJE DE LAP&Format=json&From=whatsapp:+14155238886&Location=/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json&Method=post";

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
	print_r($output);
	print_r($info);
	echo "FIn </pre>";
*/
?>
