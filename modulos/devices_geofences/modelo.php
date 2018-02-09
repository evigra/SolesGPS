<?php
	class devices_geofences extends general
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
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"time"	    =>array(
			    "title"             => "Entrada",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"time_end"	    =>array(
			    "title"             => "Salida",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"diferencia"	    =>array(
			    "title"             => "Tiempo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"deviceid"	=>array(
			    "title"             => "Dispositivo",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/devices/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "deviceid",
			    "class_field_m"    	=> "id",			    
			),
			"geofenceid"	=>array(
			    "title"             => "Geocerca",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/geofences/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "geofences",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "geofenceid",
			    "class_field_m"    	=> "id",			    
			),
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			#$this->menu_obj=new menu();
			parent::__CONSTRUCT();

		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		$datas["company_id"]    =$_SESSION["company"]["id"];
    	    $alert_id				=parent::__SAVE($datas,$option);
    	    

		}						
		public function __BROWSE($option=NULL)
    	{
    		
    		if(is_null($option)) 			$option					=array();
    		
    		#if(!isset($option["select"])) 	$option["select"]		=array();
    		if(!isset($option["where"])) 	$option["where"]		=array();
    		#if(!isset($option["group"])) 	$option["group"]		="time";
    		
    		#$option["order"]		="fechaevento DESC";
    		
    		#$option["select"]["DISTINCT(time)"]					="time";
    		#$option["select"][]									="*";
    		#$option["select"]["TIMEDIFF(time_end,time)"]		="diferencia";
    		/*
    		$option["select"][]									="time_end";
    		
    		$option["select"][]									="deviceid";
    		$option["select"][]									="geofenceid";
    		*/
    		
    		
    		
    		$option["where"][]									="company_id='{$_SESSION["company"]["id"]}'";
    		$option["where"][]									="time_end>time";
    		#$option["where"][]									="TIMEDIFF(time_end,time) >'00:02:00'"; 
    		
    		
    		#$option["echo"]			="Alert";
    		
    		#$option["order"]		="fechaevento DESC";
    		return parent::__BROWSE($option);
		}

		public function __REP_GENERAL($option=NULL)
    	{
    		
    		if(is_null($option)) 			$option					=array();
    		
    		#if(!isset($option["select"])) 	$option["select"]		=array();
    		if(!isset($option["where"])) 	$option["where"]		=array();
    		#if(!isset($option["group"])) 	$option["group"]		="time";
    		
    		#$option["order"]		="fechaevento DESC";
    		
    		#$option["select"]["DISTINCT(time)"]					="time";
    		#$option["select"][]									="*";
    		#$option["select"]["TIMEDIFF(time_end,time)"]		="diferencia";
    		
    		#$option["where"][]									="company_id='{$_SESSION["company"]["id"]}'";
    		#$option["where"][]									="time_end>time";
    		#$option["where"][]									="TIMEDIFF(time_end,time) >'00:02:00'"; 
    		
     		
    		#$option["order"]		="fechaevento DESC";
    		return parent::__VIEW_REPORT($option);
		}

	}
?>

