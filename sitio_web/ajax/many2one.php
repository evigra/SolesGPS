<?php		
	$objeto_json									=json_decode($_REQUEST["many2one_json"], true);	
	unset($_REQUEST["many2one_json"]);
		
	require_once("../../nucleo/sesion.php");
	$class_one										=$objeto_json["class_one"];
	#$class_one_id									=$objeto_json["class_one_id"];
	$class_field									=$objeto_json["class_field"];
	$class_field_id									=@$objeto_json["class_field_id"];
	$class_id										=@$objeto_json["class_id"];
	
	$row											=$objeto_json["row"];
	
	$eval="
		$"."objeto									=new {$class_one}();		
	";			
	eval($eval);	
		
	$obj											=$objeto_json;			
	$objeto->__SESSION();		
	
	$valor											=$objeto->sys_fields[$class_field];
	
	if(!isset($valor["class_template"]))			$valor["class_template"]="many2one_standar";					
	
	$option=array(
		"class_id"									=>$class_id,
		"class_one"									=>$class_one,
		"class_one_id"								=>"",
		"class_field"								=>$class_field,		
		"class_field_id"							=>$class_field_id,				
		"class_field_value"							=>$valor,		
		"words"										=>$objeto->words,		
		"view"										=>"report",				
		"json"										=>$objeto_json,
	);											
	$words											=$objeto->__MANY2ONE($option);		
		
	echo $words["$class_field"];
?>