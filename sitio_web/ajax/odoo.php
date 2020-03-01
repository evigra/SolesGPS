<?php
    require_once("../../nucleo/sesion.php");
    
	$objeto				=new position();

	$option             =array();
	$option["select"]   ="d.uniqueid, p.*, d.*, p.id as p_id";
	$option["where"]    =array();
	#$option["where"][]  ="leido=0";
	$option["where"][]  ="odoo!=1";
	$option["order"]    ="devicetime";
	#$option["echo"]     ="ODOO";
	
	$data               =$objeto->__BROWSE($option);
	
	foreach($data["data"] as $row)
	{
        $objeto->sys_private["id"]		=$row["p_id"];
        $data_update["odoo"]		="1";
        
        $option_position			=array();

        #$objeto->__PRINT_R($objeto->sys_private);
        $objeto->__SAVE($data_update,$option_position);	
	}
		
    echo json_encode($data["data"]);
?>
