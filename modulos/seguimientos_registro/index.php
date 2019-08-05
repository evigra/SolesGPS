<?php
	require_once("nucleo/sesion.php");
	$objeto							=	new seguimientos_registro();
	
	#$objeto->__SESSION();

	
	
	# TEMPLATES O PLANTILLAS ELEJIDAS PARA EL MODULO
	$objeto->words["system_body"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_body");	
	#$objeto->words["system_module"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_module");
	
	# CARGA DE ARCHIVOS EXTERNOS JS, CSS
	$objeto->words["html_head_js"]	=	$objeto->__FILE_JS(array("../".$objeto->sys_var["module_path"]."/js/index"));

		
	# CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA
	$objeto->words["system_module"]	=	$objeto->__VIEW_WRITE();	    	
	$objeto->words               	=	$objeto->__INPUT($objeto->words,$objeto->sys_fields);
	$objeto->tab_files();    	

	
	# CARGANDO LOS BOTONES LA LA VISTA
	$objeto->words["module_left"]  	=	"";
	$objeto->words["module_center"]	=	"";
	$objeto->words["module_right"]	=	"";
		

    $objeto->words["system_menu"]           	=$objeto->__MENU_SEGUIMIENTO();    	

	$objeto->words["module_title"]              ="REGISTRO DEL DISPOSITIVO";
	
	#$objeto->words[""]
	
    $objeto->words["html_head_description"] =   "EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE POSICIONES RECIBIDAS DURANTE EL RASTREO SATELITAL.";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";

    $objeto->html                               =$objeto->__VIEW_TEMPLATE("front_end", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>

