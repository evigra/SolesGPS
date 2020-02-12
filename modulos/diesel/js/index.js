	$(document).ready(function()
	{
		$(".select_devices").click(function()
		{		    
			$(".select_devices").removeClass("device_active");
			$(this).addClass("device_active");
			device_active=$(this).attr("device");
            
            $("input#deviceid").val(device_active);
            
	    	$("#form_map").dialog(
	    	{
	    		width:621	    	
	    	});
			$("#buscar_map").button({
				icons: {	primary: "ui-icon-search" },
				text: true
				})
				.click(function()
				{
					$("#form_map").dialog("destroy");

					$("form").submit();
					
					//map_history(str);
					
				}
			);			
		});    
    });
