<?php
	class celphone extends devices
	{   
		public function __CONSTRUCT()
		{
			$this->sys_table="devices";
			
			$this->sys_fields["name"]["title"]				="Modelo";
			
			$this->sys_fields["placas"]["title"]			="Responsable";
			$this->sys_fields["placas"]["description"]		="Responsable fisicamente del celular";
			
			$this->sys_fields["telefono"]["description"]	="Numero telefonico del celular";
			
			$this->sys_fields["image"]["description"]		="Imagen que se presentara en el mapa";
			
			$this->sys_fields["image"]["source"]=array(
		    	"90"	=>	"Celular Negro",
		    	"91"	=>	"Celular Azul",
		    	"92"	=>	"Celular Verde",
		    	"93"	=>	"Celular Rojo",			    	
		    );		
			parent::__CONSTRUCT();
		}	
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    	    
    	    $datas["vehicle"]		=0;
    		parent::__SAVE($datas,$option);
		}			
		public function celphones($option=NULL)
    	{
    		if(is_null($option))			$option=array();
			if(!isset($option["where"]))    $option["where"]    =array();
			
			$option["where"][]      ="vehicle=0";
			return $this->devices($option);    	
		}				
	}
?>
