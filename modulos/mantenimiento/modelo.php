<?php

	class mantenimiento extends crons
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			$this->sys_table="crons";
			
			/*
			$this->sys_fields["clave"]	    =array(
			    "title"             => "Dispositivo",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/devices/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "device_id",
			    "class_field_m"    	=> "id",			    
			);
			*/
			parent::__CONSTRUCT();					
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		$datas["company_id"]    =$_SESSION["company"]["id"];
    		$datas["tipo_cron"]    	="mantenimiento";
    		
    		parent::__SAVE($datas,$option);
		}		

   		public function __BROWSE($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		if(!is_array($option))	$option=array();    		
    		
    		if(!isset($option["where"]))	$option["where"]	=array();
    		
    		$option["where"][]="company_id='{$_SESSION["company"]["id"]}'";
    		$option["where"][]="tipo_cron='mantenimiento'";
    		
    		#$option["echo"][]="MANTE";
    		
    		return parent::__BROWSE($option);
		}
	
	}
?>
