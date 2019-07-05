<?php
	class map extends position
	{   
		public function __CONSTRUCT()
		{
			$this->sys_table="positions";
			$this->sys_module="map";
			parent::__CONSTRUCT();
		}	
		public function menu_vehicle()
    	{
    		if(isset($_SESSION["company"]["id"]))	
    		{
				$comando_sql        ="
					select
						distinct(d.id) as d_id, 
						d.*
					from 	
						devices d,
						user_group ug,
						groups g
					where 
						ug.menu_id=2
						AND(		
							(
								responsable_fisico_id={$_SESSION["user"]["id"]}		
								AND user_id=responsable_fisico_id
								AND ug.active=g.id
							)        
							OR
							(
								ug.user_id={$_SESSION["user"]["id"]}		
								AND ug.active=g.id
								AND g.nivel<40
							)
						) 			
	
				";	
				#echo $comando_sql;
				$option_conf=array();
	

				$option_conf["open"]	=1;
				$option_conf["close"]	=1;			
				$data =$this->__EXECUTE($comando_sql,$option_conf);	
				
				foreach($data as $vehicle)
				{
					if($vehicle["image"]=="")	$vehicle["image"]="01";
				
			    	@$html.="
				        <table class=\"select_devices\" device=\"{$vehicle["id"]}\" lat=\"\" lon=\"\" width=\"100%\" height=\"40\" border=\"0\">
			        		<tr>
				        		<td rowspan=\"2\"  width=\"50\" align=\"center\">
			        				<img height=\"25\" src=\"../sitio_web/img/car/vehiculo_{$vehicle["image"]}/i135.png\">
			        			</td>
			        			<td valign=\"bottom\">{$vehicle["name"]}</td>
			        			<td width=\"25\" rowspan=\"2\" class=\"event_device\"> - </td>
			        		</tr>
			        		<tr><td  valign=\"top\"><b>{$vehicle["placas"]}</b></td></tr>		        	
			        	</table>
			    	";			
				}
		    	$html="
			    	<font style=\"padding-left:5px; color:SteelBlue; font-size:13; font-weight:bold;\"> Dispositivos </font>
		        	<table class=\"select_devices\" device=\"0\" width=\"100%\" height=\"30\" border=\"0\">
			        	<tr>
		        			<td width=\"60\" align=\"center\">
			        			
		        			</td>
		        			<td valign=\"center\"><b>VER TODOS</b></td>
		        		</tr>			        	
		        	</table>		    
		        	<div id=\"devices_all\" style=\"overflow:auto;\">
			        	$html
		    		</div>
		    	";			
		    }
		    else	
			{
				$html="";
			}
			return $html;

		}		
	}
?>
