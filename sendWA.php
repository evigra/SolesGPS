<?php

	$url			="https://api.twilio.com/2010-04-01/Accounts/AC46f33ea3362e521534d758937494407b/Messages.json";
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

?>
