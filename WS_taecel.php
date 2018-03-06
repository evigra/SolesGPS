<?php
	$usuarios_sesion	="EXECUTE_CRONS";
	$usuarios_sesion	="PHPSESSID";
	
	
	session_name($usuarios_sesion);
	session_start();
	session_cache_limiter('nocache,private');	
	#if(!isset($_SESSION))
	require_once("nucleo/sesion.php");	

	$objeto				=new devices();	
	$objeto->cron_saldo();
	
?>
