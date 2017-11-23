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
    
    
    
	    if($("select#image").length>0)
	    {
	    	$("select#image").change(function()
	    	{
	    		var path="../sitio_web/img/car/vehiculo_"+$(this).val()+"/i135.png";
	    		$("#image_device").attr("src",path);	    	
	    	});	    
	    }    
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
