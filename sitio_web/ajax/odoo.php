<?php
    require_once("../../nucleo/sesion.php");
    
	$objeto				=new position();

	$option             =array();
	$option["select"]   ="p.*";
	$option["where"]    =array();
	$option["where"][]  ="leido=0";
	$option["order"]    ="devicetime";
	#$option["echo"]     ="ODOO";
	
	

	$data               =$objeto->__BROWSE($option);
	
    echo json_encode($data["data"]);
?>
