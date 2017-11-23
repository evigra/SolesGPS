<?php
	require_once("modelo.php");
	
	$objeto										=new execute();
	#$objeto->__SESSION();
	
	#$objeto->__PRINT_R($objeto->menu_obj->modulos());
	        	

	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");
	
	
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS(array("../modulos/server/js/index"));
	$objeto->words["html_head_css"]            	=$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
	
	#$objeto->sys_section="kanban";
	$module_title								="";
	
	
	
    if($objeto->sys_section=="traccar_play")			$comando="/opt/traccar/bin/traccar start;";
    else if($objeto->sys_section=="traccar_stop")		$comando="/opt/traccar/bin/traccar stop;";
    else if($objeto->sys_section=="traccar_restart")	$comando="/opt/traccar/bin/traccar restart;";
    else if($objeto->sys_section=="traccar_status")		$comando="/opt/traccar/bin/traccar status;";
    else if($objeto->sys_section=="traccar_log")		$comando="/opt/traccar/bin/traccar restart;";
    else if($objeto->sys_section=="server_reboot")		$comando="reboot;";
    else if($objeto->sys_section=="server_update")		$comando="cd /home/admin; ./actualizar.sh;";
    

	
    if(@$comando=="")							$comando="/opt/traccar/bin/traccar status;";
    
    $objeto->words["mensaje_devuelto"] 			=$objeto->__EXEC($comando);
    
	$objeto->words["module_title"]              ="SERVER";
	
	$objeto->words["module_left"]               ="";
	$objeto->words["module_center"]             ="";
	$objeto->words["module_right"]              ="";
	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE USUARIOS DE LA PLATAFORMA DE RASTREO.";
	$objeto->words["html_head_keywords"] 	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";

	$objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]}";
	
	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE("modulos/server/html/create");	
	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);    

    
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);    
	#$objeto->__PRINT_R($objeto->sys_fields);
    
?>
