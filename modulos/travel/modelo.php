<?php
	class travel extends orden_venta
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="OVT";
		
		var $movimiento_obj;
		
		##############################################################################	
		##  Metodos	
		##############################################################################        
		public function __CONSTRUCT($option=NULL)
		{
			$this->sys_fields["movimientos_ids"]["class_name"]="travels";												
			parent::__CONSTRUCT($option);				
		}
		##############################################################################
							
	}
?>
