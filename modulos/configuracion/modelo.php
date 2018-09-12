<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	#require_once("modulos/files/modelo.php");
	class configuracion extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
		var $sys_fields		=array(
			"id"			=>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			),		
			"company_id"	    	=>array(
			    "title"             => "Empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"variable"	    		=>array(
			    "title"             => "Variable",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"subvariable"	    	=>array(
			    "title"             => "SubVariable",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"tipo"	    	=>array(
			    "title"             => "Tipo",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"subtipo"	    	=>array(
			    "title"             => "SubTipo",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"objeto"	    	=>array(
			    "title"             => "Objeto",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "value"             => "",			    
			    "procedure"       	=> "autocomplete_modulos",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "modulo",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "objeto",
			    "class_field_m"    	=> "name",			    
			    
			),

			"valor"	    =>array(
			    "title"             => "valor",
			    "showTitle"         => "si",
			    "type"              => "input",
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
   	    	$datas["company_id"]=$_SESSION["company"]["id"];
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
	}
?>
