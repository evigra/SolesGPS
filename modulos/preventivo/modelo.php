<?php
	#if(file_exists("../menu/modelo.php")) require_once("../menu/modelo.php");
	
	class preventivo extends general
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
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "company",
			    "class_path"        => "modulos/company/modelo.php",
			    "class_field_o"    	=> "company_id",
			    "class_field_m"    	=> "id",			    			    
			),			
			"service"	    =>array(
			    "title"             => "servicio",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"descripcion_service"	    =>array(
			    "title"             => "Descripcion",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"devices_ids"	    =>array(
			    "title"             => "Menu",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "devices",
			    "class_path"        => "modulos/devices/modelo.php",
			    "class_field_l"    	=> "Dis",				# Label
			    "class_field_o"    	=> "id",					# Origen
			    "class_field_m"    	=> "devices_id",			# Destino
			    "value"             => "",			    
			),			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT()
		{
			#$this->menu_obj=new menu();
			parent::__CONSTRUCT();

		}
		public function reporte($option=NULL)		
    	{	
			$comando_sql		="SELECT * FROM preventivo p'";
			#echo $comando_sql;
			return $this->__EXECUTE($comando_sql);
		}
		
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    		#$option["echo"]="ALERTS";
    		$datas["company_id"]    =$_SESSION["company"]["id"];
    		
    		/*
    		$option=array(
    			"e_open"=>"SAVE alerts",
    			"e_close"=>"SAVE alerts",
    		);
    		*/
    	    #$alert_id				=
    	    parent::__SAVE($datas,$option);
    	    
    	    #$this->__PRINT_R($alert_id);
    	    
			#$this->save_geofence($datas,$alert_id);
			#$this->save_device($datas,$alert_id);
    	    #echo "<br>USUARIO=$user_id<br>";
    	    ## GUARDAR PERFILES DE USUARIO
		}				
		public function __VIEW_REPORT($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
    		/*
			$option["select"]	=array(
				"a.*",
			);
*/
			#$option["from"]		="alerts a";
			#if(!isset($option["where"]))    $option["where"]    =array();
			#$option["echo"]="ALERTS";			
			#$option["where"][]  ="company_id={$_SESSION["company"]["id"]}";
			#$option["order"]	="menu_name asc, nivel asc";
			
			$return =parent::__VIEW_REPORT($option);    				
			return $return;
		}
		
	}
?>

