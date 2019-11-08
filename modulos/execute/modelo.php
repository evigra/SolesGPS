<?php
	#if(file_exists("../device/modelo.php")) require_once("../device/modelo.php");	
	class execute extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $log=array();
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################        
		#/*
		public function __CONSTRUCT()
		{
			$url 				="solesgps.com/webHome/";
			$url 				="https://cfdiau.sat.gob.mx/nidp/app/login?id=SATx509Custom&sid=1&option=credential&sid=1";
			$option				=array("url"=>$url);
			
						
			$respuesta			=$this->__curl($option);						
			
			$this->__PRINT_R($respuesta);
			#$respuesta1			=json_decode($respuesta["return"]);



			parent::__CONSTRUCT();
		}
		#*/			
		public function saldo_correo()
    	{

		}		
	}
?>
