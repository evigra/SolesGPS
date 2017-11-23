<?php
	require_once("../../../nucleo/sesion.php");
	require_once("../../../nucleo/general.php");
	require_once("../../../nucleo/GeometryLibrary/vendor/autoload.php");

	$objeto				=new general();	
		
	$comando_sql				="
		select 
			r.*, r.id as gid, r.id as aid
		from 
			travels t join route r on r.id=t.route_id
		
		where  1=1
			AND t.company_id={$_SESSION["company"]["id"]}
			AND left(sysdate(),10) BETWEEN t.inicio AND t.fin
			
	";
	
	$geofence_data 				=$objeto->__EXECUTE($comando_sql);
	
	$return="";			
    foreach($geofence_data as $row)
    {    	
    	$points			="";
    	$vuelta			=array();
    	$ida			=array();
		$points_route	=explode(",",$row["points_route"]);		
		foreach($points_route as $i=>$point)
		{
			if($i<50)
			{
				if($point!="")
				{
					$t_punto_actual	=explode(" ",$point);				
					
				}
			}		
		}
		#echo count($ida);
		#echo count($vuelta);
		
		$ida=array_merge($ida, $vuelta);			

		$ida[]=$ida[0];
		
		#echo count($ida);
		
		foreach($ida as $point)
		{									
			$vpoints	=explode(" ",$point);
			@$latLang	.="
			PlanCoordinates.push({lat:$vpoints[0],lng:$vpoints[1]});";
		}
		
		
		$latLang				=substr($latLang,0,strlen($latLang)-1);
		@$geofences.= "		
			var PlanCoordinates	=new Array();
			$latLang
			poligono(PlanCoordinates);			
		";	
	}

	
	echo "
		<script>
            $geofences
	    </script>    	
	";	
	/*	
	echo "
		<script>
			var PlanCoordinates=[{lat:19.2393,lng:-103.70886000000002},{lat:19.239240000000002,lng:-103.70878},{lat:19.23883,lng:-103.70826000000001},{lat:19.2386,lng:-103.70797},{lat:19.2386,lng:-103.70797},{lat:19.23741,lng:-103.70876000000001},{lat:19.236990000000002,lng:-103.70908000000001},{lat:19.23683,lng:-103.70918},{lat:19.23683,lng:-103.70918},{lat:19.236710000000002,lng:-103.70926000000001}];
			poligono(PlanCoordinates);	
	    </script>    	
	";	
*/


?>

