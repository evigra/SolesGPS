<?php
	class orden_venta extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="OV";
		
		var $movimiento_obj;
		
		##############################################################################	
		##  Metodos	
		##############################################################################
        
		public function __CONSTRUCT()
		{	
			parent::__CONSTRUCT();		
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    					
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
   		public function __SAVE_PAGAR($datas=NULL,$option=NULL)
    	{    					
			$js="
				$(\"form\").attr({\"action\":&sys_section_pago_venta=create&pago_venta_total=56});					
				$(\"form\").submit(); 	        
			";	
			$this->__JS($js);
		}

   		public function __BROWSE($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla
			
			if(!isset($this->request["sys_order_". $this->sys_object]) OR $this->request["sys_order_". $this->sys_object]=="")
				$option["order"]="id desc";
			
			
			return parent::__BROWSE($option);
		}							
	}
?>

