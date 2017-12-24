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
			    "title"             => "Compra 1",
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
			    "title"             => "Venta 1",
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
			    "relation"          => "one2many",			    
			    "class_name"       	=> "company",
			    #"class_path"        => "modulos/company/modelo.php",
			    "class_field_o"    	=> "company_id",
			    "class_field_m"    	=> "id",
			    			    
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
		public function __BROWSE($option=null)
    	{
    		if(!is_array($option))	 		$option=array();
    		if(!isset($option["where"]))	$option["where"]=array();
    		
    		$option["where"][]="company_id={$_SESSION["company"]["id"]}";
    		
    		return parent::__BROWSE($option);
    	}		

	}
?>
