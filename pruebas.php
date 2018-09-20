<?php

$ch = curl_init();
 
// definimos la URL a la que hacemos la petición
curl_setopt($ch, CURLOPT_URL,"https://cfdiau.sat.gob.mx/nidp/wsfed/ep?id=SATUPCFDiCon&sid=0&option=credential&sid=0");
// indicamos el tipo de petición: POST
curl_setopt($ch, CURLOPT_POST, TRUE);
// definimos cada uno de los parámetros
#curl_setopt($ch, CURLOPT_POSTFIELDS, "postvar1=value1&postvar2=value2&postvar3=value3");
 
// recibimos la respuesta y la guardamos en una variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$remote_server_output = curl_exec ($ch);
 
// cerramos la sesión cURL
curl_close ($ch);
 
// hacemos lo que queramos con los datos recibidos
// por ejemplo, los mostramos
print_r($remote_server_output);

/*
	#date_default_timezone_set('America/Los_Angeles');
	$script_tz = date_default_timezone_get();
	
	
	
	
	echo $script_tz;
	echo "<br>".date("Y-m-d H:i:s");
	
	date_default_timezone_set('America/Mexico_City');
	echo "<br>".date("Y-m-d H:i:s");
	
	echo "<br>";


	foreach(timezone_abbreviations_list() as $timezone)
	{
		    foreach($timezone as $abbr =>$val)
		    {
		            if(isset($val['timezone_id']))
		            {
		            	echo "<br>". $val['offset']/60/60 ."<pre>" . print_r($val) . "</pre>";
		            }
		    }
	}
	*/
?>

