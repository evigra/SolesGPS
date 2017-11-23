	$(document).ready(function()
	{	    
		$("text.fila").click(function()		
		{
			var fila	=$(this).attr("fila");
			$(".contenedor").attr({"opacity":0.03});
			
			$(".contenedor[fila="+fila+"]").attr({"opacity":0.95});
		});
		$("text.columna").click(function()		
		{
			var columna	=$(this).attr("columna");
			$(".contenedor").attr({"opacity":0.01});
			
			$(".contenedor[columna="+columna+"]").attr({"opacity":1});
		});
    });    
