    <?php
    require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");

	$objeto				=new position();
	
    //$comando_sql = "CALL PR_STOP('{$_POST["date"]}','{$_GET["device_active"]}');"; 
    $comando_sql = "CALL PR_STOP_PLUS('{$_POST["fIni"]}','{$_POST["fFin"]}','{$_GET["device_active"]}','{$_POST["tStop"]}');"; 

    $datas              =$objeto->__EXECUTE($comando_sql, "");       

	 $ajax="";
    foreach($datas as $data)
    {    
    	if(!isset($data["FECHA"]))		           $data["FECHA"]                  ="";
    	if(!isset($data["HORA_INICIAL"]))          $data["HORA_INICIAL"]           ="";
    	if(!isset($data["HORA_FINAL"]))	           $data["HORA_FINAL"]             ="";
    	if(!isset($data["STOP_DURATION"]))         $data["STOP_DURATION"]          ="";
    	if(!isset($data["HORA_INICIAL_DEVICE"]))   $data["HORA_INICIAL_DEVICE"]    ="";
        if(!isset($data["HORA_FINAL_DEVICE"]))     $data["HORA_FINAL_DEVICE"]      ="";
    	if(!isset($data["VELOCIDAD"]))             $data["VELOCIDAD"]              ="";
        if(!isset($data["LATITUD"]))               $data["LATITUD"]                ="";
        if(!isset($data["LONGITUD"]))              $data["LONGITUD"]               ="";
        if(!isset($data["NUMERO_REGISTROS"]))      $data["NUMERO_REGISTROS"]       ="";


    	$txt_streetview="";
    	if($_SESSION["module"]["sys_section"]=="historyStreet")
    	{
    		$txt_streetview="if(device_active=={$data["deviceId"]}) execute_streetMap(v); ";
    	}	
	
        $ajax.="			        
	        var v 	=
            {
                se:\"historyMap\",
                de:\"{$_GET["device_active"]}\",
                la:\"{$data["LATITUD"]}\",
                lo:\"{$data["LONGITUD"]}\",
                ti:\"{$data["STOP_DURATION"]}\",
                hi:\"{$data["HORA_INICIAL"]}\",
                hf:\"{$data["HORA_FINAL"]}\",
                im:\"stop\"
            }; 
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
