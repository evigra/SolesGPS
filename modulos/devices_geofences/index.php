<?php
	$objeto							=	new devices_geofences();
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
    
    
	$date = strtotime(date("Y-m-d"));
    
    if($objeto->sys_section=="create")
	{
		# TITULO DEL MODULO
    	$module_title                	=	"Crear ";

		# PRECARGANDO LOS BOTONES PARA LA VISTA SELECCIONADA
		$module_left=array(
		    array("action"=>"Guardar"),
		    array("cancel"=>"Cancelar"),
		);
    	$module_right=array(
			#array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			array("kanban"=>"Kanban"),
			array("report"=>"Reporte"),
	    );

		# CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA
    	$objeto->words["module_body"]				=$objeto->__VIEW_CREATE($objeto->sys_module."html/create");	    	
    	$objeto->words               				=$objeto->__INPUT($objeto->words,$objeto->sys_fields);    

    }	
    elseif($objeto->sys_section=="write")
	{
		# TITULO DEL MODULO
    	$module_title                	=	"Modificar ";

		# PRECARGANDO LOS BOTONES PARA LA VISTA SELECCIONADA
		$module_left=array(
		    array("action"=>"Guardar"),
		    array("cancel"=>"Cancelar"),
		);
    	$module_right=array(
			array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			array("kanban"=>"Kanban"),
			array("report"=>"Reporte"),
	    );

		# CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA
    	$objeto->words["module_body"]				=$objeto->__VIEW_WRITE($objeto->sys_module."html/write");	    	
    	$objeto->words               				=$objeto->__INPUT($objeto->words,$objeto->sys_fields);
    	
    }	
    elseif($objeto->sys_section=="show")
	{
		# TITULO DEL MODULO
    	$module_title                	=	"Modificar ";

		# PRECARGANDO LOS BOTONES PARA LA VISTA SELECCIONADA
		$module_left=array(
		    array("action"=>"Guardar"),
		    array("cancel"=>"Cancelar"),
		);
    	$module_right=array(
			array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			array("kanban"=>"Kanban"),
			array("report"=>"Reporte"),
	    );

		#$template="system_module_not";
		# CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA
    	$objeto->words["module_body"]				=$objeto->__VIEW_SHOW($objeto->sys_module."html/show");	    	
    	$objeto->words               				=$objeto->__INPUT($objeto->words,$objeto->sys_fields);
    	
    }	
    elseif($objeto->sys_section=="report_hoy")
    {
		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS			
		$data										= $objeto->__REPORT_HOY();
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Reporte Actual de";
    }
    elseif($objeto->sys_section=="report_hoy_total")
    {
		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS			
		$data										= $objeto->__REPORT_HOY_TOTAL();
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Suma Actual de";
    }

    elseif($objeto->sys_section=="report_semana_actual")
    {
		$first = date('Y-m-d',strtotime('monday -7 days'));
		$last = date('Y-m-d',strtotime('Sunday'));

		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS			
		$data										= $objeto->__REPORT_SEMANA_ACTUAL();
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Semana ($first al $last) de ";
    }
    
    elseif($objeto->sys_section=="report_semana_actual_total")
    {
		$first = date('Y-m-d',strtotime('monday -7 days'));
		$last = date('Y-m-d',strtotime('Sunday'));

		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS			
		$data										= $objeto->__REPORT_SEMANA_TOTAL();
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Suma Semanal ($first al $last) de ";
    }    
    elseif($objeto->sys_section=="report_semana_anterior")
    {
		$first = date('Y-m-d',strtotime('last monday -7 days'));
		$last = date('Y-m-d',strtotime('last Sunday'));

		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS			
		$data										= $objeto->__REPORT_SEMANA_ANTERIOR();
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Semana Anterior ($first al $last) ";
    }
    elseif($objeto->sys_section=="report_semana_anterior_total")
    {
		$first = date('Y-m-d',strtotime('last monday -7 days'));
		$last = date('Y-m-d',strtotime('last Sunday'));

		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS			
		$data										= $objeto->__REPORT_SEMANA_ANTERIOR_TOTAL();
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Suma Semanal Anterior ($first al $last)";
    }

    else
    {
		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS			
		$data										= $objeto->__REPORT_GENERAL();
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Reporte de General de ";
    }
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);

    
    	$module_left=array(
		    array("report_hoy"=>"",				"icon"=>"ui-icon-calendar", 	"title"=>"Hoy", 			"text"=>"false"),
		    array("report_semana_actual"=>"",	"icon"=>"ui-icon-calculator", 	"title"=>"Semana Actual", 	"text"=>"false"),
		    array("report_semana_anterior"=>"",	"icon"=>"ui-icon-copy", 		"title"=>"Semana Anterior", "text"=>"false"),
		);	    

    	$module_center=array(
		    array("report_hoy_total"=>"",				"icon"=>"ui-icon-calendar", 	"title"=>"Totales Hoy", 			"text"=>"false"),
		    array("report_semana_actual_total"=>"",		"icon"=>"ui-icon-calculator", 	"title"=>"Totales Semana Actual", 	"text"=>"false"),
		    array("report_semana_anterior_total"=>"",	"icon"=>"ui-icon-copy", 		"title"=>"Totales Semana Anterior", "text"=>"false"),
		);	    
    
    
	$objeto->words["module_title"]	=	"$module_title";
	
	# CARGANDO LOS BOTONES LA LA VISTA
	$objeto->words["module_left"]  	=	$objeto->__BUTTON($module_left);
	$objeto->words["module_center"]	=	$objeto->__BUTTON($module_center);
	$objeto->words["module_right"]	=	$objeto->__BUTTON($module_right);;
		

	$objeto->words["html_head_title"]		=	"SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE DISPOSITIVOS GPS.";
	$objeto->words["html_head_keywords"]	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";

	
    $objeto->html                       	=	$objeto->__VIEW_TEMPLATE($template, $objeto->words);
    $objeto->__VIEW($objeto->html);    
?>
