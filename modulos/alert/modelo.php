<?php
	class alert extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),			
			"fechaEvento"	    =>array(
			    "title"             => "Evento",
			    "type"              => "input",
			),
			"descripcion"	    =>array(
			    "title"             => "Descripcion",
			    "type"              => "html",
			),
			"asunto"	    =>array(
			    "title"             => "Asunto",
			    "title_filter"      => "Asunto",
			    "type"              => "input",
			),
			"device_id"	=>array(
			    "title"             => "Dispositivo",
			    "title_filter"      => "Dispositivo",
			    "description"       => "Dispositivo GPS",
			    "type"              => "autocomplete",
			    "procedure"       	=> "autocomplete_devices",  
			    #"relation"          => "one2many",
			    "relation"          => "many2one",
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "device_id",
			    "class_field_m"    	=> "id",			    
			),
			"geofence_id"	=>array(
			    "title"             => "Geocerca",
			    "title_filter"      => "Geocerca",
			    "description"       => "Son cercas geograficas",
			    "type"              => "autocomplete",
			    #"relation"          => "one2many",
			    "relation"          => "many2one",
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
		public function __VIEW_REPORT($option=NULL)
    	{    		
    		if(is_null($option)) 			$option					=array();
    		
    		$option["actions"]		=array(
    			"show"		=>"1",
    			"write"		=>"false",
    			"delete"	=>"false",
    			"check"		=>"false",
    		);
    		return parent::__VIEW_REPORT($option);
		}
		public function __BROWSE($option=NULL)
    	{
    		if(is_null($option)) 			$option					=array();
    		
    		if(!isset($option["where"])) 	$option["where"]		=array();
    		    		
    		$option["where"][]		="company_id='{$_SESSION["company"]["id"]}'";
    		$option["order"]		="fechaevento DESC";    		
    		return parent::__BROWSE($option);
		}
	}
?>

