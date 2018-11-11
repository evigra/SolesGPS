	function puntos(GeoMarker)
    {
		var punto	=new String();
		var puntos	=new String();
		for(index in GeoMarker)
		{		
			punto	=GeoMarker[index];
			puntos	+=punto["latitude"]+","+punto["longitude"]+"|"; 
		    //$("input#points").val(puntos);	
		}				
	}
	
	function limpiar_virtual()
	{		
		for(indexMarker=0;indexMarker<locationsMarker.length;indexMarker++)
		{
			locationsMarker[indexMarker].setMap(null);			
		}				
		locationsMarker.length = 0;		
		locationsMarker=Array();
	}
	function limpiar_real()
	{	
		limpiar_virtual();
		//$("input#points").val("");		
		for(ilineas in lineas)
		{			
			lineas[ilineas].setMap(null);									
		}
		lineas		=Array();	
		GeoMarker	=Array();
		GeoMarker1	=Array();
	}
	
	$(document).ready(function()
	{
    	if($("div#map").length>0) 
    	{
			var location;

			var iZoom       =5;
			var iMap        ="ROADMAP";
			var coordinates ={latitude:19.057522756727606,longitude:-104.29785901920393};
			var object      ="map";
		    
		    CreateMap(iZoom,iMap,coordinates,object); 
			google.maps.event.addListener(map, 'click', function(event) 
			{ 		   
				location    =event.latLng;
				latitud     = new String(event.latLng.lng());
				longitud    = new String(event.latLng.lat());
			
				coordinate  ={latitude:latitud,longitude:longitud};
			});        
		    
			limpiar_virtual();
			limpiar_real();	  
			
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
	    link_report("&sys_section=report&sys_action=");

    	if($("div#map").length>0) 
    	{

			$("#map").click(function()
			{
				limpiar_virtual();
		        marker          =markerMap(location);
				locationsMarker.push(marker);						
			});	    

			$("#accion_punto")
				.button({
					icons: {	primary: "ui-icon-lightbulb" },
					text: true
				})		
				.click(function()
				{
					GeoMarker.push(coordinate);
					GeoMarker1.push(location);
					if(GeoMarker1.length>1)
					{
					    puntos(GeoMarker);
					    polilinea(GeoMarker1);
		            }
				}
			);	
			$("#finalizar_punto")
				.button({
					icons: {	primary: "ui-icon-play" },
					text: true
				})		
				.click(function()
				{
					
					if(GeoMarker1.length>1)
					{
						var tot			=GeoMarker1.length -1;
						for(igeo in GeoMarker1)
						{
							if(igeo==0)
							{
								var origen		=GeoMarker1[igeo];
								var origen1		=String(origen);						
							}
							else if(igeo==tot)
							{
								var destino		=GeoMarker1[igeo];
								var destino1	=String(destino);						
							}
							else
							{
								waypts.push({
									location: GeoMarker1[igeo],
									stopover: true
								});
							}	
						}
						//$("#start").val(origen1.substring(1, origen1.length-2));
						//$("#end").val(destino1.substring(1, destino1.length-2));
					
						tracert(origen,destino,waypts);
						//distance(origen,destino,waypts);
						
						limpiar_virtual();
						limpiar_real();										
					}					
				}
			);	    
			$("#limpiar_punto")
				.button({
					icons: {	primary: "ui-icon-play" },
					text: true
				})		
				.click(function()
				{
					limpiar_virtual();
					limpiar_real();				
				}
			);	    
		}	            
    });
