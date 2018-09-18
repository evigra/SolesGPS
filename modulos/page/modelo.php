<?php
	class page extends general
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
			),
			"html"	    =>array(
			    "title"             => "html",
			    "showTitle"         => "si",
			    "type"              => "html",
			),			
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			),						
			"links"	    		=>array(
			    "title"             => "Link",
			    "showTitle"         => "si",
			    "type"              => "input",
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
    		## GUARDAR USUARIO
    	    $datas["company_id"]    	=$_SESSION["company"]["id"];
    	    $user_id=parent::__SAVE($datas,$option);
		}		
	}
?>
