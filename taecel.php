<?php
			$ch = curl_init();

			#$postvars = array( 'key'=>'25d55ad283aa400af464c76d713c07ad', 'nip'=>'25d55ad283aa400af464');
			#$url = "https://taecel.com/app/api/getProducts";

			$sesion = array( 
				'key'			=>'25d55ad283aa400af464c76d713c07ad', 
				'nip'			=>'25d55ad283aa400af464'
			);			
			$postvars = $sesion;	
			$postvars['producto']='MOV100';
			$postvars['referencia']='5555555560';

			$url = "https://taecel.com/app/api/RequestTXN";
			
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
			curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
	
			$response=json_decode($response);

			echo "<pre>" . print_r($response) . "</pre>";
			
			$postvars = $sesion;	
			$postvars['transID']=$response->data->transID;

			$url = "https://taecel.com/app/api/StatusTXN";
			
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
			curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
	
			$response=json_decode($response);


			echo "<pre>" . print_r($response) . "</pre>";


			$postvars = $sesion;	
			$postvars['fecha']=date("Y-m-d");

			$url = "https://taecel.com/app/api/getSales";
			
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
			curl_setopt($ch,CURLOPT_POSTFIELDS,$postvars);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
	
			$response=json_decode($response);
			
			$datas=$response->data;
			$recargar=1;
			foreach($datas as $data)
			{
				if($data->Nota=="Recarga Exitosa" AND $data->Telefono=="5555555560")
				{
					$recargar=0;
				}
			}
			
			#echo "<pre>" . print_r($data) . "</pre>";


?>

