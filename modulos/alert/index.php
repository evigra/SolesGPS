<?php
	$objeto							=	new alert();
	$objeto->__SESSION();
	
	# TEMPLATES O PLANTILLAS ELEJIDAS PARA EL MODULO
	$objeto->words["system_body"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_body");	
	$objeto->words["system_module"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_module");
		
	
	# CARGA DE ARCHIVOS EXTERNOS JS, CSS
	$objeto->words["html_head_js"]	=	$objeto->__FILE_JS(array("../".$objeto->sys_module."js/index"));
	#$objeto->words["html_head_css"]	=	$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
		
	$module_left	="";
	$module_center	="";	
    $module_right	="";
        
    $module_title	="";
    $template		="system";
    if($objeto->sys_section=="show")
	{
		# TITULO DEL MODULO
    	$module_title                	=	"Mostrar ";

		# PRECARGANDO LOS BOTONES PARA LA VISTA SELECCIONADA
    	$module_right=array(
			#array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			#array("kanban"=>"Kanban"),
			array("report"=>"Reporte"),
	    );

		#$template="system_module_not";
		# CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA
    	$objeto->words["module_body"]				=$objeto->__VIEW_SHOW($objeto->sys_module."html/show");	    	
    	$objeto->words               				=$objeto->__INPUT($objeto->words,$objeto->sys_fields);
    	
    	#$objeto->__PRINT_R($objeto->sys_fields);
    }	

    else
    {
		# TITULO DEL MODULO
    	$module_title                	=	"Reporte de ";

		# PRECARGANDO LOS BOTONES PARA LA VISTA SELECCIONADA
    	$module_right=array(
			#array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			#array("kanban"=>"Kanban"),
			array("report"=>"Reporte"),
	    );

    	$module_center=array(
			#array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			#array("kanban"=>"Kanban"),
			array(	"report_batery_del"=>"",
					"title"=>false,
					"icon"=>"ui-icon-battery-0"
			),
			array(	"report_batery_low",
					"title"=>"",
					"icon"=>"ui-icon-battery-1"
			),
	    );
	    $module_center=$objeto->__BUTTON($module_center);

	    
	    # CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA  
		$option     					=	array();
		$option["template_title"]		=	$objeto->sys_module."html/report_title";
		$option["template_body"]		=	$objeto->sys_module."html/report_body";
	
	
		$option["order"]="id DESC";
		$data								=$objeto->__VIEW_REPORT($option);
		$objeto->words["module_body"]	=	$data["html"];	
    }
    
    
    
	$objeto->words["module_title"]	=	"$module_title Avisos";
	
	# CARGANDO LOS BOTONES LA LA VISTA
	$objeto->words["module_left"]  	=	$objeto->__BUTTON($module_left);
	$objeto->words["module_center"]	=	$module_center;
	$objeto->words["module_right"]	=	$objeto->__BUTTON($module_right);;
		

	$objeto->words["html_head_title"]		=	"SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE DISPOSITIVOS GPS.";
	$objeto->words["html_head_keywords"]	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";

	
    $objeto->html                       	=	$objeto->__VIEW_TEMPLATE($template, $objeto->words);
    $objeto->__VIEW($objeto->html);    
?>
