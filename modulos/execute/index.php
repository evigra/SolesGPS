<?php
	$objeto										=new execute();
	echo "AAAAAAAAAA";
				
	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");
		
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS(array("../".$objeto->sys_module."js/index"));
	$objeto->words["html_head_css"]            	=$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
	
	#$objeto->sys_section="kanban";
	$module_title									="";
    if($objeto->sys_section=="create")
	{
		$module_title								="Crear ";
    	$objeto->words["module_body"]               =$objeto->log;	
    }	
    if($objeto->sys_section=="create")
	{
		$module_title								="Crear ";
    	$objeto->words["module_body"]               =$objeto->log;	
    }	
    
    if($objeto->sys_section=="saldo_correo")
	{
	
    	$module_title                	=	"Modificar ";
		$objeto->saldo_correo();
    	$module_right=array(
			array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			array("kanban"=>"Kanban"),
			array("report"=>"Reporte"),
	    );	
		$objeto->words["module_body"]	=	"";	
    	#$objeto->words["module_body"]	=	$objeto->__VIEW_WRITE($objeto->sys_module."html/write");	
    	#$objeto->words               	=	$objeto->__INPUT($objeto->words,$objeto->sys_fields);
	
        
    }	
       
    
	$objeto->words["module_title"]              ="Log Traccar";
	
	$objeto->words["module_left"]               ="";
	$objeto->words["module_center"]             ="";
	$objeto->words["module_right"]              ="";
	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE USUARIOS DE LA PLATAFORMA DE RASTREO.";
	$objeto->words["html_head_keywords"] 	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";

	$objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
    
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);    
	#$objeto->__PRINT_R($objeto->sys_fields);
    
?>
