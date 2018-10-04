<?php
	class users extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"name"	    =>array(
			    "title"             => "Nombre",
			    "title_filter"      => "Nombre",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"email"	    =>array(
			    "title"             => "Mail",
			    "title_filter"      => "Mail",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"password"	    =>array(
			    "title"             => "Password",
			    "showTitle"         => "si",
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"hashedPassword"	    =>array(
			    "title"             => "Password",
			    "showTitle"         => "si",
			    "type"              => "password",
			    "default"           => "",
			    "value"             => "",			    
			),
			"files_id"	    =>array(
			    "title"             => "Imagen",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "relation"          => "one2many",
			    "class_name"       	=> "files",
			    "class_path"        => "modulos/files/modelo.php",
			    "class_field_o"    	=> "files_id",
			    "class_field_m"    	=> "id",			    
			),
			"img_files_id"	    =>array(
			    "title"             => "Imagen",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",			    
			),

			"sesion_start"	    =>array(
			    "title"             => "Modulo de inicio",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "value"             => "",			    
			    "procedure"       	=> "autocomplete_modulos",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "modulo",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "sesion_start",
			    "class_field_m"    	=> "menu",			    
			),						

			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "relation"          => "one2many",
			    "class_name"       	=> "company",
			    "class_path"        => "modulos/company/modelo.php",
			    "class_field_o"    	=> "company_id",
			    "class_field_m"    	=> "id",
			),						
			"salt"	    		=>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"usergroup_ids"	    	=>array(
			    "title"             => "Permisos",
			    "type"              => "input",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "user_group",
			    "class_path"        => "modulos/user_group/modelo.php",
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "user_id",
			    "value"             => "",			    
			),
			"devices_ids"	    	=>array(
			    "title"             => "Permisos",
			    "type"              => "input",
			    #"relation"          => "one2many",			    
			    #"class_name"       	=> "devices",
			    #"class_path"        => "modulos/devices/modelo.php",
			    #"class_field_o"    	=> "id",
			    #"class_field_m"    	=> "responsable_fisico_id",
			    "value"             => "",			    
			),
			"status"	    =>array(
			    "title"             => "Activo",
			    "showTitle"         => "si",
			    "type"              => "checkbox",
			),				
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			#echo "<br>USER :: CONSTRUC INI";

			$option		=array(		
				"name"			=>"files_obj",		
				"memory"		=>"files_obj",
			);			
			$this->files_obj		=new files($option);
			$option		=array(	
				"name"			=>"menu_obj",		
				"memory"		=>"menu_obj",
			);						
			$this->menu_obj			=new menu($option);
			#$this->device_obj		=new device();
			#$this->usergroup_obj	=new user_group();

			
			#@$_SESSION["user"]["l18n"]="es_MX";
			#$_SESSION["user"]["l18n"]="en";
			#echo "<br>USER :: CONSTRUC MEDIO";
			parent::__CONSTRUCT();
			#echo "<br>USER :: CONSTRUC FIN";
			
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    		if(count($datas)>2)
    		{

			    $datas["company_id"]    	=$_SESSION["company"]["id"];
			    $datas["hashedPassword"]	="ef38a22ac8e75f7f3a6212dbfe05273365333ef53e34c14c";
			    $datas["salt"]				="000000000000000000000000000000000000000000000000";
			    if(isset($datas["password"]) AND $datas["password"]!="")
				    $datas["password"]		=md5($datas["password"]);
				else
					unset($datas["password"]);    
			    
			    $files_id					=$this->files_obj->__SAVE();    	    
			    if(!is_null($files_id))		$datas["files_id"]			=$files_id;    	    

			    $user_id=parent::__SAVE($datas,$option);
			    
				#$this->__PRINT_R($datas);	    
			    
			    ## GUARDAR PERFILES DE USUARIO
			    $usergroup_datas=array();
			    if(isset($datas["usergroup_ids"]))
			    {
					foreach($datas["usergroup_ids"] as $index => $data)
					{
						$usergroup_option=array();
						## BUSCA PERFIL PREVIO 
						## SI EXISTE, LO MODIFICA
						## SI NO, LO CREA
						#$usergroup_option["echo"]="PERFILES";
						$usergroup_option["where"]=array(
							"user_id=$user_id",
							"company_id={$_SESSION["company"]["id"]}",
							"menu_id={$index}",
						);    	    		    	    		
						$usergroup_data						=$this->usergroup_ids_obj->groups($usergroup_option);

						if($usergroup_data["total"]>0)		$this->usergroup_ids_obj->sys_primary_id=$usergroup_data["data"][0]["id"];
						else								$this->usergroup_ids_obj->sys_primary_id=NULL;

						$usergroup_save=array(
							"user_id"		=>"$user_id",
							"company_id"	=>"{$_SESSION["company"]["id"]}",
							"menu_id"		=>"{$index}",
							"active"		=>"$data"
						);	
						$this->usergroup_ids_obj->__SAVE($usergroup_save);
					}	
				}    
			}	
		}		
		#/*
		public function __FIND_FIELDS($id=NULL)
		{
			parent::__FIND_FIELDS($id);
			if($this->sys_section=="write")
			{
				$this->sys_fields["password"]["value"]="";			
			}			
    	}
    	#*/
		public function __INPUT($words=NULL,$sys_fields=NULL)
		{	
			$this->words					=parent::__INPUT($words,$sys_fields);
			
			$this->words["permisos"]	    =$this->menu_obj->grupos_html(@$this->sys_fields["usergroup_ids"]["values"]);
			/*
			$this->words["flotilla"]	    =$this->device_obj->devices_user($this->sys_primary_id);
			*/
			if(isset($this->sys_fields["files_id"]["value"]))    	
				$this->words["img_files_id"]	            =$this->files_obj->__GET_FILE($this->sys_fields["files_id"]["value"]);
			else	$this->words["img_files_id"]="";	
			
			return $this->words;
    	}

		public function session($user,$pass)
    	{
    	    $option=array(
    	    	"where"=>
			    	array(
						"email='$user'",
						"password=md5('$pass')",
						"status=1"
			    	),
    	    );
    	    #$option["echo"]="USERS sesion()";
    	    $data_user	=$this->users($option);    	        	    
    	    if(is_array($data_user) AND array_key_exists("data",$data_user))
    	    {    	    	
    	    	if(count($data_user["data"])>0)	$return=$data_user["data"][0];
    	    	else							$return=$data_user["data"];
    	    }
			return $return;
		}		
		/*
		public function session2($user)
    	{
    	    $option=array(
    	    	"where"=>
			    	array("email='$user'"),
    	    );
    	    $data_user	=$this->users($option);    	    
    	    
    	    if(is_array($data_user) AND array_key_exists("data",$data_user))
    	    {    	    	
    	    	if(count($data_user["data"])>0)	$return=$data_user["data"][0];
    	    	else							$return=$data_user["data"];
    	    }
			return $return;
		}
		*/
		//////////////////////////////////////////////////		
		public function autocomplete_user()		
    	{	
    		$option					=array();
    		$option["where"]		=array();    		
    		$option["where"][]		="name LIKE '%{$_GET["term"]}%'";
    		
			$return =$this->__BROWSE($option);    				
			return $return;			
		}				
    	//////////////////////////////////////////////////	
	
		public function users($option=NULL)		
    	{	
			$return =$this->__VIEW_REPORT($option);    				
			return $return;
		}				
		public function __BROWSE($option=NULL)		
    	{	
    		if(is_null($option))			$option					=array();
    		if(!isset($option))				$option					=array();
    		
    		if(!isset($option["select"]))	$option["select"]		=array();
    		if(!isset($option["where"]))	$option["where"]		=array();
    		
			$option["select"]["FN_ImgFile('../modulos/users/img/user.png',files_id,0,0)"]	="img_files_id";
            $option["select"]["FN_ImgFile('../modulos/users/img/user.png',files_id,0,30)"]	="img_files_id_min";
            $option["select"]["FN_ImgFile('../modulos/users/img/user.png',files_id,0,150)"]	="img_files_id_med";
			$option["select"][]																="u.*";
			$option["from"]		="users u";			

			if(isset($_SESSION["company"]["id"]) AND isset($_SESSION["user"]["id"]))
				$option["where"][]	="(u.company_id={$_SESSION["company"]["id"]} or u.id={$_SESSION["user"]["id"]})";									    				

			return parent::__BROWSE($option);
		}				

	}
?>
