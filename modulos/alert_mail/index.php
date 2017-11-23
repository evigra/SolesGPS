<?php
	#phpinfo();
	require_once("modelo.php");
	

	$objeto										=new alert_mail();
	$objeto->words["system_menu"]               =$objeto->__TEMPLATE($objeto->sys_html."system_menu");
	#$objeto->words["system_body"]             	="aaa";
		
	# ARCHIVOS JS DEL MODULO
	
	#$objeto->__PRINT_R($_GET["a"]);
	
	$files_js=array("maps","responsivevoice");
	$files_js[]="../{$objeto->sys_module}js/map";
	$objeto->words["html_head_js"] =$objeto->__FILE_JS($files_js);

	$files_css=array();
	$objeto->words["html_head_css"] =$objeto->__FILE_CSS($files_css);		

	$objeto->words["system_module"]             =$objeto->__VIEW_CREATE($objeto->sys_module . "html/map");	
	#$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);    


	#$objeto->words["module_title"]              ="Pagina";
	#$objeto->words["module_left"]               =$objeto->__BUTTON($module_left);
	#$objeto->words["module_center"]             ="SECCION CENTRAL";
	#$objeto->words["module_right"]              =$objeto->__BUTTON($module_right);;
	
	
    #ajax_positions_now("../modulos/map_online/ajax/index.php",2000);


	$objeto->words["system_js"]          ="
		ajax_positions_now(\"../modulos/alert_mail/ajax/index.php?a={$_GET["a"]}\",2000)
	";
	
	$objeto->words["html_head_title"]          ="SolesGPS :: Mapa";
	$objeto->words["html_head_description"] =   "SolesGPS :: Es una empresa de rastreo vehicular y celular nacida en la ciudad de Manzanillo, Colima";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    	
	
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("front_end", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>
