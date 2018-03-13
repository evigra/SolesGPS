<?php
	require_once("../../../nucleo/sesion.php");
	
	$objeto				=new empresa();
	
	$option				=array("where"=>array());
	#$option["echo"]		="AUTOCOMPLETE EMPRESA";
	$option["where"][]	="nombre LIKE '%{$_GET["term"]}%'";
	$data				=$objeto->__BROWSE($option);
	
	#echo $objeto->sys_sql;

	if(count($data["data"])>0)
	{
		foreach($data["data"] as $row)
		{
			$data_json				=$row;	
			$data_json['label']		=$row["nombre"];
			$data_json['clave']		=$row["id"];
			$data_json['venta']		=$row["cliente"];
			$data_json['compra']	=$row["proveedor"];
		}
	}
	else
	{
		if(@$_GET["term"]!="")	$busqueda=@$_GET["term"];
		else					$busqueda=@$_GET["id"];
	
		$data_json[]=array(
			'label'     => "Sin resultados para ". $busqueda,
			'clave'		=> ""	
		);				
	}		
	echo json_encode($data_json);

?>

