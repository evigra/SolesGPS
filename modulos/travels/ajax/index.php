<?php
	require_once("../../../nucleo/sesion.php");	
	$option				=array();	

	$item_obj				=new item($option);	

	
	$objeto				=new travels($option);	
	$travels_datas		=$objeto->__VIAJE_HOY();
	
	$js="
		var origen;
		var destino;
		var waypts=new Array();
	";
	foreach($travels_datas["data"] as $OV)
	{
		foreach($OV["movimientos_ids"] as $items)
		{
			$item_datas=$item_obj->__BROWSE($items["item_id"]);
			foreach($item_datas["data"] as $travel)
			{
				$puntos_array = explode("|", $travel["long1"]);
				$total=count($puntos_array);
				foreach($puntos_array as $index=>$punto)
				{				
					$coord = explode(",",$punto);
					if($index==0)
					{					
						$js.="origen=LatLng({latitude:{$coord[1]},longitude:{$coord[0]}});";
					}
					else if($index==$total-2)
					{
						$js.="destino=LatLng({latitude:{$coord[1]},longitude:{$coord[0]}});";
					}
					else if($index==$total-1)
					{
						$js.="tracert(origen,destino,waypts);";
					}
					else
					{
						$js.="
							waypts.push({
								location: LatLng({latitude:{$coord[1]},longitude:{$coord[0]}});,
								stopover: true
							});					
						
						";
					}
				}				
			}			
		}			
	}
	echo "
	<script>
	$js
	</script>
	";	
?>
