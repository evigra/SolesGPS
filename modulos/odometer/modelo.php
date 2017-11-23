<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class odometer extends general
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
			"distance"	    	=>array(
			    "title"             => "Distancia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"start"	    =>array(
			    "title"             => "Odometro inicial",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),	
			"end"	    =>array(
			    "title"             => "Odometro final",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"date"	    =>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE

        /*
		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();

		}
				
		*/
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    #$datas["company_id"]=$_SESSION["user"]["company_id"];
    		parent::__SAVE($datas,$option);
		}		
		public function events($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		$option["echo"]   ="ODOMETER";
			    		
			$option["select"]   =array("start","end","distance","date");
			/*
			$option["from"]     ="event";
			
			#if(!isset($option["where"]))    $option["where"]    =array();
			
			//$option["where"][]      ="company_id={$_SESSION["user"]["company_id"]}";
			*/
			#$this->__PRINT_R($option);
			
			return $this->__VIEW_REPORT($option);
    	
		}		
		
	}
?>
