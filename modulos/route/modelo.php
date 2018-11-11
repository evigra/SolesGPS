<?php	
	class  route extends item
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $modulo="route";
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE
		
  		public function __CONSTRUCT($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			

			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}				
	}
?>
