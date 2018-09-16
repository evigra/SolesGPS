<?php	
	class item extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
				"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"nombre"	    	=>array(
			    "title"             => "Nombre",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",		
  			    "style"             => array(			    	
					"font-size"		=>array("30px"=>"1==1"),					
			    ),			    			    
			    	    
			),
			"descripcion"	    	=>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "textarea",
			    "default"           => "",
			    "value"             => "",			    
			),
			"servicio"	    =>array(
			    "title"             => "Servicio",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",
			),	
			"se_compra"	    =>array(
			    "title"             => "Se compra",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",
			),
			"se_vende"	    =>array(
			    "title"             => "Se vende",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",
			),						
			"compra1"	    =>array(
			    "title"             => "Precio de compra",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"compra2"	    =>array(
			    "title"             => "Compra 2",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"compra3"	    =>array(
			    "title"             => "Compra 3",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"compra4"	    =>array(
			    "title"             => "Compra 4",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"compra5"	    =>array(
			    "title"             => "Compra 5",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			
			"vende1"	    =>array(
			    "title"             => "Precio de venta",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"vende2"	    =>array(
			    "title"             => "Venta 2",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"vende3"	    =>array(
			    "title"             => "Venta 3",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"vende4"	    =>array(
			    "title"             => "Venta 4",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"vende5"	    =>array(
			    "title"             => "Venta 5",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),

			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    			    
			),									
			"c_barras"	    =>array(
			    "title"             => "Codigo de Barras",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    			    
			),									
			"c_qr"	    =>array(
			    "title"             => "Codigo QR",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    			    
			),									
			"ref_interna"	    =>array(
			    "title"             => "Referencia Interna",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    			    
			),									
			"type"	    =>array(
			    "title"             => "Tipo",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",		
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
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];


    		parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="company_id={$_SESSION["company"]["id"]}";
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
