<?php
	require_once("modelo.php");

	$objeto										=new position();
	$objeto->__SESSION();
	#$objeto->__PRINT_R($objeto);
	$_SESSION["module"]=array();
	$_SESSION["module"]["sys_section"]			=$objeto->sys_section;
	

	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");	
	$files_js=array("maps","responsivevoice");
	$files_js=array("maps");

/*
	if($objeto->sys_section=="report")
	{
		$option=array();
        $files_js=array("../{$objeto->sys_module}js/index");
		$option["template_title"]	                = $objeto->sys_module . "html/report_title";
		$option["template_body"]	                = $objeto->sys_module . "html/report_body";
		#$option["template_create"]	                = $objeto->sys_module . "html/report_form";
		$option["template_search"]	                = $objeto->sys_module . "html/report_form";
		
		$data										=$objeto->time_position($option);
		$objeto->words["module_body"]				=$data["html"];
    }
	elseif($objeto->sys_section=="report_distance")
	{
		$option=array();
        $files_js=array("../{$objeto->sys_module}js/index");
		$option["template_title"]	                = $objeto->sys_module . "html/report_distance_title";
		$option["template_body"]	                = $objeto->sys_module . "html/report_distance_body";
		
		$data										=$objeto->distancias($option);
		$objeto->words["module_body"]				=$data["html"];
    }

	elseif($objeto->sys_section=="show")
	{	
	    $files_js=array("../{$objeto->sys_module}js/index");
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/show");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      
    }    
    elseif($objeto->sys_section=="historyMap") // $objeto->sys_section=map
    {
		$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
		$files_js[]="../{$objeto->sys_module}js/history";
    
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/map");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      
    }
    elseif($objeto->sys_section=="historyStreet") // $objeto->sys_section=map
    {
		$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
		$files_js[]="../{$objeto->sys_module}js/history";
    
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/streetmap");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      
    }
    elseif($objeto->sys_section=="streetmap") // $objeto->sys_section=map
    {
    	
		$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
		$files_js[]="../{$objeto->sys_module}js/map";
    
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/streetmap");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      
    	//
    }
     else
     */
		$module_right=array(
		    array("create"=>"Crear"),
		    array("graph"=>"Grafica"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);


	#if($objeto->sys_private["section"]=="graph")
	{
		#BOTONES SECCION DERECHA
		$module_right=array(
		    array("create"=>"Crear"),
		    array("graph"=>"Grafica"),
		    #array("write"=>"Modificar"),
		    #array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);
	
		#CARGANDO VISTA PARTICULAR Y CAMPOS
		if($option=="")					$option				=array();			
		if(!isset($option["where"]))	$option["where"]	=array();
		
		if(!isset($option["select"]))	$option["select"]	=array();

		$option["select"][]		="devicetime";
		$option["select"][]		="speed";

		$option["where"][]		="left(now(),10)=left(devicetime,10)";

		$data										=$objeto->__VIEW_GRAPH($option);		
		$objeto->words["module_body"]				=$data;
    }    
    /*
    else // $objeto->sys_section=map
    {
		$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
		$files_js[]="../{$objeto->sys_module}js/map";
    
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/map");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      
    	//
    }
    */
    
    $module_left=array(
        array(
        	"id"	=>"year",
        	"title"	=>"AÑO",
        	"group"	=>"",
        ),
        array(
        	"id"	=>"month",
        	"title"	=>"MES",
        	"group"	=>"",
        ),

        array(
        	"id"	=>"day",
        	"title"	=>"DIA",
        	"group"	=>"",
        ),
    );
        
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS($files_js);								# ARCHIVOS JS DEL MODULO
	$objeto->words["html_head_css"]              =$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
	
	#$files_css=array();
	#$files_css[]="../{$objeto->sys_module}css/map1";
	#$files_css[]="../{$objeto->sys_module}css/map2";
	#$objeto->words["html_head_css"]             =$objeto->__FILE_CSS($files_css);								# ARCHIVOS CSS DEL MODULO

    $objeto->words["system_submenu2"]           =$objeto->menu_vehicle();    	

	$objeto->words["module_title"]              ="REPORTE DE POSICIONES";
	$objeto->words["module_left"]               =""; #$objeto->__CHECK($module_left,"DATE");
	$objeto->words["module_center"]             ="";
	$objeto->words["module_right"]              =""; #$objeto->__BUTTON($module_right);
	
    $objeto->words["html_head_description"] =   "EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE POSICIONES RECIBIDAS DURANTE EL RASTREO SATELITAL.";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
    
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>

