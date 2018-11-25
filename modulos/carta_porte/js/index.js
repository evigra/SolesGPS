	function auto_item_id(ui)
	{
		$("input#item_id").val(ui.item.clave);					
		$("input#auto_item_id").val(ui.item.label);
		
		var vende 	=$("input#venta").val();
		var compra 	=$("input#compra").val();

		var lista=1;
		
		if(compra>0)
		{ 	
			lista=compra;
			tipo="compra";
		}
		if(vende>0)
		{ 	
			lista=vende;
			tipo="vende";
		}
			
		$("input#precio").val(ui.item[tipo+lista]);					
		subtotal();
	}
	function subtotal()
	{
		var cantidad=0;
		var precio=0;
		var descuento=0;
		var subtotal=0;
		
		if(!isNaN(parseFloat($("#cantidad.movimientos").val())))	
			cantidad=parseFloat($("#cantidad.movimientos").val());
			
		if(!isNaN(parseFloat($("#precio.movimientos").val())))	
			precio=parseFloat($("#precio.movimientos").val());
			
		if(!isNaN(parseFloat($("#descuento.movimientos").val())))	
			descuento=parseFloat($("#descuento.movimientos").val());

		subtotal=(cantidad*precio)-descuento;

		$("#subtotal.movimientos").val(subtotal);
	}		
	$(document).ready(function()
	{
		
		$("input.movimientos_ids")
			.focusout(function(){subtotal();})
			.on('keydown', function (e) 
			{			
				if (e.keyCode == 13) 
				{						
					subtotal();							
				}	
			});
			
	});	
		
		
