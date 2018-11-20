<?php
	class movimiento_plantilla extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="PL";
		
		var $movimiento_obj;
		
		##############################################################################	
		##  Metodos	
		##############################################################################
        
		public function __CONSTRUCT()
		{	
			$this->movimiento_obj		=new movimiento();			
			parent::__CONSTRUCT();		
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		if(!isset($datas["tipo"]) OR $datas["tipo"]=="")
	    		$datas["tipo"]						=$this->tipo_movimiento;								
	    		
			if($this->request["sys_section_". $this->sys_object]=="create")
			{
				$option_folios=array();
				$option_folios["tipo"]			=$datas["tipo"];
				$datas["folio"]					=$this->__FOLIOS($option_folios);
			}				
			
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
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
		
			$crons_data 							=$this->__BROWSE($option);			
		
			foreach($crons_data["data"] as $rows)
			{				
				$this->sys_primary_id				=$rows["id"];
				$rows["tipo"]						=$this->tipo_movimiento;
				$this->__SAVE($rows);
				
				$rows["tipo"]						="SO";
				#if($this->request["sys_section_". $this->sys_object]=="create")
				{
					$option_folios					=array();
					$option_folios["tipo"]			=$rows["tipo"];								
					$option_folios["variable"]		=date("Y");
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
								
				$this->sys_primary_id		="";
				$this->__SAVE($rows);
			}
		}		
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla
			
			if(!isset($this->request["sys_order_". $this->sys_object]))
				$option["order"]="id desc";
			
			return parent::__BROWSE($option);
		}							
	}
?>

