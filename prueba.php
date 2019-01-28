<?php
	echo "INICIO";
	$usuarios_sesion	="EXECUTE_CRONS";
	$usuarios_sesion	="PHPSESSID";
	
	
	session_name($usuarios_sesion);
	session_start();
	session_cache_limiter('nocache,private');	
	#if(!isset($_SESSION))
	require_once("nucleo/sesion.php");	


	$objeto				=new general();	
	
	$file=file_get_contents('VIGE850830GKA.cer');
	$objeto->__PRINT_R($file);
	
	$pub_key = openssl_pkey_get_public($file);
	$objeto->__PRINT_R($pub_key);
	
	$keyData = openssl_pkey_get_details($pub_key);
	$objeto->__PRINT_R($keyData);
	
	
	#file_put_contents('./key.pub', $keyData['key']); 	
	
	

/*	
	$option				=array();	
	$option["url"]		="https://panel.apiwha.com/";	
	$respuesta			=$objeto->__curl($option);
	$objeto->__PRINT_R($respuesta);




	$option["url"]		=$respuesta["info"]["redirect_url"];	
	$respuesta			=$objeto->__curl($option);
	#$objeto->__PRINT_R($respuesta);
	
	$option["url"]		=$respuesta["info"]["redirect_url"];	
	$respuesta			=$objeto->__curl($option);
	#$objeto->__PRINT_R($respuesta);
	
	$option["url"]		=$respuesta["info"]["redirect_url"];	
	$respuesta			=$objeto->__curl($option);
	#$objeto->__PRINT_R($respuesta);
	
	$option["url"]		=$respuesta["info"]["redirect_url"];	
	$respuesta			=$objeto->__curl($option);
#	$objeto->__PRINT_R($respuesta);
#/*

	$vars_url		=explode("?",$option["url"]);

	$vars=array(
		"email"		=>"evigra@gmail.com",
		"password"	=>"EvG30JiC06",	
	);	
	$option["post"]		=$vars;
	#$option["user"]		="evigra@gmail.com";				
	#$option["pass"]		="EvG30JiC06";
	$option["url"]		="https://panel.apiwha.com/?a=" . $vars_url[1];	
	$respuesta			=$objeto->__curl($option);


	$objeto->__PRINT_R($respuesta);

	$option["url"]		=$respuesta["info"]["redirect_url"];	
	$respuesta			=$objeto->__curl($option);
	$objeto->__PRINT_R($respuesta);
	
	$option["url"]		=$respuesta["info"]["redirect_url"];	
	$respuesta			=$objeto->__curl($option);
	$objeto->__PRINT_R($respuesta);

	$option["url"]		=$respuesta["info"]["redirect_url"];	
	$respuesta			=$objeto->__curl($option);
	$objeto->__PRINT_R($respuesta);
#*/	
	echo "FIN";


/*
	$comando_sql="
		SELECT * 
		FROM geofences
	";		
	$geofences 		=$objeto->__EXECUTE($comando_sql);    
	
	foreach($geofences as $geofence)
	{	
		$points=explode("|",$geofence["points"]);
		$puntos_nuevos="";
		foreach($points as $point)
		{
			if($point!="")
			{
				$coordenadas=explode(",",$point);				
				$puntos_nuevos.="{$coordenadas[1]} {$coordenadas[0]}, ";
			}
		}	
		$puntos_nuevos=substr($puntos_nuevos,0,strlen($puntos_nuevos)-2);
		$comando_sql="
			UPDATE geofences SET points='$puntos_nuevos' 
			WHERE id='{$geofence["id"]}'
		";		
		$objeto->__EXECUTE($comando_sql);    		
	}
#*/	

/*	
	echo "<br>INICIO";
	$objeto				=new position();	

	$comando_sql="
				select p.*,
					p.id as pos_id,
					d.id as dev_id,
					DATE_SUB(p.devicetime,INTERVAL 6 HOUR) as devicetime,
					c.*,
					d.*,
					d.name as dispo,
					CASE 
						WHEN protocol='meitrack' 	THEN EXTRACT_JSON(p.attributes,'event')
						WHEN protocol='gps103' 		THEN EXTRACT_JSON(p.attributes,'alarm')					
						WHEN protocol='osmand' 		THEN 'REPORTE DE TIEMPO'					
						WHEN protocol='h02' 		THEN 'REPORTE DE TIEMPO'
					END
                    as cve_evento,
                    e.descripcion 
				from 
					positions p left join 
					event e on 
					CASE 
						WHEN protocol='meitrack' 		THEN leido=0 AND p.protocol=e.protocolo AND EXTRACT_JSON(p.attributes,'event')=e.codigo
						WHEN protocol='gps103' 			THEN leido=0 AND p.protocol=e.protocolo AND EXTRACT_JSON(p.attributes,'alarm')=e.codigo
                        WHEN protocol='osmand' 			THEN leido=0 AND p.protocol=e.protocolo
                        WHEN protocol='h02' 			THEN leido=0 
                    END left join
                    devices d on p.deviceid=d.id join
                    company c on d.company_id=c.id
				where 1=1					
					AND p.id=855283
	";		
	$position_data 				=$objeto->__EXECUTE($comando_sql);
    foreach($position_data as $row)	
	{	
		$objeto->geofences($row);		
	}
	echo "<br>FIN";
	#session_destroy();	
	
#*/	
?>
