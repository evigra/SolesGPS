<?php
	require_once("modelo.php");
	
	$objeto										=new crons_history();
	if($objeto->sys_section=="execute")
	{
		$objeto->showCrons();
	}
	else
	{
		$objeto->__SESSION();
	
		#$objeto->__PRINT_R($objeto->menu_obj->modulos());

		$objeto->words["system_body"]               	=$objeto->__TEMPLATE($objeto->sys_html."system_body"); 			# TEMPLATES ELEJIDOS PARA EL MODULO
		$objeto->words["system_module"]             	=$objeto->__TEMPLATE($objeto->sys_html."system_module");

		$objeto->words["html_head_js"]              	=$objeto->__FILE_JS(array("../".$objeto->sys_module."js/index"));
			
		#$objeto->sys_section="kanban";
		$module_title									="";
		if($objeto->sys_section=="create")
		{
			$module_title								="Crear ";
			$objeto->words["module_body"]               =$objeto->__VIEW_CREATE($objeto->sys_module . "html/create");	
			$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);    
		}	
		elseif($objeto->sys_section=="write")
		{
			$objeto->words["module_body"]               =$objeto->__VIEW_WRITE($objeto->sys_module . "html/write");	
			$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);
			$objeto->words["img_files_id"]	            =$objeto->files_obj->__GET_FILE($objeto->sys_fields["files_id"]["value"]);
			$module_title								="Modificar ";
		}	
		elseif($objeto->sys_section=="report")
		{
			$option=array();

			$option["template_title"]	                = $objeto->sys_module . "html/report_title";
			$option["template_body"]	                = $objeto->sys_module . "html/report_body";
		
			$data										=$objeto->crons($option);
			$objeto->words["module_body"]				=$data["html"];
			$module_title								="Reporte de ";		
		}
		elseif($objeto->sys_section=="kanban")
		{
			$template_body								=$objeto->sys_module . "html/kanban";
		   	$data										=$objeto->users();
			$objeto->words["module_body"]               =$objeto->__VIEW_KANBAN($template_body,$data["data"]);	
		}    
		else
		{
			$option=array();

			$option["template_title"]	                = $objeto->sys_module . "html/report_title";
			$option["template_body"]	                = $objeto->sys_module . "html/report_body";
		
			$data										=$objeto->crons($option);
			$objeto->words["module_body"]				=$data["html"];
			$module_title								="Reporte de ";		
		}
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

		$objeto->words["module_title"]              ="$module_title Crons";
	
		$objeto->words["module_left"]               =$objeto->__BUTTON($module_left);
		$objeto->words["module_center"]             ="";
		$objeto->words["module_right"]              =$objeto->__BUTTON($module_right);;
	
		$objeto->words["html_head_title"]           ="SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
		$objeto->html                               =$objeto->__VIEW_TEMPLATE("system", $objeto->words);
		$objeto->__VIEW($objeto->html);    
	}	
?>
