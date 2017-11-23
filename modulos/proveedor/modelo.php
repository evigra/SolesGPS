<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class proveedor extends customer
	{   
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE
		public function __CONSTRUCT()
		{
			$this->sys_table="customer";			
			parent::__CONSTRUCT();			
		}				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];
    	    $datas["bProveedor"]			=1;
    		parent::__SAVE($datas,$option);
		}	
		public function reporte($option=NULL)
    	{
    		if(is_null($option))	$option=array();

			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="c.bProveedor=1";

			$return =parent::reporte($option);;
			return	$return;     	
		}		
					
	}
?>

