<?php
	require_once("../../../nucleo/sesion.php");	
	$option				=array();	
	$option["name"]		="p_txt";	
	
	$objeto				=new travels($option);	
	$datas				=$objeto->__VIAJE_HOY();
	
	$objeto->__PRINT_R($datas);
	
	
?>
