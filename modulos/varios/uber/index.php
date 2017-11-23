<?php
	require_once("modelo.php");

	$objeto										=new uber();
	$objeto->__SESSION();
	#$objeto->__PRINT_R($objeto);

	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/create");	
	$objeto->words               				=$objeto->__INPUT($objeto->words,$objeto->sys_fields);    
	
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS(array("maps","../".$objeto->sys_module."js/index"));
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS(array("maps","../".$objeto->sys_module."js/index"));
	
	
	
    $module_center=array(
        array("accion_punto"=>"ORIGEN"),
        array("finalizar_punto"=>"DESTINO")
    );    
    $module_title                                   ="";

	
	#/*
	$objeto->words["module_title"]              ="$module_title Ruta";

	$objeto->words["module_center"]             =$objeto->__BUTTON($module_center);

	
	#if()
	
	#$objeto->__PRINT_R($_SESSION["user"]);
	$objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
	
	#*/
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE GEOCERCAS.";
	$objeto->words["html_head_keywords"] 	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
		
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("front_end", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>
