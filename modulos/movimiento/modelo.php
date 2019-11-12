<?php
	class movimiento extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),
			"company_id"	    =>array(
			    "title"             => "empresa",
			    "titleShow"         => "no",			    
			    "description"       => "Responsable del dispositivo",
			    "type"              => "autocomplete",
			    "procedure"       	=> "__AUTOCOMPLETE",
			    "relation"          => "many2one",
			    "recursive"         => "2",
			    "class_name"       	=> "company",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "company_id",
			    "class_field_m"    	=> "id",			    
			),			
			"trabajador_id"	    =>array(
			    "title"             => "Vendedor",
			    "description"       => "Responsable del dispositivo",
			    "type"              => "autocomplete",
			    "procedure"       	=> "__AUTOCOMPLETE",
			    "relation"          => "many2one",
			    "recursive"         => "2",
			    "class_name"       	=> "trabajador",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "trabajador_id",
			    "class_field_m"    	=> "id",			    
			),			
			"empresa_id"	=>array(
			    "title"             => "Empresa",
			    "title_filter"      => "Empresa",	
			    "type"              => "autocomplete",	
			    "procedure"       	=> "__AUTOCOMPLETE",
			    #"relation"          => "one2many",			    
			    "relation"          => "many2one",
			    "recursive"         => "2",
			    "class_name"       	=> "company_system",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "empresa_id",
			    "class_field_m"    	=> "id",			    
			),			
			#/*
			"movimiento_id"	    =>array(
			    "type"              => "autocomplete",
			    "procedure"       	=> "__AUTOCOMPLETE",
			    #"relation"          => "one2many",			    
			    "relation"          => "many2one",
			    "recursive"         => "2",
			    "class_name"       	=> "movimiento",			    
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "movimiento_id",
			    "class_field_m"    	=> "id",			    
			),
			#*/
			"movimientos_ids"	    =>array(
			    "type"              => "form",
			    "relation"          => "one2many",
			    "class_name"       	=> "movimientos",			    
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "movimiento_id",				
			),
			"subtipo"	    =>array(
			    "title"             => "Tipo",
			    "title_filter"      => "Subtipo",		
			    "type"              => "input",
			),			
			"tipo"	    =>array(
			    "title"             => "Tipo",
			    "title_filter"      => "Tipo",				    
			    "type"              => "hidden",
			),			
			"compra"	    =>array(
			    "title"             => "Lista de compra",
			    "type"              => "hidden",
			),			
			"venta"	    =>array(
			    "title"             => "Lista de venta",
			    "type"              => "hidden",
			),			
			"registro"	    =>array(
			    "title"             => "Registrado",
			    "type"              => "input",
			),			
			"fecha"	    =>array(
			    "title"             => "Fecha",
			    "title_filter"      => "Fecha",
			    "type"              => "datetime",
			),				

			"caducidad"	    =>array(
			    "title"             => "Caducidad",
			    "title_filter"      => "Caducidad",
			    "type"              => "date",
			),
			"folio"	    =>array(
			    "title"             => "Folio Interno",
			    "title_filter"      => "Folio Interno",
			    "type"              => "hidden",
			),	
			"estatus"	    =>array(
			    "title"             => "Estatus",
			    "type"              => "select",
			    "source"            => array(
				    "1"     		=> "Activo",
				    "0" 	    	=> "Bloqueado",
				    "-1"  	   		=> "Cancelado",
				)
			),
			"flow"	    =>array(
			    "title"             => "Estado",
			    "type"              => "flow",			    
			    "source"            => array(			    	
				    "flow1"     	=> "Presupuesto",
				    "flow2"     	=> "Presup. Enviado",
				    "flow3"  	   	=> "Confirmado",
				    "flow4"  	   	=> "Cancelado",
				)
			),			
			"cron_cantidad"	    =>array(
			    "title"             => "Cantidad de Tiempo",
			    "type"              => "input",
			),	
			"cron_unidad"	    =>array(
			    "title"             => "Unidad de tiempo",
			    "type"              => "select",
			    "source"            => array(
				    "DAY"     		=> "Dia",
				    "MONTH"     	=> "Mes",
				    "YEAR"  	   	=> "Ano",
				)
			),	
			"subtotal"	    =>array(
			    "title"             => "Subtotal",
			    "type"              => "input",
			),	
			"total"	    =>array(
			    "title"             => "Total",
			    "type"              => "input",
			),	
			"iva"	    =>array(
			    "title"             => "IVA",
			    "type"              => "input",
			),	
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################        
		public function __CONSTRUCT($option=NULL)
		{	
			return parent::__CONSTRUCT($option);					
		}
   		public function action_enviar()
    	{       	
			$this->__FIELDS();			
			$opcion=array(
				"message"=>"CORREO ENVIADO",
			);
					
			$this->sys_request["flow"]	="flow2";					
			$this->__SAVE($this->sys_request, $opcion);			
			    	
    		if($this->sys_fields["empresa_id"]["values"][0]["email"]!="")
    		{
				$option=array(
					"title"	=>"SolesGPS :: Cotizacion",
					"to"	=>$this->sys_fields["empresa_id"]["values"][0]["email"],
					"to"	=>"evigra@gmail.com,contacto@solesgps.com",
					"to"	=>"evigra@gmail.com",
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
   		public function action_enviar_wa()
    	{       	
			$this->__FIELDS();			
			$opcion=array(
				"message"=>"WhatsApp ENVIADO",
			);
					
			$this->sys_request["flow"]	="flow2";					
			$this->__SAVE($this->sys_request, $opcion);				
    	
    		if($this->sys_fields["empresa_id"]["values"][0]["telefono"]!="")
    		{
				$return=$this->__WA(
					array(
						"telefono"=>$this->sys_fields["empresa_id"]["values"][0]["telefono"], 
						"mensaje"=>"Su orden de venta la encontrara en la siguiente liga 
						
						http://developer.solesgps.com/orden_venta/&sys_action=print_pdf&sys_section=write&sys_id={$this->sys_private["id"]}&sys_pdf=S&a=.pdf"
					)
				);							
				#$this->__PRINT_R($return); 		    				    		
			}   
			else 	        	    $this->__PRINT_R("La empresa no tiene telefono registrado"); 		    				    		
		}
		
   		public function action_confirmar()
    	{
    		$this->__FIELDS();			
    		$datas				=array();
    		$datas["estatus"]	="1";    		   			
			$datas["flow"]		="flow3";

    	    $return				=$this->__SAVE($datas);
    	    return $return;
		}
		##############################################################################
   		public function action_cancelar()
    	{    	
    		$datas				=array();
    		$datas["estatus"]	="-1";    		   			
			$datas["flow"]		="flow4";

    	    $return				=$this->__SAVE($datas);
    	    return $return;
		}
		
		##############################################################################
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
  			if((!isset($datas["tipo"]) OR $datas["tipo"]=="") AND isset($this->tipo_movimiento) AND $this->tipo_movimiento!="")
    			$datas["tipo"]					=$this->tipo_movimiento;								
    		    		
			if(!isset($datas["estatus"]))
    		{
    			$datas["estatus"]	="1";    		   			
				$datas["flow"]		="flow3";
			}

			if(isset($datas["subtipo"]) AND ($datas["subtipo"]=="SV" OR $datas["subtipo"]=="SC"))	
			{
				$datas["iva"]					=0;				
				$datas["total"]					=$datas["subtotal"];
			}					
			if($this->sys_private["section"]=="create")
			{
				$option_folios=array();
				$option_folios["tipo"]			=$datas["tipo"];
				$option_folios["variable"]		=date("Y");
				$datas["folio"]					=$this->__FOLIOS($option_folios);
			}				

			$datas["registro"]					=$this->sys_date;
			if(isset($_SESSION["company"]["id"]))
				$datas["company_id"]			=$_SESSION["company"]["id"];
			if(!isset($datas["trabajador_id"])	OR $datas["trabajador_id"]=="")	
				$datas["trabajador_id"]			=$_SESSION["user"]["trabajador_id"];		

    	    return parent::__SAVE($datas,$option);
		}
		##############################################################################
   		public function __INPUT($words=NULL, $fields=NULL)
    	{
    	    $this->words =parent::__INPUT($words, $fields);    	    
    	    
    	    if(isset($this->tipo_movimiento) AND !in_array($this->tipo_movimiento,array("PV","PC")) AND isset($this->sys_fields["movimientos_ids"]["obj"]->__VIEW_REPORT))    	    
	    	    $this->__TOTALES($this->sys_fields["movimientos_ids"]["obj"]->__VIEW_REPORT);
    	    
    	    return parent::__INPUT($this->words, $this->sys_fields);    	        	    
		}
		##############################################################################
   		public function __TOTALES($option=NULL)
    	{
    		$this->sys_fields["subtotal"]["value"]	=0;
    		$this->sys_fields["iva"]["value"]		=0;
    		$this->sys_fields["total"]["value"]		=0;
    		foreach(@$option["data"] as $row)
    		{
				$this->sys_fields["subtotal"]["value"]	+=$row["subtotal"];
				$this->sys_fields["iva"]["value"]		+=$row["impuesto"];
    		}
			if(isset($this->sys_fields["subtipo"]["value"]) AND ($this->sys_fields["subtipo"]["value"]=="SV" OR $this->sys_fields["subtipo"]["value"]=="SC"))	
				$this->sys_fields["iva"]["value"]=0;

    		$this->sys_fields["total"]["value"]		=$this->sys_fields["subtotal"]["value"] + $this->sys_fields["iva"]["value"];  			
    		$this->sys_fields["subtotal"]["value"]	=$this->sys_fields["subtotal"]["value"];
		}
		##############################################################################
   		public function __VIEW_REPORT($option="")
    	{			    	
			if($option=="")					$option				=array();			
			if(!isset($option["color"]))	$option["color"]	=array();		
			
			$option["color"]["orange"]		="$"."row[\"estatus\"]=='-1'";	
			$option["color"]["red"]			="$"."row[\"flow\"]=='flow4'";
			return parent::__VIEW_REPORT($option);
		}							
		##############################################################################
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")					$option				=array();			
			if(!isset($option["where"]))	$option["where"]	=array();
			
			if(isset($_SESSION["company"]["id"]))
	    		$option["where"][]			="company_id={$_SESSION["company"]["id"]}";    		
	    		
			if(!isset($this->sys_private["order"]))
				$option["order"]="id desc";
	    		
			return parent::__BROWSE($option);
		}							
		##############################################################################
   		public function __BROWSE_CUENTAS($option="")
    	{			    	
			if($option=="")					$option				=array();			
			if(!isset($option["where"]))	$option["where"]	=array();
			
			if(!isset($option["select"]))	$option["select"]	=array();

			$option["select"][]	="m1.*";
			$option["select"]["CASE WHEN SUM(m1.orden)>0 THEN SUM(m1.orden)	END"]	="orden";
			$option["select"]["CASE WHEN SUM(m1.pago)>0 THEN SUM(m1.pago) END"]		="pago";
			$option["select"]["			
				CASE					
					WHEN venta=1 AND SUM(m1.pago)-SUM(m1.orden)>0 THEN SUM(m1.orden)-SUM(m1.pago)
					WHEN venta=1 AND SUM(m1.orden)-SUM(m1.pago)>0 THEN SUM(m1.orden)-SUM(m1.pago)
					WHEN venta=1 AND SUM(m1.pago)-SUM(m1.orden)=0 THEN ''

					WHEN compra=1 AND SUM(m1.orden)-SUM(m1.pago)>0 THEN SUM(m1.pago)-SUM(m1.orden)
					WHEN compra=1 AND SUM(m1.pago)-SUM(m1.orden)>0 THEN SUM(m1.pago)-SUM(m1.orden)
					#WHEN compra=1 AND SUM(m1.pago)-SUM(m1.orden)=0 THEN ''
				END
			"]="deudor"; 
			$option["select"]["			
				CASE					
					WHEN venta=1 THEN ''
					WHEN compra=1 THEN ''
				END
			"]="modulo_deudor"; 


			$option["select"]["				
				CASE 
					WHEN compra=1 AND SUM(m1.pago)-SUM(m1.orden)>0 THEN ''
				END				
			"]="acreedor";
			$option["select"]["			
				CASE					
					WHEN venta=1 THEN '../pago_venta/'
					WHEN compra=1 THEN '../pago_compra/'
				END
			"]="modulo_acreedor"; 
			
			$option["select"]["IF(SUM(m1.orden)-SUM(m1.pago)!=0 AND COMPRA=1, '#ff0000','')"]="color1";
			$option["select"]["IF(SUM(m1.orden)-SUM(m1.pago)!=0 AND VENTA=1, '#1bce54','')"]="color2";    
			$option["select"]["IF(SUM(m1.orden)-SUM(m1.pago)=0, '#ccc','')"]="color3";

			$option["from"]		="
				(
					SELECT  
						(CASE WHEN tipo IN (\"PV\",\"OC\") then total else 0 end) as PAGO,
						(CASE WHEN tipo IN (\"OV\",\"PC\") then total else 0 end) as ORDEN,		
						m.*
					FROM movimiento m 
					WHERE 
						tipo in (\"PV\", \"OV\",\"PC\", \"OC\")			
						AND estatus=1
						AND flow='flow3'
				) m1 
			";
			$option["group"]	="m1.empresa_id";
			return $option;
		}
		##############################################################################
   		public function __BROWSE_TOTALES($option="")
    	{			    	
			if($option=="")					$option				=array();			
			if(!isset($option["select"]))	$option["select"]	=array();
			if(!isset($option["where"]))	$option["where"]	=array();
			
			$option["select"][]	="m1.*";
			$option["select"]["CASE WHEN SUM(m1.orden)>0 THEN SUM(m1.orden)	END"]	="orden";
			$option["select"]["CASE WHEN SUM(m1.pago)>0 THEN SUM(m1.pago) END"]		="pago";
			$option["select"]["
				CASE					
					WHEN venta=1 AND SUM(m1.pago)-SUM(m1.orden)>0 THEN SUM(m1.orden)-SUM(m1.pago)
					WHEN venta=1 AND SUM(m1.orden)-SUM(m1.pago)>0 THEN SUM(m1.orden)-SUM(m1.pago)
					WHEN venta=1 AND SUM(m1.pago)-SUM(m1.orden)=0 THEN ''

					WHEN compra=1 AND SUM(m1.orden)-SUM(m1.pago)>0 THEN SUM(m1.pago)-SUM(m1.orden)
					#WHEN compra=1 AND SUM(m1.orden)-SUM(m1.pago)>0 THEN SUM(m1.orden)-SUM(m1.pago)
					#WHEN compra=1 AND SUM(m1.pago)-SUM(m1.orden)=0 THEN ''
				END				
			"]="deudor"; 
			$option["select"]["				
				CASE 
					WHEN compra=1 AND SUM(m1.pago)-SUM(m1.orden)>0 THEN ''
				END				
			"]="acreedor";
			
			$option["select"]["IF(SUM(m1.orden)-SUM(m1.pago)!=0 AND COMPRA=1, '#ff0000','')"]="color1";
			$option["select"]["IF(SUM(m1.orden)-SUM(m1.pago)!=0 AND VENTA=1, '#1bce54','')"]="color2";    
			$option["select"]["IF(SUM(m1.orden)-SUM(m1.pago)=0, '#ccc','')"]="color3";

			$option["from"]		="
				(
					SELECT  
						SUM(CASE WHEN tipo IN (\"PV\",\"OC\") then total else 0 end) as PAGO,
						SUM(CASE WHEN tipo IN (\"OV\",\"PC\") then total else 0 end) as ORDEN,		
						vc.id,company_id,IF(venta=1, 'VENTA','COMPRA'),registro,tipo,compra,venta,fecha,movimiento_id,folio,
						caducidad,estatus,cron_cantidad,cron_unidad,trabajador_id,subtotal,iva,total,subtipo
					FROM movimiento vc 
					WHERE 
						tipo in (\"PV\", \"OV\",\"PC\", \"OC\")			
						AND estatus=1
					GROUP BY tipo					
				) m1
			";
			$option["group"]	="m1.empresa_id";
			return parent::__BROWSE($option);
		}									
	}
?>
