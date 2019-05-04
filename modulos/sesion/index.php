<?php	
	$objeto	=new sesion();

	$objeto->words["html_head_description"]			="SolesGPS desarrollo su propia plataforma de rastreo vehicular y celular, con la finalidad de satisfacer las nececidades de sus clientes";	
	$objeto->words["html_head_keywords"] 			="GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
	$objeto->words["html_head_title"]           	="SOLES GPS :: Iniciar sesion";

	$objeto->words["html_head_css"]					=$objeto->__FILE_CSS(array("../".$objeto->sys_var["module_path"]."css/index",));	
	$objeto->words["html_head_js"] 					=$objeto->__FILE_JS(array("../".$objeto->sys_var["module_path"]."js/index"));	
		
		
	$objeto->words["system_module"]					=$objeto->__VIEW_CREATE();		
	$objeto->words                 					=$objeto->__INPUT($objeto->words,$objeto->sys_fields);    
	$objeto->words["system_menu"]   				=$objeto->__TEMPLATE($objeto->sys_html."system_menu");    
	$view	="front_end";
	
 		
	$objeto->html                  					= $objeto->__VIEW_TEMPLATE($view, $objeto->words);
	$objeto->words["module_title"]					="Sesiones registradas";
	$objeto->words["module_left"]					="";
	$objeto->words["module_center"]					="";
	$objeto->words["module_right"]					="";
	
	if(!array_key_exists("mensaje_sesion",$objeto->words))
		$objeto->words["mensaje_sesion"]			="";
	
	$objeto->__VIEW($objeto->html);    
?>

