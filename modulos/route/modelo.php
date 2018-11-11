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
		public function __CONSTRUCT()
		{	
			$this->sys_fields["long1"]	    =array(
			    "title"             => "points",
			    "type"              => "hidden",
			);									
			$this->sys_fields["campo1"]	    =array(
			    "title"             => "points_route",
			    "type"              => "input",
			);									

			$this->files_obj	=new files();
			parent::__CONSTRUCT();
		}
		
	}
?>
