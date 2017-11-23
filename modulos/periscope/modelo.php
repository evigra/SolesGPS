<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class periscope extends general
	{   
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();			
		}				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];

    	    $files_id					=$this->files_obj->__SAVE();    	    
    	    if(!is_null($files_id))		$datas["file_id"]			=$files_id;    	    

    		parent::__SAVE($datas,$option);
		}				
	}
?>

