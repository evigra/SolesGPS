<?php
	require_once("nucleo/general.php");
	class webDrone extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"satellite_tracking"	    =>array(
			    "title"             => "RASTREO SATELITAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"real_time"	    =>array(
			    "title"         => "TIEMPO REAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    
			),
			"management"	    =>array(
			    "title"             => "ADMINISTRACION",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),	
			"effective"	    =>array(
			    "title"             => "EFECTIVA",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),	
			"tracking"	    =>array(
			    "title"             => "RASTREO",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"satellite"	    =>array(
			    "title"             => "SATELITAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_1"	    =>array(
			    "title"             => "Conozca todo el camino de tu unidad en cada traslado.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"monitoring"	    =>array(
			    "title"             => "MONITOREO",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_2"	    =>array(
			    "title"             => "Monitoree sus unidades en cualquier momento.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"control"	    =>array(
			    "title"             => "CONTROL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"total"	    =>array(
			    "title"             => "TOTAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_3"	    =>array(
			    "title"             => "Administre sus unidades de una manera integral.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),		
			"multi"	    =>array(
			    "title"             => "MULTI",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"platform"	    =>array(
			    "title"             => "PLATAFORMA",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_4"	    =>array(
			    "title"             => "Acceso a travez de Pc, Laptop, Tablet o Smart Phone.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"reduction"	    =>array(
			    "title"             => "REDUCCION",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"costs"	    	=>array(
			    "title"             => "COSTOS",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_5"	    =>array(
			    "title"             => "Obtenga un beneficio y desempeño optimo sobre tus unidades.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"satisfaction"	    =>array(
			    "title"             => "SATISFACCION",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"customer"	    	=>array(
			    "title"             => "CLIENTE",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_6"	    =>array(
			    "title"             => "Servicios y soporte eficaz, oportuno y de calidad.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"multiple"	    =>array(
			    "title"             => "MULTIPLES",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"reports"	    	=>array(
			    "title"             => "REPORTES",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_7"	    =>array(
			    "title"             => "Reportes de los eventos de tus unidades.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"record"	    =>array(
			    "title"             => "HISTORIAL",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"month"	    	=>array(
			    "title"             => "MES",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"begin_8"	    =>array(
			    "title"             => "1 mes de registro historico de eventos, por unidad.",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"our"	    	=>array(
			    "title"             => "NUESTRO",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"job"	    	=>array(
			    "title"             => "TRABAJO",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"main_services"	    	=>array(
			    "title"             => "Algunos de nuestros principales servicios, son los siguientes:",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"services"	    	=>array(
			    "title"             => "SERVICIOS",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"vehicle_tracking"	    	=>array(
			    "title"             => "RASTREO VEHICULAR",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"cell_tracking"	    	=>array(
			    "title"             => "RASTREO CELULAR",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"we_are"	    	=>array(
			    "title"             => "1 Sesion Fotografica<br><br>
			    						1 Vuelo <br><br>
			    						15 Fotos<br><br>
			    						1 CD con material del vuelo<br>
			    						Sin edicion
				",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"our_1"	    	=>array(
			    "title"             => "Nuestra",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),		
			"mission"	    	=>array(
			    "title"             => "MISION",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"our_mission"	    	=>array(
			    "title"             => "1 Sesion en Video<br><br>
			    						1 Vuelo <br><br>
			    						5 Fotos<br><br>
			    						1 Video de 1 o 2 minutos como maximo<br><br>
			    						1 CD con material del vuelo<br>
			    						Sin edicion
				",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),	
			"vision"	    	=>array(
			    "title"             => "VISION",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"our_vision"	    	=>array(
			    "title"             => "1 Sesion en Video<br><br>
			    						1 Vuelo <br><br>
			    						15 Fotos<br><br>
			    						1 Video de 2 o 3 minutos como maximo<br><br>
			    						1 CD con material del vuelo<br>
			    						Sin edicion
				",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"call_us"	    	=>array(
			    "title"             => "Llamanos",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"write_us"	    	=>array(
			    "title"             => "Escribenos",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"call_us_here"	    	=>array(
			    "title"             => "Llamanos Aqui",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"write_us_here"	    	=>array(
			    "title"             => "Escribenos Aqui",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"near_you"	    	=>array(
			    "title"             => "Cerca de Ti",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"foot_1"	    	=>array(
			    "title"             => "Geolocalizacion y Rastreo Satelital",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"foot_2"	    	=>array(
			    "title"             => "Vehicular y Celular",
			    "showTitle"         => "si",
			    "type"              => "txt",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),				
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        public function __CONSTRUCT()
		{
			@$_SESSION["user"]["l18n"]="";
			#@$_SESSION["user"]["l18n"]="es_MX";
			#@$_SESSION["user"]["l18n"]="en";

			parent::__CONSTRUCT();

		}

		public function __SAVE($datas=NULL,$option=NULL)
    	{
 	  		parent::__SAVE($datas,$option);
		}		
	}
?>
