<?php
	$objeto							=	new celphone();
	$objeto->__SESSION();
	
	# TEMPLATES O PLANTILLAS ELEJIDAS PARA EL MODULO
	$objeto->words["system_body"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_body");	
	$objeto->words["system_module"]	=	$objeto->__TEMPLATE($objeto->sys_html."system_module");
	
	# CARGA DE ARCHIVOS EXTERNOS JS, CSS
	$objeto->words["html_head_js"]	=	$objeto->__FILE_JS();
		
	$module_left	="";
	$module_center	="";	
    $module_right	="";
        
    $module_title	="";
    if($objeto->sys_private["section"]=="create")
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
    	$objeto->words["module_body"]	=	$objeto->__VIEW_CREATE();	    	
    	$objeto->words               	=	$objeto->__INPUT($objeto->words,$objeto->sys_fields);    
    	
    }	
    elseif($objeto->sys_private["section"]=="write")
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
    	$objeto->words["module_body"]	=	$objeto->__VIEW_WRITE();
    	$objeto->words               	=	$objeto->__INPUT($objeto->words,$objeto->sys_fields);
    }
	elseif($objeto->sys_private["section"]=="kanban")
	{
		# TITULO DEL MODULO
    	$module_title                	=	"Reporte Modular de ";

		# PRECARGANDO LOS BOTONES PARA LA VISTA SELECCIONADA
    	$module_right=array(
			array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			#array("kanban"=>"Kanban"),
			array("report"=>"Reporte"),
	    );

		# CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA
    	$option										=$objeto->celphones();
		$data										=$objeto->__VIEW_KANBAN($option);		
		$objeto->words["module_body"]				=$data["html"];
    }	
	else
	{
		# TITULO DEL MODULO
    	$module_title                	=	"Reporte de ";

		# PRECARGANDO LOS BOTONES PARA LA VISTA SELECCIONADA
    	$module_right=array(
			array("create"=>"Crear"),
			#array("write"=>"Modificar"),
			array("kanban"=>"Kanban"),
			#array("report"=>"Reporte"),
	    );
	    
	    # CARGANDO VISTA Y CARGANDO CAMPOS A LA VISTA  
    	$option										=$objeto->celphones();
		$data										=$objeto->__VIEW_REPORT($option);		
		$objeto->words["module_body"]				=$data["html"];

    }
	
	$objeto->words["module_title"]	=	"$module_title Celulares";
	$objeto->words["module_left"]  	=	$objeto->__BUTTON($module_left);
	$objeto->words["module_center"]	=	$module_center;
	$objeto->words["module_right"]	=	$objeto->__BUTTON($module_right);;
		
	#$objeto->__PRINT_R($_SESSION["user"]);
	$objeto->words["html_head_title"]		=	"SOLES GPS :: {$_SESSION["company"]["nombre"]} :: {$objeto->words["module_title"]}";
	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE DISPOSITIVOS GPS.";
	$objeto->words["html_head_keywords"]	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
	
    $objeto->html                       	=	$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);
	#$objeto->__PRINT_R($objeto->sys_fields);
    
    
?>
