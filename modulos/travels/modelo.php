<?php
	class travels extends movimientos
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_table			="movimientos";
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),			
			#######################################################################
			"movimiento_id"	    =>array(
				"title"             => "Calculo ID",			    
			    "type"              => "input",								
			    "attr"             => array(		
					"required",
					"tabindex"		=>"1",
			    	"grupo"=>"1"
			    ),				
			),
			"item_id"	=>array(
			    "title"             => "ARTICULO",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "type"              => "autocomplete",
			    "procedure"       	=> "autocomplete_item",
			    #"relation"          => "one2many",			    
			    "relation"          => "many2one",
			    "class_name"       	=> "item",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "item_id",
			    "class_field_m"    	=> "id",			    
			),			

			"cantidad"	    =>array(
				"title"             => "CANTIDAD",			    
			    "type"              => "input",								
			    "attr"             => array(						
					"tabindex"		=>"1",			    	
			    ),				
			),
			"precio"	    =>array(
				"title"             => "PRECIO",			    
			    "type"              => "input",								
			    "attr"             => array(		
					"tabindex"		=>"1",			    	
			    ),				
			),
			"subtotal"	    =>array(
				"title"             => "SUBTOTAL",			    
			    "type"              => "input",								
			    "attr"             => array(		
					"tabindex"		=>"1",			    	
			    ),				
			),
			"impuesto"	    =>array(
				"title"             => "IVA",			       
			    "type"              => "input",								
			    "attr"             => array(		
					"tabindex"		=>"1",			    	
			    ),				
			),
			"descuento"	    =>array(
				"title"             => "DESCUENTO",			        
			    "type"              => "input",								
			    "attr"             => array(						
					"tabindex"		=>"1",			    	
			    ),				
			),

			#######################################################################
		);				
		
		##############################################################################	
		##  Metodos	
		##############################################################################		
		
	}
?>
