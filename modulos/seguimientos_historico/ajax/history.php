<?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../../../modulos/position/modelo.php");
	require_once("../modelo.php");
		
	$objeto				=new seguimientos_historico();
		
	$option				=array();
	$option["select"]=array( 
		"p.*",
		"d.*",
		"DATE_SUB(p.devicetime,INTERVAL 6 HOUR)"	=>"date",
		"truncate((extract_JSON(p.attributes,'totalDistance') + d.odometro_inicial)/1000 ,1)"	=>"milage",
		"p.attributes"	=>"p_attributes",		
	);	

	$option["where"][]	="d.id={$_SESSION["seguimiento_id"]}";
	$option["limit"]	="1000";
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
    	
		$txt_streetview="if(device_active=={$data["deviceid"]}) execute_streetMap(v);";    	
		
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
    	
    	
    		device_active={$_SESSION["seguimiento_id"]};
            if (typeof del_locations == 'function') {
                del_locations();
            }		
            butons_simulation();
            if (typeof fn_localizaciones == 'function') 
            {
                $ajax
            }             
		    simulation_action=\"play\";
		    del_locations();
		    $(\"div#odometro\").show();
			paint_history(isimulacion, historyMap);
            
        </script>
    ";
?>
