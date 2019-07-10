<?php
	class orden_venta extends movimiento
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_table			="movimiento";
		var $tipo_movimiento	="OV";
		
		var $movimiento_obj;
		
		##############################################################################	
		##  Metodos	
		##############################################################################        
		public function __CONSTRUCT($option=NULL)
		{				
			parent::__CONSTRUCT($option);		
		}
		##############################################################################
   		public function __SAVE($datas=NULL,$option=NULL)
    	{    		    					
    	    $return= parent::__SAVE($datas,$option);
    	    return $return;
		}
		##############################################################################
   		public function action_enviar()
    	{   
    		if($this->sys_fields["empresa_id"]["values"][0]["email"]!="")
    		{
				$option=array(
					"title"	=>"SolesGPS :: Cotizacion",
					"to"	=>$this->sys_fields["empresa_id"]["values"][0]["email"],
					"to"	=>"evigra@gmail.com",
					"html"	=>"PRUEBA DE COTIZACION",
					"file"	=>"http://developer.solesgps.com/orden_venta/&sys_action=print_pdf&sys_section=write&sys_id=90&sys_pdf=S&a=.pdf"
				);			
				
				$this->send_mail($option);
								
				$this->__PRINT_R("CORREO ENVIADO"); 		    				    		
			}   
			else 	        	    $this->__PRINT_R("La empresa no tiene correo registrado"); 		    				    		
		}
		##############################################################################
   		public function __BROWSE($option="")
    	{			    	
			if($option=="")	$option=array();			
			if(!isset($option["where"]))	$option["where"]=array();
			
			$option["where"][]				="tipo='{$this->tipo_movimiento}'";   # PL plantilla
			
			if(!isset($this->sys_private["order"]) OR $this->sys_private["order"]=="")
				$option["order"]="id desc";
			
			$return= parent::__BROWSE($option);
			return $return;
		}							
	}
?>
