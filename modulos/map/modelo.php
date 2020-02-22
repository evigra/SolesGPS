<?php
	class map extends position
	{   
		public function __CONSTRUCT()
		{
			$this->sys_table="positions";
			$this->sys_module="map";
			parent::__CONSTRUCT();
		}	
		
	}
?>
