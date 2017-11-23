<?php
    require_once("../../../nucleo/sesion.php");
#	require_once("../modelo.php");

	$objeto				=new item();	
	$option				=array();
	
	$option["where"]=	array("nombre LIKE '%{$_GET["term"]}%'");
	
	$data				=$objeto->__BROWSE($option);

	$data_json=array();
	if(count($data["data"])>0)
	{
		foreach($data["data"] as $row)
		{
			$data_json[]=array(
				'label'     => $row["nombre"],
				'clave'		=> $row["id"]	
			);			
		}
	}
	else
	{
		$data_json[]=array(
			'label'     => "Sin resultados para \"{$_GET["term"]}\"",
			'clave'		=> ""	
		);				
	}		
	echo json_encode($data_json);
?>
