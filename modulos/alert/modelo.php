<?php
	class alert extends general
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
			"fechaEvento"	    =>array(
			    "title"             => "Evento",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"descripcion"	    =>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "html",
			    "default"           => "",
			    "value"             => "",			    
			),
			"asunto"	    =>array(
			    "title"             => "Asunto",
			    "title_filter"      => "Asunto",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"device_id"	=>array(
			    "title"             => "Dispositivo",
			    "title_filter"      => "Dispositivo",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "procedure"       	=> "autocomplete_devices",  
			    "relation"          => "one2many",			    
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "device_id",
			    "class_field_m"    	=> "id",			    
			),
			"geofence_id"	=>array(
			    "title"             => "Geocerca",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/geofences/ajax/autocomplete.php",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "geofences",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "geofence_id",
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
    	    return parent::__SAVE($datas,$option);
		}						
		public function __BROWSE($option=NULL)
    	{
    		
    		if(is_null($option)) 			$option					=array();
    		
    		if(!isset($option["where"])) 	$option["where"]		=array();
    		    		
    		$option["where"][]		="company_id='{$_SESSION["company"]["id"]}'";
    		$option["order"]		="fechaevento DESC";
    		$option["action"]		=array(
    			"show"		=>"1",
    			"write"		=>false,
    			"delete"	=>false,
    			"check"		=>false,
    		);
    		
    		#$option["echo"]			="Alert";
    		
    		return parent::__BROWSE($option);
		}
	}
?>

