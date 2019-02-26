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
			    "title"             => "Empresa",
			    "type"              => "input",
			),			
			"trabajador_id"	    =>array(
			    "title"             => "Vendedor",
			    "description"       => "Responsable del dispositivo",
			    "type"              => "autocomplete",
			    "procedure"       	=> "__AUTOCOMPLETE",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "trabajador",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "trabajador_id",
			    "class_field_m"    	=> "id",			    
			),			
			"empresa_id"	=>array(
			    "title"             => "Empresa",
			    "title_filter"      => "Empresa",	
			    "type"              => "autocomplete",
			    "value"             => "",			    
			    "procedure"       	=> "__AUTOCOMPLETE",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "company",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "empresa_id",
			    "class_field_m"    	=> "id",			    
			),			
			"movimientos_ids"	    =>array(
			    "title"             => "Horario",
			    "type"              => "form",
			    "relation"          => "many2one",			    
			    "class_name"       	=> "movimientos",			    
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "movimiento_id",				
			),
			"tipo"	    =>array(
			    "title"             => "Tipo",
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
			    "title"             => "Folio",
			    "title_filter"      => "Folio",
			    "type"              => "hidden",
			),	
			"estatus"	    =>array(
			    "title"             => "Activo",
			    "type"              => "checkbox",
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
        
		public function __CONSTRUCT()
		{	
			parent::__CONSTRUCT();					
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
			$datas["registro"]				=$this->sys_date;
			if(isset($_SESSION["company"]["id"]))
				$datas["company_id"]		=$_SESSION["company"]["id"];
			if(!isset($datas["trabajador_id"])	OR $datas["trabajador_id"]=="")	
				$datas["trabajador_id"]		=$_SESSION["user"]["trabajador_id"];		

    	    return parent::__SAVE($datas,$option);
		}
   		public function __INPUT($words=NULL, $fields=NULL)
    	{
    	    $this->words =parent::__INPUT($words, $fields);    	    
    	    $this->__TOTALES($this->obj_movimientos_ids->__VIEW_REPORT);
    	    
    	    return parent::__INPUT($this->words, $this->sys_fields);    	        	    
		}
   		public function __TOTALES($option=NULL)
    	{
    		#$this->__PRINT_R($option);
    		$this->sys_fields["subtotal"]["value"]=0;
    		$this->sys_fields["iva"]["value"]=0;
    		$this->sys_fields["total"]["value"]=0;
    		foreach($option["data"] as $row)
    		{
				$this->sys_fields["subtotal"]["value"]+=$row["subtotal"];
    		}    		    		    		
    		$this->sys_fields["total"]["value"]		=$this->sys_fields["subtotal"]["value"] + $this->sys_fields["iva"]["value"];  			
    		$this->sys_fields["subtotal"]["value"]	=$this->sys_fields["subtotal"]["value"];
		}
		
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")					$option				=array();			
			if(!isset($option["where"]))	$option["where"]	=array();
			
			if(isset($_SESSION["company"]["id"]))
	    		$option["where"][]			="company_id={$_SESSION["company"]["id"]}";    		
			return parent::__BROWSE($option);
		}							
	}
?>

