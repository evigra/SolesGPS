    <?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");

	$objeto				=new position();
	
	$option				=array();
	#$option["echo"]	="AJAX POSITIONS";
	$option["select"]=array( 
		"p.*",
		"d.*",
		"serverTime"							=>"date",
	);	
	$option["where"][]	="serverTime>'{$_POST["date"]} 00:00:01'";
	$option["where"][]	="serverTime<'{$_POST["date"]} 23:59:59'";
	$option["where"][]	="d.id={$_GET["device_active"]}";
	$option["limit"]	="10000";
	
	$datas				=$objeto->position($option);

	 $ajax="";
    foreach($datas["data"] as $data)
    {    
    	if(!isset($data["milage"]))		$data["milage"]	="undefined";
    	if(!isset($data["batery"]))		$data["batery"]	="";
    	if(!isset($data["address"]))	$data["address"]="";
    	if(!isset($data["course"]))		$data["course"]	="1";
    	if(!isset($data["speed"]))		$data["speed"]	="undefined";
    	
    	
    	$txt_streetview="";
    	if($_SESSION["module"]["sys_section"]=="historyStreet")
    	{
    		$txt_streetview="if(device_active=={$data["deviceId"]}) execute_streetMap(v);";
    	}	
		/*
	        var v 	={section:\"historyMap\", name:\"{$data["name"]}\",deviceId:\"{$data["deviceId"]}\",latitude:\"{$data["latitude"]}\",longitude:\"{$data["longitude"]}\", course:{$data["course"]}, milage:\"{$data["milage"]}\", speed:\"{$data["speed"]}\", batery:\"{$data["batery"]}\", times:\"{$data["serverTime"]}\", address:\"{$data["address"]}\", image:\"{$data["image"]}\", other:{$data["other"]}};
	        var position	=locationsMap(v);
	        ------------------
	        var v 	={se:\"historyMap\", na:\"{$data["name"]}\",de:\"{$data["deviceId"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["serverTime"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ot:{$data["other"]}};
	        var position	=locationsMap(v);
    	*/
    	#if(!$data[""]))		$data[""]="";
        $ajax.="
       		////////				        
	        var v 	={se:\"historyMap\", na:\"{$data["name"]}\",de:\"{$data["deviceId"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["serverTime"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", ot:{$data["other"]}};
	        locationsMap(v);
			$txt_streetview			
        ";
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
