<?php
	#if(file_exists("nucleo/general.php")) require_once("nucleo/general.php");
	
	class files extends general
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
			"file"	    	=>array(
			    "title"             => "archivo",
			    "showTitle"         => "si",
			    "type"              => "file",
			    "default"           => "",
			    "value"             => "",			    
			),
			"type"	    	=>array(
			    "title"             => "Tipo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"table"	    =>array(
			    "title"             => "Modulo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),	
			"company_id"	    =>array(
			    "title"             => "Compañia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),
			"user_id"	    =>array(
			    "title"             => "Usuario",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),						
			"fecha"	    =>array(
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


		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();
		}
				

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $return =NULL;
			if(@is_array($this->request["files"]))
			{							
				if(is_null($option))	$option=array();
				if(!array_key_exists("table",$option))		$option["table"]="";
				

				if(isset($this->request["files"]["error"]) AND $this->request["files"]["error"]==0)
				{
					$uploads_dir 			= 'modulos/files/file';
					$datas					=array();
					$tmp_name 				= $this->request["files"]["tmp_name"];
					$name 					= $this->request["files"]["name"];
					$type 					= $this->request["files"]["type"];
					
					$vtype					=explode(".",$name);
					$ctype					=count($vtype) - 1;
					$extencion				=$vtype[$ctype];
					
					$datas["file"]			=$name;
					$datas["type"]			=$type;
					$datas["extension"]		=$extencion;
					$datas["table"]			=$option["table"];
					$datas["company_id"]	=$_SESSION["company"]["id"];
					$datas["user_id"]		=$_SESSION["user"]["id"];
					$datas["fecha"]			=$this->sys_date;
										
					$return					=parent::__SAVE($datas,$option);

					$path					="$uploads_dir/$return.$extencion";
					#$path					="$uploads_dir/$name";

					move_uploaded_file($tmp_name, $path);							
				}
			}	

		    return $return;	
		}		

   		public function __GET_FILE($id=NULL)
    	{    	    
			$return="";
			if(!is_null($id))
			{
				$data=$this->__BROWSE($id);
				if(is_array($data) and count($data)>0)
				{
					#$this->__PRINT_R($id);
					#$this->__PRINT_R($data);
					if(array_key_exists("type",$data[0]))
					{
						if($data[0]["type"]=="image/png")		$return="<img src=\"../modulos/files/file/$id.png\">";
						if($data[0]["type"]=="image/jpg")		$return="<img src=\"../modulos/files/file/$id.jpg\">";
					}		
				}				
			}					
			#$return="";
		    return $return;	
		}
		
		/*
		public function __FIND_FIELDS($id=NULL)
		{
			if(!is_null($id))
			{
				
				$option=array("where"=>array("id='$id'",)	);	
				
				$datas	=$this->devices($option);
				
				#$this->__PRINT_R($datas);
				
				if(count($datas["data"])>0)
				{
					foreach(@$datas["data"][0] as $field =>$value)
					{
					    $eval="$"."this->sys_fields[\"$field\"]"."[\"value\"]=\"$value\";";
					    eval($eval);
					}
				}
				
			}			    
    	}
    			
		public function devices($option=NULL)
    	{
    		if(is_null($option))	$option=array();
    		
			$option["select"]   =array(
					"device.*",
					"IF(vehicle=1,'../modulos/device/img/car.png','../modulos/device/img/cell.png')"	=>"file_id",
			);
			$option["from"]     ="device";
			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="company_id={$_SESSION["user"]["company_id"]}";
			
			#$this->__PRINT_R($option);
			
			return $this->__VIEW_REPORT($option);
    	
		}		
		*/
	}
?>
