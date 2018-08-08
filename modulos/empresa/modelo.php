<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class empresa extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
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
			"nombre"	    	=>array(
			    "title"             => "Empresa",
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
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"proveedor"	    	=>array(
			    "title"             => "Proveedor",
			    "showTitle"         => "si",
			    "type"              => "input",
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
			"chat_whatsapp"	    	=>array(
			    "title"             => "Grupo WhatsApp",
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
			
			#$this->files_obj	=new files();	
			parent::__CONSTRUCT();
		}
				
		
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];    
    	    
    	    if(!isset($datas["razon_social"]))	$datas["razon_social"]=$datas["nombre"];
    	    	        	    
    		return parent::__SAVE($datas,$option);
		}		
		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="company_id={$_SESSION["company"]["id"]}";
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}				
		public function autocomplete_empresa()		
    	{	
    		$option					=array();
    		$option["where"]		=array();    		
    		$option["where"][]		="nombre LIKE '%{$_GET["term"]}%'";
    		
    		$option["echo"]			="autocomplete_empresa";
    		
    		
    		
			$return =$this->__BROWSE($option);    				
			return $return;			
		}				
		
	}
?>
