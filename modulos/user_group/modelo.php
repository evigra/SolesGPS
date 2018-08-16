<?php
	#if(file_exists("../device/modelo.php")) require_once("../device/modelo.php");
	
	class user_group extends general
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
			"user_id"	    =>array(
			    "title"             => "Usuario",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"menu_id"	    =>array(
			    "title"             => "Menu",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    #"source"            => "../modulos/company/ajax/index.php",
			    "default"           => "",
			    "value"             => "",			    
			),						
			"active"	    =>array(
			    "title"             => "Activo",
			    "showTitle"         => "si",
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),			

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    	    $datas["company_id"]    	=@$_SESSION["company"]["id"];
    		parent::__SAVE($datas,$option);
		}		
		public function groups($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(
				"user_group.*",
			);
			#$option["echo"]		="USER_GROUP";
			$option["from"]		="user_group";
			
			$return =$this->__VIEW_REPORT($option);    				
			return $return;
		}		
		
	}
?>
