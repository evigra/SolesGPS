<?php	
	if(!isset($_SESSION))
	{
		$usuarios_sesion						="PHPSESSID";
		session_name($usuarios_sesion);
		session_start();
		session_cache_limiter('nocache,private');	
		/*
		if(count($_COOKIE) > 0 AND isset($_COOKIE["solesgps"])) 
		{
			$_SESSION=$_COOKIE["solesgps"];
		} 
		*/		
	}
	if(isset($_SESSION))
	{
		if(@$_GET["sys_action"]=="cerrar_sesion")
		{
			session_destroy();
			$destino= $_SESSION["company"]["sistema_web"];	
			Header ("Location: $destino");			
		}	
	}	
	
	if(@file_exists("nucleo/general.php"))				require_once("nucleo/general.php");		
	if(@file_exists("../nucleo/general.php")) 			require_once("../nucleo/general.php");
	if(@file_exists("../../nucleo/general.php"))		require_once("../../nucleo/general.php");
	if(@file_exists("../../../nucleo/general.php")) 	require_once("../../../nucleo/general.php");
	if(@file_exists("../../../../nucleo/general.php")) 	require_once("../../../../nucleo/general.php");

    $objeto	=new general(array("temporal"=>"SESION"));
    
	$comando_sql="
		SELECT * 
		FROM modulos
	";		
	$modulos 		=$objeto->__EXECUTE($comando_sql);    
	
	foreach($modulos as $modulo)
	{
		if(file_exists("modulos/{$modulo["clase"]}/modelo.php")) 				require_once("modulos/{$modulo["clase"]}/modelo.php");
		if(file_exists("../modulos/{$modulo["clase"]}/modelo.php")) 			require_once("../modulos/{$modulo["clase"]}/modelo.php");
		if(file_exists("../../modulos/{$modulo["clase"]}/modelo.php")) 			require_once("../../modulos/{$modulo["clase"]}/modelo.php");
		if(file_exists("../../../modulos/{$modulo["clase"]}/modelo.php")) 		require_once("../../../modulos/{$modulo["clase"]}/modelo.php");
		#if(file_exists("../../../../modulos/{$modulo["clase"]}/modelo.php")) 	require_once("../../../../modulos/{$modulo["clase"]}/modelo.php");
	}

?>	
