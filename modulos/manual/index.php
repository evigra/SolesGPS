<?php
	$objeto							=	new manual();
	
	$objeto->words["system_body"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_body");	# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_module");
		
	$objeto->words["html_head_js"]	=	$objeto->__FILE_JS();

	$module_title                	=	"Crear ";


	$objeto->words["module_body"]	=	$objeto->__VIEW_CREATE();
	
	if($_REQUEST["sys_section"]=="metodos")
	{
		$objeto->words["module_title"]	=	"Manual :: Input";
		$objeto->words["module_body"]	=	$objeto->__VIEW_CREATE($objeto->sys_var["module_path"]."html/input");		

	}
	else
	{	##### METODOS

		$objeto->words["module_title"]	=	"Manual :: Metodos";
		$objeto->words["module_body"]	=	$objeto->__VIEW_CREATE($objeto->sys_var["module_path"]."html/metodos");		

	}
		
	$objeto->words["module_title"]	=	"$module_title Manual";

	$objeto->words["html_head_title"]		=	"SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE DISPOSITIVOS GPS.";
	$objeto->words["html_head_keywords"]	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
	
    $objeto->html                       	=	$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>
