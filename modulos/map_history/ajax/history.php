<?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../../../modulos/position/modelo.php");
	require_once("../modelo.php");
		
	$objeto				=new map_history();
		
	$option				=array();
	$option["select"]=array( 
		"p.*",
		"d.*",
		"DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)"	=>"date",
		"truncate((extract_JSON(p.attributes,'totalDistance') + d.odometro_inicial)/1000 ,1)"	=>"milage",
		"p.attributes"	=>"p_attributes",		
	);	

	if(isset($_POST["start"]))	$option["where"][]	="DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)>'{$_POST["start"]} 00:00:01'";
	if(isset($_POST["end"]))	$option["where"][]	="DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)<'{$_POST["end"]} 23:59:59'";

	$option["where"][]	="d.id={$_POST["device_active"]}";
	$option["limit"]	="100000";
	$option["order"]	="p.devicetime DESC";


	#$option["echo"]		="POSITION";			
	$datas				=$objeto->position($option);

	$ajax="";
    foreach($datas["data"] as $data)
    {    
    	if(!isset($data["milage"]))		$data["milage"]	="undefined";
    	if(!isset($data["batery"]))		$data["batery"]	="";
    	if(!isset($data["address"]))	$data["address"]="";
    	if(!isset($data["course"]))		$data["course"]	="1";
    	if(!isset($data["speed"]))		$data["speed"]	="undefined";
    	
    	if(!isset($data["estatus"]))	$data["estatus"]="";
    	if(!isset($data["nivel"]))		$data["nivel"]="";

    	
    	$txt_streetview="";
		
		if($data["p_attributes"]!="")			
			$ot="ot:{$data["p_attributes"]}";
		else	
			$ot="ot:\"\"";
		
	    $ajax.="
	   		////////				        
			var v 	={se:\"historyMap\", na:\"{$data["name"]}\",de:\"{$data["deviceid"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["date"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", al:\"{$data["altitude"]}\", $ot, st:\"{$data["estatus"]}\",  ni:\"{$data["nivel"]}\"};
			locationsMap(v);				
		";        
    }
    if($ajax=="") $ajax="
    	$(\"div#tablero\").html(\"No se encontraron datos\");
    	$(\"div#tablero2\").html(\"\");
    ";
    else
		$ajax.="historyMap=\"historyMap\";";
	    
    echo "
    	<script>
            if (typeof del_locations == 'function') {
                del_locations();
            }		
            butons_simulation();
            if (typeof fn_localizaciones == 'function') 
            {
                $ajax
            }             
        </script>
    ";
?>
