	$(document).ready(function()
	{
		$(".select_devices").click(function()
		{		    
			$(".select_devices").removeClass("device_active");
			$(this).addClass("device_active");
			device_active=$(this).attr("device");

	    	$("#form_map").dialog(
	    	{
	    		width:621	    	
	    	});
	    	alert("aaaa");
			$("#buscar_map").button({
				icons: {	primary: "ui-icon-search" },
				text: true
				})
				.click(function()
				{
					$("#form_map").dialog("destroy");
					
					var str = $("form").serialize() + "&device_active="+device_active;				
					
					//map_history(str);
					
				}
			);			
		});    
    });
