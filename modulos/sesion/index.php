<?php
	echo "LALO";	
	$objeto	=new sesion();
	$objeto->__PRINT_R($objeto);	
	if(!isset($objeto->words["mensaje_sesion"]) OR @$objeto->words["mensaje_sesion"]=="")		
		$objeto->words["mensaje_sesion"]				="
			<font size='3'>
				<b>SolesGPS tiene</b> las funciones mas interesantes.<br>
				<b>Notificaciones</b> a su Smartphone, <b>para recibirlas con WhatsApp</b>
			</font>";
			

	$objeto->words["html_head_description"]			="SolesGPS desarrollo su propia plataforma de rastreo vehicular y celular, con la finalidad de satisfacer las nececidades de sus clientes";	
	$objeto->words["html_head_keywords"] 			="GPS, RASTREO, MANZANILLO, SATELITAL, CELULAR, VEHICULAR, VEHICULO, TRACTO, LOCALIZACION, COLIMA, SOLES, SATELITE, GEOCERCAS, STREET VIEW, MAPA";
	$objeto->words["html_head_title"]           	="SOLES GPS :: Iniciar sesion";

	$objeto->words["html_head_css"]					=$objeto->__FILE_CSS();	
	$objeto->words["html_head_js"] 					=$objeto->__FILE_JS();	
		
	$objeto->words["system_module"]					=$objeto->__VIEW_CREATE();		
	$objeto->words                 					=$objeto->__INPUT($objeto->words,$objeto->sys_fields);    
	$objeto->words["system_menu"]   				=$objeto->__TEMPLATE($objeto->sys_html."system_menu");    
	$view											="front_end";	
 		
	$objeto->html                  					= $objeto->__VIEW_TEMPLATE($view, $objeto->words);
	$objeto->words["module_title"]					="Sesiones registradas";
	$objeto->words["module_left"]					="";
	$objeto->words["module_center"]					="";
	$objeto->words["module_right"]					="";
	
	if(!array_key_exists("mensaje_sesion",$objeto->words))
		$objeto->words["mensaje_sesion"]			="";
	
	$objeto->__VIEW($objeto->html);    
?>

