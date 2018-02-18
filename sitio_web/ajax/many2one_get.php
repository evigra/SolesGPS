<?php	
	$objeto_json									=json_decode($_REQUEST["many2one_json"], true);	
	unset($_REQUEST["many2one_json"]);
		
	require_once("../../nucleo/sesion.php");
	$class_one										=$objeto_json["class_one"];
	$class_one_id									=@$objeto_json["class_one_id"];
	$class_field									=$objeto_json["class_field"];
	$class_field_id									=$objeto_json["class_field_id"];
	
	$row											=@$objeto_json["row"];
	
	$obj											=$objeto_json;			
	
	$eval="
		$"."objeto									=new {$class_one}();				
	";		
	eval($eval);	
	
	$objeto->__SESSION();	
		
	$valor											=$objeto->sys_fields[$class_field];
	
	if(!isset($valor["class_template"]))			$valor["class_template"]="many2one_standar";					

	$js												="";
	$row 											=$_SESSION["SAVE"][$objeto->sys_object][$class_field]["data"][$class_field_id];
	$_SESSION["SAVE"][$objeto->sys_object][$class_field]["active_id"]			=$class_field_id;
	
	#$objeto->__PRINT_R($row);
	
	foreach($row as $field=>$value)
	{
		$js.="$(\"#$field".".$class_field\").val(\"$value\");
		";
	}
	
	echo "
		<script>
			$js
		</script>
	";
?>