<?php
	require_once("nucleo/general.php");
	class webFeatures extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"tracking"	    =>array(
			    "title"             => "RASTREO",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"satellite"	    =>array(
			    "title"             => "SATELITAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    
			),
			"begin_1"	    =>array(
			    "title"             => "Conozca todo el camino de tu unidad en cada traslado.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"content_1_1"	    =>array(
			    "title"             => "En la actualidad es muy importante conocer con exactitud la posición,
										de cada una de nuestras unidades automotores. <b>SOLES GPS</b>, le ofrece
										opciones de rastreo satelital, para que sus vehículos siempre esten al alcance
										de su vista.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"content_1_2"	    =>array(
			    "title"             => "Además de el rastreo satelital de vehículos, <b>SOLES GPS</b>, le ofrece
										la posibilidad de rastrear tus dispositivos móviles, que a su vez le permitirán
										conocer la ubicación de sus seres queridos, como puede ser personas mayores, niños, etc.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"monitoring"	    =>array(
			    "title"             => "MONITOREO",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"begin_2"	    	=>array(
			    "title"             => "Monitoree sus unidades en cualquier momento.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_2_1"	    =>array(
			    "title"             => "<b>SOLES GPS</b> pone a su disposición el servicio de Street View, una de las
							    		API'S mas famosas de google.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_2_2"	    =>array(
			    "title"             => "Con la cual le permite observar de manera más atractiva
							    		el trayecto de alguna de tus unidades en <b>tiempo real</b>, 
							    		u observar algún viaje que haya realizado anteriormente.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"control"	    =>array(
			    "title"             => "CONTROL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"total"	    =>array(
			    "title"             => "TOTAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"begin_3"	    =>array(
			    "title"             => "Administre sus unidades de una manera integral.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_3_1"	    =>array(
			    "title"             => "Nuestro sistema, pone a su disposición un conjunto de utilidades y 
										herramientas administrativas, para que tenga <b>Control Total</b> sobre
										sus dispositivos registrados.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_3_2"	    =>array(
			    "title"             => "Algunas de las herramientas:",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_3_3"	    =>array(
			    "title"             => "<b>Geocercas</b>, le permiten delimitar zonas o rutas de traslado
										de tus unidades.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_3_4"	    =>array(
			    "title"             => "<b>Alertas</b>, posibilidad de configurar un sin fin de alertas, tales como
										limites de velocidad, horarios de circulación, tiempo de paradas, etc.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_3_5"	    =>array(
			    "title"             => "<b>Simulación</b>, revivir cualquier traslado dentro del historial, a través
										de la simulación, ubicando en el mapa los puntos por donde se movió tu unidad.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_3_6"	    =>array(
			    "title"             => "<b>Notificaciones</b>, cualquier evento que para usted o su operación resulte sobresaliente
										será posible configurar para recibir notificaciones vía correo electrónico, en tiempo real.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"multi"	    =>array(
			    "title"             => "MULTI",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"platform"	    =>array(
			    "title"             => "PLATAFORMA",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"begin_4"	    =>array(
			    "title"             => "Acceso a travez de Pc, Laptop, Tablet o Smart Phone.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"content_4_1"	    =>array(
			    "title"             => "El sistema <b>SOLES GPS</b>, presenta la versatilidad de ser multiplataforma. 
										Puede ser utilizado desde cualquier dispositivo inteligente o PC. Solo contando 
										con una conexión a internet será posible tener acceso a todas
										sus funcionalidades  al alcance de su mano.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"reduction"	    =>array(
			    "title"             => "REDUCCION",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"costs"	    =>array(
			    "title"             => "COSTOS",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"begin_5"	    =>array(
			    "title"             => "Obtenga un beneficio y desempeño optimo sobre tus unidades.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_5_1"	    =>array(
			    "title"             => "Para <b>SOLES GPS</b>, lo más importante es ayudarlo a optimizar sus recursos, reducción de costos y el incremento de beneficios.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"satisfaction"	    =>array(
			    "title"             => "SATISFACCION",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"customer"	    =>array(
			    "title"             => "CLIENTE",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"begin_6"	    =>array(
			    "title"             => "Servicios y soporte eficaz, oportuno y de calidad.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_6_1"	    =>array(
			    "title"             => "<b>SOLES GPS</b>, busca constantemente mejorar y brindar a sus clientes
										herramientas más competitivas, que representen para ellos y para sus 
										propios clientes un incremento en sus utilidades.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_6_2"	    =>array(
			    "title"             => "<b>SOLES GPS</b>, te permite compartir el tiempo de rastreo a tus clientes,
									esta característica representa para ellos un plus en su servicio.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"multiple"	    =>array(
			    "title"             => "MULTIPLES",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"reports"	    =>array(
			    "title"             => "REPORTES",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"begin_7"	    =>array(
			    "title"             => "Reportes de los eventos de tus unidades.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"content_7_1"	    =>array(
			    "title"             => "Posibilidad para analizar estadísticamente los eventos de cada una de sus unidades, a través
										de la gran variedad de reportes que le permiten llegar al nivel de detalle que usted necesite.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"content_7_2"	    =>array(
			    "title"             => "Gestionar gran información sobre sus unidades, tales como viajes, servicios, refacciones, etc.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"record"	    =>array(
			    "title"             => "HISTORIAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),	
			"month"	   	 	=>array(
			    "title"             => "MES",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"begin_8"	    =>array(
			    "title"             => "1 mes de registro historico de eventos, por unidad.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),
			"content_8_1"	    =>array(
			    "title"             => "Historial de eventos, hasta por un mes dentro del sistema <b>SOLES GPS</b>, 
										si el número de unidades rebasa la cantidad de 50, se podrá instalar un centro
										de datos en su empresa con el límite de almacenamiento que usted decida.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			),				
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################
  		
			public function __CONSTRUCT()
		{
			#@$_SESSION["user"]["l18n"]="";
			@$_SESSION["user"]["l18n"]="es_MX";
			#@$_SESSION["user"]["l18n"]="en";

			parent::__CONSTRUCT();

		}

	}
?>
