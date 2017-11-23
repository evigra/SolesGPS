<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class movimiento extends general
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
			"contabilidad_id"	    	=>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"item_id"	=>array(
			    "title"             => "Item",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/item/ajax/index.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "item",
			    "class_path"        => "modulos/item/modelo.php",
			    "class_field_l"    	=> "clave",				# Label
			    "class_field_o"    	=> "item_id",		
			    "class_field_m"    	=> "id",			    
			),			
			
			"costo_unitario"	    	=>array(
			    "title"             => "Precio Unitario",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"cantidad"	    	=>array(
			    "title"             => "Cantidad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"unidad_medida"	    	=>array(
			    "title"             => "Unidad de medida",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"fecha"	    	=>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE


		public function __CONSTRUCT()
		{
			
			$this->files_obj	=new files();	
			parent::__CONSTRUCT();
		}				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];    	    
    		parent::__SAVE($datas,$option);
		}		

		public function reporte($option=NULL)
    	{
    		if(is_null($option))	$option=array();

			$option["select"]   =array("m.*, i.*, i.name as item");
			$option["from"]     ="movimiento m JOIN item i on m.item_id=i.id";

			if(!isset($option["where"]))    $option["where"]    =array();
			
			#$option["where"][]      ="m.company_id={$_SESSION["company"]["id"]}";

			$return =$this->__VIEW_REPORT($option);
			return	$return;     	
		}				
	}
?>
