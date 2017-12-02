<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class servicios extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
				"id_servicio"	    =>array(
			    "title"             => "Clave",
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
			"descripcion"	    	=>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"nombre"	    	=>array(
			    "title"             => "Nombre",
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
			"Fecha_de_registro"	    	=>array(
			    "title"             => "registrodo desde",
			    "showTitle"         => "si",
			    "type"              => "date",
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


	
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	  //  $datas["company_id"]		=$_SESSION["company"]["id"];    	        	    
    		parent::__SAVE($datas,$option);
		}		

		public function __BROWSE($option=NULL)
    	{
    		
			$return =parent::__BROWSE($option);
			return	$return;     	
		}		



		
		
	}
?>
