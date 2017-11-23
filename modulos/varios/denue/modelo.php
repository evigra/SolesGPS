<?php
	if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class denue extends general
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
			"empresa"	    =>array(
			    "title"             => "empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"razon_social"	    =>array(
			    "title"             => "razon_social",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"actividad"	    =>array(
			    "title"             => "actividad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"personal"	    =>array(
			    "title"             => "personal",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"vialidad"	    =>array(
			    "title"             => "vialidad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"exterior"	    =>array(
			    "title"             => "exterior",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"interior"	    =>array(
			    "title"             => "interior",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"asentamiento"	    =>array(
			    "title"             => "asentamiento",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"cp"	    =>array(
			    "title"             => "cp",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"municipio"	    =>array(
			    "title"             => "municipio",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"telefono"	    =>array(
			    "title"             => "telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"mail"	    =>array(
			    "title"             => "Mail",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"web"	    =>array(
			    "title"             => "web",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"latitud"	    =>array(
			    "title"             => "Mail",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"longitud"	    =>array(
			    "title"             => "Mail",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();
		}
		
		public function report($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(				
				"denue.*",
			);
			$option["from"]		="denue";
			
			$return =$this->__VIEW_REPORT($option);    				
			return $return;
		}	

					
	}
?>
