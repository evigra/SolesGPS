	$(document).ready(function()
	{
		$("font.relacion").mouseover(function(){
			var relacion = $(this).attr("relacion");
			var back	 = $(this).css("background");			
			$("font.relacion").css( "background",back);		
			$("font.relacion[relacion='"+ relacion +"']").css( "background","red");		
		});
		
		
		
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
	    if($("#write").length>0)
	    {
			$("#write").button({
				icons: {	primary: "ui-icon-pencil" },
				text: false
				})
				.click(function(){
				    window.location="&sys_section=write&sys_action=";		    
				}
			);
	    }
	    if($("#filtrar").length>0)
	    {
			$("#filtrar").button({
				icons: {	primary: "ui-icon-pencil" },
				text: true
				})
				.click(function()
				{
					$("form").submit();		        
				}
			);	    		
		}	
		action_cancel();
	    link_kanban("&sys_section=kanban&sys_action=");
	    link_report("&sys_section=report&sys_action=");
    
		/*
    	$("[type=checkbox]").click(function() {  
        if($(this).is(':checked')) {  
            $(this).parents( ".cKanban" ).css( "background","red"); //.css("background-color ", "red ");
        } else {  
            $( ".cBotones.actionsv" ).css( "display", "none"); 
        }  
    	});    	
    	*/

    });
