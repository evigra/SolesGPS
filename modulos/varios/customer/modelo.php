<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class customer extends general
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
			"clave"	    	=>array(
			    "title"             => "Clave",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"razonSocial"	    	=>array(
			    "title"             => "Razon Social",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"RFC"	    	=>array(
			    "title"             => "RFC",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"domicilio"	    	=>array(
			    "title"             => "Domicilio",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"ciudad"	    	=>array(
			    "title"             => "Ciudad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"codigoPostal"	    	=>array(
			    "title"             => "CP",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"contacto"	    	=>array(
			    "title"             => "contacto",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"puesto"	    	=>array(
			    "title"             => "puesto",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"telefono"	    	=>array(
			    "title"             => "telefono",
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

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


		public function __CONSTRUCT()
		{
			
			$this->files_obj	=new files();	
			parent::__CONSTRUCT();
		}
				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];
    	    
    		parent::__SAVE($datas,$option);
		}		

		public function reporte($option=NULL)
    	{
    		if(is_null($option))	$option=array();

			$option["select"]   =array("c.*");
			$option["from"]     ="customer c";
			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="c.company_id={$_SESSION["company"]["id"]}";

			$return =$this->__VIEW_REPORT($option);
			return	$return;     	
		}		
		
	}
?>
