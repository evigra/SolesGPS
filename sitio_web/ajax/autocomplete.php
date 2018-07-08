<?php
	require_once("../../nucleo/sesion.php");
	
	if(isset($_REQUEST["autocomplete"]))
	{
		$autocomplete									=json_decode($_REQUEST["autocomplete"], true);	
		unset($_REQUEST["autocomplete"]);

		$class_name										=@$autocomplete["class_name"];		
		$class_field_l									=@$autocomplete["class_field_l"];	
		$class_field_m									=@$autocomplete["class_field_m"];		
	}
	else
	{
		$class_name										=@$_REQUEST["class_name"];		
		$class_field_l									=@$_REQUEST["class_field_l"];	
		$class_field_m									=@$_REQUEST["class_field_m"];		
		$procedure										=@$_REQUEST["procedure"];
	}	

	$eval="
		$"."objeto		=new {$class_name}();		
	";		
	if(isset($procedure))
	{
		$datas										=array();
		$eval.="
			$"."datas		=$"."objeto->{$procedure}();
		";		
		eval($eval);
		$datas			=$datas["data"];
		
		foreach($datas as $index => $data)
		{
			$datas[$index]["label"]			=$data[$class_field_l];
			$datas[$index]["clave"]			=$data[$class_field_m];
		}
		$datas[]=array(
			"label"		=>"Crear registro",
			"clave"		=>"create"
		);
		echo json_encode($datas);
	}
	else
	{
		$eval.="																
			$"."view_auto_create  			=$"."objeto->__VIEW_CREATE($"."objeto->sys_module . \"html/create\");	
			$"."objeto->words				=$"."objeto->__INPUT(array(),$"."objeto->sys_fields);
			
			echo $"."objeto->__REPLACE($"."view_auto_create,$"."objeto->words);
		";		
		eval($eval);
	}
?>
