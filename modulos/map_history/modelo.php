<?php
	class map_history extends position
	{   
		public function __CONSTRUCT($option=NULL)
		{
			$this->sys_fields["start"]["type"]		="datetime";
			$this->sys_fields["start"]["title"]		="Fecha Inicial";

			$this->sys_fields["end"]["type"]		="datetime";
			$this->sys_fields["end"]["title"]		="Fecha Final";
			
			$this->sys_fields["speed"]["type"]		="input";
			$this->sys_fields["speed"]["title"]		="Velocidad";
			
			$this->sys_fields["address"]["type"]	="input";
			$this->sys_fields["address"]["title"]	="Calle";
		
			$this->sys_table						="position";
			$this->sys_module						="map_history";
			
			parent::__CONSTRUCT($option);
		}	
	}
?>


