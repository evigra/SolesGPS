<?php
    require_once("../../../nucleo/sesion.php");
	$objeto				=new seguimientos_stop();
	
		$option["where"][]	="deviceid = {$_SESSION["seguimiento_id"]}";



	#$option["where"][]	="DATE_SUB(devicetime,INTERVAL 5 HOUR)>=DATE_SUB(devicetime,INTERVAL 17 HOUR)";
	#$option["where"][]	="DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)<='{$_POST["end"]} 23:59:59'";

	
	$option["select"]	=array(
		"deviceid",
		"DATE_SUB(devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)" => "devicetime",
		"image",
		"course",
		"placas"
	);
	$option["limit"]	="10";
	
	#$option["echo"]		="POSITION";
	

	#if(!isset($option["having"]))	
	{
		if(!isset($_POST["tiempo"]))	$_POST["tiempo"]=5;
		$option["having"]	=array("time > TIME(SEC_TO_TIME({$_POST["tiempo"]}*60))");	
	}	
	$data_position		=$objeto->time_position($option);			
    $datas              =$data_position["data"];
    
    #$objeto->__PRINT_R($datas);
	$ajax="";
    foreach($datas as $data)
    {    
    	if(!isset($data["date"]))				$data["date"]				="";
    	if(!isset($data["time"]))				$data["time"]				="";
    	if(!isset($data["start"]))				$data["start"]				="";
        if(!isset($data["end"]))				$data["end"]				="";
    	#if(!isset($data["speed"]))				$data["speed"]				="";
        if(!isset($data["longitud"]))			$data["longitud"]			="";
        if(!isset($data["latitud"]))			$data["latitud"]			="";
        if(!isset($data["placas"]))				$data["placas"]				="";
        if(!isset($data["NUMERO_REGISTROS"]))	$data["NUMERO_REGISTROS"]	="";

    	$txt_streetview="";
    	if($_SESSION["module"]["sys_section"]=="historyStreet")
    	{
    		$txt_streetview="if(device_active=={$data["deviceId"]}) execute_streetMap(v); ";
    	}	

        $ajax.="			        
			var v 	=
			{
				se:\"historyMap\",
				de:\"{$data["deviceid"]}\",
				da:\"{$data["date"]}\",
				la:\"{$data["latitude"]}\",
				lo:\"{$data["longitude"]}\", 
				ti:\"{$data["time"]}\", 
                hi:\"{$data["start"]}\",
                hf:\"{$data["end"]}\",
				im:\"{$data["image"]}\",								
				na:\"{$data["name"]}\",
				co:{$data["course"]}, 				
				pl:\"{$data["placas"]}\", 				
				ad:\"{$data["address"]}\"
			};
              
            locationsMap(v);
			$txt_streetview			
        ";
    }
    $ajax_positions="";
    #if(@$_POST["repetir"]=="si")		$ajax_positions="ajax_positions_time();";
    
    echo "
    	<script>
            if (typeof del_locations == 'function') {
                del_locations();
            }		
            if (typeof fn_localizaciones == 'function') {
                $ajax
                $ajax_positions
  
				var html_load=\"Datos cargados\";
				$(\"div#tablero\").html(html_load);
            }            
        </script>
    ";	
?>
