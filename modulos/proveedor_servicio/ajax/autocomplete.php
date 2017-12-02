<?php
	require_once("../../../nucleo/sesion.php");
	require_once("../../../nucleo/general.php");
	
	$objeto				=new servicios();
	
	$option				=array("where"=>array());
	
	$option["where"][]	="nombre LIKE '%{$_GET["term"]}%'";
	$data				=$objeto->__BROWSE($option);
	
	#echo $objeto->sys_sql;

	if(count($data["data"])>0)
	{
		foreach($data["data"] as $row)
		{
			$data_json[]=array(
				'id_servicio'     => $row["nombre"],
				'id'		=> $row["id_servicio"]
			);			
		}
	}
	else
	{
		if(@$_GET["term"]!="")	$busqueda=@$_GET["term"];
		else					$busqueda=@$_GET["id_servicio"];
	
		$data_json[]=array(
			'id_servicio'     => "Sin resultados para ". $busqueda,
			'id'		=> ""	
		);				
	}		
	echo json_encode($data_json);

?>

