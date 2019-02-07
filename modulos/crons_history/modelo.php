<?php
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
			    "title"             => "Resumen",
			    "title_filter"      => "Resumen",
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
			"codigo"	    =>array(
			    "title"             => "Codigo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"objeto"	    =>array(
			    "title"             => "Objeto",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"execute"	    =>array(
			    "title"             => "Execute",
			    "showTitle"         => "si",
			    "type"              => "input",
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
			
			return $data;					
		}
	}
?>
