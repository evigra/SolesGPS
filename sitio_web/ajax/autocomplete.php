<?php
	require_once("../../nucleo/sesion.php");
	$datas=array();
	$eval="
		$"."objeto		=new {$_REQUEST["class_name"]}();		
		$"."datas		=$"."objeto->{$_REQUEST["procedure"]}();
	";		
	eval($eval);
	
	$datas			=$datas["data"];
	
	foreach($datas as $index => $data)
	{
		$datas[$index]["label"]			=$data[$_REQUEST["class_field_l"]];
		$datas[$index]["clave"]			=$data[$_REQUEST["class_field_m"]];
	}
	$datas[]=array(
		"label"		=>"Crear registro",
		"clave"		=>""
	);
	echo json_encode($datas);
?>
