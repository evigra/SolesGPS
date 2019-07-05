<?php
	class alerts extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),			
			"name"	    =>array(
			    "title"             => "Alerta",
			    "type"              => "input",
			),
			"geofence_in"	    =>array(
			    "title"             => "Email de entrada",
			    "type"              => "input",
			),
			"geofence_out"	    =>array(
			    "title"             => "Email de salida",
			    "type"              => "input",
			),
			
			"event"	    =>array(
			    "title"             => "Evento",
			    "type"              => "select",
			    "source"			=>array(
			    	"ingeofence"		=>	"Entrada a geocerca",
			    	"outgeofence"		=>	"Salida de geocerca",
			    ),				    	    

			),
			"status"	    =>array(
			    "title"             => "Estatus",
			    "type"              => "select",
			    "source"			=>array(
			    	"activo"		=>	"Activa",
			    	"inativo"		=>	"Inactivo",
			    ),				    	    
			),			
			"geofences_ids"	    =>array(
			    "title"             => "Menu",
			    "type"              => "input",
			    #"relation"          => "one2many",			    
			    "relation"          => "2to1",
			    "class_name"       	=> "geofences",
			),			
			"devices_ids"	    =>array(
			    "title"             => "Menu",
			    "type"              => "input",			    
			    #"relation"          => "one2many",			    
			    "relation"          => "2to1",
			    "class_name"       	=> "devices",
			),			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT($option=NULL)
		{
			#$this->menu_obj=new menu();
			parent::__CONSTRUCT($option);

		}
		public function device($option=NULL)		
    	{	
			$comando_sql		="SELECT * FROM alerts_device ag WHERE device_id={$option["device_id"]} AND alerts_id='{$option["alerts_id"]}'";
			#echo $comando_sql;
			return $this->__EXECUTE($comando_sql);
		}
		public function save_device($datas,$alert_id=NULL)		
    	{	
			$devices=$this->sys_fields["devices_ids"]["obj"]->devices_data();
			
    		foreach($devices as $device)
    		{
    			$status ="status=0";
    			if(is_array(@$datas["devices_ids"]))
    			{
    				if(array_key_exists(@$device["id"],@$datas["devices_ids"])) 		$status ="status=1";
    				else											   					$status ="status=0";
    			}	
    			
				$alerts_device_option=array(
					"alerts_id"		=>"$alert_id",
					"device_id"		=>"{$device["id"]}",
				);    	    		    	    		
				$alerts_device_data	=$this->device($alerts_device_option);
				
				$status.=", device_id='{$device["id"]}', alerts_id='$alert_id'";
				if(count($alerts_device_data)>0)		$comando_sql="UPDATE alerts_device SET $status WHERE id='{$alerts_device_data[0]["id"]}'";
				else									$comando_sql="INSERT INTO alerts_device SET $status";
				
				$this->__EXECUTE($comando_sql);
    		}    	
		}
		
		public function geofence($option=NULL)		
    	{	    		
			$comando_sql		="SELECT * FROM alerts_geofence ag WHERE geofence_id={$option["geofence_id"]} AND alerts_id='{$option["alerts_id"]}'";
			return $this->__EXECUTE($comando_sql);
		}
		public function save_geofence($datas,$alert_id=NULL)		
    	{	
			$geofences=$this->sys_fields["geofences_ids"]["obj"]->geofences_data();
    		foreach($geofences as $geofence)
    		{
    			$status ="status=0";
    			if(is_array(@$datas["geofences_ids"]))
    			{
    				if(array_key_exists($geofence["id"],@$datas["geofences_ids"])) 	$status ="status=1";
    				else											   				$status ="status=0";
    			}	
    			
				$alerts_geofence_option=array(
					"alerts_id"		=>"$alert_id",
					"geofence_id"	=>"{$geofence["id"]}",
				);    	    		    	    		
				$alerts_geofence_data	=$this->geofence($alerts_geofence_option);
				
				$status.=", geofence_id='{$geofence["id"]}', alerts_id='$alert_id'";
				if(count($alerts_geofence_data)>0)		$comando_sql="UPDATE alerts_geofence SET $status WHERE id='{$alerts_geofence_data[0]["id"]}'";
				else									$comando_sql="INSERT INTO alerts_geofence SET $status";
				
				$this->__EXECUTE($comando_sql);
    		}    	
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    		$datas["company_id"]    =$_SESSION["company"]["id"];
    		
    	    $alert_id				=parent::__SAVE($datas,$option);    	    
    	    
			$this->save_geofence($datas,$alert_id);
			$this->save_device($datas,$alert_id);
		}				
		public function alerts($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(
				"a.*",
			);
			$option["from"]		="alerts a";
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]  ="a.company_id={$_SESSION["company"]["id"]}";
			
			$return =$this->__VIEW_REPORT($option);    				
			return $return;
		}		
	}
?>
