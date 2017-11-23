<?php
    require_once("../../../nucleo/sesion.php");

	$objeto				=new position();
	$comando_sql        ="
		select 
			d.*,p.*
		from 
			positions p join 
			devices d on p.deviceid=d.id
		where 	md5(p.id)='{$_GET["a"]}'
	";

	$datas              =$objeto->__EXECUTE($comando_sql, "AJAX POSITION");	

	$ajax="";
	if(count($datas)>0) 
	{
		foreach($datas as $data)
		{    
			#$objeto->__PRINT_R($data);
			if(!isset($data["milage"]))		$data["milage"]		="undefined";
			if(!isset($data["batery"]))		$data["batery"]		="";
			if(!isset($data["address"]))	$data["address"]	="";
			if(!isset($data["course"]))		$data["course"]		="1";
			if(!isset($data["speed"]))		$data["speed"]		="undefined";
			if(!isset($data["altitude"]))	$data["altitude"]	="0";
			
		    $ajax.="
		    	var device_active={$data["deviceid"]};
				var v 	={st:\"{$data["estatus"]}\",na:\"{$data["name"]}\",de:\"{$data["deviceid"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["servertime"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", ot:{$data["attributes"]}};
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
            if (typeof fn_localizaciones == 'function') 
            {
                $ajax
                $ajax_positions
            }            
        </script>
    ";
?>
