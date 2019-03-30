<?php
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
			"company_id"	    	=>array(
			    "title"             => "Company",
			    "type"              => "input",
			),
			/*
			"locacion_id"	    =>array(
			    "title"             => "Locacion",
			    "description"       => "Responsable del dispositivo",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "procedure"       	=> "__AUTOCOMPLETE",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "trabajador",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "responsable_id",
			    "class_field_m"    	=> "id",			    
			),
						
			"departamento_id"	    =>array(
			    "title"             => "Departamento",
			    "description"       => "Responsable del dispositivo",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "procedure"       	=> "__AUTOCOMPLETE",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "trabajador",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "responsable_id",
			    "class_field_m"    	=> "id",			    
			),

			*/			
			"trabajador_ids"	    =>array(
			    "title"             => "Horario",
			    "showTitle"         => "si",
			    "type"              => "form",
			    "relation"          => "many2one",			    
			    "class_name"       	=> "trabajador",			    
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "company_id",				
			),
			
			"razonSocial"	    	=>array(
			    "title"             => "Razon Social",
			    "type"              => "input",
			),
			"nombre"	    	=>array(
			    "title"             => "Nombre",
			    "title_filter"		=> "Nombre",
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
			#/*
			"img_files_id"	    =>array(
			    "title"             => "Logo",
			    "type"              => "show_file",
			),						
			"img_files_id_med"	    =>array(
			    "title"             => "Logo",
			    "type"              => "show_file",
			),
			"img_files_id_chi"	    =>array(
			    "title"             => "Logo",
			    "type"              => "show_file",
			),
			"img_files_id_sup_chi"	    =>array(
			    "title"             => "Logo",
			    "type"              => "show_file",
			),

			#*/						
			"Id_detalleDatos"	=>array(
			    "title"             => "Id Detalle Datos",
			    "type"              => "input",
			),
			"lema"	=>array(
			    "title"             => "Lema",
			    "type"              => "input",
			),
			"telefono"	=>array(
			    "title"             => "Telefono Alertas",
			    "type"              => "input",
			),						
			"telefono_contacto"	=>array(
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
			"sms"	    	=>array(
			    "title"             => "SMS",
			    "type"              => "checkbox",
			),			
			"whatsapp"	    	=>array(
			    "title"             => "WhatsAPP",
			    "type"              => "checkbox",
			),			

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################		
		public function __CONSTRUCT($option=NULL)
		{
			return parent::__CONSTRUCT($option);
		}
		public function __SAVE($datas=NULL,$option=NULL)
    	{    	
    	    #$files_id							=$_SESSION["obj"]["files_obj"]->__SAVE($this->sys_table);    	    
    	    #if(!is_null($files_id))				$datas["files_id"]			=$files_id;    		

			

			if(isset($_SESSION["company"]) AND isset($_SESSION["company"]["id"]))
				$datas["company_id"]			=$_SESSION["company"]["id"];
    	    
    	    if(!isset($datas["tipo_company"]) OR @$datas["tipo_company"]=="")	
    	    	$datas["tipo_company"]			="COMPANY";

    		parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    	$option["where"]	=array();
			if(!isset($option["select"]))   	$option["select"]	=array();

			$option["select"]["admin_soles37.FN_ImgFile('../modulos/users/img/user.png',files_id,0,0)"]		="img_files_id";
			$option["select"]["admin_soles37.FN_ImgFile('../modulos/users/img/user.png',files_id,300,300)"]	="img_files_id_med";				
			$option["select"]["admin_soles37.FN_ImgFile('../modulos/users/img/user.png',files_id,150,90)"]	="img_files_id_chi";
			$option["select"]["admin_soles37.FN_ImgFile('../modulos/users/img/user.png',files_id,40,24)"]	="img_files_id_sup_chi";
			$option["select"][]					="company.*";			

			$option["from"]						="company";			
						
			if($this->sys_recursive==1 AND isset($_SESSION["company"]) AND isset($_SESSION["company"]["id"]))
				$option["where"][]      		="company_id={$_SESSION["company"]["id"]}";
			else
				$option["where"][]      		="company_id=3";
			$return 							=parent::__BROWSE($option);
			return	$return;     	
		}				
		public function __AUTOCOMPLETE()		
    	{	
    		$option								=array();
    		$option["where"]					=array();    		
    		$option["where"][]					="nombre LIKE '%{$_GET["term"]}%'";
    		
			$return 							=$this->__BROWSE($option);    				
			return $return;			
		}							
	}
?>
