<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	#require_once("modulos/files/modelo.php");
	class cliente extends company
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
    	    	$datas["tipo_company"]			="COMPANY";

    		parent::__SAVE($datas,$option);
		}		
		public function companys($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		if(!isset($option["where"]))	$option["where"]=array();
    		    		
			$option["where"][]	="tipo_company IN ('GPS','COMPANY')";
			return parent::companys($option);    	
		}				
	}
?>
