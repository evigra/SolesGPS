<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	#require_once("modulos/files/modelo.php");
	class company extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"id"			=>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"razonSocial"	    	=>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"RFC"	    		=>array(
			    "title"             => "RFC",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"fechaRegistro"	    	=>array(
			    "title"             => "Fecha de Registro",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"estatus"	    =>array(
			    "title"             => "Estatus",
			    "showTitle"         => "si",
			    "type"              => "select",
			    "default"           => "",
			    "value"             => "",
			    "source"            => array(
			    	"1"=>"Vigente",
			    	"0"=>"Cancelado"
			    
			    ),
			),
			"web"	    =>array(
			    "title"             => "Web",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"files_id"	    =>array(
			    "title"             => "Logo",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),			
			"img_files_id"	    =>array(
			    "title"             => "Logo",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						
			"img_files_id_med"	    =>array(
			    "title"             => "Logo",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						

			"Id_detalleDatos"	=>array(
			    "title"             => "Id Detalle Datos",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"lema"	=>array(
			    "title"             => "Lema",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),
			"telefono"	=>array(
			    "title"             => "Telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),						
			"mail_from"	=>array(
			    "title"             => "Mail FROM",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),			
			"mail_bbc"	=>array(
			    "title"             => "Mail BBC",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),			
			"pago_anterior"	=>array(
			    "title"             => "Pago Anterior",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),			
			"pago_siguiente"	=>array(
			    "title"             => "Pago Siguiente",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),			
			"domicilio_fiscal"	=>array(
			    "title"             => "Domicilio Fiscal",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "value"             => "",
			),			

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################		
        
		public function __CONSTRUCT()
		{
			
			$this->files_obj	=new files(array("temporal"=>"AUX_DEVICE"));
			parent::__CONSTRUCT();
		}

		public function __SAVE($datas=NULL,$option=NULL)
    	{
    	    $files_id					=$this->files_obj->__SAVE();    	    
    	    if(!is_null($files_id))		$datas["files_id"]			=$files_id;    		

    		parent::__SAVE($datas,$option);
		}		

		public function companys($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		    		
			$option["select"]	=array(
				"admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,0,0)"		=>"img_files_id",
				"admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,180,0)"	=>"img_files_id_med",				
			    "company.*",			    
			);			
			$option["from"]		="company";			
			return $this->__VIEW_REPORT($option);    	
		}				
	}
?>
