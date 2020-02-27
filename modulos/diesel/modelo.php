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
			$option["select"]["right(left(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),16),11)"]                 ="devicetime";
			$option["select"]["if(extract_JSON(p.attributes,'io3') is null ,0,round(avg(left(extract_JSON(p.attributes,'io3'),4)),2))"]	="diesel";
			#$option["select"][]	="round(avg(speed*1.852))";
			$option["select"][]	="if(round(avg(speed*1.852))<5,100,0)";
			$option["where"][]				="'{$this->sys_fields["start"]["value"]}'<=DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)";
			$option["where"][]				="'{$this->sys_fields["end"]["value"]}'>=DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)";
			$option["where"][]				="deviceid ='{$this->sys_fields["deviceid"]["value"]}'";							
            $option["group"]	            ="left(devicetime,15)";
			$option["order"]				="devicetime ASC";
						
			$option["title"]	="['Hora','% Tanque de Diesel','Vehiculo parado'],";
			#$option["echo"]	="DIESEL";
			$option_graph["AreaChart1"]=$option;

            ############################################
			$option				=array();	
			#$option["select"]["left(right(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),8),5)"]	="devicetime";
			$option["select"]["
			    if(right(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),5)=='00:00')
			        right(left(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),16),11)
			    else
			        right(left(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),16),6)
			            
			"]	                            ="devicetime";
			$option["select"]["if(extract_JSON(p.attributes,'io3') is null ,0,round(avg(left(extract_JSON(p.attributes,'io3'),4)),2))"]	="diesel";
			$option["select"][]	            ="round(avg(speed*1.852))";
			$option["where"][]				="'{$this->sys_fields["start"]["value"]}'<=DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)";
			$option["where"][]				="'{$this->sys_fields["end"]["value"]}'>=DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)";
			$option["where"][]				="deviceid ='{$this->sys_fields["deviceid"]["value"]}'";							
            $option["group"]	            ="left(devicetime,15)";
			$option["order"]				="devicetime ASC";
						
			$option["title"]	="['Hora','% Tanque de Diesel','Speed'],";
			#$option["echo"]	="DIESEL";
			$option_graph["AreaChart2"]=$option;
            

			$option_graph["ColumnChart1"]=$option;

			return parent::__VIEW_GRAPH($option_graph);
		}		
		
	}
?>
