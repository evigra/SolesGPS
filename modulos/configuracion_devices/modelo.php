<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class configuracion_devices extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_table		="configuracion";
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),		
			"variable"	    	=>array(
			    "title"             => "Marca",
			    "type"              => "input",
			),
			"subvariable"	    	=>array(
			    "title"             => "Modelo",
			    "type"              => "input",
			),

			"tipo"	    =>array(
			    "title"             => "Imei",
			    "type"              => "input",
			),	
			"subtipo"	    =>array(
			    "title"             => "Estatus",
			    "type"              => "input",
			),
			"objeto"	    =>array(
			    "title"             => "Clave Datos",
			    "type"              => "input",
			),						
			"positionId"	    =>array(
			    "title"             => "Posicion Actual",
			    "type"              => "input",
			),						
			"valor"	    =>array(
			    "title"             => "Comando",
			    "type"              => "input",
			),
		);				
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
    	    $datas["objeto"]			=$this->sys_object;

    		parent::__SAVE($datas,$option);
		}		
	
	}
?>s
