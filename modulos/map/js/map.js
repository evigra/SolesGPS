	$(document).ready(function()
	{	    
	    var location;
	    var iZoom       =5;
	    var iMap        ="ROADMAP";
	    var coordinates ={latitude:19.057522756727606,longitude:-104.29785901920393};
	    var object      ="map";
        
        CreateMap(iZoom,iMap,coordinates,object); 
        
		maxZoomService = new google.maps.MaxZoomService();
           
        
        ajax_positions_now("../modulos/travels/ajax/index.php",100);
        ajax_positions_now("../sitio_web/ajax/map_online.php");
        ajax_positions("../sitio_web/ajax/map_online.php");
		status_device();
                
		$(".select_devices").click(function()
		{		    
			ajax_positions_now("../sitio_web/ajax/map_online.php");
			$(".select_devices").removeClass("device_active");
			$(this).addClass("device_active");
			device_active=$(this).attr("device");
			
			var actualiza="no";
            status_device(actualiza, this);
		});    	
    });
    
	function messageMap(marcador, vehicle) 
	{
		var contentString = '<div id="contentIW"> \
								<table> \
									<tr> <th align=\"left\"> FECHA	</th>  <td> '+vehicle["da"]+'	</td> 	</tr> \
									<tr> <th align=\"left\"> VELOCIDAD </th> <td> '+vehicle["sp"]+'</td> 	</tr> \
								</table> \
							</div>';

		var infowindow = map_info({content: contentString});
		
		messageMaps(marcador, vehicle,infowindow);		
	}	
        
