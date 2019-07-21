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
			if(isset($_SESSION["company"]) AND isset($_SESSION["company"]["id"]))
				$datas["company_id"]			=$_SESSION["company"]["id"];
    	
    	    if(!isset($datas["tipo_company"]) OR @$datas["tipo_company"]=="")	
    	   		$datas["tipo_company"]			=$this->company_type;    		    		

    		parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]	=array();
			if(!isset($option["select"]))   $option["select"]	=array();

			$option["where"][]		="tipo_company='{$this->company_type}'";
			if(isset($_SESSION["company"]) AND isset($_SESSION["company"]["id"]))
				$option["where"][]		="company_id='{$_SESSION["company"]["id"]}'";
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}						
	}
?>
