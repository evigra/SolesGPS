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
			#$comando="/opt/traccar/bin/traccar status;";			
		}
		public function __EXEC($comando)
		{
			return shell_exec($comando);
		}					
		function traccar_exist() 
		{ 
			if(@file_get_contents("http://solesgps.com:8082"))
			{
				$comando="sudo /opt/traccar/bin/traccar stop; sudo /opt/traccar/bin/traccar start;";
				$objeto->__EXEC($comando);
			}	
		}		
	}
?>
