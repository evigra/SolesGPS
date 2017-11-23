    <?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");

	$objeto				=new denue();
	#AND p.deviceID=".$objeto->request["deviceId"]."
	$comando_sql        ="
				select 
					empresa as name,
					id as deviceId,
					concat(municipio, ', ',vialidad, ' #' , exterior) as address,
					latitud as latitude,
					longitud as longitude
					
				from 
					denue d
	";
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
			    var v 	={na:\"{$data["name"]}\",de:\"{$data["deviceId"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ad:\"{$data["address"]}\"};
			    locationsMap(v);
				$txt_streetview";
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
