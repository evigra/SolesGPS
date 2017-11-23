<?php
	if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class device_geofence extends general
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
			"name"	    =>array(
			    "title"             => "Geocerca",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			
			"points"	    =>array(
			    "title"             => "Puntos",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			    
			),
			"geofence_email_in"	    =>array(
			    "title"             => "Email al entrar",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"geofence_email_out"	    =>array(
			    "title"             => "Email al salir",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"company_id"	    =>array(
			    "title"             => "Compania",
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
    		$datas["company_id"]    =$_SESSION["company"]["id"];
    		parent::__SAVE($datas,$option);
		}	
		public function geofence($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		
			$option["select"]   =array("g.*",);			
			$option["from"]		="geofences g";
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
