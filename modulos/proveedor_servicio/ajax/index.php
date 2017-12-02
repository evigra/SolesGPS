<?php
    require_once("../../../nucleo/general.php");
	require_once("../modelo.php");

	$objeto				=new servicios();	
	$option				=array();
	
	$option["where"]=	array("nombre LIKE '%{$_GET["term"]}%'");
	
	$data				=$objeto->__BROWSE($option);

	$data_json=array();
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
		$data_json[]=array(
			'id_servicio'     => "Sin resultados para \"{$_GET["term"]}\"",
			'id'		=> ""	
		);				
	}		
	echo json_encode($data_json);
?>
