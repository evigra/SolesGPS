<?php
	require_once("nucleo/general.php");
	class webHome extends general
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
			    "title"             => "Somos una empresa orgullosamente mexicana, fundada en la ciudad de Manzanillo, Colima.
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
			    "title"             => " <p> 
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
			    "title"             => "<p>
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
    		/*
    		echo "SAVE MODULO";
    		$this->__PRINT_R($datas);
    		*/
    		parent::__SAVE($datas,$option);
    		#$this->__PRINT_R($this->sys_sql);
    		
		}		
	}
?>
