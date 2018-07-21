<?php
	#if(file_exists("../device/modelo.php")) 
	#require_once("../device/modelo.php");
	#if(file_exists("device/modelo.php")) 
	#require_once("device/modelo.php");
	
	class trabajador extends users
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			#echo "<br>USER :: CONSTRUC INI";
			$this->files_obj		=new files();
			$this->menu_obj			=new menu();
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
    	    $datas["company_id"]    	=$_SESSION["company"]["id"];
    	    $datas["hashedPassword"]	="ef38a22ac8e75f7f3a6212dbfe05273365333ef53e34c14c";
    	    $datas["salt"]				="000000000000000000000000000000000000000000000000";
    	    if(isset($datas["password"]))
	    	    $datas["password"]		=md5($datas["password"]);
    	    
    	    $files_id					=$this->files_obj->__SAVE();    	    
    	    if(!is_null($files_id))		$datas["files_id"]			=$files_id;    	    

    	    $user_id=parent::__SAVE($datas,$option);
    	    
    	    #echo "<br>USUARIO=$user_id<br>";
    	    ## GUARDAR PERFILES DE USUARIO
		}		
		
		public function __INPUT($words,$sys_fields)
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
						"password=md5('$pass')"
			    	),
    	    );
    	    $data_user	=$this->users($option);    	        	    
    	    if(is_array($data_user) AND array_key_exists("data",$data_user))
    	    {    	    	
    	    	if(count($data_user["data"])>0)	$return=$data_user["data"][0];
    	    	else							$return=$data_user["data"];
    	    }
			return $return;
		}		
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
		//////////////////////////////////////////////////		
		public function autocomplete_user()		
    	{	
    		$option					=array();
    		$option["where"]		=array();    		
    		$option["where"][]		="name LIKE '%{$_GET["term"]}%'";
    		
			$return =$this->__BROWSE($this->browse_users($option));    				
			return $return;
			
		}				
    	//////////////////////////////////////////////////	
	
		public function users($option=NULL)		
    	{	
			$return =$this->__VIEW_REPORT($this->browse_users($option));    				
			return $return;
		}				
		public function browse_users($option=NULL)		
    	{	
    		if(is_null($option))			$option					=array();
    		if(!isset($option))				$option					=array();
    		
    		if(!isset($option["select"]))	$option["select"]		=array();
    		if(!isset($option["where"]))	$option["where"]		=array();
    		
			$option["select"]["FN_ImgFile('../modulos/users/img/user.png',files_id,0,0)"]	="img_files_id";
            $option["select"]["FN_ImgFile('../modulos/users/img/user.png',files_id,0,30)"]	="img_files_id_min";
            $option["select"]["FN_ImgFile('../modulos/users/img/user.png',files_id,0,150)"]	="img_files_id_med";
			$option["select"][]																="users.*";
			$option["from"]		="users";			
			if(isset($_SESSION["company"]["id"]))
				$option["where"][]	="(users.company_id={$_SESSION["company"]["id"]} or users.id={$_SESSION["user"]["id"]})";						
			    				
			return $option;
		}				

	}
?>
