    <?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");

	$objeto				=new position(array("temporal"=>"AUX_DEVICE"));
	
	
	if(array_key_exists("id",$_SESSION["user"]) AND $_SESSION["user"]["id"]!="")
	{	
		$comando_sql        ="
		update sesion set last_time='{$objeto->sys_date}' 
		WHERE 1=1 
			AND user_id={$_SESSION["session"]["user_id"]}
			AND date='{$_SESSION["session"]["date"]}'
			AND server_addr='{$_SESSION["session"]["server_addr"]}'
			AND remote_addr='{$_SESSION["session"]["remote_addr"]}'
	";
	#echo $comando_sql;
	#device d on p.deviceId=d.id AND d.positionId=p.id join
	$objeto->__EXECUTE($comando_sql, "AJAX POSITION");	
		# device d on p.deviceId=d.id AND d.positionId=p.id join
		$comando_sql        ="
				select 
					d.*,p.*,c.*
				from 
					positions p join 
					devices d on p.deviceId=d.id AND d.positionId=p.id join
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
			
				$ajax.="
			   		////////				        
					var v 	={st:\"{$data["estatus"]}\",na:\"{$data["name"]}\",de:\"{$data["deviceId"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["serverTime"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", ot:{$data["other"]}};
					locationsMap(v);
				";
			}
		}	
		$ajax_positions="";
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
   } 
?>
