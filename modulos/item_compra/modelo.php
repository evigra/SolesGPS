<?php	
	class item_compra extends item
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $modulo		="item_compra";
		var $sys_table	="item";
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE

   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
			if($this->modulo!="")    
	    	    $datas["modulo"]			=$this->modulo;
    	    
    		parent::__SAVE($datas,$option);
		}		
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();	
    		if(is_array($option))
    		{		
				if(!isset($option["where"]))    $option["where"]    =array();
				
				if(isset($_SESSION["company"]["id"]))
					$option["where"][]      ="company_id={$_SESSION["company"]["id"]}";
					
					
			}									
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}				
	}
?>
