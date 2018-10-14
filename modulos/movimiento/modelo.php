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
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"company_id"	    =>array(
			    "title"             => "Empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"trabajador_id"	=>array(
			    "title"             => "Vendedor",
			    "title_filter"      => "Empresa",	
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "value"             => "",			    
			    "procedure"       	=> "autocomplete_empresa",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "trabajador",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "trabajador_id",
			    "class_field_m"    	=> "id",			    
			),			
			"empresa_id"	=>array(
			    "title"             => "Empresa",
			    "title_filter"      => "Empresa",	
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "value"             => "",			    
			    "procedure"       	=> "autocomplete_empresa",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "company",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "empresa_id",
			    "class_field_m"    	=> "id",			    
			),			
			"movimientos_ids"	    =>array(
			    "title"             => "Horario",
			    "showTitle"         => "si",
			    "type"              => "form",
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "many2one",			    
			    "class_name"       	=> "movimientos",			    
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "movimiento_id",				
			),
			"tipo"	    =>array(
			    "title"             => "Tipo",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),			
			"compra"	    =>array(
			    "title"             => "Lista de compra",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),			
			"venta"	    =>array(
			    "title"             => "Lista de venta",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),			
			"registro"	    =>array(
			    "title"             => "Registrado",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"fecha"	    =>array(
			    "title"             => "Fecha",
			    "title_filter"      => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "datetime",
			    "default"           => "",
			    "value"             => "",
			),				

			"caducidad"	    =>array(
			    "title"             => "Caducidad",
			    "title_filter"      => "Caducidad",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",
			),
			"folio"	    =>array(
			    "title"             => "Folio",
			    "title_filter"      => "Folio",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),	
			"cron_cantidad"	    =>array(
			    "title"             => "Cantidad de Tiempo",
			    "showTitle"         => "si",
			    "type"              => "input",
			),	
			"cron_unidad"	    =>array(
			    "title"             => "Unidad de tiempo",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "source"            => array(
				    "DAY"     		=> "Dia",
				    "MONTH"     	=> "Mes",
				    "YEAR"  	   	=> "Ano",
				)
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
			$datas["registro"]			=$this->sys_date;
			$datas["company_id"]		=$_SESSION["company"]["id"];
			if(!isset($datas["trabajador_id"]))	$datas["trabajador_id"]=$_SESSION["user"]["id"];

			$_this->__PRINT_R($_SESSION);

    	    return parent::__SAVE($datas,$option);
		}
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")					$option				=array();			
			if(!isset($option["where"]))	$option["where"]	=array();
			
    		$option["where"][]				="company_id={$_SESSION["company"]["id"]}";    		

			return parent::__BROWSE($option);
		}							
	}
?>

