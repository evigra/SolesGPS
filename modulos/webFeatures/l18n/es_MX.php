<?php
		$this->sys_fields_l18n	=array(
			"tracking"	    	=>"RASTREO",
			"satellite"	    	=>"SATELITAL",
			"begin_1"	    	=>"Conozca todo el camino de tu unidad en cada traslado.",
			"content_1_1"	  	=>"En la actualidad es muy importante conocer con exactitud la posición,
									de cada una de nuestras unidades automotores. <b>SOLES GPS</b>, le ofrece
									opciones de rastreo satelital, para que sus vehículos siempre esten al alcance
									de su vista.",
			"content_1_2"	  	=>"Además de el rastreo satelital de vehículos, <b>SOLES GPS</b>, le ofrece
									la posibilidad de rastrear tus dispositivos móviles, que a su vez le permitirán
									conocer la ubicación de sus seres queridos, como puede ser personas mayores, niños, etc.",
			"monitoring"		=>"MONITOREO",
			"begin_2"	    	=>"Monitoree sus unidades en cualquier momento.",
			"content_2_1"	  	=>"<b>SOLES GPS</b> pone a su disposición el servicio de Street View, una de las
							    	API'S mas famosas de google.",
			"content_2_2"	  	=>"Con la cual le permite observar de manera más atractiva
							    	el trayecto de alguna de tus unidades en <b>tiempo real</b>, 
							    	u observar algún viaje que haya realizado anteriormente.",
			"control"			=>"CONTROL",
			"total"				=>"TOTAL",
			"begin_3"	    	=>"Administre sus unidades de una manera integral.",
			"content_3_1"	  	=>"Nuestro sistema, pone a su disposición un conjunto de utilidades y 
									herramientas administrativas, para que tenga <b>Control Total</b> sobre
									sus dispositivos registrados.",
			"content_3_2"	  	=>"Algunas de las herramientas:",
			"content_3_3"	  	=>"<b>Geocercas</b>, le permiten delimitar zonas o rutas de traslado
									de tus unidades.",
			"content_3_4"	  	=>"<b>Alertas</b>, posibilidad de configurar un sin fin de alertas, tales como
									limites de velocidad, horarios de circulación, tiempo de paradas, etc.",
			"content_3_5"	  	=>"<b>Simulación</b>, revivir cualquier traslado dentro del historial, a través
									de la simulación, ubicando en el mapa los puntos por donde se movió tu unidad.",
			"content_3_6"	  	=>"<b>Notificaciones</b>, cualquier evento que para usted o su operación resulte sobresaliente
									será posible configurar para recibir notificaciones vía correo electrónico, en tiempo real.",
			"multi"				=>"MULTI",
			"platform"			=>"PLATAFORMA",
			"begin_4"	    	=>"Acceso a travez de Pc, Laptop, Tablet o Smart Phone.",
			"content_4_1"	  	=>"El sistema <b>SOLES GPS</b>, presenta la versatilidad de ser multiplataforma. 
									Puede ser utilizado desde cualquier dispositivo inteligente o PC. Solo contando 
									con una conexión a internet será posible tener acceso a todas
									sus funcionalidades  al alcance de su mano.",
			"reduction"			=>"REDUCCION",
			"costs"				=>"COSTOS",
			"begin_5"	    	=>"Obtenga un beneficio y desempeño optimo sobre tus unidades.",
			"content_5_1"	  	=>"Para <b>SOLES GPS</b>, lo más importante es ayudarlo a optimizar sus recursos, reducción de costos y el incremento de beneficios.",
			"satisfaction"		=>"SATISFACCION",
			"customer"			=>"CLIENTE",
			"begin_6"	    	=>"Servicios y soporte eficaz, oportuno y de calidad.",
			"content_6_1"	  	=>"<b>SOLES GPS</b>, busca constantemente mejorar y brindar a sus clientes
									herramientas más competitivas, que representen para ellos y para sus 
									propios clientes un incremento en sus utilidades.",
			"content_6_2"	  	=>"<b>SOLES GPS</b>, te permite compartir el tiempo de rastreo a tus clientes,
									esta característica representa para ellos un plus en su servicio.",
			"multiple"			=>"MULTIPLES",
			"reports"			=>"REPORTES",
			"begin_7"	    	=>"Reportes de los eventos de tus unidades.",
			"content_7_1"	  	=>"Posibilidad para analizar estadísticamente los eventos de cada una de sus unidades, a través
									de la gran variedad de reportes que le permiten llegar al nivel de detalle que usted necesite.",
			"content_7_2"	  	=>"Gestionar gran información sobre sus unidades, tales como viajes, servicios, refacciones, etc.",
			"record"			=>"HISTORIAL",
			"month"				=>"MES",
			"begin_8"	    	=>"1 mes de registro historico de eventos, por unidad.",
			"content_8_1"	  	=>"Historial de eventos, hasta por un mes dentro del sistema <b>SOLES GPS</b>, 
									si el número de unidades rebasa la cantidad de 50, se podrá instalar un centro
									de datos en su empresa con el límite de almacenamiento que usted decida.",
			"foot_1"			=>"Geolocalizacion y Rastreo Satelital",
			"foot_2"			=>"Vehicular y Celular",
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
