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
		public function __CONSTRUCT()
		{	
			$this->files_obj	=new files();
			parent::__CONSTRUCT();
		}
		public function __SAVE($datas=NULL,$option=NULL)
    	{  		    	    
    	    if(!isset($datas["tipo_company"]) OR @$datas["tipo_company"]=="")	
    	   		$datas["tipo_company"]			=$this->company_type;    		    		

    		parent::__SAVE($datas,$option);
		}		
		public function companys($option=NULL)
    	{
    		if(is_null($option))			$option					=array();
    		if(!isset($option["where"]))	$option["where"]		=array();
    		
    		$option["where"][]	="tipo_company='{$this->company_type}'";
			return $this->__VIEW_REPORT($option);    	
		}				
	}
?>
