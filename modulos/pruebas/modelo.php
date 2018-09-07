<?php
	class prueba extends movimiento_plantilla
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		#var $sys_table			="movimiento";
		
        
		public function __CONSTRUCT()
		{	
			#$this->movimiento_obj		=new movimiento();
			
			parent::__CONSTRUCT();		
			#$this->__PRINT_R($_SESSION["SAVE"]);
			
		}
		#/*
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
	}
?>

