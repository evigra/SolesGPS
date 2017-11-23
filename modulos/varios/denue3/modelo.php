<?php

	
	class denue extends general
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
			"empresa"	    =>array(
			    "title"             => "empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"razon_social"	    =>array(
			    "title"             => "razon_social",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"actividad"	    =>array(
			    "title"             => "actividad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			
			"personal"	    =>array(
			    "title"             => "personal",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"vialidad"	    =>array(
			    "title"             => "vialidad",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"exterior"	    =>array(
			    "title"             => "exterior",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"interior"	    =>array(
			    "title"             => "interior",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"asentamiento"	    =>array(
			    "title"             => "asentamiento",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"cp"	    =>array(
			    "title"             => "cp",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"municipio"	    =>array(
			    "title"             => "municipio",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"telefono"	    =>array(
			    "title"             => "telefono",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"mail"	    =>array(
			    "title"             => "Mail",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"web"	    =>array(
			    "title"             => "web",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"latitud"	    =>array(
			    "title"             => "Mail",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"longitud"	    =>array(
			    "title"             => "Mail",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			#echo "<br>USER :: CONSTRUC INI";
			$this->files_obj		=new files();
			$this->menu_obj			=new menu();
			#$this->usergroup_obj	=new user_group();

			
			@$_SESSION["user"]["l18n"]="es_MX";
			#$_SESSION["user"]["l18n"]="en";
			#echo "<br>USER :: CONSTRUC MEDIO";
			parent::__CONSTRUCT();
			#echo "<br>USER :: CONSTRUC FIN";
			
		}
   		public function __OPEN_DENUE()
    	{    	
    		
			$gestor = fopen("modulos/denue/denue.csv", "rb");
			if (FALSE === $gestor)
			{
				exit("Falló la apertura del flujo al URL");
			}
			
			$contenido = '';
			while (!feof($gestor)) {
				$contenido .= fread($gestor, 1024);
			}
			fclose($gestor);
			
			$contenido 	= nl2br($contenido);
			$rows 		= explode("<br />",$contenido);

			foreach($rows as $index_row=>$row)
			{	
				$cols	=explode(",",$row);
				foreach($cols as $index_col=>$col)
				{						
					$pos_comillas 	= strpos($col, '"');
					if(!strlen($pos_comillas)>0	)					
						$cols[$index_col]	='"'.$col.'"';					
				}
				$row=implode(",",$cols);
				
				#echo "INSERT INTO denue VALUES(".$row.");\n";
			

				#$datas_menu =$this->__EXECUTE($rows[$index_row], "DEVICE MODELO");			

			}	
			
			
  		}
		
	  				
		public function report($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(				
				"denue.*",
			);
			$option["from"]		="denue";
			
			$return =$this->__VIEW_REPORT($option);    				
			return $return;
		}				
	}
?>
