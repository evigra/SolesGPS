<?php	
	class  route extends item
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $modulo		="route";
		var $sys_table	="item";
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE
		public function __CONSTRUCT($option=NULL)
		{	
			$this->sys_fields["long1"]	    =array(
			    "title"             => "points",
			    "type"              => "hidden",
			);									
			$this->sys_fields["campo1"]	    =array(
			    "title"             => "points_route",
			    "type"              => "hidden",
			);									
			$this->sys_fields["campo2"]	    =array(
			    "title"             => "Tiempo",
			    "type"              => "input",
			);									
			$this->sys_fields["campo3"]	    =array(
			    "title"             => "Distancia",
			    "type"              => "input",
			);									

			parent::__CONSTRUCT($option);
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["type"]			=2;
    	    
    	    if($datas["long1"]=="")		   	unset($datas["long1"]);
    	    if($datas["campo1"]=="")		unset($datas["campo1"]);
    	    	
    	    $datas["se_vende"]		=1;
    	    $datas["se_compra"]		=1;
    	    
    		parent::__SAVE($datas,$option);
		}				
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option))	$option=array();			
			if(!isset($option["where"]))    $option["where"]    =array();
			
			if($this->modulo!="")
				$option["where"][]      ="modulo='{$this->modulo}'";
									
			$return 				=parent::__BROWSE($option);
			return	$return;     	
		}				
	}
?>
