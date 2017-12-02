<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class prueba extends general
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
			    "title"             => "Dispositivo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"Distancia"	    	=>array(
			    "title"             => "Distancia Km/ 5000 km",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"proveedor"	    =>array(
			    "title"             => "Proveedor",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),	
			"status"	    =>array(
			    "title"             => "Alertas",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"1"		=>	"Activa",
			    	"0"		=>	"Inactiva",
			    ),	
			),
			"dataId"	    =>array(
			    "title"             => "Clave Datos",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"positionid"	    =>array(
			    "title"             => "Posicion Actual",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"transmision"	    =>array(
			    "title"             => "Transmision",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"Automatica"	=>	"Automatica",
			    	"Estandar"		=>	"Estandar",
			    ),	
			    
			),
			"tipoCombustible"   =>array(
			    "title"             => "Tipo de Combustible",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"emisionesCO2"      =>array(
			    "title"             => "Emisiones CO2",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"caballosPotencia"   =>array(
			    "title"             => "Caballos de Potencia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"fecha ultimachecada"   =>array(
			    "title"             => "Fecha al dia  ".'<br>'." de recorrido",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",
			),

			"Agregar_Servicio"   =>array(
			    "title"             => "Add Servicio",
			    "showTitle"         => "si",
			    "type"              => "button",
			    "default"           => "",
			    "value"             => "",
			),
			"valorCoche"   =>array(
			    "title"             => "Costo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"numAsientos"   =>array(
			    "title"             => "Numero de Asientos",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"numPuertas"   =>array(
			    "title"             => "Numero de Puertas",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"color"   =>array(
			    "title"             => "Color",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"image"   =>array(
			    "title"             => "Imagen",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"			=>array(
			    	"01"	=>	"Carro Gris",
			    	"02"	=>	"Carro Rojo",
			    	"03"	=>	"Camioneta Gris",
			    	"90"	=>	"Celular Negro",
			    	"91"	=>	"Celular Azul",
			    	"92"	=>	"Celular Verde",
			    	"93"	=>	"Celular Rojo",			    	
			    )
			),			
			"telefono"   =>array(
			    "title"             => "Telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"file_id"	    =>array(
			    "title"             => "Imagen",
			    "showTitle"         => "no",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",			    
			),	
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    /*
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "company",
			    "class_path"        => "modulos/company/modelo.php",
			    "class_field_o"    	=> "company_id",
			    "class_field_m"    	=> "id",			    			    
			    */
			),
			"responsable_id"	    =>array(
			    "title"             => "Externo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			/*
			"responsable_fisico_id"	=>array(
			    "title"             => "Supervisor",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/users/ajax/index.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "users",
			    #"class_path"        => "modulos/users/modelo.php",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "responsable_fisico_id",
			    "class_field_m"    	=> "id",			    
			),
			#*/
			"placas"	    		=>array(
			    "title"             => "Placas",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"speed_max"	    		=>array(
			    "title"             => "Velocidad Maxima",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"mail_speed"	    		=>array(
			    "title"             => "Mail por exceso de velocidad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"Siguiente_m"	    =>array(
			    "title"             => "Siguiente Mantenimiento",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    
			),
			
			

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE

 public	function __VIEW_REPORT($option) {




 $t =	parent::__VIEW_REPORT($option);
//$this->__PRINT_R($t);
 return $t;




}

/*  public	function __BROWSE($option) {
			if(is_null($option))			$option				=array();
    		if(is_null($option["select"]))	$option["select"]	=array();
    		$option["select"]="name as nombre,dc.id_device as Id ,distancia_del_dia AS Distancia ";   
//	     	$option["select"][]=["placas"];
    		//$option["order"]="Distancia ASC";


			
			//$option["select"]["lastUpdate"]		= "ULTIMO REPORTE";
			
			$option["from"]						="Distancia_corte as dc INNER JOIN devices d   ON dc.id_device = d.id ";
			
			$option["group"]					="Distancia";
			
			
			$option["hidden"]="consulta_";
			//$option["where"][]					="SEC_TO_TIME(TIMESTAMPDIFF(SECOND, lastUpdate, now()))>'00:10:00'";
	






///// wea para ver que trae el query -----------------
 $t =	parent::__BROWSE($option);
$this->__PRINT_R($t);
 return $t;
// Fin de la wea para ver que trae el query 			----------------------------


}*/
}


			



?>
