<?php	
	$objeto											=new movimiento();		
	$objeto->__SESSION();
	
	# CARGANDO PLANTILLAS GENERALES
	$objeto->words["system_body"]               	=$objeto->__TEMPLATE($objeto->sys_html."system_body"); 		
	$objeto->words["system_module"]             	=$objeto->__TEMPLATE($objeto->sys_html."system_module");	
	
	# CARGANDO ARCHIVOS PARTICULARES		
	$objeto->words["html_head_js"]              	=$objeto->__FILE_JS();
	#$objeto->words["html_head_css"]             	=$objeto->__FILE_CSS(array("../sitio_web/css/basicItems"));
		
	$module_left		="";	
	$module_right		="";	
	$module_center		="";	
	
	$module_title									="";
	
    if($objeto->sys_private["section"]=="create")
	{
		#BOTONES SECCION IZQUIERDA
		$module_left=array(
		    array("action"=>"Guardar"),
		    array("cancel"=>"Cancelar"),
		);
		#BOTONES SECCION DERECHA
		$module_right=array(
		    #array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);
		
		$module_title								="Crear ";
    	$objeto->words["module_body"]               =$objeto->__VIEW_CREATE();	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);    	
    }	
    elseif($objeto->sys_private["section"]=="write")
	{
		#BOTONES SECCION IZQUIERDA
		$module_left=array(
		    array("action"=>"Guardar"),
		    array("cancel"=>"Cancelar"),
		);
		
		$module_center=array(
		    array("action_pagar"=>"PAGAR"),
		    array("action_abonar"=>"ABONAR"),
		    array("action_cancelar"=>"CANCELAR"),
		);

		$objeto->sys_fields["tipo"]["type"]		="value";
		$objeto->sys_fields["folio"]["type"]	="value";
		
		#BOTONES SECCION DERECHA
		$module_right=array(
		    array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);		

		#CARGANDO VISTA PARTICULAR Y CAMPOS
    	$objeto->words["module_body"]               =$objeto->__VIEW_WRITE();	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);
		
    	$module_title								="Modificar ";
    }	
    elseif($objeto->sys_private["section"]=="show")
	{
		#BOTONES SECCION IZQUIERDA
		$module_left=array(
		    array("action"=>"Guardar"),
		    array("cancel"=>"Cancelar"),
		);
		#BOTONES SECCION DERECHA
		$module_right=array(
		    array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);		
		#CARGANDO VISTA PARTICULAR Y CAMPOS
    	$objeto->words["module_body"]               =$objeto->__VIEW_WRITE($objeto->sys_var["module_path"] . "html/show");	
    	$objeto->words                              =$objeto->__INPUT($objeto->words,$objeto->sys_fields);
    		    
    	$module_title								="Formato ";
    }	
	elseif($objeto->sys_private["section"]=="kanban")
	{
		#BOTONES SECCION DERECHA
		$module_right=array(
		    array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),
		);	
		#CARGANDO VISTA PARTICULAR Y CAMPOS
		
		$option=array();
		if($objeto->sys_private["action"]=="clientes")	
		{
			#$this->__PRINT_R($objeto->sys_private["action"]);
		
			$option["having"]=array(
				"deudor=''",
				"acreedor=''",
			);
		}
		
		
    	$option										=$objeto->__BROWSE_CUENTAS($option);
		$data										=$objeto->__VIEW_KANBAN($option);		
		$objeto->words["module_body"]				=$data["html"];
    }    
    else
    {
    
    	#$objeto->__PRINT_R($objeto);
		#BOTONES SECCION DERECHA
		$module_right=array(
		    array("create"=>"Crear"),
		    #array("write"=>"Modificar"),
		    array("kanban"=>"Kanban"),
		    array("report"=>"Reporte"),		    
		);

		#CARGANDO VISTA PARTICULAR Y CAMPOS
		$option=array();	
		$data										= $objeto->__VIEW_REPORT($option);		
		$objeto->words["module_body"]				=$data["html"];
		$module_title								="Reporte de ";
    }
    
	$objeto->words["module_title"]              ="$module_title Movimientos";
	
	$objeto->words["module_left"]               =$objeto->__BUTTON($module_left);
	$objeto->words["module_center"]             =$objeto->__BUTTON($module_center);
	$objeto->words["module_right"]              =$objeto->__BUTTON($module_right);    
    
	$objeto->words["html_head_title"]		=	"SOLES GPS :: {$_SESSION["company"]["razonSocial"]} :: {$objeto->words["module_title"]}";
	
	$objeto->words["html_head_description"]	=	"EN LA EMPRESA SOLESGPS, CONTAMOS CON UN MODULO PARA ADMINISTRAR EL REGISTRO DE DISPOSITIVOS GPS.";
	$objeto->words["html_head_keywords"]	=	"GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
  
    $objeto->html                               =$objeto->__VIEW_TEMPLATE("system", $objeto->words);
    $objeto->__VIEW($objeto->html);    
?>
