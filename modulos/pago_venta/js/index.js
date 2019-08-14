	function auto_empresa_id(ui)
	{
		$("input#empresa_id").val(ui.item.clave);					
		$("input#auto_empresa_id").val(ui.item.label);
		
		
		$("input#venta").val(ui.item.cliente);
		$("input#compra").val(ui.item.proveedor);
	}
	$(document).ready(function()
	{		
    });
    // ###########################################################################
