    <?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");

	$objeto				=new position();
	#AND p.deviceID=".$objeto->request["deviceId"]."
	$comando_sql        ="
				select d.*, p.*
				from 
					position p,
					device d,
					user_group ug,
					groups g
				where 	1=1
			    	AND p.deviceId=d.id
			    	AND d.positionId=p.id
					AND d.company_id={$_SESSION["company"]["id"]}
					AND ug.menu_id=2
					AND(		
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
			if($_SESSION["module"]["sys_section"]=="streetmap")
			{
				$txt_streetview="if(device_active=={$data["deviceId"]}) execute_streetMap(v);";
			}	
			
			#if(!$data[""]))		$data[""]="";
		    $ajax.="
		   		////////				        
			    var v 	={na:\"{$data["name"]}\",de:\"{$data["deviceId"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["serverTime"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", ot:{$data["other"]}};
			    locationsMap(v);
				$txt_streetview
			";
		}
	}	
    $ajax_positions="";
    if(@$_POST["repetir"]=="si")		$ajax_positions="ajax_positions_time();";
    
    echo "
    	<script>
            if (typeof del_locations == 'function') {
                del_locations();
            }		
            if (typeof fn_localizaciones == 'function') {
                $ajax
                $ajax_positions
            }            
        </script>
    ";
?>
