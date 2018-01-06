<?php	
	class facturas extends general
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
			"nombre"	    	=>array(
			    "title"             => "Nombre",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"file_id"	    	=>array(
			    "title"             => "XML",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",			    
			),
			
			"empresa_id"	    =>array(
			    "title"             => "Cliente",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "cliente",
			    #"class_path"        => "modulos/company/modelo.php",
			    "class_field_o"    	=> "name",
			    "class_field_o"    	=> "empresa_id",
			    "class_field_m"    	=> "id",
			    			    
			),									
			"company_id"	    =>array(
			    "title"             => "Cliente",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "company",
			    #"class_path"        => "modulos/company/modelo.php",
			    "class_field_o"    	=> "company_id",
			    "class_field_m"    	=> "id",
			    			    
			),									

		);				
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE
		public function __CONSTRUCT()
		{
			
			$this->files_obj	=new files();	
			parent::__CONSTRUCT();
		}


   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["company_id"]		=$_SESSION["company"]["id"];

    	    $files_id					=$this->files_obj->__SAVE();    	    
    	    
    	    
    	    
    	    if(!is_null($files_id))		$datas["files_id"]			=$files_id;    	    


			#$this->__PRINT_R($datas);
    		parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=null)
    	{
    		if(!is_array($option))	 		$option=array();
    		if(!isset($option["where"]))	$option["where"]=array();
    		
    		$option["where"][]="company_id={$_SESSION["company"]["id"]}";
    		
    		return parent::__BROWSE($option);
    	}		

	}
?>
