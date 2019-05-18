<?php
    require_once("../../../nucleo/sesion.php");
    #require_once("../../../nucleo/general.php");
	#require_once("../modelo.php");

	$objeto				=new geofences();
	
	$option["where"]	=array();
	$option["where"][]	="(hidden is null or hidden in (0,'0'))";
	#$option["where"][]	="color='yellow'";		
	$option["limit"]	="10000";	
	
	$data_obj			=$objeto->geofence($option);
	$geofences="";
	if(is_array(@$data_obj["data"]))
	{
		foreach($data_obj["data"] as $geofence)
		{
			$geofence["area"]	=substr($geofence["area"],9,strlen($geofence["area"])-11);
			$vgeofence			=explode(", ",$geofence["area"]);
		
			#$vgeofence	=explode("|",$geofence["points"]);
			$latLang	="";
			foreach($vgeofence as $points)
			{
		
				if($points!="")
				{
					#$vpoints	=explode(", ",$points);
					$vpoints	=explode(" ",$points);
					$latLang	.="
				{lat:$vpoints[0],lng:$vpoints[1]},";
				}
			}
			$latLang				=substr($latLang,0,strlen($latLang)-1);
			$geofences.= "

				var flightPlanCoordinates=[
				$latLang
				];
				poligono(flightPlanCoordinates,{color:\"{$geofence["color"]}\",geofence:\"{$geofence["name"]}\"});			
			";	
		}	
	}
	echo "
		<script>
	        setTimeout(function()
		    { 
	            $geofences
	        } ,300);    
	    </script>    
	";      
	
?>

