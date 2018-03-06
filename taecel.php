<?php
			$ch = curl_init();

			#$postvars = array( 'key'=>'25d55ad283aa400af464c76d713c07ad', 'nip'=>'25d55ad283aa400af464');
			#$url = "https://taecel.com/app/api/getProducts";
			
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
			

			$postvars = array( 'key'=>'25d55ad283aa400af464c76d713c07ad', 'nip'=>'25d55ad283aa400af464','transID'=>$response["data"]["transID"]);
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
<!--
<html>
	<head>
        <script src="sitio_web/js/jquery-1.10.2.js"></script>
        <script src="sitio_web/js/jquery-ui-1.10.3.custom.js"></script>
	</head>
	<body>
	<div id="script">	
		cuerpo	
	</div>
	</body>	
	<script>
		// PEDIR PRODUCTOS
		/*
		$.ajax(
		{
			async:		false,
			cache:		false,
			dataType:	"json",
			type: 		"POST",  
			url: 		"https://taecel.com/app/api/getProducts",
			data:		{key:"25d55ad283aa400af464c76d713c07ad",nip:"25d55ad283aa400af464"},
            success: 	function(sessionResponse){
               alert(sessionResponse);
            }			
        });
        //*/
        /*
        var data_real
		$.ajax(
		{
			async:		true,
			cache:		false,
			type: 		"POST",  
			url: 		"https://taecel.com/app/api/RequestTXN?lalo=1",
			data:		{key:"25d55ad283aa400af464c76d713c07ad",nip:"25d55ad283aa400af464",producto:"TEL050",referencia:"3121204804"},
            success: 	function(data)
            {
            	alert(data);
            	data_real=data;
            	$("#script").html("lalo");
            }			
        });
        //alert(data_real);

	
		//----------------------------------------------------------------------------------
		// SI FUNCIONA		
		//----------------------------------------------------------------------------------
		/*
		$.ajax(
		{
			async:false,
			cache:false,
			dataType:"json",
			type: "POST",  
			url: "http://solesgps.com:8082/api/session",
			data:{email:"admin",password:"EvG30"},
            success: function(sessionResponse){
                console.log(sessionResponse);

            }			
		//----------------------------------------------------------------------------------
        });
		$.ajax({
			type: 'GET',
			url: 'http://solesgps.com:8082/api/devices?all=true&userId=50',
			headers: {
				"Authorization": "Basic " + btoa("admin:EvG30")
			},
			contentType:"application/json",
			success: function (response) 
			{
				console.log(response);
			}
		});        
		//---------------------------------------------------------------------------------
		$.ajax({
			type: 'POST',
			url: 'http://solesgps.com:8082/api/commands',
			headers: {
				"Authorization": "Basic " + btoa("admin:EvG30")
			},
			contentType:"application/json",
			data:JSON.stringify({attributes:{},deviceId:23,type:"engineStop"}),
			success: function (response) 
			{
				console.log(response);
			}
		});        
		
        //----------------------------------------------------------------------------------
        //----------------------------------------------------------------------------------
        //----------------------------------------------------------------------------------
        /*
		var name = "DESDE JS";
		var uid = "DESDEJS";
		$.ajax({
			type: 'POST',
			url: 'http://solesgps.com:8082/api/devices',
			headers: {
			"Authorization": "Basic " + btoa("admin:EvG30")
			},
			contentType:"application/json",
			data:JSON.stringify({
				name:name,
				uniqueId:uid
			}),
			success: function (response) {
				console.log(response);
			}
		});        
		
		//----------------------------------------------------------------------------------

		
		//var comando="engineResume";
		var comando="engineStop";
		
		$.ajax({
			type: 'POST',
			url: 'http://solesgps.com:8082/api/commands',
			headers: {
				"Authorization": "Basic " + btoa("admin:EvG30")
			},
			contentType:"application/json",
			data:JSON.stringify({attributes:{},deviceId:23,type:comando}),
			success: function (response) 
			{
				console.log(response);
			}
		});        


		//----------------------------------------------------------------------------------
*/
	</script>
</html>
-->
