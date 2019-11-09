<?php
	require_once("modelo.php");

	$objeto										=new home();
	#$objeto->__PRINT_R($objeto);
	

	$objeto->words["system_menu"]               =$objeto->__TEMPLATE($objeto->sys_html."system_menu");
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");
		
	# ARCHIVOS JS DEL MODULO
	$files_js=array();
	$files_js[]="../{$objeto->sys_var["module_path"]}js/jssor.slider-22.0.6.mini";
	$files_js[]="../{$objeto->sys_var["module_path"]}js/index";	
	
	$objeto->words["html_head_js"] =$objeto->__FILE_JS($files_js);

	$files_css=array();

	$files_css[]="../{$objeto->sys_var["module_path"]}css/estilo";

	$objeto->words["html_head_css"] =$objeto->__FILE_CSS($files_css);		

	$objeto->words["system_module"]             =$objeto->__VIEW_SHOW();	
	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);    


	$objeto->words["module_title"]              ="Pagina";
	#$objeto->words["module_left"]               =$objeto->__BUTTON($module_left);
	$objeto->words["module_center"]             ="SECCION CENTRAL";
	#$objeto->words["module_right"]              =$objeto->__BUTTON($module_right);;
	
	#if()
	
	$objeto->words["html_head_title"]          ="SolesGPS :: Inicio";
	$objeto->words["html_head_description"] =   "SolesGPS :: Es una empresa de rastreo vehicular y celular nacida en la ciudad de Manzanillo, Colima";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    
	
	
	
	
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("front_end", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>
