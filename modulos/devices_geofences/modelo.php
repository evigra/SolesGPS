<?php
	class devices_geofences extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $sys_filter		=array(
				"name"=>"d.name",		
		);
		#var $sys_enviroments	="DEVELOPER";
		var $sys_fields		=array(
			"id"	    =>array(
			    "title"             => "id",
			    "type"              => "primary key",
			),
			"company_id"	    =>array(
			    "title"             => "Compania",
			    "type"              => "input",
			),			
			"time"	    =>array(
			    "title"             => "Entrada",
			    "title_filter"      => "Entrada",
			    "type"              => "input",
			),
			"time_end"	    =>array(
			    "title"             => "Salida",
			    "title_filter"      => "Salida",
			    "type"              => "input",
			),
			"diferencia"	    =>array(
			    "title"             => "Tiempo",
			    "title_filter"      => "Tiempo",
			    "type"              => "input",
			),
			"deviceid"	=>array(
			    "title"             => "Dispositivo",
			    "title_filter"      => "Dispositivo",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "type"              => "autocomplete",
			    "procedure"       	=> "autocomplete_devices",
			    #"relation"          => "one2many",
			    "relation"          => "many2one",
			    "class_name"       	=> "devices",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "deviceid",
			    "class_field_m"    	=> "id",			    
			),
			
			"geofenceid"	=>array(
			    "title"             => "Geocerca",
			    "title_filter"      => "Geocerca",
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "type"              => "autocomplete",
			    #"source"           	=> "../modulos/geofences/ajax/autocomplete.php",			    
			    "procedure"       	=> "autocomplete_geofences",
			    "relation"          => "many2one",
			    "class_name"       	=> "geofences",
			    "class_field_l"    	=> "name",				# Label
			    "class_field_o"    	=> "geofenceid",
			    "class_field_m"    	=> "id",			    
			),
			
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        
		public function __CONSTRUCT($option=NULL)
		{
			#$this->menu_obj=new menu();
			#$this->__PRINT_R($_SESSION);
			parent::__CONSTRUCT($option);
		}
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		$datas["company_id"]    =$_SESSION["company"]["id"];
    	    $alert_id				=parent::__SAVE($datas,$option);
    	  
		}						
		public function __BROWSE($option=NULL)
    	{    		
    		if(is_null($option)) 			$option					=array();
    		
    		#if(!isset($option["select"])) 	$option["select"]		=array();
    		if(!isset($option["where"])) 	$option["where"]		=array();	
    		
    		$option["where"][]									="company_id='{$_SESSION["company"]["id"]}'";
    		$option["where"][]									="time_end>time";
    		$option["where"][]									="TIMEDIFF(time_end,time) >'00:02:00'"; 
    		
    		return parent::__BROWSE($option);
		}
   		public function __REPORT_HOY($option=NULL)
    	{
			if(is_null($option)) 							$option=array();	
			if($option=="")									$option=array();			
			if(!isset($option["where"]))					$option["where"]=array();
			if(!isset($option["select"]))					$option["select"]=array();
			
			$option["select"]["id"]							="id";			
			$option["select"]["TIMEDIFF(time_end,time)"]	="diferencia";			
			$option["select"]["time"]						="time";
			$option["select"]["time_end"]					="time_end";						
			$option["select"]["deviceid"]					="deviceid";
			$option["select"]["geofenceid"]					="geofenceid";						

			$option["where"][]							="left(time,10)=left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10)";			

			$option["template_title"]	            	    = $this->sys_var["module_path"] . "html/report_especifico/title";
			$option["template_body"]	           		    = $this->sys_var["module_path"] . "html/report_especifico/body";
						
			if(!isset($this->request["sys_order_devices_geofences"]))
				$option["order"]="time desc";
			
			$return =$this->__VIEW_REPORT($option);
			#$this->__PRINT_R($this->sys_sql);
			return $return;
			
		}				
   		public function __REPORT_HOY_TOTAL($option=NULL)
    	{
			if(is_null($option)) 							$option=array();	
			if($option=="")									$option=array();			
			if(!isset($option["where"]))					$option["where"]=array();
			
			if(!isset($option["select"]))					$option["select"]=array();
			
			$option["select"]["id"]							="id";			
			$option["select"]["SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(time_end,time))))"]	="diferencia";			
			$option["select"]["count(time)"]				="time";
			$option["select"]["left(time_end,10)"]			="time_end";						
			$option["select"]["deviceid"]					="deviceid";
			$option["select"]["geofenceid"]					="geofenceid";						
			
			#$option["select"]="devices_geofences.geofenceid, devices_geofences.deviceid, count(devices_geofences.time) as time, count(devices_geofences.time_end) as time_end";
			
			$option["where"][]							="left(time,10)=left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10)";			

			$option["template_title"]	            	    = $this->sys_var["module_path"] . "html/report_especifico/title";
			$option["template_body"]	           		    = $this->sys_var["module_path"] . "html/report_especifico/body";			

			$option["group"]	                		= "deviceid, geofenceid, left(time,10)";

			if(!isset($this->request["sys_order_devices_geofences"]))
				$option["order"]="id desc";			
			#$option["echo"]="id desc";

			$return =$this->__VIEW_REPORT($option);
			#$this->__PRINT_R($this->sys_sql);
			return $return;
		}				

   		public function __REPORT_SEMANA_ACTUAL($option=NULL)
    	{
			$first = date('Y-m-d',strtotime('monday -7 days'));
			$last  = date ( 'Y-m-d' , strtotime ( '+6 day' , strtotime ( $first ) ) );			
    	
    	
			if(is_null($option)) 							$option=array();	
			if($option=="")									$option=array();			
			if(!isset($option["where"]))					$option["where"]=array();
			if(!isset($option["select"]))					$option["select"]=array();
						
			$option["select"][]								="*";
			$option["select"]["TIMEDIFF(time_end,time)"]	="diferencia";
			
			#$option["where"][]								="time BETWEEN SUBDATE(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10),WEEKDAY(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10))) AND ADDDATE(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10),6-WEEKDAY(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10)))";
			$option["where"][]								="time BETWEEN '$first 00:00:00' AND '$last 23:59:59'";

			$option["template_title"]	            	    = $this->sys_var["module_path"] . "html/report_especifico/title";
			$option["template_body"]	           		    = $this->sys_var["module_path"] . "html/report_especifico/body";
			
			if(!isset($this->request["sys_order_devices_geofences"]))
				$option["order"]="time desc";
			$return =$this->__VIEW_REPORT($option);
			#$this->__PRINT_R($this->sys_sql);
			return $return;

		}				
   		public function __REPORT_SEMANA_TOTAL($option=NULL)
    	{
			$first = date('Y-m-d',strtotime('monday -7 days'));
			$last  = date ( 'Y-m-d' , strtotime ( '+6 day' , strtotime ( $first ) ) );			

			$first = date('Y-m-d',strtotime('last monday -7 days'));
			$last  = date ( 'Y-m-d' , strtotime ( '+10 day' , strtotime ( $first ) ) );			


			if(is_null($option)) 							$option=array();	
			if($option=="")									$option=array();			
			if(!isset($option["where"]))					$option["where"]=array();
			
			if(!isset($option["select"]))					
			{
				$option["select"]=array();
				
				$option["select"]["id"]							="id";			
				$option["select"]["SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(time_end,time))))"]	="diferencia";			
				$option["select"]["count(time)"]				="time";
				$option["select"]["left(time_end,10)"]			="time_end";						
				$option["select"]["deviceid"]					="deviceid";
				$option["select"]["geofenceid"]					="geofenceid";						
			}			
			#$option["select"]="devices_geofences.geofenceid, devices_geofences.deviceid, count(devices_geofences.time) as time, count(devices_geofences.time_end) as time_end";
			
			#$option["where"][]							="time BETWEEN SUBDATE(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10),WEEKDAY(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10))) AND ADDDATE(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10),WEEKDAY(left(DATE_SUB(now(),INTERVAL {$_SESSION["user"]["huso_h"]} HOUR),10))+1)";			
			$option["where"][]								="time BETWEEN '$first 00:00:00' AND '$last 23:59:59'";

			if(!isset($option["template_title"]))
				$option["template_title"]	           	    = $this->sys_var["module_path"] . "html/report_especifico/title";
				
			if(!isset($option["template_body"]))	
				$option["template_body"]	           		= $this->sys_var["module_path"] . "html/report_especifico/body";
			
			if(!isset($option["group"]))			
				$option["group"]	                		= "deviceid, geofenceid, left(time,10)";

			if(!isset($this->request["sys_order_devices_geofences"]) AND !isset($option["order"]))
				$option["order"]="id desc";
			
			return $this->__VIEW_REPORT($option);
		}				


   		public function __REPORT_SEMANA_ANTERIOR($option=NULL)
    	{
			$first = date('Y-m-d',strtotime('last monday -7 days'));
			$last  = date ( 'Y-m-d' , strtotime ( '+6 day' , strtotime ( $first ) ) );			
    	    	
			if(is_null($option)) 							$option=array();	
			if($option=="")									$option=array();			
			if(!isset($option["where"]))					$option["where"]=array();
			if(!isset($option["select"]))					$option["select"]=array();

			$option["select"][]								="*";
			$option["select"]["TIMEDIFF(time_end,time)"]	="diferencia";
			
			$option["where"][]								="time BETWEEN '$first 00:00:00' AND '$last 23:59:59'";

			$option["template_title"]	            	    = $this->sys_var["module_path"] . "html/report_especifico/title";
			$option["template_body"]	           		    = $this->sys_var["module_path"] . "html/report_especifico/body";

			if(!isset($this->request["sys_order_devices_geofences"]))
				$option["order"]="time desc";
	
			$return =$this->__VIEW_REPORT($option);
			#$this->__PRINT_R($this->sys_sql);
			return $return;
		}				
   		public function __REPORT_SEMANA_ANTERIOR_TOTAL($option=NULL)
    	{
			$first = date('Y-m-d',strtotime('last monday -7 days'));
			$last  = date ( 'Y-m-d' , strtotime ( '+6 day' , strtotime ( $first ) ) );			


			if(is_null($option)) 							$option=array();	
			if($option=="")									$option=array();			
			if(!isset($option["where"]))					$option["where"]=array();
			if(!isset($option["select"]))					$option["select"]=array();


			$option["select"]["id"]							="id";			
			$option["select"]["SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(time_end,time))))"]	="diferencia";			
			$option["select"]["count(time)"]				="time";
			$option["select"]["left(time_end,10)"]			="time_end";						
			$option["select"]["deviceid"]					="deviceid";
			$option["select"]["geofenceid"]					="geofenceid";						

			
			$option["where"][]								="time BETWEEN '$first 00:00:00' AND '$last 23:59:59'";

			$option["template_title"]	            	    = $this->sys_var["module_path"] . "html/report_especifico/title";
			$option["template_body"]	           		    = $this->sys_var["module_path"] . "html/report_especifico/body";
			
			if(!isset($option["group"]))
				$option["group"]	                		= "deviceid, geofenceid, left(time,10)";
			
			if(!isset($this->request["sys_order_devices_geofences"]))
				$option["order"]="id desc";
			$return =$this->__VIEW_REPORT($option);
			#$this->__PRINT_R($this->sys_sql);
			return $return;
		}				
   		public function __REPORT_ESPECIAL_SEMANA($first,$last)
    	{
    		$comando_sql		="
				SELECT g.id as gid, g.name as gname, d.id as did, d.name as dname,  time, time_end, TIMEDIFF(time_end,time) as diferencia 
				FROM 
					devices_geofences dg JOIN 
					devices d ON d.id=dg.deviceid JOIN
					geofences g ON g.id=dg.geofenceid
				WHERE	1=1 
					AND time_end>time
					AND TIMEDIFF(time_end,time) >'00:03:00' 
					AND dg.company_id='{$_SESSION["company"]["id"]}'
					AND	time BETWEEN '$first 00:00:00' AND '$last 23:59:59'
				ORDER BY geofenceid asc, deviceid asc, time desc
				LIMIT 50;    
    		";
    		$datas 	            = $this->__EXECUTE($comando_sql);    		
			
			$data=array();
			foreach($datas as $rows)
			{
				$gid				=$rows["gid"];
				$did				=$rows["did"];
				$diferencia			=$rows["diferencia"];
				$time				=$rows["time"];
				$time_end			=$rows["time_end"];
				
				$option=array("select"=>array(),"where"=>array());
				$option["select"]["id"]							="id";			
				$option["select"]["SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(time_end,time))))"]	="diferencia";			
				$option["select"]["geofenceid"]					="geofenceid";						
				$option["where"][]								="time BETWEEN '$first 00:00:00' AND '$last 23:59:59'";
				$option["where"][]								="geofenceid='$gid'";
				$option["where"][]								="TIMEDIFF(time_end,time) >'00:03:00' ";
				
				if(!isset($data[$gid]))
				{										
					$option["group"]	                			= "geofenceid";					
					
					$return_device =$this->__BROWSE($option);

					$data[$gid]=array(
						"name"		=>$rows["gname"],
						"time"		=>$return_device["data"][0]["diferencia"],
						"devices"	=>array(),
					);				
				}
				
				if(!isset($data[$gid]["devices"][$did]))
				{
					$option["group"]	                			= "geofenceid,deviceid";					
					$option["where"][]								="deviceid='$did'";
					
					$return_device =$this->__BROWSE($option);
				
					$data[$gid]["devices"][$did]=array(
						"name"		=>$rows["dname"],
						"time"		=>$return_device["data"][0]["diferencia"],
						"eventos"	=>array(),					
					);				
				}
				
				$data[$gid]["devices"][$did]["eventos"][]=array(
					"diferencia"	=>$diferencia,
					"time"			=>$time,
					"time_end"		=>$time_end,
				);

			} 
			
			$return="";
			foreach($data as $row)
			{
				$return.="
					<tr style=\"background-color:#bbb; color:#000; size:7;\">
						<td width=\"90\" height=\"40\"><b>{$row["time"]}</b></td>
						<td width=\"440\" align=\"left\" colspan=\"4\"><b>{$row["name"]}</b> </td>
					</tr>";				
				foreach($row["devices"] as $devices)
				{
					$return.="
						<tr  style=\"background-color:#ccc; \">
							<td width=\"90\" height=\"30\"><b>{$devices["time"]}</b></td>
							<td width=\"20\"></td>
							<td width=\"420\" align=\"left\" colspan=\"3\"><b>{$devices["name"]}</b></td>
						</tr>
					";
					$tipo=1;
					foreach($devices["eventos"] as $eventos)
					{
						if($tipo==1)
						{
							$class="background-color:#E5E5E5;";
							$tipo=2;
						}
						else
						{
							$class="background-color:#D5D5D5;";
							$tipo=1;						
						}
						$return.="
							<tr style=\"$class\">
								<td width=\"90\" height=\"30\">{$eventos["diferencia"]}</td>
								<td width=\"20\"></td>
								<td width=\"20\"></td>
								<td width=\"200\">{$eventos["time"]}</td>
								<td width=\"200\">{$eventos["time_end"]}</td>
							</tr>
						";					
					}										
				}				
				$return.="
					<tr>
						<td colspan=\"5\">&nbsp;</td>
					</tr>
				";
				
			}
			
			$return=array("html"=>"<table >$return</table>");
			   		
			#$this->__PRINT_R($data);	
			return $return;
		}				
		
   		public function CRON_DELETE()
    	{
			$comando_sql="
				DELETE g.* FROM devices_geofences as g WHERE g.id IN ( 
					SELECT * FROM (
						SELECT gd.id FROM devices_geofences as gd
						GROUP BY gd.time, gd.deviceid, gd.geofenceid
						HAVING count(gd.id)>1
					) as o
				);			
			";
			$this->__EXECUTE($comando_sql);
			return "Geocercas borradas";
		}
   		public function __REPORT_GENERAL($option=NULL)
    	{
			if(is_null($option)) 							$option=array();	
			if($option=="")									$option=array();			
			if(!isset($option["where"]))					$option["where"]=array();
			if(!isset($option["select"]))					$option["select"]=array();
			
			$option["select"][]								="*";
			$option["select"]["TIMEDIFF(time_end,time)"]	="diferencia";
			
			$option["template_title"]	            	    = $this->sys_var["module_path"] . "html/report_especifico/title";
			$option["template_body"]	           		    = $this->sys_var["module_path"] . "html/report_especifico/body";
			
			#$option["where"][]							="estatus = 'APROVADO'";

			#$option["actions"]							= array();
			#$option["actions"]["write"]					="$"."row[\"estatus\"]==''  OR $"."this->__NIVEL_SESION(\"<=20\")==true";
			#$option["actions"]["show"]					="$"."row[\"estatus\"]!='CANCELADO'";			
			#$option["actions"]["check"]					="false";
			#$option["actions"]["delete"]				="false";
			
			

			$option["order"]="id desc";
			#if($this->__NIVEL_SESION(">=20")==true)	 // NIVEL ADMINISTRADOR 			
			{					
			#	$option["where"][]="left(trabajador_departamento_id,6)=left('{$_SESSION["user"]["departamento_id"]}',6)";				
			}


			#$option["color"]["red"]						="$"."row[\"trabajador_turno\"]==$"."row[\"sustituto_turno\"]";			
			
			#$option["color"]["blue"]					="substr($"."row[\"trabajador_puesto_id\"],2,4) != substr($"."row[\"sustituto_puesto_id\"],2,4)";			
			
			#$option["color"]["blue"]					.="OR (substr($"."row[\"trabajador_puesto_id\"],2,4) == substr($"."row[\"sustituto_puesto_id\"],2,4)";			
			#$option["color"]["blue"]					.="AND substr($"."row[\"trabajador_puesto_id\"],0,2) > substr($"."row[\"sustituto_puesto_id\"],0,2))";											


			
			return $this->__VIEW_REPORT($option);
		}				
		
	}
?>
