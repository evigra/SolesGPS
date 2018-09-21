<?php
	$url			="https://panel.apiwha.com/save_channel_state.php?channel=5213143520972&state=ONLINE";
	$url			="https://panel.apiwha.com/";


	$ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$d);
    curl_setopt($ch, CURLOPT_REFERER, $ref);
    curl_setopt ($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_MAXREDIRS,3);
    curl_setopt($ch,CURLOPT_VERBOSE,0);   // me informará (si esta en cero) de todos los errores que halla curl
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION,3);
    if ($method == 'POST')
    {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
    }
 	
	
	
/*	
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, "evigra@gmail.com:EvG30JiC06");
	curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	$output = curl_exec($ch);
	$info = curl_getinfo($ch);
	echo "<pre>";
	print_r($info);
	echo "<br><br>-------<br><br>";
	print_r($output);	
	echo "</pre>";
	///////
	#/*
	$url			="https://panel.apiwha.com/page_login.php?signup=";
	$url			="https://panel.apiwha.com/save_channel_state.php?channel=5213143520972&state=ONLINE";
	
	curl_setopt($ch, CURLOPT_URL, $url);
	$output = curl_exec($ch);
	$info = curl_getinfo($ch);
	echo "<pre>";
	print_r($info);
	echo "<br><br>-------<br><br>";
	print_r($output);	
	echo "</pre>";	#*/
*/



	curl_close($ch);


/*

$my_apikey = "6AOOUTB9WG20HRXMTYOW";
$number = "5213141182618";


	
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

	$ch = curl_init();
	$url = "https://panel.apiwha.com/save_channel_state.php?channel=5213143520972&state=OFFLINE";
	$my_result_object = json_decode(file_get_contents($url, false));

print_r($my_result_object);
*/
?>
