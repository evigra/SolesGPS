<?php
	require_once("../../nucleo/sesion.php");
	#require_once("../../../nucleo/general.php");
	
	$eval="
		$"."objeto=new {$_REQUEST["class"]}();		
	";	
	eval($eval);
	
	$data_json=array();
	foreach($objeto->sys_fields as $field => $data_field)
	{
		#$objeto->__PRINT_R($data_field["title"]);
		
		if(@$data_field["title_filter"]!="")
			$data_json[]=array("field"=>"$field", "title"=>"{$data_field["title_filter"]}", "term"=>"{$_REQUEST["term"]}", "value"=>"$field LIKE '{$_REQUEST["term"]}'");
	}
	echo json_encode($data_json);
	
	

	
	#$objeto->__PRINT_R($objeto->sys_fields);

	#echo json_encode($objeto->sys_fields);
?>
