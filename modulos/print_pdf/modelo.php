<?php
	class print_pdf extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_filter		=array(
				"name"=>"d.name",		
		);
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),		
			"module"	    	=>array(
			    "title"             => "Modulo",
			    "type"              => "input",
			),
			"section"	    	=>array(
			    "title"             => "Seccion",
			    "type"              => "input",
			),
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################
		public function __CONSTRUCT($option=NULL)
		{
			parent::__CONSTRUCT($option);

			$option=array(
				"id"		=>$this->sys_fields["module"]["id"],
				"section"	=>$this->sys_fields["module"]["section"],
				"module"	=>$this->sys_fields["module"]["module"],									
			);			
			$this->PDF_PRINT($option);
		}
	  				
		
	}
?>
