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
		var $sys_enviroments	="PRODUCTION";
		
		public function __CONSTRUCT($option=array())
		{  	
			if(!isset($this->sys_fields))			$this->sys_fields=array();
			
			if(!isset($option))						$option=Array();
			if(!is_array($option))					$option=Array();
						
			if(!isset($_SESSION))
				@$_SESSION							=array();

			if(!isset($_SESSION["user"]))
				@$_SESSION["user"]					=array();
    		if(!isset($_SESSION["user"]["huso_h"]))
   				@$_SESSION["user"]["huso_h"]		=5;
				
			if(!isset($_SESSION["user"]["l18n"])) 
				@$_SESSION["user"]["l18n"]			="es_MX";
			
			@$_SESSION["user"]["huso_h"]		=6;
			
			$this->sys_date							=date("Y-m-d H:i:s");
			$this->sys_date2						=date("Y-m-d");
						
			$nuevafecha								= strtotime ( '-7 hour' , strtotime ( $this->sys_date ) ) ;
			$this->sys_date 						= date ( 'Y-m-d H:i:s' , $nuevafecha );
			 
			
			if(!is_array($option)) 					$option=array();
			
			
			if(isset($option["object"])) 			$this->sys_object				=$option["object"];
			if(isset($option["name"])) 				$this->sys_name					=$option["name"];
			if(isset($option["table"])) 			$this->sys_table				=$option["table"];
			if(isset($option["memory"])) 			$this->sys_memory				=$option["memory"];
			if(isset($option["class_one"])) 		$this->class_one				=$option["class_one"];

			if(isset($option["sys_enviroments"])) 	$this->sys_enviroments			=$option["sys_enviroments"];
			if(!isset($this->sys_enviroments)) 		$this->sys_enviroments			="PRODUCTION";
			if(!isset($this->sys_object)) 			$this->sys_object				= get_class($this);
			if(!isset($this->sys_name)) 			$this->sys_name					= $this->sys_object;			
			if(!isset($this->sys_table)) 			$this->sys_table				= $this->sys_object;			
			if(!isset($this->sys_module)) 			$this->sys_module               ="modulos/".$this->sys_object."/";
					
			$this->sys_l18n    		       		 =$this->sys_module."l18n/";			
			
			if($this->sys_enviroments=="DEVELOPER")
			{	
				error_reporting(-1);
				ini_set('display_errors', 1);				
			}
			else if($this->sys_enviroments=="TESTING")	
			{
				ini_set('display_errors', 0);
			}				
			else if($this->sys_enviroments=="PRODUCTION")	
			{
				ini_set('display_errors', 0);
			}				
			
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
				
		    	if(!isset($_SESSION["pdf"]))							$_SESSION["pdf"]	=array();		    					
				
				if(!isset($_SESSION["pdf"]["title"]))					$_SESSION["pdf"]["title"]					=$this->words["module_title"];
				if(!isset($_SESSION["pdf"]["subject"]))					$_SESSION["pdf"]["subject"]					=$this->words["html_head_title"];
				if(!isset($_SESSION["pdf"]["template"]))				$_SESSION["pdf"]["template"]				=$template;
				
				if(!isset($_SESSION["pdf"]["PDF_PAGE_ORIENTATION"]))	$_SESSION["pdf"]["PDF_PAGE_ORIENTATION"]	="P";   	# (P=portrait, L=landscape)
				if(!isset($_SESSION["pdf"]["PDF_UNIT"]))				$_SESSION["pdf"]["PDF_UNIT"]				="mm";   	# [pt=point, mm=millimeter, cm=centimeter, in=inch
				if(!isset($_SESSION["pdf"]["PDF_PAGE_FORMAT"]))			$_SESSION["pdf"]["PDF_PAGE_FORMAT"]			="A4";   	# [pt=point, mm=millimeter, cm=centimeter, in=inch
				if(!isset($_SESSION["pdf"]["PDF_HEADER_LOGO"]))			$_SESSION["pdf"]["PDF_HEADER_LOGO"]			="tcpdf_logo.jpg";   	# [pt=point, mm=millimeter, cm=centimeter, in=inch
				if(!isset($_SESSION["pdf"]["PDF_HEADER_LOGO_WIDTH"]))	$_SESSION["pdf"]["PDF_HEADER_LOGO_WIDTH"]	=20;   	
				if(!isset($_SESSION["pdf"]["PDF_MARGIN_TOP"]))			$_SESSION["pdf"]["PDF_MARGIN_TOP"]			=50;   	
				
						
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
    		
	    	if(!isset($option["name"]))    					$name							=@$this->sys_name;
	    	else											$name							=$option["name"];
            
			if(isset($this->request["sys_order_$name"]))	$option["sys_order_$name"]		=$this->request["sys_order_$name"];
			if(isset($this->request["sys_torder_$name"]))	$option["sys_torder_$name"]		=$this->request["sys_torder_$name"];
    		
    		
    		if(!isset($option["sys_torder_$name"]))			$sys_torder						="ASC";
    		else
    		{
    		    if($option["sys_torder_$name"]=="ASC")      $sys_torder						="DESC";
    		    else                                        $sys_torder						="ASC";
    		}
    		
    		if(!isset($option["select"])) 	
    		{
    			$select="*";
    		}    		
    		else							
    		{
    			if(is_array($option["select"]))
    			{
    				$select				="";
    				$html_title			=array();
					$html_title_clean	=array();
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
							$option_report_titles=array(
								"sys_order"		=>"$sys_order",
								"sys_torder"	=>"$sys_torder",
								"sys_order"		=>"$sys_order",
								"font"			=>"$campo",
								"name"			=>"$name",
							);
							$html_title["$title"]				=$this->__REPORT_TITLES($option_report_titles);
							
							$option_report_titles["option"]		="pdf";
							$html_title_clean["$campo"]			=$this->__REPORT_TITLES($option_report_titles);
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
			if(isset($this->sys_fields) AND is_array($this->sys_fields))
			{
				foreach($this->sys_fields as $campo=>$valor)
				{        								
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

							eval($eval);										

							$option["where"][]="$class_field_m IN ($busqueda)";			
						}
						else	$option["where"][]="$campo LIKE '%$busqueda%'";	
						

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


			if(is_array(@$return["data"][0]))
			{
				foreach($return["data"][0] as $campo => $title)
				{
					$font		=$title;
					if(is_string($campo))	$sys_order	=$campo;							
					else					$sys_order	=$title;    						

					if(!isset($html_title["$campo"]))	
					{						
						$option_report_titles=array(
							"sys_order"		=>"$sys_order",
							"sys_torder"	=>"$sys_torder",						
							"font"			=>"$campo",
							"name"			=>"$name",
						);
						$html_title["$campo"]				=$this->__REPORT_TITLES($option_report_titles);
						
						$option_report_titles["option"]		="pdf";
						$html_title_clean["$campo"]			=$this->__REPORT_TITLES($option_report_titles);
							
					}	
				}    			
			}
			if(!is_array(@$html_title))
			{
				$return["data_0"][0]=array();	
				foreach($this->sys_fields as $campo => $value)
				{	
					$return["data_0"][0]["$campo"]="";
					if(isset($value["title"]))	$font		=$value["title"];					
					else 						$font		=$campo;
					
					if(is_string($campo))	$sys_order	=$campo;									
					else					$sys_order	=$title;    						

					if(!isset($html_title["$campo"]))	
					{						
						$option_report_titles=array(
							"sys_order"		=>"$sys_order",
							"sys_torder"	=>"$sys_torder",
							"font"			=>"$campo",
							"name"			=>"$name",
						);
						$html_title["$campo"]				=$this->__REPORT_TITLES($option_report_titles);
						
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
			
		
			
			if(!isset($this->sys_memory) OR $this->sys_memory=="")
			{	
				###########################################################	
				##################  REAL ##################################
				###########################################################		
				$fields			="";
				$return			="";
				$many2one		=array();
				
				if(!isset($option) OR is_null($option))	$option=array();
				
				if(!array_key_exists("message",$option))   
					$option["message"]="DATOS GUARDADOS";
								
				if(!(is_null(@$this->sys_primary_id) OR @$this->sys_primary_id==""))
				{
					$data_anterior=$this->__BROWSE($this->sys_primary_id);				
				}		
				foreach($datas as $campo=>$valor)
				{					
					if(is_array($valor))
					{
						$many2one["$campo"]=$valor;						
					}				
					if(is_null(@$this->sys_primary_id) OR @$this->sys_primary_id=="") 
					{
						#if(count(@$this->sys_fields["$campo"])>1 and $valor!="")
						if(count(@$this->sys_fields["$campo"])>1 )
						{
							if(!is_array($valor))	
								$fields	.="$campo='$valor',";
						}
					}
					else
					{
						#if(count(@$this->sys_fields["$campo"])>1 and $valor!="" and @$this->sys_fields["$campo"]["type"]!='primary key')
						if(count(@$this->sys_fields["$campo"])>1 and @$this->sys_fields["$campo"]["type"]!='primary key')
						{
							if(!is_array($valor))	
							{									
								if($data_anterior[0][$campo]!=$valor)		
									@$modificados.=" 
										<b>{$this->sys_fields["$campo"]["title"]}</b>= $valor
									";
								$fields	.="$campo='$valor',";
							}	
						}
					}	
				}    

				if($fields!="")
				{
					$SAVE_JS="";
					$fields				=substr($fields,0,strlen($fields)-1);
					$insert=0;					
					
					$user_id			=@$_SESSION["user"]["id"];
					$user_name			=@$_SESSION["user"]["name"];
									
					$data_historico="
						tabla='$this->sys_table',
						objeto='$this->sys_object',
						user_id='$user_id',
						user_name='$user_name',
						fecha='$this->sys_date',
						remote_addr='{$_SERVER["REMOTE_ADDR"]}',												
					";
					
					if(is_null(@$this->sys_primary_id) OR @$this->sys_primary_id=="") 
					{
						$insert=1;
						$this->sys_sql	="INSERT INTO {$this->sys_table} SET $fields";
						$this->__PRINT_JS.="
							$(\"input[system!='yes']\").each(function(){                		
								$(this).val(\"\");                			
							})
						";            
						$data_historicos="descripcion='<font>$user_name</font> <b>CREO</b> El registro'";					
						#$data_historicos="descripcion='{$_SESSION["user"]["matricula"]}<b>CREO</b> El registro'";					
					}	
					else 
					{	
						$this->sys_sql	="UPDATE {$this->sys_table} SET $fields WHERE {$this->sys_primary_field}='{$this->sys_primary_id}'";					
						if(@$modificados!="")
						{
							$data_historicos="descripcion='<font>$user_name</font> <b>MODIFICO</b> los valores $modificados'";	
							#$data_historicos="descripcion='{$_SESSION["user"]["matricula"]}<b>MODIFICO</b> los valores $modificados'";	
						}	
					}	

					$option["open"]	=1;
					#$option_conf["close"]	=1;
					$this->__EXECUTE($this->sys_sql,$option);
					

					
					if(@$this->OPHP_conexion->error=="")
					{					
						unset($option["open"]);
									
						$this->__PRINT="Datos guardados correctamente";
											
						
						$option["close"]=1;
						
						if($insert==1)
						{
							#$option_conf["open"]	=1;
							$option["close"]	=1;
						
							#echo "ENTRO {$this->sys_object}";
							$data = $this->__EXECUTE("SELECT LAST_INSERT_ID() AS ID",$option); 
							unset($option["close"]);
							$this->sys_primary_id=$data[0]["ID"];
						}	
						$return=@$this->sys_primary_id;
						

						foreach($many2one as $campo =>$valores)	
						{										
							$valor_campo	=$this->sys_fields["$campo"];
							
							$eval="								
								$"."this->$campo"."_obj									=new {$valor_campo["class_name"]}();		
								$"."class_field_m										=$"."valor_campo[\"class_field_m\"];
											
								foreach($"."valores as $"."valor)
								{	
									if(!(isset(    $"."valor_campo[$"."class_field_m]     ) AND $"."valor_campo[$"."class_field_m]==\"\"))								
										$"."valor[$"."class_field_m]						=$"."this->sys_primary_id;								
									
									$"."primary_field					=$"."this->$campo"."_obj->sys_primary_field;
									
									if(isset($"."valor[$"."primary_field]) AND  $"."valor[$"."primary_field]>0	)
									{										
										$"."this->$campo"."_obj->sys_primary_id		=$"."valor[$"."primary_field];	
									}	
									else
									{	
										$"."this->$campo"."_obj->sys_primary_id		=\"\";
									}
									$"."this->$campo"."_obj->__SAVE($"."valor);		
								}	
							";
							eval($eval);														
							unset($_SESSION["SAVE"][$this->sys_object][$campo]);	
							
							
						}
						
						if(!in_array($this->sys_table,$this->sys_modules))
						{	
							if(!isset($data_historicos))	$data_historicos="";								
							$comando_sql="INSERT INTO historico SET $data_historico $data_historicos, clave=$this->sys_primary_id	";						
							if(@$data_historicos!="")
							{	
								$this->__EXECUTE($comando_sql);					
							}	
						}					
					}						
				}				
				#echo "<br>FIN __SAVE $return";
				return $return;
			}
			else
			{
				###########################################################	
				##################  MEMORIA ###############################
				###########################################################
				if(isset($datas["class_one"]))
				{		
					
					$class_one		=$datas["class_one"];
					$class_field	=$datas["class_field"];
					
					if(!isset($_SESSION["SAVE"]["$class_one"][$class_field]))
					{	
						$_SESSION["SAVE"]=array(
							"$class_one"	=>array(						
								"$class_field"	=> array()
							)
						);
					}				

					$valor_campo	=$this->sys_fields[$this->sys_primary_field]["value"];
	
					$row														=$datas["row"];				

					if(!isset($row[$this->sys_primary_field]))		$row[$this->sys_primary_field]=@$this->sys_primary_id;
					
					if(!isset($_SESSION["SAVE"]["$class_one"][$class_field]["data"]))	
						$_SESSION["SAVE"]["$class_one"][$class_field]["data"]=array();
					
					if(isset($datas["class_field_id"]) AND $datas["class_field_id"]>=0 )
					{
						$active_id		=$datas["class_field_id"];						
						$_SESSION["SAVE"]["$class_one"][$class_field]["data"][$active_id]	=	$row;							
					}
					else	$_SESSION["SAVE"]["$class_one"][$class_field]["data"][]	=	$row;
	
					$_SESSION["SAVE"]["$class_one"][$class_field]["total"]	=	count($_SESSION["SAVE"]["$class_one"][$class_field]["data"]);
			

				}		
			}
    	}
    	##############################################################################	   	
		public function __EXECUTE($comando_sql, $option=array("open"=>1,"close"=>1))
    	{
    		if(is_string($option))
    		{
    			$option=array("open"=>1,"close"=>1);
    		}
    	
    		$return=array();    		    		
    		
    		if(@$this->sys_sql=="") 		$this->sys_sql=$comando_sql;
    		
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
