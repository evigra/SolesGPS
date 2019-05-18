<?php
	$objeto										=new geofences();
	$objeto->__SESSION();

	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");
	
	$objeto->words["html_head_js"]              =$objeto->__FILE_JS(array("maps","../".$objeto->sys_var["module_path"]."js/index"));
	
    $module_left=array(
        array("action"=>"Guardar"),
        array("cancel"=>"Cancelar"),
    );
    $module_right=array(
        array("create"=>"Crear"),
        array("report"=>"Reporte"),
    );    
    $module_center=array(
        array("accion_punto"=>"Agregar"),
        array("finalizar_punto"=>"Finalizar"),
        array("limpiar_punto"=>"Limpiar"),
    );    
    $module_title                                   ="";

    if($objeto->sys_private["section"]=="create")
	{
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE();	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);    
    	$module_title                               ="Crear ";
    }	
    elseif($objeto->sys_private["section"]=="write")
	{
    	$objeto->words["module_body"]               =$objeto->__VIEW_WRITE();	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);
    	$module_title                               ="Modificar ";
    }	
	else
	{
		$module_center								="";
	    $module_left                                ="";
		$data										=$objeto->geofence();
		$objeto->words["module_body"]				=$data["html"];	
		$module_title                               ="Reporte de ";
    }

	$objeto->words["module_title"]              ="$module_title Geocercas";
	$objeto->words["module_left"]               =$objeto->__BUTTON($module_left);
	$objeto->words["module_center"]             =$objeto->__BUTTON($module_center);
	$objeto->words["module_right"]              =$objeto->__BUTTON($module_right);;
	

	$objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["nombre"]} :: {$objeto->words["module_title"]}";
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE GEOCERCAS.";
	$objeto->words["html_head_keywords"] 	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
		
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>
