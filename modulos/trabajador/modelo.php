<?php
	class trabajador extends users
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu=array();
		var $sys_table="users";
		##############################################################################	
		##  Metodos	
		##############################################################################

   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		## GUARDAR USUARIO
    		if(is_array($datas))	$datas["tipo"]				="trabajador";
    	    return parent::__SAVE($datas,$option);
		}		
		//////////////////////////////////////////////////		
		public function __BROWSE($option=NULL)		
    	{	
    		if(is_null($option))			$option					=array();
    		if(!isset($option))				$option					=array();
    		
    		#if(!isset($option["select"]))	$option["select"]		=array();
    		if(!isset($option["where"]))	$option["where"]		=array();
    		
    		
			$option["where"][]	="tipo='trabajador'";						
			    				
			return parent::__BROWSE($option);
		}				

	}
?>
