<?php
	class plantilla_venta extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="TV";
		
		#var $movimiento_obj;
		
		##############################################################################	
		##  Metodos	
		##############################################################################
        
		public function __CONSTRUCT($option=NULL)
		{	
			parent::__CONSTRUCT($option);		
		}
		##############################################################################
		/*
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}	
		*/
		##############################################################################
		public function __CRON($option=NULL)		
    	{	
    		if(is_null($option))			$option				=array();
    		if(is_null(@$option["select"]))	$option["select"]	=array();
    		if(is_null(@$option["where"]))	$option["where"]	=array();	
			
			$option["select"][]="movimiento.*";
			$option["select"]["
					CASE
						WHEN cron_unidad='DAY' 		THEN DATE_ADD(LEFT(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10), INTERVAL cron_cantidad DAY)
						WHEN cron_unidad='MONTH' 	THEN DATE_ADD(LEFT(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10), INTERVAL cron_cantidad MONTH)
						WHEN cron_unidad='YEAR' 	THEN DATE_ADD(LEFT(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10), INTERVAL cron_cantidad YEAR)
					END				
			"]		="caducidad";
			$option["select"]["LEFT(now(),10)"]		="fecha";
			
			$option["where"][]="
				(
					LEFT(caducidad,10)= LEFT(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10) 
					OR (LEFT(caducidad,10)='0000-00-00' AND LEFT(fecha,10)='0000-00-00') 
					OR (LEFT(caducidad,10)='0000-00-00' AND LEFT(fecha,10)=LEFT(now(),10)) 
				 )
			";
			$option["where"][]						="cron_cantidad>0";
			$option["where"][]						="estatus=1";
		
		
			$crons_data 							=$this->__BROWSE($option);			
		
			foreach($crons_data["data"] as $rows)
			{				
				$this->sys_private["id"]				=$rows["id"];
				$rows["tipo"]						=$this->tipo_movimiento;
				$this->__SAVE($rows);
				
				$rows["tipo"]						="OV";
				#if($this->request["sys_section_". $this->sys_object]=="create")
				{
					$option_folios					=array();
					$option_folios["tipo"]			=$rows["tipo"];								
					$option_folios["variable"]		=date("Y");
					$option_folios["company_id"]	=$rows["company_id"];
					$rows["folio"]					=$this->__FOLIOS($option_folios);
				}	
				unset($rows["id"]);								
				unset($rows["cron_cantidad"]);
				unset($rows["cron_unidad"]);
				
				foreach($rows["movimientos_ids"] as $indice => $row)
				{
					unset($rows["movimientos_ids"][$indice]["movimiento_id"]);
					unset($rows["movimientos_ids"][$indice]["id"]);
				}
								
				$this->sys_private["id"]		="";
				$this->__SAVE($rows);
				
				@$txt_WA="";
				
			}
		}
		##############################################################################		
   		public function __VIEW_REPORT($option="")
    	{			    	
			if($option=="")	$option=array();			
			$option["color"]["red"]	="$"."row[\"estatus\"]=='0'";
			return parent::__VIEW_REPORT($option);
		}							
		##############################################################################
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla

			if(!isset($this->sys_private["order"]))
				$option["order"]="id desc";
			
			return parent::__BROWSE($option);
		}							
	}
?>

