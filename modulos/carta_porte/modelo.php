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
			#$this->sys_fields["image"]=array(
		
		
			parent::__CONSTRUCT($option);			
			$this->words["html_head_js"]              	=$this->__FILE_JS(array("../".$this->sys_module."js/index"));			
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    	    return parent::__SAVE($datas,$option);
		}
	}
?>

