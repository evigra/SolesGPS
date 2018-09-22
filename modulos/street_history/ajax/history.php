<?php
    require_once("../../../nucleo/sesion.php");
#    require_once("../../../nucleo/general.php");
#	require_once("../../../modulos/position/modelo.php");
#	require_once("../modelo.php");
		
	$objeto				=new street_history();
		
	$option				=array();
	#$option["echo"]	="AJAX POSITIONS";
	$option["select"]=array( 
		"p.*",
		"d.*",
		"TIME(DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR))"	=>"date",
	);	
	if(isset($_POST["start"]))	$option["where"][]	="DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)>'{$_POST["start"]}'";
	if(isset($_POST["end"]))	$option["where"][]	="DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)<'{$_POST["end"]}'";
	$option["where"][]	="d.id={$_POST["device_active"]}";
	$option["limit"]	="100000";
	$option["order"]	="p.devicetime DESC";
 	 		
	$datas				=$objeto->position($option);

	#$objeto->__PRINT_R($datas);
	
	$ajax="";
    foreach($datas["data"] as $data)
    {    
    	if(!isset($data["milage"]))		$data["milage"]	="undefined";
    	if(!isset($data["batery"]))		$data["batery"]	="";
    	if(!isset($data["address"]))	$data["address"]="";
    	if(!isset($data["course"]))		$data["course"]	="1";
    	if(!isset($data["speed"]))		$data["speed"]	="undefined";
    	
    	
		
    	$txt_streetview="if(device_active=={$data["deviceid"]}) execute_streetMap(v);";
    	$txt_streetview="";
        $ajax.="
       		////////				        
	        var v 	={se:\"historyMap\", na:\"{$data["name"]}\",de:\"{$data["deviceid"]}\",la:\"{$data["latitude"]}\",lo:\"{$data["longitude"]}\", co:{$data["course"]}, mi:\"{$data["milage"]}\", sp:\"{$data["speed"]}\", ba:\"{$data["batery"]}\", ti:\"{$data["date"]}\", ad:\"{$data["address"]}\", im:\"{$data["image"]}\", ev:\"{$data["event"]}\", ge:\"{$data["geofence"]}\", ot:{$data["attributes"]}};
	        locationsMap(v);
	        $txt_streetview
        ";
    }
    if($ajax=="") $ajax="
    	$(\"div#tablero\").html(\"No se encontraron datos\");
    	$(\"div#tablero2\").html(\"\");
    ";    
    else
    	$ajax.="historyMap=\"historyStreet\";";
    	
    echo "
    	<script>
            if (typeof del_locations == 'function') 
            {
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
