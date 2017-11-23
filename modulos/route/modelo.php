<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class route extends general
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
			"company_id"	    =>array(
			    "title"             => "empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),		

			"name"	    =>array(
			    "title"             => "Ruta",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			/*
			"description"	    =>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			    
			),
			*/
			"start"	    =>array(
			    "title"             => "Origen",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"end"	    =>array(
			    "title"             => "Destino",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"costo"	    =>array(
			    "title"             => "Costo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),				
			"venta"	    =>array(
			    "title"             => "Venta",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),				
			"distancia"	    =>array(
			    "title"             => "Distancia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"inegi1"	    =>array(
			    "title"             => "Distancia",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),
			"inegi2"	    =>array(
			    "title"             => "Distancia",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),
			
			/*				
			"text"	    =>array(
			    "title"             => "Indicaciones",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),
			*/			
			"tiempo"	    =>array(
			    "title"             => "Tiempo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"points"	    =>array(
			    "title"             => "Tiempo",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),			
			"points_route"	    =>array(
			    "title"             => "Tiempo",
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
		
		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		/*
    		echo "SAVE MODULO";
    		$this->__PRINT_R($datas);
    		*/
    		#$option["echo"]="ROUTE";
    		$datas["company_id"]    =$_SESSION["company"]["id"];
    		parent::__SAVE($datas,$option);
		}	
		public function report($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		
			$option["select"]   =array("route.*",);			
			$option["from"]		="route";
			#$option["echo"]		="geofence";
            
			$option["where"]	=array(
			    "company_id={$_SESSION["company"]["id"]}",
			    #"company_id=3",
			);
            
			#$option["order"]	="date DESC";
			
			return $this->__VIEW_REPORT($option);						
		}		
	}
?>
