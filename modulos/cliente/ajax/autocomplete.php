<?php
	require_once("../../../nucleo/sesion.php");
	require_once("../../../nucleo/general.php");
	
	$objeto				=new cliente();
	
	$option				=array("where"=>array());
	
	$option["where"][]	="razon_social LIKE '%{$_GET["term"]}%'";
	$data				=$objeto->__BROWSE($option);
	
	#echo $objeto->sys_sql;

	if(count($data["data"])>0)
	{
		foreach($data["data"] as $row)
		{
			$data_json[]=array(
				'label'     => $row["razon_social"],
				'clave'		=> $row["id"]
			);			
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

	/*
	$retun=array();
	$comando_sql        ="
        select 	c.*
        from 	customer c 
        where  1=1
			AND clave LIKE '%{$_GET["term"]}%'
			AND c.company_id={$_SESSION["company"]["id"]} 
	";	
	#echo $comando_sql;
	$data =$objeto->__EXECUTE($comando_sql);	

	#$objeto->__PRINT_R($data);
	$data_json=array();
	if(count($data)>0)
	{
		foreach($data as $row)
		{
			$data_json[]=array(
				'label'     => $row["clave"],
				'clave'		=> $row["id"]
			);			
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
	*/
?>

