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

			"empresa_id"	=>array(
			    "title"             => "Empresa",
			    "title_filter"      => "Empresa",	
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    #"source"           	=> "../modulos/empresa/ajax/autocomplete.php",
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
				#"class_template"  	=> "many2one_lateral",			    
				#"class_report" 		=> "kanban",			    
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "movimiento_id",				
				#"class_field_l"    	=> "horario",	
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
			"movimiento_id"	    =>array(
			    "title"             => "Relacion",
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
			/*		
			"plazos_id"	    =>array(
			    "title"             => "Plazos",
			    "title_filter"      => "Plazos",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			*/
				
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################
        
		public function __CONSTRUCT()
		{	
			parent::__CONSTRUCT();		
			#$this->__PRINT_R($_SESSION["SAVE"]);
			
		}
		public function __FOLIOS($option_folios="")
		{	
			$option_folios=array();
			$option_folios["variable"]		=date("Y");
			$option_folios["subvariable"]	=date("Y");
			$option_folios["tipo"]			="SO";
			$option_folios["subtipo"]		="";
			$option_folios["objeto"]		="";
		
			return parent::__FOLIOS($option_folios);		
		}

		#/*
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    		#$datas["total"]		=count(explode(",",$datas["dias"]));
			$datas["registro"]			=$this->sys_date;
			$datas["company_id"]		=$_SESSION["company"]["id"];
			
			if(@$this->request["sys_section_movimiento"]=="create")
			{				
				$datas["folio"]				=$this->__FOLIOS();
			}
			/*				
			if(@$this->request["sys_action_movimiento"]=="__SAVE_pagar")
			{
				$datas["movimiento_id"]						=$this->sys_primary_id;
				$datas["tipo"]								="PAG";
				
				$this->request["sys_id"]					="";
				$this->request["sys_id_movimiento"]			="";
				$this->request["sys_section_movimiento"]	="create";
				
				$this->sys_primary_id	="";
			}
			*/
			
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='PL'";   # PL plantilla
    		$option["where"][]				="company_id={$_SESSION["company"]["id"]}";    		

			return parent::__BROWSE($option);
		}							

	}
?>

