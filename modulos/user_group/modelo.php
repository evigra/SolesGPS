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
			    "type"              => "primary key",
			),
			"user_id"	    =>array(
			    "title"             => "Usuario",
			    "type"              => "input",
			),
			"menu_id"	    =>array(
			    "title"             => "Menu",
			    "type"              => "input",
			),
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),						
			"active"	    =>array(
			    "title"             => "Activo",
			    "type"              => "password",
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
    		if(is_array($datas))
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
