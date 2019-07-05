<?php
	class carta_porte extends movimientos
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();		
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimientos";
		
		##############################################################################	
		##  Metodos	
		##############################################################################
		public function __CONSTRUCT($option=array())
		{	
			$this->sys_fields["item_id"]	=array(
			    "title"             => "Articulo",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "type"              => "autocomplete",
			    "procedure"       	=> "autocomplete_item",
			    "relation"          => "one2many",			    
			    "class_name"       	=> "route",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "item_id",
			    "class_field_m"    	=> "id",			    
			);
			parent::__CONSTRUCT($option);			
			$this->words["html_head_js"]              	=$this->__FILE_JS(array("../".$this->sys_module."js/index"));			
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    	    return parent::__SAVE($datas,$option);
		}
	}
?>
