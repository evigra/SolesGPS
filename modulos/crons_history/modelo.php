<?php
	#if(file_exists("../device/modelo.php")) require_once("../device/modelo.php");
	
	class crons_history extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"resume"	    =>array(
			    "title"             => "resume",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"date"	    =>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",			    
			),
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		parent::__SAVE($datas,$option);
		}		
		
		public function crons($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
    		$time_now=substr(@$this->sys_date,0,16);
			$option["select"]	=array(				
				"crons_history.*",
			);
			$option["from"]		="crons_history";
			$option["order"]	="id desc";
			$data = $this->__VIEW_REPORT($option);
			
			#$this->__PRINT_R($data);
			
			return $data;		
			
		}

								
	}
?>
