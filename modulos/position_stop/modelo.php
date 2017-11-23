<?php
	if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class position_stop extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $noactualizar	=array("stop");
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"FECHA"	    =>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			
			"HORA_INICIAL"	    =>array(
			    "title"             => "Inicio",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			"HORA_FINAL"	    =>array(
			    "title"             => "Fin",
			    "showTitle"         => "si",
			    "type"              => "font",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						
			"latitud"	    =>array(
			    "title"             => "Latitud",
			    "showTitle"         => "si",
			    "type"              => "font",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						
			"longitud"	    =>array(
			    "title"             => "Longitud",
			    "showTitle"         => "si",
			    "type"              => "font",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						
			"stop_duration"	    =>array(
			    "title"             => "Tiempo",
			    "showTitle"         => "si",
			    "type"              => "font",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			@$_SESSION["user"]["l18n"]="es_MX";
			#$_SESSION["user"]["l18n"]="en";		
			parent::__CONSTRUCT();			
		}
		
		public function __SAVE($datas=NULL,$option=NULL)
    	{    		
    		parent::__SAVE($datas,$option);
		}	
		public function time_position($option)
    	{
			
			$comando_sql 	= "
				SELECT 
						id,
						DATE(serverTime)                                        																									FECHA,
						DATE(deviceTime)                                        																									FECHA2,
						MIN(TIME(DATE_SUB(deviceTime,INTERVAL 6 HOUR)))                                   												HORA_INICIAL,   
						MAX(TIME(DATE_SUB(deviceTime,INTERVAL 6 HOUR)))                                   												HORA_FINAL,
						TIMEDIFF(MAX(TIME(DATE_SUB(deviceTime,INTERVAL 6 HOUR))),MIN(TIME(DATE_SUB(deviceTime,INTERVAL 6 HOUR))))	STOP_DURATION,
						MIN(TIME(deviceTime))                                   HORA_INICIAL_DEVICE,
						MAX(TIME(deviceTime))                                   HORA_FINAL_DEVICE,  
						speed                                                   VELOCIDAD,
						latitude                                                LATITUD,    
						longitude                                               LONGITUD,
						COUNT(*)                                                NUMERO_REGISTROS    
				FROM 
						position
				WHERE
						deviceid = 6 
				#AND DATE( serverTime ) = '2015-12-29'
				AND DATE(DATE_SUB(deviceTime,INTERVAL 6 HOUR)) ='2016-01-05'
				AND speed = 0
				AND event   IN   ('INTERVALO DE TIEMPO DE RASTREO','REPORTE DE TIEMPO')
				GROUP BY    
						CONCAT(longitude,latitude,course)
				HAVING 
						STOP_DURATION > TIME('00:01:00')
				ORDER BY
						TIME(serverTime) ASC;			
			";			
			$datas          =$this->__EXECUTE($comando_sql, "algo");
			

	    	if(!isset($option["name"]))    	$option["name"]	=$this->sys_object;

			$option["data"]		=$datas;
			$option["total"]	=count($datas);
			$option["inicio"]	=1;
			$option["fin"]		=count($datas);
			
			return $this->__VIEW_REPORT($option); 						 

		}		

					
	}
?>
