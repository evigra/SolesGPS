<?php
	class map_speed extends position
	{   
		public function __CONSTRUCT()
		{
			$this->sys_fields["start"]["type"]		="date";
			$this->sys_fields["start"]["title"]		="Fecha Inicial";

			$this->sys_fields["end"]["type"]		="date";
			$this->sys_fields["end"]["title"]		="Fecha Final";
			
			$this->sys_fields["tiempo"]["type"]		="input";
			$this->sys_fields["tiempo"]["title"]	="Velocidad";
			
			$this->sys_fields["speed"]["type"]		="input";
			$this->sys_fields["speed"]["title"]		="Velocidad";
			
			$this->sys_fields["address"]["type"]	="input";
			$this->sys_fields["address"]["title"]	="Calle";
		
			$this->sys_table						="position";
			$this->sys_module						="map_stop";
						
			parent::__CONSTRUCT();
		}	
		public function speed_position($option=NULL)
    	{
    		if(is_null($option))	$option=array();
			#$option["echo"]	="TIME POSITION";
			if(!isset($option))				$option=array();
			if(!isset($option["select"]))	$option["select"]		=array();

			$option["select"][]						="p.id";
			#$option["select"]["device"]				="d.id";
			$option["select"][]						="name";
			$option["select"][]						="latitude";
			$option["select"][]						="longitude";
			$option["select"]["round(speed * 1.852)"]		="speed";
			$option["select"]["DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)"]	="date";
			$option["select"][]						="address";
			$option["select"]["event"]				="other";

			$option["order"]	="date DESC";
	
			return $this->__BROWSE($option);						
		}		
		
	}
?>
