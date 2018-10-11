<?php
	class trabajador extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",			    
			    "type"              => "primary key",
			),
			"nombre"	    =>array(
			    "title"             => "Nombre",
			    "title_filter"      => "Nombre",
			    "type"              => "input",
  			    "style"             => array(			    	
					"font-size"		=>array("30px"=>"1==1"),					
			    ),			    			    
			    
			),
			"email"	    =>array(
			    "title"             => "Mail",
			    "title_filter"      => "Mail",
			    "type"              => "input",
			),
			"telefono"	    =>array(
			    "title"             => "telefono",
			    "type"              => "input",
			),			
			"extension"	    =>array(
			    "title"             => "Extension",
			    "type"              => "input",
			),
			"files_id"	    =>array(
			    "title"             => "Imagen",
			    "type"              => "file",
			    "relation"          => "one2many",
			    "class_name"       	=> "files",
			    "class_path"        => "modulos/files/modelo.php",
			    "class_field_o"    	=> "files_id",
			    "class_field_m"    	=> "id",			    
			),
			"domicilio"	    =>array(
			    "title"             => "Domicilio",
			    "type"              => "input",
			),						
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),						
			"locacion"	    		=>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),
			"departamento_id"	    =>array(
			    "title"             => "Activo",
			    "type"              => "input",
			),				
		);				
	
		##############################################################################	
		##  Metodos	
		##############################################################################

   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    		if(is_array($datas))	$datas["tipo"]				="trabajador";
    		
    		$datas["company_id"]    	=$_SESSION["company"]["id"];	
    	    return parent::__SAVE($datas,$option);
		}		
		//////////////////////////////////////////////////		
		public function __BROWSE($option=NULL)		
    	{	
    		if(is_null($option))			$option					=array();
    		if(!isset($option))				$option					=array();
    		
    		#if(!isset($option["select"]))	$option["select"]		=array();
    		if(!isset($option["where"]))	$option["where"]		=array();
    		
    					
			$option["where"][]	="company_id='{$_SESSION["company"]["id"]}'";						
			    				
			return parent::__BROWSE($option);
		}				
	}
?>
