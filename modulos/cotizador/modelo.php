<?php
	class cotizador extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		##############################################################################	
		##  Metodos	
		##############################################################################
        
		public function __CONSTRUCT()
		{	
			parent::__CONSTRUCT();		
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		
			$datas["tipo"]			="COT";
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
		#*/		
   		public function __REPORTE($option="")
    	{			    	
			if($option=="")	$option=array();
			#if(!isset($option["select"]))	$option["select"]=array();
			
			
			#$option["select"][]							="*";
			#$option["select"]["concat(tipo,folio)"]		="folio";
			
			#$option["from"]								="movimiento m";
			
			$option["template_title"]	                = $this->sys_module . "html/report_title";
			#$option["template_title"]	                = "";
			$option["template_body"]	                = $this->sys_module . "html/report_body";
			
			$option["where"]			                = array();
			$option["where"][]							="tipo='COT'";
	
			
			if(!isset($this->request["sys_order_movimiento"]))
				$option["order"]="id desc";
			
			return parent::__VIEW_REPORT($option);
		}						

	}
?>
