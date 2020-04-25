<?php
	require_once("nucleo/sesion.php");

    #print_r($_REQUEST);
    	
	$_SESSION["seguimiento_md5"]=$_REQUEST["a"];		
	
	$objeto										=new map_espejo();
	
	$_SESSION["module"]=array();
	$_SESSION["module"]["sys_section"]			=$objeto->sys_private["section"];
	
	$files_js=array("maps","responsivevoice");
	$files_js[]="../{$objeto->sys_var["module_path"]}/js/map";
	
	$objeto->words["system_template"]           =$objeto->__VIEW_CREATE($objeto->sys_var["module_path"] . "html/streetmap");	
	
	
	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields); 
    	    	    
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS($files_js);								# ARCHIVOS JS DEL MODULO
	$objeto->words["module_title"]              ="REPORTE DE POSICIONES";
	
	
    $objeto->words["html_head_description"] =   "SolesGPS facilita la cuenta espejo para localizar el vehiculo";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="SOLESGPS :: CUENTA ESPEJO";

    $objeto->html                               =$objeto->__VIEW_TEMPLATE("front_end", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>
