$(document).ready(function()
{         
	$(".movimientos_ids").on('keydown', function (e) 
	{			
        if (e.keyCode == 13) 
		{						
			calcular_movimientos();							
		}	
    });

});

function calcular_movimientos()
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

	
 

    
    
  
   
    
   
                   
   
 
