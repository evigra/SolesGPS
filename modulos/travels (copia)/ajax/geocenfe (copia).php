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
			if($i<500)
			{
				if($point!="")
				{
					$t_punto_actual	=explode(" ",$point);				
					
					if(@$anterior=="")		$anterior=$t_punto_actual;
					else
					{
						$nuevo	=$t_punto_actual;
					
						if(abs($nuevo[0]-$anterior[0])>0.00000001 AND abs($nuevo[1]-$anterior[1])>0.00000001)						
						{								
							$response1 =  \GeometryLibrary\SphericalUtil::computeHeading(
								array('lat' => $anterior[0], 'lng' => $anterior[1]), 
								array('lat' => $nuevo[0], 'lng' => $nuevo[1])
							);	

						
						  	$nuevo_p1 =  \GeometryLibrary\SphericalUtil::computeOffset(array('lat' => $nuevo[0], 'lng' => $nuevo[1]), 60, $response1 - 90);
						  	$nuevo_p2 =  \GeometryLibrary\SphericalUtil::computeOffset(array('lat' => $nuevo[0], 'lng' => $nuevo[1]), 60, $response1 + 90);
							
						  	$anterior_p1 =  \GeometryLibrary\SphericalUtil::computeOffset(array('lat' => $anterior[0], 'lng' => $anterior[1]), 60, $response1 - 90);
						  	$anterior_p2 =  \GeometryLibrary\SphericalUtil::computeOffset(array('lat' => $anterior[0], 'lng' => $anterior[1]), 60, $response1 + 90);
						
								
							if(@$nue_ant_p1=="")
							{
								$nue_ant_p1	=$nuevo_p1;
								$nue_ant_p2	=$nuevo_p2;
							
						  		$ida[]		=$anterior_p1["lat"]." ".$anterior_p1["lng"];					  						  		
						  		array_unshift($vuelta, $anterior_p2["lat"]." ".$anterior_p2["lng"]);
							}				
							else
							{														
								$actual_p1_lat=($nue_ant_p1["lat"] + $anterior_p1["lat"])/2;
								$actual_p1_lng=($nue_ant_p1["lng"] + $anterior_p1["lng"])/2;
							
								$actual_p2_lat=($nue_ant_p2["lat"] + $anterior_p2["lat"])/2;
								$actual_p2_lng=($nue_ant_p2["lng"] + $anterior_p2["lng"])/2;

						  		$ida[]		=$actual_p1_lat." ".$actual_p1_lng;					  						  		
						  		array_unshift($vuelta, $actual_p2_lat." ".$actual_p2_lng);

								$nue_ant_p1	=$nuevo_p1;
								$nue_ant_p2	=$nuevo_p2;
							}
						}
						$anterior=$nuevo;
					}	
				}
			}		
		}
  		$ida[]		=$nue_ant_p1["lat"]." ".$nue_ant_p1["lng"];
  		array_unshift($vuelta, $nue_ant_p2["lat"]." ".$nue_ant_p2["lng"]);
				
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
			var option={};
			option.color=\"#FF0000\";
			option.opacity=1;
			poligono(PlanCoordinates,option);			
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

