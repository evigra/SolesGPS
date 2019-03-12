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

			var mod_destino	="pago_venta";
			var mod_actual	="orden_venta";
			var variables="../pago_venta/";
			variables+="&sys_section_"+mod_destino+"=create";
			variables+="&"+mod_destino+"_total=" + $("#total[name='"+mod_actual+"_total']").val();
			variables+="&"+mod_destino+"_total=" + $("#total[name='"+mod_actual+"_total']").val();								

			$("form").attr({"action":variables);					
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
