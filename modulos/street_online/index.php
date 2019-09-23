<?php
	require_once("modelo.php");
	$objeto										=new street_online();
	
	$objeto->__SESSION();
	#/*
	$_SESSION["module"]							=array();
	$_SESSION["module"]["sys_section"]			=$objeto->sys_private["section"];
	

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
		#$option["template_form"]	                = $objeto->sys_module . "html/report_form";
		
		$data										=$objeto->time_position($option);
		$objeto->words["module_body"]				=$data["html"];
    }
	elseif($objeto->sys_section=="show")
	{	
	    $files_js=array("../{$objeto->sys_module}js/index");
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/show");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      
    }    
    else // $objeto->sys_section=map
    {
    */
		$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module_not");
		$files_js[]									="../{$objeto->sys_var["module_path"]}js/map";
    
		$objeto->words["module_body"]   			=$objeto->__VIEW_CREATE($objeto->sys_var["module_path"] . "html/report_form");
		$objeto->words								=$objeto->__INPUT($objeto->words,$objeto->sys_fields); 

		$form_map									=$objeto->words["module_body"];
		$objeto->words["module_body"]				="";

    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_var["module_path"] . "html/streetmap");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);      
    	
    	$objeto->words["form_map"]					=$form_map;
    	//
    	/*
    }
    
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
    */    
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS($files_js);								# ARCHIVOS JS DEL MODULO
	#$objeto->words["html_head_css"]             =$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
	
    $objeto->words["system_submenu2"]           =$objeto->menu_vehicle();    	

	$objeto->words["module_title"]              ="REPORTE DE POSICIONES";
	$objeto->words["module_left"]               ="";
	$objeto->words["module_center"]             ="";
	$objeto->words["module_right"]              =""; #$objeto->__BUTTON($module_right);
	
    $objeto->words["html_head_description"] =   "EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE POSICIONES RECIBIDAS DURANTE EL RASTREO SATELITAL.";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["nombre"]} :: {$objeto->words["module_title"]}";
    
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system_menu_module", $objeto->words);
    $objeto->__VIEW($objeto->html);
   # */
?>


