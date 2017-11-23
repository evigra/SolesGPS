<?php
	class cliente extends empresa
	{   
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE
		public function __CONSTRUCT()
		{
			$this->sys_table="empresa";
			parent::__CONSTRUCT();			
		}				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];
    	    $datas["cliente"]			=1;
    		parent::__SAVE($datas,$option);
		}	
		public function __BROWSE($option=NULL)
    	{
    		if(is_null($option))	$option=array();

			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="cliente=1";

			$return =parent::__BROWSE($option);;
			return	$return;     	
		}		
					
	}
?>

