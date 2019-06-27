<?php
	class company_system extends company
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="company";
		var $company_type		="SYSTEM";	

		##############################################################################	
		##  Metodos	
		##############################################################################		
		public function __CONSTRUCT($option=NULL)
		{	
			$this->files_obj	=new files();
			parent::__CONSTRUCT($option);
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
		public function __REPORT_ACTIVO($option=NULL)
    	{    		
    		$this->sys_fields["estatus"]["filter"]="1";    		    		    		
			$return 				=$this->__VIEW_REPORT($option);
			return	$return;     	
		}						

	}
?>
