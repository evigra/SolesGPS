<?php
	class event extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
				"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),		
			"protocolo"	    	=>array(
			    "title"             => "Protocolo",
			    "type"              => "input",
			),
			"codigo"	    =>array(
			    "title"             => "Codigo del Evento",
			    "type"              => "input",
			),	
			"descripcion"	    =>array(
			    "title"             => "Descripcion",
			    "type"              => "input",
			),
			"estatus"	    =>array(
			    "title"             => "Estatus",
			    "type"              => "input",
			),						
			"fechaRegistro"	    =>array(
			    "title"             => "Fecha de Registro",
			    "type"              => "input",
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
			
			return $this->__VIEW_REPORT($option);
    	
		}		
		
	}
?>
