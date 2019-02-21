<?php
	$objeto							=	new manual();
	#$objeto->__SESSION();
	#$objeto->__PRINT_R($objeto);
	
	$objeto->words["system_body"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_body");	# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_module");
	
	
	$objeto->words["html_head_js"]	=	$objeto->__FILE_JS(array("../".$objeto->sys_module."js/index"));
	
    $module_center	=	"";
    $module_title	=	"";


	$module_title                	=	"Crear ";

	$objeto->words["module_body"]	=	$objeto->__VIEW_CREATE($objeto->sys_module."html/create");	
	$objeto->words               	=	$objeto->__INPUT($objeto->words,$objeto->sys_fields);    


	
	#$objeto->words["module_title"]	=	"$module_title Dispositivos";
	#$objeto->words["module_left"]  	=	$objeto->__BUTTON($module_left);
	#$objeto->words["module_center"]	=	$module_center;
	#$objeto->words["module_right"]	=	$objeto->__BUTTON($module_right);;
		
	#$objeto->__PRINT_R($_SESSION["user"]);
	$objeto->words["html_head_title"]		=	"SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE DISPOSITIVOS GPS.";
	$objeto->words["html_head_keywords"]	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
	
    $objeto->html                       	=	$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);
	#$objeto->__PRINT_R($objeto->sys_fields);
    
    
?>
