<?php
	require_once("modulos/position/modelo.php");
	require_once("modelo.php");

	$objeto										=new map();
	$objeto->__SESSION();
	#$_SESSION["module"]=array();
	#$_SESSION["module"]["sys_section"]			=$objeto->sys_section;
	
	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$files_js=array("maps","responsivevoice");
	#$files_js=array("maps");	
	#$files_js[]="../{$objeto->sys_module}js/map";
	$files_js[]="../{$objeto->sys_module}js/map";        
	
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/map");	
	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      

	$objeto->words["html_head_js"]              =$objeto->__FILE_JS($files_js);								# ARCHIVOS JS DEL MODULO
	$objeto->words["html_head_css"]              =$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
	
    $objeto->words["system_submenu2"]           =$objeto->menu_vehicle();    	

	$objeto->words["module_title"]              ="MAP ONLINE";
	
    $objeto->words["html_head_description"] =   "EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE POSICIONES RECIBIDAS DURANTE EL RASTREO SATELITAL.";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
    
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system_menu_module", $objeto->words);
    $objeto->__VIEW($objeto->html);
    
    #$objeto->__PRINT_R($_SESSION);
?>
