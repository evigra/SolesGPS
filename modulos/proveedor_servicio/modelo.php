<?php	
	class proveedor_servicio extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			
			"id_proveedor"	=>array(
			    "title"             => "Proveedor",
			    "description"       => "Proveedor del servicio que se le da al vehiculo",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/proveedores/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "proveedores",
			    "class_field_l"    	=> "Nombre",				# Label
			    "class_field_o"    	=> "id_proveedor",
			    "class_field_m"    	=> "id_proveedor",			    
			), 	
			"id_detalle_servicio_proveedor"	    	=>array(
			    "title"             => "Clave",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "", 

			    
			),
			"id_servicio"	    	=>array(
			    "title"             => "servicio",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/servicios/ajax/autocomplete.php", 		    
			    "value"             => "",	
	
			    "relation"          => "one2many",			    
			    "class_name"       	=> "servicios",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "id_servicio",
			    "class_field_m"    	=> "id_servicio",
			),
			"descripcion"	    =>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),	
			"secompra"	    =>array(
			    "title"             => "Se compra",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",
			),
			"sevende"	    =>array(
			    "title"             => "Se vende",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			    "default"           => "",
			    "value"             => "",
			),						
			"precio"	    =>array(
			    "title"             => "se compra 1",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"precio2"	    =>array(
			    "title"             => "se compra 2",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"precio3"	    =>array(
			    "title"             => "se compra 3",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"precio4"	    =>array(
			    "title"             => "se compra 4",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			
			"se_vende"	    =>array(
			    "title"             => "Venta 1",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"se_vende2"	    =>array(
			    "title"             => "Venta 2",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"se_vende3"	    =>array(
			    "title"             => "Venta 3",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"se_vende4"	    =>array(
			    "title"             => "Venta 4",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			
				
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	  //  $datas["company_id"]		=$_SESSION["company"]["id"];    	        	    
    		parent::__SAVE($datas,$option);
		}		

		public function __BROWSE($option=NULL)
    	{
    		
			$return =parent::__BROWSE($option);
			return	$return;     	
		}		
				

	}
?>
