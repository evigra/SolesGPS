<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	#require_once("modulos/files/modelo.php");
	class company extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_enviroments	="DEVELOPER";
		var $sys_fields		=array(
			"id"			=>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),		
			"razonSocial"	    	=>array(
			    "title"             => "Razon Social",
			    "type"              => "input",
			),
			"RFC"	    		=>array(
			    "title"             => "RFC",
			    "type"              => "input",
			),
			"fechaRegistro"	    	=>array(
			    "title"             => "Fecha de Registro",
			    "type"              => "date",
			),
			"estatus"	    =>array(
			    "title"             => "Estatus",
			    "type"              => "select",
			    "source"            => array(
			    	"1"=>"Vigente",
			    	"0"=>"Cancelado"
			    ),
			),
			"web"	    =>array(
			    "title"             => "Web",
			    "type"              => "input",
			),
			"sistema_web"	    =>array(
			    "title"             => "Plataforma Web",
			    "type"              => "input",
			),

			"files_id"	    =>array(
			    "title"             => "Logo",
			    "type"              => "file",
			),			
			"img_files_id"	    =>array(
			    "title"             => "Logo",
			    "type"              => "file",
			),						
			"img_files_id_med"	    =>array(
			    "title"             => "Logo",
			    "type"              => "file",
			),						
			"Id_detalleDatos"	=>array(
			    "title"             => "Id Detalle Datos",
			    "type"              => "input",
			),
			"lema"	=>array(
			    "title"             => "Lema",
			    "type"              => "input",
			),
			"telefono"	=>array(
			    "title"             => "Telefono",
			    "type"              => "input",
			),						
			"extension"	    	=>array(
			    "title"             => "Extension",
			    "type"              => "input",
			),				
			
			"mail_from"	=>array(
			    "title"             => "Mail FROM",
			    "type"              => "input",
			),			
			"mail_bbc"	=>array(
			    "title"             => "Mail BBC",
			    "type"              => "input",
			),			
			"pago_anterior"	=>array(
			    "title"             => "Pago Anterior",
			    "type"              => "date",
			),			
			"pago_siguiente"	=>array(
			    "title"             => "Pago Siguiente",
			    "type"              => "date",
			),			
			"chat_whatsapp"	    	=>array(
			    "title"             => "Grupo WhatsApp",
			    "type"              => "input",
			),							
			"nombre"	    	=>array(
			    "title"             => "Nombre",
			    "type"              => "input",
			),			
			"email"	    	=>array(
			    "title"             => "Email",
			    "type"              => "input",
			),			
			"domicilio_fiscal"	=>array(
			    "title"             => "Domicilio Fiscal",
			    "type"              => "input",
			),			
			"tipo_company"	=>array(
			    "title"             => "TIPO",
			    "type"              => "hidden",
			),			
			"cliente"	    	=>array(
			    "title"             => "Cliente",
			    "type"              => "checkbox",
			),			
			"proveedor"	    	=>array(
			    "title"             => "Proveedor",
			    "type"              => "checkbox",
			),						
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################		
		public function __CONSTRUCT()
		{
			$this->files_obj	=new files();
			parent::__CONSTRUCT();
		}
		public function __SAVE($datas=NULL,$option=NULL)
    	{
    	    $files_id							=$this->files_obj->__SAVE($this->sys_table);    	    
    	    if(!is_null($files_id))				$datas["files_id"]			=$files_id;    		

			if(isset($_SESSION["company"]) AND isset($_SESSION["company"]["id"]))
				$datas["company_id"]			=$_SESSION["company"]["id"];
    	    
    	    if(!isset($datas["tipo_company"]) OR @$datas["tipo_company"]=="")	
    	    	$datas["tipo_company"]			="COMPANY";

    		parent::__SAVE($datas,$option);
		}		
		public function companys($option=NULL)
    	{
    		if(is_null($option))				$option						=array();
    		if(!isset($option["where"]))		$option["where"]			=array();
    		    		
			$option["select"]	=array(
				"admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,0,0)"		=>"img_files_id",
				"admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,180,0)"	=>"img_files_id_med",				
			    "company.*",			    
			);			
			$option["from"]						="company";			
			return $this->__VIEW_REPORT($option);    	
		}
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			if(isset($_SESSION["company"]) AND isset($_SESSION["company"]["id"]))
				$option["where"][]      ="company_id={$_SESSION["company"]["id"]}";
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}				
		public function autocomplete_empresa()		
    	{	
    		$option					=array();
    		$option["where"]		=array();    		
    		$option["where"][]		="nombre LIKE '%{$_GET["term"]}%'";
    		
			$return =$this->__BROWSE($option);    				
			return $return;			
		}							
	}
?>
