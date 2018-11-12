<?php	
	class item extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $modulo		="";
		var $sys_fields		=array(
				"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),		
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),									
			"tipo"	    	=>array(
			    "title"             => "tipo",
			    "type"              => "hidden",
			),
			"nombre"	    	=>array(
			    "title"             => "Nombre",
			    "type"              => "input",
  			    "style"             => array(			    	
					"font-size"		=>array("30px"=>"1==1"),					
			    ),			    			    			    	    
			),
			"modulo"	    	=>array(
			    "title"             => "modulo",
			    "type"              => "hidden",
			),
			"descripcion"	    	=>array(
			    "title"             => "Descripcion",
			    "type"              => "input",
			),
			"servicio"	    =>array(
			    "title"             => "Servicio",
			    "type"              => "checkbox",
			),	
			"se_compra"	    =>array(
			    "title"             => "Se compra",
			    "type"              => "checkbox",
			),
			"se_vende"	    =>array(
			    "title"             => "Se vende",
			    "type"              => "checkbox",
			),						
			"compra1"	    =>array(
			    "title"             => "Precio de compra",
			    "type"              => "input",
			),						
			"compra2"	    =>array(
			    "title"             => "Compra 2",
			    "type"              => "input",
			),						
			"compra3"	    =>array(
			    "title"             => "Compra 3",
			    "type"              => "input",
			),						
			"compra4"	    =>array(
			    "title"             => "Compra 4",
			    "type"              => "input",
			),						
			"compra5"	    =>array(
			    "title"             => "Compra 5",
			    "type"              => "input",
			),									
			"vende1"	    =>array(
			    "title"             => "Precio de venta",
			    "type"              => "input",
			),
			"vende2"	    =>array(
			    "title"             => "Venta 2",
			    "type"              => "input",
			),
			"vende3"	    =>array(
			    "title"             => "Venta 3",
			    "type"              => "input",
			),
			"vende4"	    =>array(
			    "title"             => "Venta 4",
			    "type"              => "input",
			),
			"vende5"	    =>array(
			    "title"             => "Venta 5",
			    "type"              => "input",
			),
			"c_barras"	    =>array(
			    "title"             => "Codigo de Barras",
			    "type"              => "input",
			),									
			"c_qr"	    =>array(
			    "title"             => "Codigo QR",
			    "type"              => "input",
			),									
			"ref_interna"	    =>array(
			    "title"             => "Referencia Interna",
			    "type"              => "input",
			),									
			"type"	    =>array(
			    "title"             => "Tipo",
			    "type"              => "select",
				"source"			=>array(
					""				=>"Seleccciona un Tipo",
					"1"				=>"Consumible",
					"2"				=>"Servicio",
					"3"				=>"Producto disponible",
				)					    	    			    
			),									
			"tax_venta_ids"	    =>array(
			    "title"             => "Horario",
			    "showTitle"         => "si",
			    "type"              => "form",
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "many2many",			    
			    "relation_table"    => "item_tax",
			    "class_name"       	=> "tax",			    
				#"class_template"  	=> "many2one_lateral",			    
				#"class_report" 		=> "kanban",			    
			    "class_field_o"    	=> "item_id",
			    "class_field_m"    	=> "tax_id",				
				#"class_field_l"    	=> "horario",	
			),
			"campo1"	    =>array(
			    "title"             => "campo1",
			    "type"              => "input",
			),									
			"campo2"	    =>array(
			    "title"             => "campo2",
			    "type"              => "input",
			),									
			"campo3"	    =>array(
			    "title"             => "campo3",
			    "type"              => "input",
			),									
			"campo4"	    =>array(
			    "title"             => "campo4",
			    "type"              => "input",
			),									
			"campo5"	    =>array(
			    "title"             => "campo5",
			    "type"              => "input",
			),									
			"long1"	    =>array(
			    "title"             => "long1",
			    "type"              => "input",
			),									
			"long2"	    =>array(
			    "title"             => "long2",
			    "type"              => "input",
			),									
			"long3"	    =>array(
			    "title"             => "long3",
			    "type"              => "input",
			),									
			"long4"	    =>array(
			    "title"             => "long4",
			    "type"              => "input",
			),									
			"long5"	    =>array(
			    "title"             => "long5",
			    "type"              => "input",
			),									




			/*
			"tax_compra_ids"	    =>array(
			    "title"             => "Horario",
			    "showTitle"         => "si",
			    "type"              => "form",
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "many2many",			    
			    "relation_table"    => "item_tax",
			    "class_name"       	=> "tax",			    
				"class_template"  	=> "many2one_lateral",			    
				#"class_report" 		=> "kanban",			    
			    "class_field_o"    	=> "item_id",
			    "class_field_m"    	=> "tax_id",				
				#"class_field_l"    	=> "horario",	
			),
			*/
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];
    	    $datas["modulo"]			=$this->modulo;
    		parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="company_id={$_SESSION["company"]["id"]}";
			if($this->modulo!="")
				$option["where"][]      ="modulo='{$this->modulo}'";
				
					
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}				
		public function autocomplete_item()		
    	{	
    		$option					=array();
    		$option["where"]		=array();    		
    		$option["where"][]		="nombre LIKE '%{$_GET["term"]}%'";
    		
			$return =$this->__BROWSE($option);    				
			return $return;			
		}				
	}
?>
