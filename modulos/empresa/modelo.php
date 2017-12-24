<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class empresa extends general
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
			"company_id"	    	=>array(
			    "title"             => "Compañia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"clave"	    	=>array(
			    "title"             => "Clave",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"razon_social"	    	=>array(
			    "title"             => "Razon Social",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"rfc"	    	=>array(
			    "title"             => "RFC",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"domicilio_fiscal"	    	=>array(
			    "title"             => "Domicilio",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"persona_fisica"	    	=>array(
			    "title"             => "Persona Fisica",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"fecha_registro"	    	=>array(
			    "title"             => "registro",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"cliente"	    	=>array(
			    "title"             => "Cliente",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"proveedor"	    	=>array(
			    "title"             => "Proveedor",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",			    
			),						
			"email"	    	=>array(
			    "title"             => "Email",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"telefono"	    	=>array(
			    "title"             => "Telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),	
			"extension"	    	=>array(
			    "title"             => "Extension",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),				
			"trabajador"	    	=>array(
			    "title"             => "Trabajador",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),							
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


		public function __CONSTRUCT()
		{
			
			$this->files_obj	=new files(array("temporal"=>"AUX_DEVICE"));
			parent::__CONSTRUCT();
		}
				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];    	        	    
    		parent::__SAVE($datas,$option);
		}		

		public function __BROWSE($option=NULL)
    	{
    		if(is_null($option))	$option=array();
			#$option["echo"]   =array("EMPRESA");
			$option["select"]   =array(
				"e.*",
				"
					CASE 
						WHEN cliente=1 	THEN 'SI'
						ELSE ''
					END
				"=>"cliente",
				"
					CASE 
						WHEN proveedor=1 	THEN 'SI'
						ELSE ''
					END
				"=>"proveedor",
				
			);
			$option["from"]     ="empresa e";
			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="company_id={$_SESSION["company"]["id"]}";

			$return =parent::__BROWSE($option);
			return	$return;     	
		}		
		
	}
?>
