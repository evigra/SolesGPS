	
	function puntos(GeoMarker)
    {
		var punto	=new String();
		var puntos	=new String();
		for(index in GeoMarker)
		{		
			punto	=GeoMarker[index];
			puntos	+=punto["latitude"]+","+punto["longitude"]+"|"; 
		    $("input#long1").val(puntos);	
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
		$("input#long1").val("");		
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
						tracert(origen,destino,waypts);
						distance(origen,destino,waypts);
										
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
    
    	
