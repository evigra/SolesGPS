
<?php 
class distancia_corte extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_fields		=array(
				"id_distancia_corte"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),		
			"id_device"	    	=>array(
			    "title"             => "Numero dispositivo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),
			"fecha_corte"	    	=>array(
			    "title"             => "Fecha ",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"distancia_total_corte_del_dia"	    	=>array(
			    "title"             => "Distancia total del corte del dia",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"distancia_del_dia"	    	=>array(
			    "title"             => "Distancia del dia ",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

			"status"	    	=>array(
			    "title"             => "status",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),

		);




	public	function cron_corte_dia(){

	$option= array();
	$option["select"]="id_dispositivo,fecha_Activo";
	$option["where"]=1;
    $datos=$this->__BROWSE($option);
    //execute


	$query="SELECT id_dispositivo,fecha_Activo FROM corte_activo Where estatus=1";
	}

	public function cron_distance_()
    	{			    
    	echo "AQUIIIIIIIIIII";
			$comando_sql="
				insert into Distancia_corte (id_device,fecha_corte,distancia_total_corte_del_dia,distancia_del_dia)
				select 	
					d.id as dev_id,    

					left(DATE_SUB(p.devicetime,INTERVAL 6 HOUR),10) as fecha,

					max(truncate((extract_JSON(p.attributes,'totalDistance') + d.odometro_inicial)/1000,1)) as final,

					max(truncate((extract_JSON(p.attributes,'totalDistance') + d.odometro_inicial)/1000,1)) -
					min(truncate((extract_JSON(p.attributes,'totalDistance') + d.odometro_inicial)/1000,1)) as distance
					
					
					
					
				from 
					positions p join 
					devices d on p.deviceId=d.id 
				where 	1=1				
					and extract_JSON(p.attributes,'totalDistance') > 0    
					and left(DATE_SUB(p.devicetime,INTERVAL 6 HOUR),10) > left(DATE_SUB(now(),INTERVAL 2 day),10)
					and left(DATE_SUB(now(),INTERVAL 1 day),10) = left(DATE_SUB(p.devicetime,INTERVAL 6 HOUR),10)
				group by dev_id, left(DATE_SUB(p.devicetime,INTERVAL 6 HOUR),10)
				having distance>0			
			";
			$position_data 		=$this->__EXECUTE($comando_sql);
		}


}

 ?> 
