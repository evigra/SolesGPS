<?php
	require_once("nucleo/sesion.php");
	#require_once("modulos/position/modelo.php");
	
	$_SESSION["seguimiento_md5"]=$_REQUEST["a"];		
	
	$objeto										=new seguimientos();
	
	$_SESSION["module"]=array();
	$_SESSION["module"]["sys_section"]			=$objeto->sys_private["section"];
	

	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");	
	$files_js=array("maps","responsivevoice");
	#$files_js=array("maps");
	$files_js[]="../{$objeto->sys_module}js/map";
	
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_var["module_path"] . "html/streetmap");	
	
	
	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields); 
    	    	    
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS($files_js);								# ARCHIVOS JS DEL MODULO
	#$objeto->words["html_head_css"]              =$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
	
    $objeto->words["system_menu"]           	=$objeto->__MENU_SEGUIMIENTO();    	

	$objeto->words["module_title"]              ="REPORTE DE POSICIONES";
	
	#$objeto->words[""]
	
    $objeto->words["html_head_description"] =   "Solicito su colaboracion, se han robado mi vehiculo.  ";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="NECESITO AYUDA :: SE ACABAN DE ROBAR MI VEHICULO";

    $objeto->html                               =$objeto->__VIEW_TEMPLATE("front_end", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>

