<?php
	class sesiones extends sesion
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_mensaje="";
		var $sys_table	="sesion";
		var $sys_fields	=array(
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"user"	    =>array(
			    "title"             => "Usuario",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"pass"	    =>array(
			    "title"             => "Password",
			    "showTitle"         => "si",		
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),
			
			"user_id"	    =>array(
			    "title"             => "Nombre",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"server_addr"	    =>array(
			    "title"             => "Servidor",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"date"	    =>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),
			"remote_addr"	    =>array(
			    "title"             => "Servidor",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"http_user_agent"	    =>array(
			    "title"             => "Agente",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

	}
?>

