<?php
	class orden_venta extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="OV";
		
		var $movimiento_obj;
		
		##############################################################################	
		##  Metodos	
		##############################################################################        
		public function __CONSTRUCT($option=NULL)
		{				
			parent::__CONSTRUCT($option);		
		}
		##############################################################################
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    		    					
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
		##############################################################################
   		public function action_enviar()
    	{   
    		if($this->sys_fields["empresa_id"]["values"][0]["email"]!="")
    		{
				$option=array(
					"title"	=>"SolesGPS :: Cotizacion",
					"to"	=>$this->sys_fields["empresa_id"]["values"][0]["email"],
					"to"	=>"evigra@gmail.com,  contacto@solesgps.com",
					"html"	=>"

{$this->sys_fields["empresa_id"]["values"][0]["nombre"]} \n
PRESENTE \n\n

Buenas día\n\n

Le hacemos llegar la cotización solicitada.\n\n

Nuestro servicio de rastreo lee permite a ustedes observar a cualquier hora del día la ubicación de sus unidades.\n
Como características principales el sistema soles le ofrece las siguientes:\n\n

    * Rastreo en tiempo real con reporte de actualización cada minuto.\n
    * Geocercas, delimitar zonas geográficas de cualquier dimensión, \n
    * Alertas e-mail de entrada o salida de geocercas, exceso de velocidad, horarios de servicio, etc.\n
    * Paro de motor de forma remota.\n
    * Trazado de rutas.\n
    * Reporte de paradas, y duración de cada una de ellas.\n
    * Visión Street view en tiempo real.\n
    * Simulación de recorrido a manera de historial.\n
    * Reportes gráficos de historial.\n\n

Ademas uno de los principales beneficios con los que cuenta con nosotros, es del desarrollo 
a la medida, podemos generar la solución a cualquier necesidad operativa integrándolo a nuestro sistema para su servicio sin compromiso alguno\n\n

Estamos a su completa disposición en caso de requerir mas información o resolución de dudas.\n\n

Sin mas por ahora, agradezco de antemano su atención, y le deseo que tenga un excelente día.\n\n

Saludos cordiales
Equipo SolesGPS	
					",
					"file"	=>"http://developer.solesgps.com/orden_venta/&sys_action=print_pdf&sys_section=write&sys_id={$this->sys_private["id"]}&sys_pdf=S"
				);			
				
				$this->send_mail($option);
								
				$this->__PRINT_R("CORREO ENVIADO"); 		    				    		
			}   
			else 	        	    $this->__PRINT_R("La empresa no tiene correo registrado"); 		    				    		
		}
		##############################################################################
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla
			
			if(!isset($this->sys_private["order"]) OR $this->sys_private["order"]=="")
				$option["order"]="id desc";
			
			$return= parent::__BROWSE($option);
			return $return;
		}							
	}
?>
