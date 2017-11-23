<?php
		$this->sys_fields_l18n	=array(
			"id"	    		=>"",
			"FECHA"	    		=>"Fecha",
			"HORA_INICIAL"	    =>"Inicio",
		);				

		$this->sys_view_l18n	=array(
			"action"    		=>"Guardar",
			"cancel"	    	=>"Cancela",
			"create"	   		=>"Crear",
			"kanban"			=>"Kanban",
			"report"			=>"Reporte",
			"module_title"    	=>"Reporte de paradas",
		);
		$this->sys_view_l18n["html_head_title"]="SOLES GPS";
		if(@$_SESSION["company"] and @$_SESSION["company"]["razonSocial"])
			$this->sys_view_l18n["html_head_title"].=" :: {$_SESSION["company"]["razonSocial"]} :: {$this->sys_view_l18n["module_title"]}";
?>
