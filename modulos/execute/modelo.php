<?php
	#if(file_exists("../device/modelo.php")) require_once("../device/modelo.php");	
	class execute extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $log=array();
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################        
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();
			#$ultima_linea = passthru('/opt/traccar/bin/traccar status', $var);
			$ultima_linea = passthru('ls', $var);		
			
			#echo $var;	
		}			
	}
?>
