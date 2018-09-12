<?php
	#if(file_exists("../device/modelo.php")) 
	#require_once("../device/modelo.php");
	#if(file_exists("device/modelo.php")) 
	#require_once("device/modelo.php");
	
	class modulo extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $sys_table		="modulos";
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			),
			"name"	    =>array(
			    "title"             => "Nombre",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"clase"	    =>array(
			    "title"             => "Clase",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"descripcion"	    =>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"menu"	    =>array(
			    "title"             => "URL",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			
		);						
		##############################################################################	
		##  Metodos	
		##############################################################################
		public function autocomplete_modulos()		
    	{	
    		$option					=array();
  			$option["select"]		=array();    		
    		$option["where"]		=array();    		
    		
    		$option["where"][]		="name LIKE '%{$_GET["term"]}%'";
    		
			$return =$this->__BROWSE($option);    				
			return $return;			
		}				

	}
?>
