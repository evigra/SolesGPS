<?php
/*
	if(@file_exists("nucleo/GeometryLibrary/vendor/autoload.php"))			require_once("nucleo/GeometryLibrary/vendor/autoload.php");
	if(@file_exists("../nucleo/GeometryLibrary/vendor/autoload.php"))		require_once("../nucleo/GeometryLibrary/vendor/autoload.php");
	if(@file_exists("../../nucleo/GeometryLibrary/vendor/autoload.php"))	require_once("../../nucleo/GeometryLibrary/vendor/autoload.php");				
*/	
	class diesel extends position
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################

		##############################################################################	
		##  Metodos	
		##############################################################################        		/*
		public function __CONSTRUCT($option=NULL)
		{
			$this->sys_fields["start"]["type"]		="datetime";
			$this->sys_fields["start"]["title"]		="Fecha Inicial";

			$this->sys_fields["end"]["type"]		="datetime";
			$this->sys_fields["end"]["title"]		="Fecha Final";
					
			$this->sys_table						="position";
			$this->sys_module						="diesel";
			
			parent::__CONSTRUCT($option);
		}

		public function __VIEW_GRAPH($option_graph=array(),$template=NULL)
		{
		    
		
			$option				=array();	
			#$option["select"]["left(right(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),8),5)"]	="devicetime";
			$option["select"]["right(left(devicetime,16),11)"]	="devicetime";
			$option["select"][]				="if(extract_JSON(p.attributes,'io3') is null ,0,round(avg(left(extract_JSON(p.attributes,'io3'),4)),2))";
			$option["where"][]				="DATE_SUB('{$this->sys_fields["start"]["value"]}',INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)<=DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)";
			$option["where"][]				="DATE_SUB('{$this->sys_fields["end"]["value"]}',INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)>=DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)";
			$option["where"][]				="deviceid ='{$this->sys_fields["deviceid"]["value"]}'";							
            $option["group"]	            ="left(devicetime,15)";
			$option["order"]				="devicetime ASC";
			
			
			$option["title"]	="['Hora','% Tanque de Diesel'],";
			#$option["echo"]	="DIESEL";
			$option_graph["AreaChart"]=$option;

			return parent::__VIEW_GRAPH($option_graph);
		}		
		
	}
?>
