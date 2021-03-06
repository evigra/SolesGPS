<?php
	require_once("modelo.php");

	$objeto										=new position();
	$objeto->__SESSION();

	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");	
	

	#elseif($objeto->sys_private["section"]=="graph")
	{
		#BOTONES SECCION DERECHA
		$module_right=array(
		    array("create"	=>"Crear"),
		    #array("write"	=>"Modificar"),
		    array("kanban"	=>"Kanban"),
		    array("graph"	=>"Grafica"),
		    array("report"	=>"Reporte"),		    
		);
	
		#CARGANDO VISTA PARTICULAR Y CAMPOS
		
		$data												=$objeto->__VIEW_GRAPH();		
		$objeto->words["module_body"]						=$data["html"];
    }    



	/*
	#if($objeto->sys_private["section"]=="graph")
	{
		#BOTONES SECCION DERECHA
		$module_right=array(
		    array("create"=>"Crear"),
		    array("graph"=>"Grafica"),
		    array("report"=>"Reporte"),
		);
	
		#CARGANDO VISTA PARTICULAR Y CAMPOS
		$option				=array();			
		if(!isset($option["where"]))	$option["where"]	=array();		
		if(!isset($option["select"]))	$option["select"]	=array();

		#$option["echo"]			="GRAPH";

		$option["select"]["left(right(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),8),5)"]	="devicetime";
		$option["select"][]									="p.speed";

		#$option["where"][]									="left(now(),10)=left(DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10)";
		$option["where"][]									="left('2019-08-31',10)=left(DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10)";
		$option["order"]									="devicetime ASC";
		$option["limit"]									="10";

		$data												=$objeto->__VIEW_GRAPH($option);		
		$objeto->words["module_body"]						=$data["html"];
		$files_js=array(
			"graph"=>array(
				"data"=>$data["data"],
				"type"=>"PieChart",
				#"type"=>"BarChart",
				"type"=>"ColumnChart",
				
				#"type"=>"AreaChart",
				"type"=>"LineChart",
			)
		);		
    }    
	*/
	#$objeto->words["html_head_js"]              =$objeto->__FILE_JS($files_js);								# ARCHIVOS JS DEL MODULO
#	$objeto->words["html_head_css"]              =$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
	

#    $objeto->words["system_submenu2"]           =$objeto->menu_vehicle();    	

	$objeto->words["module_title"]              ="REPORTE DE POSICIONES";
	$objeto->words["module_left"]               =""; #$objeto->__CHECK($module_left,"DATE");
	$objeto->words["module_center"]             ="";
	$objeto->words["module_right"]              =$objeto->__BUTTON($module_right);
	
    $objeto->words["html_head_description"] =   "EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE POSICIONES RECIBIDAS DURANTE EL RASTREO SATELITAL.";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
    
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system_menu_module", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>

