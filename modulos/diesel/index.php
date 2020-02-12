<?php

	$objeto										=new diesel();
	$objeto->__SESSION();

	$objeto->words["system_body"]               =$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
	$objeto->words["system_module"]             =$objeto->__TEMPLATE($objeto->sys_html."system_module");	
	
	#$files_js=array("graph");
	#$files_js[]="../{$objeto->sys_var["module_path"]}js/index";

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
	


		$objeto->words["module_body"]   			=$objeto->__VIEW_CREATE();
		$objeto->words								=$objeto->__INPUT($objeto->words,$objeto->sys_fields); 

        #$objeto->__PRINT_R($objeto->sys_fields);
    
        if($objeto->sys_fields["deviceid"]["value"]>0)
        {
		    $data									=$objeto->__VIEW_GRAPH();		
		    $objeto->words["graph"]				    =$data["html"];
		}    
		else    $objeto->words["graph"]				="";
		


		#CARGANDO VISTA PARTICULAR Y CAMPOS
    }    

    $objeto->words["html_head_js"]              .=$objeto->__FILE_JS();								# ARCHIVOS JS DEL MODULO

    $objeto->words["system_submenu2"]           =$objeto->menu_vehicle();    	

	$objeto->words["module_title"]              ="REPORTE DE COMBUSTIBLE";
	$objeto->words["module_left"]               =""; #$objeto->__CHECK($module_left,"DATE");
	$objeto->words["module_center"]             ="";
	$objeto->words["module_right"]              ="";
	
    $objeto->words["html_head_description"] =   "EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE POSICIONES RECIBIDAS DURANTE EL RASTREO SATELITAL.";
    $objeto->words["html_head_keywords"]    =   "GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
    $objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
    
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system_menu_module", $objeto->words);
    $objeto->__VIEW($objeto->html);
?>

