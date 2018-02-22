	function auto_item_id(ui)
	{
		$("input#item_id").val(ui.item.clave);					
		$("input#auto_item_id").val(ui.item.label);
		
		var vende 	=$("input#venta").val();
		var compra 	=$("input#compra").val();

		var lista=1;
		
		if(compra>0) 	lista=compra;
		if(vende>0) 	lista=vende;

		$("input#precio").val(ui.item["vende"+lista]);					
		subtotal();
	}
	function subtotal()
	{
		var cantidad 			=$("input#cantidad").val();
		var precio 				=$("input#precio").val();
		var descuento 			=$("input#descuento").val();										
		
		var subtotal_articulo 	= (cantidad * precio) - descuento;
												
		$("input#subtotal").val(subtotal_articulo);
	}		
	$(document).ready(function()
	{	
		
	
		
		
		
			
	});	
		
		
