<?php
	require_once("MySQL.php");
	//echo "entro aca";
	$e="holi";
	$Q= new MySQL();

	//$opcion=$_POST['data'];
	//$op=$opcion["opciones"];


$t=	$Q->query_assoc("select * from device");
//echo $e;
//	print_r($t);
	echo json_encode($t);

?>