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

		public function __VIEW_REPORT($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(				
				"s.*",
				"u.*",
				"c.*",
			);
			$option["from"]		="
				sesion s join
				users u on s.user_id=u.id join
				company c on c.id=u.company_id
			";
			$option["order"]		="date desc";
			
			#$option["where"]=" and u.company_id={$_SESSION["company"]["id"]} or u.id={$_SESSION["user"]["id"]}";
			if(!isset($option["where"]))
				$option["where"]=" and u.company_id={$_SESSION["company"]["id"]}";
			$return =parent::__VIEW_REPORT($option);    				
			return $return;
		}				

	}
?>

