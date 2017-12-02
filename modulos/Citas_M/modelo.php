<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class Citas_M extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
				"id_cita_m"	    =>array(
			    "title"             => "Clave",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"name"	    =>array(
			    "title"             => "Clave",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"id_dispositivo"	    	=>array(
			    "title"             => "Dispositivo",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/devices/ajax/autocomplete_.php", 		    
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "id_dispositivo",
			    "class_field_m"		=> "id",    
			),     
			"fecha_registro"	    	=>array(
			    "title"             => "Fecha de registro",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",			    
			),
			"estatus"	    	=>array(
			    "title"             => "Estado",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "1",			    
			),
			"distancia"	    	=>array(
			    "title"             => "Distancia programada",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"id_detalle_servicio_proveedor"	    	=>array(
			    "title"             => "Servicio detalle",
			    "showTitle"         => "si",
			     "type"             => "autocomplete",
			    "source"           	=> "../modulos/proveedor_servicio/ajax/autocomplete_.php", 		    
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "proveedor_servicio",
			    "class_field_l"    	=> "id_servicio",				# Label
			    "class_field_o"    	=> "id_detalle_servicio_proveedor",
			    "class_field_m"		=> "id_detalle_servicio_proveedor",    
			    		    
			),
			"id_servicio"	    	=>array(
			    "title"             => "Servicio",
			    "showTitle"         => "si",
			     "type"             => "autocomplete",
			    "source"           	=> "../modulos/servicios/ajax/autocomplete.php", 		    
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "servicios",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "id_servicio",
			    "class_field_m"		=> "id_servicio",    
			    		    
			),			
			"fecha"	    	=>array(
			    "title"             => "Fecha Cita",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",			    
			),						
			"distancia_total"	    	=>array(
			    "title"             => "Distancia total Recoridaa",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			     "source"           	=> "/ajax/autocomplete_.php", 		    
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "id_dispositivo",
			    "class_field_m"    	=> "id",		    
			),			
			"telefono"	    	=>array(
			    "title"             => "Telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),	
			"extension"	    	=>array(
			    "title"             => "Extension",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),				
			"trabajador"	    	=>array(
			    "title"             => "Trabajador",
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
    	  //$this->__PRINT_R($datas);  
    	  $datas["fecha_registro"]=date("y-m-d"); 	        	    
    		parent::__SAVE($datas,$option);
    		// $this->__PRINT_R($this->sys_sql); 
    		
		}		

		public function __BROWSE($option=NULL)
    	{
    		
    		$option["select"]="m.id_cita_m, m.id_dispositivo, m.fecha_registro, m.estatus, m.distancia, m.distancia_total, m.id_servicio as id_servicio, m.id_detalle_servicio_proveedor, m.fecha, d.name ";
    		$option["from"]="Citas_M m inner join devices d on m.id_dispositivo=d.id";
			$return =parent::__BROWSE($option);
			return	$return;     	
		}		



		
		
	}
?>
