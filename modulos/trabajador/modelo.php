<?php
	class trabajador extends company
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="company";
		var $company_type		="TRABAJADOR";	

		##############################################################################	
		##  Metodos	
		##############################################################################		
		public function __CONSTRUCT($option=NULL)
		{	
			return parent::__CONSTRUCT($option);
		}
		public function __SAVE($datas=NULL,$option=NULL)
    	{  		    	    
    	    if(!isset($datas["tipo_company"]) OR @$datas["tipo_company"]=="")	
    	   		$datas["tipo_company"]			=$this->company_type;    		    		

    		parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]	=array();
			if(!isset($option["select"]))   $option["select"]	=array();

			$option["where"][]	="tipo_company='{$this->company_type}'";
			
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}						
	}
?>
