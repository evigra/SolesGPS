<?php
	class travels extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"nombre"	    =>array(
			    "title"             => "Nombre",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"clave"	    =>array(
			    "title"             => "Clave",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"descripcion"	    =>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"mercancia"	    =>array(
			    "title"             => "Mercancia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"inicio"	    =>array(
			    "title"             => "F Inicio",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"fin"	    =>array(
			    "title"             => "F Final",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",			    
			),			

			"route_id"	=>array(
			    "title"             => "Ruta",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/route/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "route",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "route_id",
			    "class_field_m"    	=> "id",			    
			),

			
			"device_id"	=>array(
			    "title"             => "Dispositivo",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/devices/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "device_id",
			    "class_field_m"    	=> "id",			    
			),
/*
			"empresa_id"	=>array(
			    "title"             => "Cliente",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/cliente/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "cliente",
			    "class_field_l"    	=> "razon_social",				# Label
			    "class_field_o"    	=> "empresa_id",
			    "class_field_m"    	=> "id",			    
			),			
*/
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"origen_empresa"	    =>array(
			    "title"             => "Empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"origen_domicilio"	    =>array(
			    "title"             => "Domicilio",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"origen_contacto"	    =>array(
			    "title"             => "Contacto",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"origen_telefono"	    =>array(
			    "title"             => "Telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"destino_empresa"	    =>array(
			    "title"             => "Empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"destino_domicilio"	    =>array(
			    "title"             => "Domicilio",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"destino_contacto"	    =>array(
			    "title"             => "Contacto",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"destino_telefono"	    =>array(
			    "title"             => "Telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"ejes"	    =>array(
			    "title"             => "Ejes del Camion",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			#echo "<br>USER :: CONSTRUC INI";
			#$this->files_obj		=new files();
			#$this->menu_obj			=new menu();
			#$this->device_obj		=new device();
			#$this->usergroup_obj	=new user_group();

			
			#@$_SESSION["user"]["l18n"]="es_MX";
			#$_SESSION["user"]["l18n"]="en";
			#echo "<br>USER :: CONSTRUC MEDIO";
			parent::__CONSTRUCT();
			#echo "<br>USER :: CONSTRUC FIN";
			
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		#$option["echo"]				="__SAVE";	
    	    $datas["company_id"]    	=$_SESSION["company"]["id"];    	    
    	    parent::__SAVE($datas,$option);    	    
		}		
		
	
		public function __BROWSE($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		    		
			if(!isset($option["where"]))	$option["where"]=array();
			#if(!isset($option["where"]))	
			$option["select"]	=array("d.*,t.*,d.name as device_id");
			$option["from"]		="travels t left join devices d on t.device_id = d.id";			
			$option["where"][]	="t.company_id={$_SESSION["company"]["id"]}";
			#$option["where"][]="company_id={$_SESSION["company"]["id"]}";		
			#$option["echo"]	="REPORT";	
			$return =parent::__BROWSE($option);
			return $return;
		}				
	}
?>

