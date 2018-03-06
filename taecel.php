<?php
			$ch = curl_init();

			$postvars = array( 'key'=>'25d55ad283aa400af464c76d713c07ad', 'nip'=>'25d55ad283aa400af464','producto'=>'TEL050','referencia'=>'3121204804');
			$url = "https://taecel.com/app/api/RequestTXN";
			
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
			curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
			curl_setopt($ch,CURLOPT_TIMEOUT, 20);
			$response = curl_exec($ch);
	
			$response=json_decode($response);

			echo "<pre>" . print_r($response) . "</pre>";
			
			$postvars = array( 'key'=>'25d55ad283aa400af464c76d713c07ad', 'nip'=>'25d55ad283aa400af464','transID'=>$response->data->transID);
			$url = "https://taecel.com/app/api/StatusTXN";
			
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
			curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
			curl_setopt($ch,CURLOPT_TIMEOUT, 20);
			$response = curl_exec($ch);
	
			$response=json_decode($response);

			echo "<pre>" . print_r($response) . "</pre>";
?>
