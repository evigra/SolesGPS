<?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
    require_once("../../../modulos/position/modelo.php");
	#require_once("../modelo.php");

	$objeto				=new position();
	#AND p.deviceID=".$objeto->request["deviceId"]."
	$comando_sql        ="
				select 
					d.*,p.*,c.*
				from 
					position p join 
					device d on p.deviceId=d.id AND d.positionId=p.id join
					user_group ug on ug.menu_id=2 join
					company c on d.company_id={$_SESSION["company"]["id"]} AND d.company_id=c.id,
					groups g
				where 	1=1				
					AND (		
						(
							responsable_fisico_id={$_SESSION["user"]["id"]}
							AND user_id=responsable_fisico_id
							AND ug.active=g.id
						)        
						OR						
						(
							ug.user_id={$_SESSION["user"]["id"]}
							AND ug.active=g.id
							AND g.nivel<40
						)
					)		
	";
    #echo $comando_sql;
	$datas              =$objeto->__EXECUTE($comando_sql, "AJAX POSITION");	
	
	 $ajax="";
	if(count($datas)>0) 
	{
		foreach($datas as $data)
		{    
			#$objeto->__PRINT_R($data);
			if(!isset($data["milage"]))		$data["milage"]="undefined";
			if(!isset($data["batery"]))		$data["batery"]="";
			if(!isset($data["address"]))	$data["address"]="";
			if(!isset($data["course"]))		$data["course"]="1";
			if(!isset($data["speed"]))		$data["speed"]	="undefined";
			
			$txt_streetview="";
			if($device_active==$data["deviceId"])		
				$txt_streetview="execute_streetMap(v);";

		    $ajax.="
		   		////////				        
			    var v 	={na:\"{$data["name"]}\",de:\"{$data["deviceId"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["serverTime"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", ot:{$data["other"]}};
			    locationsMap(v);
				$txt_streetview
			";
		}
	}	
    $ajax_positions="";
	
	if(!isset($_GET["device_active"]))	$_GET["device_active"]=0;
    $device_active=$_GET["device_active"];
    echo "
    	<script>
            if (typeof del_locations == 'function') 
            {
                del_locations();
            }		
            if (typeof fn_localizaciones == 'function') 
            {
                $ajax
            }            
        </script>
    ";
?>
