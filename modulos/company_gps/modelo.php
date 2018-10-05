<?php
	class company_gps extends company
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="company";

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
    	    $files_id					=$this->files_obj->__SAVE($this->sys_table);    	    
    	    if(!is_null($files_id))		$datas["files_id"]			=$files_id;
    	    
    	    if(!isset($datas["tipo_company"]) OR @$datas["tipo_company"]=="")	
    	   		$datas["tipo_company"]			="GPS";    		    		

    		parent::__SAVE($datas,$option);
		}		
		public function companys($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		if(!isset($option["where"]))	$option["where"]=array();
    		    		
			$option["select"]	=array(
				"admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,0,0)"		=>"img_files_id",
				"admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,180,0)"	=>"img_files_id_med",				
			    "company.*",			    
			);			
			$option["from"]		="company";			
			$option["where"][]	="tipo_company='GPS'";
			return $this->__VIEW_REPORT($option);    	
		}				
	}
?>
