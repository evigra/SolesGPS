	function auto_empresa_id(ui)
	{
		$("input#empresa_id").val(ui.item.clave);					
		$("input#auto_empresa_id").val(ui.item.label);
		
		
		$("input#venta").val(ui.item.cliente);
		$("input#compra").val(ui.item.proveedor);
	}
	$(document).ready(function()
	{		
		$("#action_pagar").click(function(){

			$("form").attr({"action":"../pago_venta/&sys_section_pago_venta=create&pago_venta_total=56"});					
			$("form").submit();
		});
		$("#action_abonar").click(function(){
			$("#sys_action_movimiento").val("__SAVE_abonar");
			$("form").submit();
		});
		$("#action_pagar").click(function(){
			$("#action_cancelar").val("__SAVE_cancelar");
			$("form").submit();
		});
    });
    // ###########################################################################
