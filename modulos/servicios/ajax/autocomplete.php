<?php
	require_once("../../../nucleo/sesion.php");
	require_once("../../../nucleo/general.php");
	
	$objeto				=new general();		
	
	$retun=array();
	$comando_sql        ="
        select 
            s.*
        from 
            servicios s 
        where  1=1
			AND s.nombre LIKE '%{$_GET["term"]}%'
			
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
				'label'     => $row["nombre"],
				'clave'		=> $row["id_servicio"]	
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
?>
