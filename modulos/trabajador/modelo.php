<?php
	class trabajador extends users
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $sys_table="users";
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			$this->files_obj		=new files();
			parent::__CONSTRUCT();
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
