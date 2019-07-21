<?php
	class travels extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="OVT";
		
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
   		public function action_confirmar()
    	{
    		$this->__FIELDS();			
    		$datas			=array();
    		$datas["estatus"]="1";    		   			
			$datas["flow"]	="flow3";

    	    $return= parent::__SAVE($datas);
    	    return $return;
		}
		##############################################################################
   		public function action_cancelar()
    	{    	
    		$datas			=array();
    		$datas["estatus"]="-1";    		   			
			$datas["flow"]	="flow4";

    	    $return= parent::__SAVE($datas);
    	    return $return;
		}
		##############################################################################
   		public function action_enviar()
    	{       	
			$this->__FIELDS();			
			$opcion=array(
				"message"=>"CORREO ENVIADO",
			);
					
			$this->__SAVE($this->sys_request, $opcion);			
    	    	
			$data			=array();
			$data["flow"]	="flow2";
			$this->__SAVE($data);
    	
    		if($this->sys_fields["empresa_id"]["values"][0]["email"]!="")
    		{
				$option=array(
					"title"	=>"SolesGPS :: Cotizacion",
					"to"	=>$this->sys_fields["empresa_id"]["values"][0]["email"],
					"to"	=>"evigra@gmail.com,contacto@solesgps.com",
					"html"	=>"<b>{$this->sys_fields["empresa_id"]["values"][0]["nombre"]}</b> <br>
PRESENTE <br><br>

Buenas día<br><br>

Le hacemos llegar la cotización solicitada.<br><br>

Nuestro servicio de rastreo lee permite a ustedes observar a cualquier hora del día la ubicación de sus unidades.<br>
Como características principales el sistema soles le ofrece las siguientes:<br><br>

    * Rastreo en tiempo real con reporte de actualización cada minuto.<br>
    * Geocercas, delimitar zonas geográficas de cualquier dimensión, <br>
    * Alertas e-mail de entrada o salida de geocercas, exceso de velocidad, horarios de servicio, etc.<br>
    * Paro de motor de forma remota.<br>
    * Trazado de rutas.<br>
    * Reporte de paradas, y duración de cada una de ellas.<br>
    * Visión Street view en tiempo real.<br>
    * Simulación de recorrido a manera de historial.<br>
    * Reportes gráficos de historial.<br><br>

Ademas uno de los principales beneficios con los que cuenta con nosotros, es del desarrollo 
a la medida, podemos generar la solución a cualquier necesidad operativa integrándolo a nuestro sistema para su servicio sin compromiso alguno<br>

Estamos a su completa disposición en caso de requerir mas información o resolución de dudas.<br><br>

Sin mas por ahora, agradecemos de antemano su atención, y les deseamos que tengan un excelente día.<br><br>

Saludos cordiales<br>
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
   		public function __VIAJE_HOY($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla
			
			$option["where"][]				="fecha>='{$_SESSION["var"]["datetime"]}'";   # PL plantilla
			$option["where"][]				="caducidad<='{$_SESSION["var"]["datetime"]}'";   # PL plantilla
						
			$return= parent::__BROWSE($option);
			return $return;
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
