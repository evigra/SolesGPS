<?php
	#require_once("modelo.php");

	$objeto	=new sesiones();
	#$objeto->__PRINT_R($objeto);

	$objeto->words["html_head_description"]			="SolesGPS desarrollo su propia plataforma de rastreo vehicular y celular, con la finalidad de satisfacer las nececidades de sus clientes";
	$objeto->words["html_head_keywords"] 			="GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
	$objeto->words["html_head_title"]           	="SOLES GPS :: Iniciar sesion";

	$objeto->words["html_head_css"]					= $objeto->__FILE_CSS(array(
		"../".$objeto->sys_module."css/index",		
		));	
	
	
	$objeto->words["html_head_js"] 					=$objeto->__FILE_JS(array("../".$objeto->sys_module."js/index"));	
		

		$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
		$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");	
	
		$option=array();
		$option["template_title"]	                =$objeto->sys_module . "html/report_title";
		$option["template_body"]	                =$objeto->sys_module . "html/report_body";
		
		$data										=$objeto->sesion($option);
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Reporte de ";
		
    
    	$view	="system";
 		
	$objeto->html                  					= $objeto->__VIEW_TEMPLATE($view, $objeto->words);
	$objeto->words["module_title"]					="Sesiones registradas";
	$objeto->words["module_left"]					="";
	$objeto->words["module_center"]					="";
	$objeto->words["module_right"]					="";
	
	if(!array_key_exists("mensaje_sesion",$objeto->words))
		$objeto->words["mensaje_sesion"]			="";
	
	$objeto->__VIEW($objeto->html);    
	


?>

