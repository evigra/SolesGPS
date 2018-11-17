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
		public function __CONSTRUCT()
		{	
			$this->sys_fields["long12"]	    =array(
			    "title"             => "points",
			    "type"              => "hidden",
			);									
			$this->sys_fields["campo1"]	    =array(
			    "title"             => "points_route",
			    "type"              => "input",
			);									
			$this->sys_fields["campo2"]	    =array(
			    "title"             => "Tiempo",
			    "type"              => "input",
			);									
			$this->sys_fields["campo3"]	    =array(
			    "title"             => "Distancia",
			    "type"              => "input",
			);									

			parent::__CONSTRUCT();
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["type"]		=2;
    		parent::__SAVE($datas,$option);
		}		
			
	}
?>
