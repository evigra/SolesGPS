	$(document).ready(function()
	{
		if($("#map").length>0) 
		{
			var location;
			var iZoom       =5;
			var iMap        ="ROADMAP";
			var coordinates ={latitude:19.057522756727606,longitude:-104.29785901920393};
			var object      ="map";
		    
		    CreateMap(iZoom,iMap,coordinates,object);    			

			$.ajax(
			{
				async:false,
				cache:false,
				dataType:"html",
				type: "POST",  
				url: "../modulos/denue/ajax/index.php",
				success:  function(res)
				{				    	
				    $("#script").html(res);
				}
			});    

		
		}	
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
	    link_kanban("&sys_section=map&sys_action=");
	    link_report("&sys_section=report&sys_action=");

    });
