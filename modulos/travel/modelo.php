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
   		public function __VIAJE_HOY($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla
            $option["where"][]              ="fecha<='{$_SESSION["var"]["datetime"]}'";   # PL plantilla
            $option["where"][]              ="caducidad>='{$_SESSION["var"]["datetime"]}'";   # PL plantilla			
			if(!isset($this->sys_private["order"]) OR $this->sys_private["order"]=="")
				$option["order"]="id desc";
			
			$return= $this->__BROWSE($option);
			return $return;
		}							
							
	}
?>
