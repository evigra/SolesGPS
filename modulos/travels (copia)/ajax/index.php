<?php
	require_once("../../../nucleo/sesion.php");
	#require_once("../../../nucleo/general.php");
	
	$objeto				=new general();	
		
	$retun=array();
	$comando_sql        ="
        select    r.*
        from      travels t join route r on r.id=t.route_id
        where  1=1
			AND t.company_id={$_SESSION["company"]["id"]}
			AND left(sysdate(),10) BETWEEN t.inicio AND t.fin	
	";	
	$data =$objeto->__EXECUTE($comando_sql);	
	$routes="";
	if(count($data)>0)
	{
		foreach($data as $row)
		{
			$routes.="		
				var origen	=new google.maps.LatLng({$row["start"]});
				var destino	=new google.maps.LatLng({$row["end"]});				
				tracert(origen,destino);		
			";	
		}
		echo "
			<script>
				$routes
			</script> 	
		";	
	}
?>
