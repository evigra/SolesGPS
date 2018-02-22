<?php
    require_once("../../../nucleo/sesion.php");
#	require_once("../modelo.php");
	if(isset($_GET["term"]) AND $_GET["term"]!="")
	{
		$objeto				=new item();	
		$option				=array();
		
		$option["where"]=	array("nombre LIKE '%{$_GET["term"]}%'");
		
		$data				=$objeto->__BROWSE($option);

		$data_json=array();
		
		if(count($data["data"])>0)
		{
			foreach($data["data"] as $index=>$row)
			{
				$data["data"][$index]["label"]=$row["nombre"];
				$data["data"][$index]["clave"]=$row["id"];
			}
			$data_json=$data["data"];
			
		}
		else
		{
			$data_json[]=array(
				'label'     => "Sin resultados para \"{$_GET["term"]}\"",
				'clave'		=> ""	
			);				
		}		
		echo json_encode($data_json);
	}
?>
