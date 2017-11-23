<?php
	require_once("modelo.php");

	$objeto										=new principal();
	#$objeto->__PRINT_R($objeto);
	

	$objeto->words["system_menu"]               =$objeto->__TEMPLATE($objeto->sys_html."system_menu");
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");
	
	
	$objeto->words["html_head_js"]              ="../".$objeto->sys_module."js/index";								# ARCHIVOS JS DEL MODULO
	
	

	$objeto->words["system_module"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/show");	
	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);    


	$objeto->words["module_title"]              ="Vehiculos";
	#$objeto->words["module_left"]               =$objeto->__BUTTON($module_left);
	$objeto->words["module_center"]             ="SECCION CENTRAL";
	#$objeto->words["module_right"]              =$objeto->__BUTTON($module_right);;
		
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE PRINCIPAL.";
	$objeto->words["html_head_keywords"] 	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
	$objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";

    $objeto->html                               =$objeto->__VIEW_TEMPLATE("front_end", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>
