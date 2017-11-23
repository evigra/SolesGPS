	$(document).ready(function()
	{
		$("#action").button({
			icons: {	primary: "ui-icon-document" },
			text: true
		    })
		    .click(function(){
				var variables=getVarsUrl();
				var str_url="";
				for(ivariables in variables)
				{
					if(ivariables=="sys_action")	str_url+="&"+ivariables+"=__SAVE";
					else							str_url+="&"+ivariables+"="+ variables[ivariables];
				}		        
				$("form")
					.attr({"action":str_url})
					.submit();
		        
		    }
	    );		

		$("#create").button({
			icons: {	primary: "ui-icon-document" },
			text: false
		    })
		    .click(function(){
		        window.location="&sys_section=create&sys_action=";		    
		    }
	    );		

		$("#write").button({
			icons: {	primary: "ui-icon-pencil" },
			text: false
		    })
		    .click(function(){
		        window.location="&sys_section=write&sys_action=";		    
		    }
	    );		
		action_cancel();
	    link_kanban("&sys_section=kanban&sys_action=");
	    link_report("&sys_section=report&sys_action=");


		$(".select_devices").click(function()
		{		    
			$(".select_devices").removeClass("device_active");
			$(this).addClass("device_active");
			device_active=$(this).attr("device");
			
			$("div#tablero").html("Dispositivo seleccionado :: Esperando filtrado");
			$("div#tablero2").html("");
			
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
					
					var str = $("form").serialize() + "&device_active="+device_active;				
					
					var html_load="Cargando datos<br>\
					<img id=\"loader1\" height=\"30\" width=\"30\" src=\"../sitio_web/img/loader1.gif\">";
					$("div#tablero").html(html_load);
					map_history(str);
					
				}
			);			
		});    


    });
    
	function map_history(str)
	{
		$.ajax(
		{
			async:false,
			cache:false,
			dataType:"html",
			type: "POST",  
			data: str,
			url: "../modulos/map_history/ajax/history.php",
			success:  function(res)
			{					
				//$("#tablero").html("");
				$("#script").html(res);
			},
			beforeSend:function()
			{
			
			},
			error:function(res)
			{			    
				map_history(str);
				$("div#tablero").html("Se presento un error :: Estamos intentando nuevamente");
			}						
		});	
	}    
    
