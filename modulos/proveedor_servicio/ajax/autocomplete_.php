<?php
	require_once("../../../nucleo/sesion.php");
	require_once("../../../nucleo/general.php");
	
	$objeto				=new general();		
	
	$retun=array();
	$comando_sql        ="
        select 
            *
        from 
            servicios s inner join proveedor_servicio ps on s.id_servicio=ps.id_servicio inner join proveedores  p on ps.id_proveedor
        where  s.id_servicio= {$_GET["term"]} 
			
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
				'label'     => "Proveedor ".$row["Nombre"]."    precio $".$row["precio"],
				'clave'		=> $row["id_detalle_servicio_proveedor"]	
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
