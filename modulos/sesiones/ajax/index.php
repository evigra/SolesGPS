<?php
	require_once("../../../nucleo/sesion.php");
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");
	#require_once("../../compamodelo.php");

	$objeto				=new sesion(array("temporal"=>"AUX_DEVICE"));
	$objeto->__UPDATE();
?>
