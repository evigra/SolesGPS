<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class event extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
				"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"protocolo"	    	=>array(
			    "title"             => "Protocolo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"codigo"	    =>array(
			    "title"             => "Codigo del Evento",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),	
			"descripcion"	    =>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"estatus"	    =>array(
			    "title"             => "Estatus",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"fechaRegistro"	    =>array(
			    "title"             => "Fecha de Registro",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE

        /*
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();

		}
				
		*/
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    #$datas["company_id"]=$_SESSION["user"]["company_id"];
    		parent::__SAVE($datas,$option);
		}		
		public function __FIND_FIELDS($id=NULL)
		{

			if(!is_null($id))
			{
				
				$option=array("where"=>array("id='$id'",)	);	
				
				$datas	=$this->events($option);
				
				#$this->__PRINT_R($datas);
				
				if(count($datas["data"])>0)
				{
					foreach(@$datas["data"][0] as $field =>$value)
					{
					    $eval="$"."this->sys_fields[\"$field\"]"."[\"value\"]=\"$value\";";
					    eval($eval);
					}
				}
				
			}
			    
    	}		
		public function events($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		
			$option["select"]   =array(
					"event.*",
					//"IF(vehicle=1,'../modulos/device/img/car.png','../modulos/device/img/cell.png')"	=>"file_id",
			);
			$option["from"]     ="event";
			
			#if(!isset($option["where"]))    $option["where"]    =array();
			
			//$option["where"][]      ="company_id={$_SESSION["user"]["company_id"]}";
			
			#$this->__PRINT_R($option);
			
			return $this->__VIEW_REPORT($option);
    	
		}		
		
	}
?>
