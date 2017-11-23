<?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
    require_once("../../../modulos/position/modelo.php");
	require_once("../modelo.php");

	$objeto				=new map_speed();
	
	if($_POST["device_active"]>0)
		$option["where"][]	="deviceid = {$_POST["device_active"]}";

	$option["where"][]	="DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)>='{$_POST["start"]} 00:00:01'";
	$option["where"][]	="DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)<='{$_POST["end"]} 23:59:59'";
	$option["where"][]	="1.852* speed >={$_POST["tiempo"]}";

	
	$option["select"]	=array("deviceid","DATE_SUB(p.devicetime,INTERVAL {$_SESSION["user"]["huso_h"]} HOUR)"=>"devicetime","image","course");
	$option["limit"]	="1000";
	
	$option["echo"]		="POSITION";
	

	#if(!isset($option["having"]))	
	#	$option["having"]	=array("time > TIME(SEC_TO_TIME({$_POST["tiempo"]}*60))");	
		
	$data_position		=$objeto->speed_position($option);			
    $datas              =$data_position["data"];
    
    #$objeto->__PRINT_R($datas);
	$ajax="";
    foreach($datas as $data)
    {    
    	if(!isset($data["date"]))				$data["date"]				="";
    	if(!isset($data["time"]))				$data["time"]				="";
    	if(!isset($data["start"]))				$data["start"]				="";
        if(!isset($data["end"]))				$data["end"]				="";
    	if(!isset($data["speed"]))				$data["speed"]				="";
        if(!isset($data["longitud"]))			$data["longitud"]			="";
        if(!isset($data["latitud"]))			$data["latitud"]			="";
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
                sp:\"{$data["speed"]}\",
				im:\"{$data["image"]}\",								
				na:\"{$data["name"]}\",
				co:{$data["course"]}, 				
				ad:\"{$data["address"]}\"
			};
              
            locationsMap(v);
			$txt_streetview			
        ";
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
  
				var html_load=\"Datos cargados\";
				$(\"div#tablero\").html(html_load);
            }            
        </script>
    ";	
?>
