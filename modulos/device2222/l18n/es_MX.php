<?php
		$this->sys_fields_l18n	=array(
			"satellite_tracking"	=>"RASTREO SATELITAL",
			"real_time"	    		=>"TIEMPO REAL",
			"management"	    	=>"ADMINISTRACION",
			"effective"				=>"EFECTIVA",
			"tracking"	    		=>"RASTREO",
			"satellite"	    		=>"SATELITAL",
			"begin_1"	    		=>"Conozca todo el camino de tu unidad en cada traslado.",
			"monitoring"			=>"MONITOREO",
			"begin_2"	    		=>"Monitoree sus unidades en cualquier momento.",
			"control"				=>"CONTROL",
			"total"					=>"TOTAL",
			"begin_3"	    		=>"Administre sus unidades de una manera integral.",
			"multi"					=>"MULTI",
			"platform"				=>"PLATAFORMA",
			"begin_4"	    		=>"Acceso a travez de Pc, Laptop, Tablet o Smart Phone.",
			"reduction"				=>"REDUCCION",
			"costs"					=>"COSTOS",
			"begin_5"	    		=>"Obtenga un beneficio y desempeño optimo sobre tus unidades.",
			"satisfaction"			=>"SATISFACCION",
			"customer"				=>"CLIENTE",
			"begin_6"	    		=>"Servicios y soporte eficaz, oportuno y de calidad.",
			"multiple"				=>"MULTIPLES",
			"reports"				=>"REPORTES",
			"begin_7"	    		=>"Reportes de los eventos de tus unidades.",
			"record"				=>"HISTORIAL",
			"month"					=>"MES",
			"begin_8"	    		=>"1 mes de registro historico de eventos, por unidad.",
			"our"					=>"NUESTRO",
			"job"					=>"TRABAJO",
			"main_services"			=>"Algunos de nuestros principales servicios, son los siguientes:",
			"services"				=>"SERVICIOS",
			"vehicle_tracking"		=>"RASTREO VEHICULAR",
			"cell_tracking"			=>"RASTREO CELULAR",
			"we_are"				=>"Somos una empresa orgullosamente mexicana, fundada en la ciudad de Manzanillo, Colima.
							            <span>
							                Comprometidos con el cuidado del medio ambiente y la optimización de los recursos.
							            </span>
							            <span>
							                Somos una empresa orientada a ofrecer servicios de localización y rastreo
							                satelital de vehiculos y dispositivos moviles. 
							            </span>
							            <span>
							                Priorizando la calidad del servicio y la constante busqueda de la mejora.
							                Implementando en Odoo(OpenERP) una herramiendo de administración integral empresarial, nuestra plataforma de rastreo y localización satelital.
							            </span>",
			"our_1"					=>"Nuestra",
			"mission"				=>"MISION",
			"our_mission"			=>" <p> 
							                Garantizar la calidad en todos y cada uno de nuestros
							                servicios, ofreciendo información, efectiva, veraz y oportuna.
							            </p>    
							            <p>
							                Brindar soporte y atención ante cualquier eventualidad que 
							                pueda presentarse durante la operación de nuestro servicio.
							            </p>
							            <p> 
							                Otorgar las herramientas de monitoreo y rastreo de sus unidades,
							                con el proposito de permitir optimizar sus activos.
							            </p>    
							            <p>
							                Comprometidos con la entera satisfacción de nuestros
							                clientes, buscando siempre cubrir todas sus necesidades
							                y cumplir las espectativas de servicio.
							            </p> ",
			"vision"				=>"VISION",
			"our_vision"			=>"<p>
							                Convertirnos en la compañia lider en el servicio de rastreo satelital y soluciones informaticas a nivel mundial.
							            </p>
							            <p> 
							                Colocarnos en los más rigurosos estandares de calidad, que asegure la 
							                satisfacción del consumidor a través de productos innovadores 
							                y de un servicio de primer nivel.
							            </p>        
							            <p> 
							                Ser una empresa que inspire confianza en sus servicios y que permita al consumidor
							                sentirse seguro, a travéz de las herramientas empresariales de administración que se brindan
							                para controlar sus activos.
							            </p>",
			"call_us"				=>"Llamanos",
			"write_us"				=>"Escribenos",
			"call_us_here"			=>"Llamanos Aqui",
			"write_us_here"			=>"Escribenos Aqui",
			"near_you"				=>"Cerca de Ti",
			"foot_1"				=>"Geolocalizacion y Rastreo Satelital",
			"foot_2"				=>"Vehicular y Celular",
			);				

		$this->sys_view_l18n	=array(
			"action"    		=>"Guardar",
			"cancel"	    	=>"Cancela",
			"create"	   		=>"Crear",
			"kanban"			=>"Kanban",
			"report"			=>"Reporte",
			"module_title"    	=>"Administracion de Usuarios",
		);
		$this->sys_view_l18n["html_head_title"]="SOLES GPS";
		if(@$_SESSION["company"] and @$_SESSION["company"]["razonSocial"])
			$this->sys_view_l18n["html_head_title"].=" :: {$_SESSION["company"]["razonSocial"]} :: {$this->sys_view_l18n["module_title"]}";
?>
