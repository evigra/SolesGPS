<?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");

	$objeto				=new geofences();
	$data_obj			=$objeto->geofence();
	$geofences="";
	foreach($data_obj["data"] as $geofence)
	{
		$vgeofence	=explode("|",$geofence["points"]);
		$latLang	="";
		foreach($vgeofence as $points)
		{
			if($points!="")
			{
				$vpoints	=explode(",",$points);
				$latLang	.="
			{lat:$vpoints[1],lng:$vpoints[0]},";			
			}
		}
		$latLang				=substr($latLang,0,strlen($latLang)-1);
		$geofences.= "
			var flightPlanCoordinates=[
			$latLang
			];
			poligono(flightPlanCoordinates);			
		";	
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
