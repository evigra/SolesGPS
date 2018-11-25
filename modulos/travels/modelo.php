<?php
	class travels extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="SCP";
		
		var $movimiento_obj;
		
		##############################################################################	
		##  Metodos	
		##############################################################################
        
		public function __CONSTRUCT()
		{	
			$this->sys_fields["movimientos_ids"]=array(
			    "title"             => "Horario",
			    "type"              => "form",
			    "relation"          => "many2one",			    
			    "class_name"       	=> "carta_porte",			    
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "movimiento_id",				
			);
			parent::__CONSTRUCT();		
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		$datas["tipo"]						=$this->tipo_movimiento;								
			if($this->request["sys_section_". $this->sys_object]=="create")
			{
				$option_folios=array();
				$option_folios["tipo"]			=$this->tipo_movimiento;
				$datas["folio"]					=$this->__FOLIOS($option_folios);
			}				
			
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla
			
			if(!isset($this->request["sys_order_". $this->sys_object]))
				$option["order"]="id desc";
			
			return parent::__BROWSE($option);
		}							
	}
?>

