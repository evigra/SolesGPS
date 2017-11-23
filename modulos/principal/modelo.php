<?php
	require_once("nucleo/general.php");
	class principal extends general
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
			"responsable"	    =>array(
			    "title"             => "Responsable",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			"ubicacion"	    =>array(
			    "title"             => "Ubicacion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),	
			"bastidor"	    =>array(
			    "title"             => "Bastidor",
			    "showTitle"         => "si",
			    "type"              => "font",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        /*
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();

		}
		*/
		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		/*
    		echo "SAVE MODULO";
    		$this->__PRINT_R($datas);
    		*/
    		parent::__SAVE($datas,$option);
    		#$this->__PRINT_R($this->sys_sql);
    		
		}		
	}
?>
