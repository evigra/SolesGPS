<?php
	require_once("../../../nucleo/sesion.php");
	/*	
	$objeto					=new users(array("temporal"=>"AUX_USERS"));
	$option					=array("where"=>array());
	
	$option["where"][]		="name LIKE '%{$_GET["term"]}%'";
	$option["where"][]		="company_id={$_SESSION["company"]["id"]}";
	
	$data					=$objeto->__BROWSE($option);	

	$data_json=array();
	if(count($data["data"])>0)
	{
		foreach($data["data"] as $row)
		{
			$data_json[]=array(
				'label'     => $row["name"],
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
	#/*		
	$objeto				=new general(array("temporal"=>"AUX_DEVICE"));
	
	
	$retun=array();
	$comando_sql        ="
        select 
            u.*
        from 
            users u 
        where  1=1
			AND name LIKE '%{$_GET["term"]}%'
			AND u.company_id={$_SESSION["company"]["id"]} 
			#OR u.id={$_SESSION["user"]["id"]}		
	";	

	$data =$objeto->__EXECUTE($comando_sql, "DEVICE MODELO");	

	$data_json=array();
	if(count($data)>0)
	{
		foreach($data as $row)
		{
			$data_json[]=array(
				'label'     => $row["name"],
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
	#*/
?>
