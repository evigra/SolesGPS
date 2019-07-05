<?php	
	class seguimientos_registro extends devices
	{   
		##############################################################################	
		##  Metodos	
		##############################################################################&sys_action=__SAVE
		public function __CONSTRUCT()
		{
			$this->sys_table="devices";
			
			$this->sys_fields["name"]["title"]				="Modelo";			
			$this->sys_fields["placas"]["description"]		="Placas actuales del vehiculo";			
			$this->sys_fields["telefono"]["description"]	="Numero telefonico del celular";			
			$this->sys_fields["image"]["description"]		="Imagen que se presentara en el mapa";			
			$this->sys_fields["image"]["source"]=array(
					"01"	=>	"Tracto Azul",
			    	"02"	=>	"Carro Rojo",
			    	"03"	=>	"Carro Blanco",	
		    );
		    $this->request["sys_id"]=$_SESSION["seguimiento_id"];
			parent::__CONSTRUCT();			
		}				
				
		public function tab_files()		
    	{
			$this->words["files_title"]				="";
			$this->words["files_description"]		="";
			
			if($this->sys_fields["file_id"]["value"]!="")
			{
				$this->words["files_title"]				="<li  class=\"form\"><a href=\"#tabs-10\">Imagenes</a></li>";    		
				$aux									="modulos/files/file/{$this->sys_fields["file_id"]["value"]}.jpg";
			
				if(file_exists("../$aux"))				$path		="../$aux";
				else									$path		="http://solesgps.com/$aux";			
			
				$this->words["files_description"]		="
					<div id=\"tabs-10\"  class=\"form\">
						<img src=\"$path\" width=\"300\">
					<div>
				";
			}    		    		
		}						
	}
?>
