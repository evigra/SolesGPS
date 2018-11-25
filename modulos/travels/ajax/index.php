<?php
	require_once("../../../nucleo/sesion.php");	
	$option				=array();	
	$option["name"]		="p_txt";	
	
	$objeto				=new personal_txt($option);	
	#$objeto->__PRINT_R($option);
	#$objeto->__PRINT_R($objeto);

	
	$option["actions"]	="false";
	$option["where"]	=array("trabajador_clave='{$_GET["matricula"]}'","dias LIKE '%/". date("n")."/%'");
				
	$data										= $objeto->__REPORT_SUSTITUTO($option);
	
	echo $data["html"];
	
?>
