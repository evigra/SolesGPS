	$(document).ready(function()
	{
	    
	    var location;
	    var iZoom       =5;
	    var iMap        ="ROADMAP";
	    var coordinates ={latitude:19.057522756727606,longitude:-104.29785901920393};
	    var object      ="map";
        
        CreateMap(iZoom,iMap,coordinates,object); 
        
		/*
	    coordinates 	={latitude:19.3481,longitude:-104.1};
        var vehicle 	={name:"CAMIONETA",deviceId:"6",latitude:"19.3481",longitude:"-104.1", course:"52", milage:"", speed:"22.1382", batery:"", times:"2015-11-27 18:11:34", address:"", image:"01", other: {"event":35,"sat":9,"gsm":12,"hdop":1.0,"odometer":7869714,"runtime":7318019,"cell":"334|2|1912|47505" ,"status":770,"adc1":6,"battery":4.19,"power":1453,"ip":"187.210.230.15"}};
		
        execute_streetMap(coordinates, vehicle);
		*/

        setTimeout(function()
        {    
    	    ajax_positions_time();	          
    	},1000);    
    });
