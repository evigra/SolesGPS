<?php
    require_once("../../nucleo/sesion.php");
    #require_once("../../../nucleo/general.php");
    #require_once("../../../modulos/position/modelo.php");
	#require_once("../modelo.php");

	$objeto				=new position();
	$ajax="";

	if(isset($_SESSION["company"]["id"]))
	{
		$compania=" d.company_id={$_SESSION["company"]["id"]} AND ";
	
		if(@$_SESSION["module"]["name"]=="map/")
		{
			$compania="";
		}

		$comando_sql        ="
			select 
				d.id as d_id,
				d.*,c.*,g.*,
				d.name as d_name				
			from 

		        devices d  join
				user_group ug on 
					ug.menu_id=2 join
				company c on 
					$compania					
					d.company_id=c.id,
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
		$datas_device          =$objeto->__EXECUTE($comando_sql);	

		foreach($datas_device as $data_device)
		{    
			if($data_device["odometro_inicial"]=="")$data_device["odometro_inicial"]=0;
	
			$comando_sql        ="
				SELECT 
					p.*,
				
					p.attributes as p_attributes,
					truncate((extract_JSON(p.attributes,'totalDistance') + {$data_device["odometro_inicial"]})/1000*1.007805,1) as milage, 
					DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR) as devicetime
				FROM 	positions p 
				WHERE 	1=1						
				ORDER BY devicetime DESC				
				LIMIT 1
			";
			#echo "<br><br>$comando_sql";
			$datas              =$objeto->__EXECUTE($comando_sql);	
			#https://www.facebook.com/foro.militar.esp/videos/vb.993885607353760/1039612849447702/?type=2&theater
		
			if(count($datas)>0) 
			{
				foreach($datas as $data)
				{    
					$comando_sql        ="
						select 					
							CASE 
								WHEN DATE_SUB(sysdate(),INTERVAL 25 MINUTE)>DATE_SUB(p.devicetime,INTERVAL 5 HOUR) 	THEN 'deviceOffline'
				                else                  e.type
							END
				            as cve_evento								
						from 
							positions p join
							events e  on 
								e.deviceid=p.deviceid 
						where e.deviceid={$data_device["d_id"]}	       
						ORDER BY e.id DESC
						LIMIT 1
					";
					$comando_sql        ="
						select 	
							e.type         as type								
						from 
							positions p join
							events e  on 
								e.deviceid=p.deviceid 
						where e.deviceid={$data_device["d_id"]}	       
						ORDER BY e.id DESC
						LIMIT 1
					";

					$datas_event     =$objeto->__EXECUTE($comando_sql);	
		
					#$objeto->__PRINT_R($data);
					if(!isset($datas_event[0]["type"]))		$datas_event[0]["type"]		="";
					if(!isset($data["milage"]))		$data["milage"]		="undefined";
					if(!isset($data["batery"]))		$data["batery"]		="";
					if(!isset($data["address"]))	$data["address"]	="";
					if(!isset($data["course"]))		$data["course"]		="1";
					if(!isset($data["speed"]))		$data["speed"]		="undefined";
					if(!isset($data["altitude"]))	$data["altitude"]	="0";
					if(!isset($data["nivel"]))		$data["nivel"]		="100";
					if(!isset($data_device["d_name"]))		$data_device["d_name"]		="";
	
					if(@$_SESSION["module"]["name"]=="map/")
					{
						$data["estatus"]=1;
					}

			
					$txt_streetview="";
					#if($_SESSION["module"]["sys_section"]=="streetmap")
					{
						$txt_streetview="if(device_active=={$data["deviceid"]}) execute_streetMap(v);";
					}			
			
					#$objeto->__PRINT_R($data["p_attributes"]);
			
					if($data["p_attributes"]!="")			
						$ot="ot:{$data["p_attributes"]}";
					else	
						$ot="ot:\"\"";
			
					$ajax.="
				   		////////				        
						var v 	={st:\"{$data_device["estatus"]}\",dn:\"{$data_device["d_name"]}\",ty:\"{$datas_event[0]["type"]}\",na:\"{$data_device["name"]}\",de:\"{$data["deviceid"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["devicetime"]}\", ad:\"{$data["address"]}\", im:\"{$data_device["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", $ot, ni:\"{$data_device["nivel"]}\"};
						locationsMap(v);				
						$txt_streetview
					";
				}
			}	
		}
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
		$ajax_positions="";
	}	
?>
