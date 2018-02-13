<?php
	include('auxiliar.php');	
	class general extends auxiliar
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		#var $ophp_fields		=array();
			
		##############################################################################	
		##  Metodos	
		##############################################################################
		var $sys_fields_l18n	=NULL;
		public function __CONSTRUCT($option=NULL)
		{  
			
		
			if($option == NULL)							$option							=array();
			if(!is_array($option))						$option							=array();
			
			if(isset($option["object"]))				$this->sys_object				=$option["object"];
			if(isset($option["name"]))					$this->sys_name					=$option["name"];
			if(isset($option["table"]))					$this->sys_table				=$option["table"];
			
			
			#$this->__PRINT_R($_SESSION);
			
			if(!isset($_SESSION))						@$_SESSION						=array();
			if(!isset($_SESSION["user"]))				@$_SESSION["user"]				=array();
    		if(!isset($_SESSION["user"]["huso_h"]))		@$_SESSION["user"]["huso_h"]	=6;
    		
    		$_SESSION["user"]["huso_h"]	=6;								
    		
			if(!isset($_SESSION["user"]["l18n"])) 		@$_SESSION["user"]["l18n"]		="es_MX";
						
			if(!isset($this->sys_object)) 				$this->sys_object				= get_class($this);
			if(!isset($this->sys_name)) 				$this->sys_name					= $this->sys_object;
			if(!isset($this->sys_table))         		$this->sys_table				= $this->sys_object;

			
			if($this->sys_name!="general")
			{
                
				$this->sys_module               			="modulos/".$this->sys_object."/";		
				$this->sys_l18n    		       	 			=$this->sys_module."l18n/";			
			
				if(file_exists($this->sys_l18n . @$_SESSION["user"]["l18n"].".php"))
				{				
					include($this->sys_l18n . @$_SESSION["user"]["l18n"].".php");				
				}	
				@include("nucleo/l18n/" . @$_SESSION["user"]["l18n"].".php");
			
				$this->sys_date								=date("Y-m-d H:i:s");
				$this->sys_date2							=date("Y-m-d");

				$this->__REQUEST();
						
				$eval="
					if(@$"."this->request[\"sys_section_".$this->sys_name."\"]!=\"\")
					{
						$"."this->sys_action	=@$"."this->request[\"sys_action_".$this->sys_name."\"];
						$"."this->sys_section	=@$"."this->request[\"sys_section_".$this->sys_name."\"];
					
						#if(isset($"."this->request[\"sys_id_".$this->sys_name."\"]))
					
						$"."this->request[\"sys_id\"]	=@$"."this->request[\"sys_id_".$this->sys_name."\"];					
					}	
				";
				eval($eval);							
			
			
				$this->__FIND_FIELD_ID();		
				$this->__FIND_FIELDS();
				if(@$this->sys_vpath==$this->sys_name."/" AND @$this->sys_action=="__SAVE" AND ($this->sys_section=="create" OR $this->sys_section=="write"))
				{
					$this->__PRE_SAVE();
				    $words["system_message"]    			=@$this->__SAVE_MESSAGE;
				    $words["system_js"]     				=@$this->__SAVE_JS;	            
				}							
				
				$this->__FIND_FIELDS(@$this->sys_primary_id);

				
			}	
		}
		public function __BROWSE($option=array())
    	{    	
    		$option_conf=array();

			$option_conf["open"]	=1;
			$option_conf["close"]	=1;
    		
    		#####################
    		$retun				=array();
    		$id="";
    		if(is_numeric($option))
    		{    			
    			$this->__FIND_FIELD_ID();
    			$id		=$option;
    			$option	=array();
				
    			$option["where"]=array(
    				"{$this->sys_primary_field}='$id'"
    			);
    		}
    		
	    	if(!isset($option["name"]))    	$name	=@$this->sys_name;
	    	else							$name	=$option["name"];
            
			if(isset($this->request["sys_order_$name"]))     $option["sys_order_$name"]    =$this->request["sys_order_$name"];
			if(isset($this->request["sys_torder_$name"]))    $option["sys_torder_$name"]   =$this->request["sys_torder_$name"];
    		
    		
    		if(!isset($option["sys_torder_$name"])) 	    $sys_torder="ASC";
    		else
    		{
    		    if($option["sys_torder_$name"]=="ASC")      $sys_torder="DESC";
    		    else                                        $sys_torder="ASC";
    		}
    		
    		if(!isset($option["select"])) 	
    		{
    			$select="{$this->sys_table}.*";
    			
    		}    		
    		else							
    		{
    			if(is_array($option["select"]))
    			{
    				$select		="";
    				$html_title	=array();
    				foreach($option["select"] as $campo => $title)
    				{
    					$font		=$title;
    					if(is_string($campo))
    					{
							if($select=="")		
							{
							    $select		    ="$campo as $title";									
							}
							else
							{
								$select		    .=", $campo as $title";
							}				
							$sys_order	=$campo;	
													
						}
						else
						{
    						if($select=="")		
    						{
    						    $select		    ="$title";
    						}
    						else
    						{				
    						    $select		    .=", $title";
    						}
    						$sys_order	=$title;    						
						}
						if(!isset($html_title["$title"]))	
						{
							$html_title["$title"]	=$this->__REPORT_TITLES($sys_order,$sys_torder,$font,$name);
						}	
    				}    			
    			}
    			else 
    			{
    				$select=$option["select"];
    			}	
    		}	
    		#####################
    		if(!isset($option["from"]))	$from=	$this->sys_table;
    		else						$from=	$option["from"];
			#####################
    		$where='WHERE 1=1';
    		
    		
			##   FILTER AUTOCOMPLETE ######
			if(isset($option["filter"]) AND is_array($option["filter"]))
			{
				foreach($option["filter"] as $campo=>$valor)
				{        	
					if(is_int($campo))	$campo=$valor;
											
					if(@$this->request["sys_filter_{$this->sys_name}_{$campo}"])
					{	
						if(!isset($option["where"]))    $option["where"]=array();		

						$busqueda					=$this->request["sys_filter_{$this->sys_name}_{$campo}"];
						
						if(@$this->sys_fields[$campo]["relation"]=="one2many")
						{
							
							$class_field_o			=$valor["class_field_o"];
							$class_field_m			=$valor["class_field_m"];
							$class_field_l			=$valor["class_field_l"];
							
							$eval="
								$"."obj_$campo   				=new {$valor["class_name"]}();
								
								$"."option_$campo=array(
									\"where\"=>array(
										\"$class_field_l LIKE '%{$busqueda}%'\"
									)
								);									
								$"."data_$campo					=$"."obj_$campo"."->__BROWSE($"."option_$campo);
								
								$"."busqueda=\"\";
								foreach($"."data_$campo"."[\"data\"] as $"."row_$campo)
								{									
									if($"."busqueda==\"\") 	$"."busqueda		= $"."row_$campo"."[\"$class_field_o\"];
									else					$"."busqueda		.= \",\" . $"."row_$campo"."[\"$class_field_o\"];
								}															
							";
							#$this->__PRINT_R($eval);
							eval($eval);										

							$option["where"][]="$class_field_m IN ($busqueda)";			
						}
						else	$option["where"][]="$campo LIKE '%$busqueda%'";	
						
						#$this->__PRINT_R($option["where"]);
					}
					
				}	
			}	
	    		
    		
    		
    		if(isset($option["where"]))
    		{
    			if(is_array($option["where"]))
    			{
					foreach($option["where"] as $datas)
					{ 			
						$where.=" and $datas";
					}    		
				}
				else	$where.=" ". $option["where"];
					
    		}    		
    		#####################
			$order="";
    		if(isset($option["order"]))		
    		{
    			$order=	" ORDER BY ".$option["order"];
    		}
    		if(isset($option["sys_order_$name"]))		
    		{
    			if($order=="")	$order	=" ORDER BY ";
    			else    		$order	.=", ";
    			
    			$order			.=$option["sys_order_$name"];
    			
				if(isset($option["sys_torder_$name"]))	$order.=" ".$option["sys_torder_$name"];
    		}	
    		#####################
    		$group="";
    		if(isset($option["group"]))		
    		{
    			$group=	" GROUP BY ".$option["group"];				
    		}	
    		#####################

    		$having="";
    		if(isset($option["having"]))
    		{
    			$having=" HAVING 1=1 ";
    			if(is_array($option["having"]))
    			{
					foreach($option["having"] as $datas)
					{ 			
						$having.=" and $datas";
					}    		
				}
				else	$having.=" ". $option["having"];					
    		}    		
    		
    		#####################
    		$limit="";

    		if(isset($option["sys_page_$name"]))		
    		{
    			if(isset($this->request["sys_row_$name"])) 		$option["sys_row_$name"]    =$this->request["sys_row_$name"];
    			else							    			$option["sys_row_$name"]	=50;
    			
    			
    			$inicio						=$option["sys_page_$name"] * $option["sys_row_$name"] - $option["sys_row_$name"];
    			
    			$return["inicio"]    		=$inicio;
    			
    			$limit						=" LIMIT $inicio, {$option["sys_row_$name"]}";
    		}	

    		if(isset($option["limit"]))
    		{    			
    			$limit						=" LIMIT {$option["limit"]}";
    		}			
    		
    		#####################
    		
    		if(isset($option["total"]))
    			$this->sys_sql					="SELECT count(*) as total FROM $from $where  $group $having";
    		else	
    			$this->sys_sql					="SELECT count(*) as total, $select FROM $from $where  $group $having";
    		

    		#$total 	            = $this->__EXECUTE($this->sys_sql,$option_conf);
    		$total 	            = $this->__EXECUTE($this->sys_sql);
			
            #$this->__PRINT_R($total);
                        
            $subtotal			=count($total);
            #echo $subtotal;
    		if($subtotal>1)         $return["total"]    =$subtotal;
    		elseif($subtotal=1)     
    		{    			
    			if(is_array(@$total[0]))
	    			$return["total"]    =$total[0]["total"];
	    		else 	
	    		{
	    			#$return["total"]	="SE HA DETECTADO UN ERROR";
	    			#$option["echo"]		="ERROR AL EJECUTAR CONSULTA";
	    		}	
    		}	

    		$this->sys_sql		="SELECT $select FROM $from $where  $group  $having $order $limit";
    		    		
    		    		
    		
    		if(isset($option["echo"])  AND in_array($_SERVER["SERVER_NAME"],$this->serv_error))
             	echo "<div class=\"echo\" title=\"{$option["echo"]}\">".$this->sys_sql."</div>";
   			
   			#$return["data"] 	= $this->__EXECUTE($this->sys_sql, $option);
   			$return["data"] 	= $this->__EXECUTE($this->sys_sql);

   			#echo "<br><br>OPTIONS<<<<<<<<<<<<<<<<<<<<<br>";
   			#$this->__PRINT_R($option);
   			#$this->__PRINT_R($return["data"]);
   			#$html_title=array();
			if(is_array(@$return["data"][0]))
			{
				foreach($return["data"][0] as $campo => $title)
				{
					$font		=$title;
					if(is_string($campo))	$sys_order	=$campo;							
					else					$sys_order	=$title;    						

					if(!isset($html_title["$campo"]))	
					{
						$html_title["$campo"]	=$this->__REPORT_TITLES($sys_order,$sys_torder,$sys_order,$name);
					}	
				}    			
			}
   			
   			if(isset($html_title))	$return["title"]	= $html_title;
    		if($id!="")				$return				=$return["data"];
    		if(!isset($return["total"]) AND isset($return["data"]))
    		{
    			$return["total"]=count($return["data"]);
    		}

    		return $return;    		
    	}		
		##############################################################################		 		
		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		#echo "<br>INI __SAVE ";
    		$fields	="";
    		$return	="";
    		
			#$this->__PRINT_R($datas);    		
    		
    		if(!isset($option) OR is_null($option))	$option=array();
			
			if(!array_key_exists("message",$option))   
				$option["message"]="DATOS GUARDADOS";
			
    		#echo "<br>__SAVE :: ". $this->__PRINT_R($this->sys_fields);
    		foreach($datas as $campo=>$valor)
    		{
    			if(count(@$this->sys_fields["$campo"])>1 and $valor!="" and @$this->sys_fields["$campo"]["type"]!='primary key')
    			{
    				if(!is_array($valor))	
	    				$fields	.="$campo='$valor',";
    			}
    		}    		
    		#echo "<br>__SAVE :: ". $this->__PRINT_R($fields);
    		if($fields!="")
    		{
    			$SAVE_JS="";
    			$fields				=substr($fields,0,strlen($fields)-1);
    			$insert=0;	
                if(is_null(@$this->sys_primary_id) OR @$this->sys_primary_id=="") 
                {
                    #echo "ENTRO {$this->sys_object}";
                	$insert=1;
                	$this->sys_sql	="INSERT INTO {$this->sys_table} SET $fields";
                	$SAVE_JS="
                		$(\"input[system!='yes']\").each(function(){
                		
                			$(this).val(\"\");
                			
                		})
                	";                	
                }	
                else $this->sys_sql	="UPDATE {$this->sys_table} SET $fields WHERE {$this->sys_primary_field}='{$this->sys_primary_id}'";

				#$option_conf=array();


				$option["open"]	=1;
				#$option_conf["close"]	=1;
    			$this->__EXECUTE($this->sys_sql,$option);

				#if(isset($option["echo"]))
		        #	echo "<div class=\"echo\" title=\"{$option["echo"]}\">".$this->sys_sql."</div>";
    			

    			unset($option["open"]);
    			
    			
    			if($this->__MESSAGE_EXECUTE!="")    $this->__SAVE_MESSAGE   =$this->__MESSAGE_EXECUTE;
    			else                                $this->__SAVE_MESSAGE   =$option["message"];
    			
    			$data_message						=$this->__MESSAGE($this->__SAVE_MESSAGE,$option);
    			
    			$this->__SAVE_HTML	=$data_message["html"];
    			$this->__SAVE_JS	=$data_message["js"] . $SAVE_JS;
    			    			
    			#$this->__PRINT_R($this->__SAVE_JS);
    			
    			$option["close"]=1;
    			
    			if($insert==1)
    			{
					#$option_conf["open"]	=1;
					$option["close"]	=1;
    			
    			    #echo "ENTRO {$this->sys_object}";
    				$data = $this->__EXECUTE("SELECT LAST_INSERT_ID() AS ID",$option); 
    				unset($option["close"]);
    				#echo "<br>__SAVE :: ". $this->__PRINT_R($data);
    				$this->sys_primary_id=$data[0]["ID"];
    			}	
    			$return=@$this->sys_primary_id;
    		}
    		
    		#echo "<br>FIN __SAVE $return";
    		return $return;
    		
    	}
    	##############################################################################	   	
		public function __EXECUTE($comando_sql, $option=array("open"=>1,"close"=>1))
    	{
    		if(is_string($option))
    		{
    			$option=array("open"=>1,"close"=>1);
    		}
    	
    		$return=array();    		    		
    		
	   		if(is_array($option))
    		{
    			#echo "<br>RESULTADO ABIERTO $comando_sql ";    			
    			#if(!isset($option["open"]))	$option["open"]=1;    		

				if(isset($option["echo"])  AND in_array($_SERVER["SERVER_NAME"],$this->serv_error))
		        	echo "<div class=\"echo\" style=\"display:none;\" title=\"{$option["echo"]}\">".$this->sys_sql."</div>";

    		
    			if(isset($option["open"]))	
    			{    			
    				$this->abrir_conexion();
    				if(isset($option["e_open"])  AND in_array($_SERVER["SERVER_NAME"],$this->serv_error))
    					echo "<br><b>CONECCION ABIERTA</b><br>$comando_sql<br>{$option["e_open"]}";    				
    			}	
    		}

			$row=0;				
			if(is_object($this->OPHP_conexion)) 
			{
				$resultado	= @$this->OPHP_conexion->query($comando_sql);
				if(isset($this->OPHP_conexion->error) AND $this->OPHP_conexion->error!="" AND in_array($_SERVER["SERVER_NAME"],$this->serv_error))
				{					
					echo "
						<div class=\"echo\" style=\"display:none;\" title=\"Error\">
							{$this->OPHP_conexion->error}
							<br><br>
							$comando_sql
						</div>
					";
				}						
			}	
			else
			{
				$resultado=array();
				if(in_array($_SERVER["SERVER_NAME"],$this->serv_error))				
					echo "<div class=\"echo\" style=\"display:none;\" title=\"Coneccion\">Error en la conecion</div>";
			}	

						
			if(is_object(@$resultado)) 
			{			
				while($datos = $resultado->fetch_assoc())
				{			
					foreach($datos as $field =>$value)
					{
						if(is_string($field) AND !is_null($field))
						{
							#$value 					= html_entity_decode($value);
							$return[$row][$field]	=$value;
						}	
					}		
					$row++;	
				}
				$resultado->free();					
			}

			$this->__MESSAGE_EXECUTE="";
       		if(@$error!="")	
       		{
       			$sql='INSERT INTO sql_erros SET sql="$comando_sql"';
				@mysql_query($comando_sql);
       		    $this->__MESSAGE_EXECUTE    =$error;
       		}
       		#/*
    		if(is_array($option))
    		{
    			if(isset($option["close"]))	
    			{
    				$this->cerrar_conexion();
    				    if(isset($option["e_close"]) AND in_array($_SERVER["SERVER_NAME"],$this->serv_error))
    					echo "<br><b>CONECCION CERRADA</b><br>{$option["e_close"]}";
    			}	
    		}
       		#*/
       		return $return;	
    		//
    	}    	   	
	}
?>
