<?php
	class seguimientos_stop extends position
	{   
		public function __CONSTRUCT()
		{
			$this->sys_fields["start"]["type"]		="date";
			$this->sys_fields["start"]["title"]		="Fecha Inicial";

			$this->sys_fields["end"]["type"]		="date";
			$this->sys_fields["end"]["title"]		="Fecha Final";
			
			$this->sys_fields["tiempo"]["type"]		="input";
			$this->sys_fields["tiempo"]["title"]	="Minuto";
			
			$this->sys_fields["speed"]["type"]		="input";
			$this->sys_fields["speed"]["title"]		="Velocidad";
			
			$this->sys_fields["address"]["type"]	="input";
			$this->sys_fields["address"]["title"]	="Calle";
		
			$this->sys_table						="position";
			$this->sys_module						="map_stop";
						
			parent::__CONSTRUCT();
		}	
	}
?>
