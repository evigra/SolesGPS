<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	#require_once("modulos/files/modelo.php");
	class tax extends configuracion
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
		##############################################################################	
		##  Metodos	
		##############################################################################		
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();
		}
		public function __SAVE($datas=NULL,$option=NULL)
    	{
   	    	$datas["subtipo"]="TAX";
    		return parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="subtipo='TAX'";
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}				
	}
?>
