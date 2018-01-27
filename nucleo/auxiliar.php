<?php
	include('basededatos.php');
	require_once('class.phpmailer.php');
	require_once('class.smtp.php');
	
	class auxiliar extends basededatos 
	{   
		##############################################################################	
		##  PROPIEDADES
		##############################################################################
		var $request					=array();	# este arrat recibe las variables del POST		
		var $sys_true					=array(1,"1","true", "si");
		var $sys_false				    =array(0,"0","false", "no");
		var $sys_section	   		 	="";
		var $sys_action		   		 	="";
		var $html						="";
		var $sitio_web					="";		
		var	$jquery						="";
		var	$jquery_aux					="";	
		var $sys_html     		      	="sitio_web/html/";
		var $serv_error					=array("pruebas.solesgps.com","localhost");    				    				
		
		var $sys_date           		=""; 
				
		var $words=array(
		    "html_head_title"           => "ESTE ES EL TITULO DE LA VENTANA :: words[html_head_title]",
		    "html_head_description"     => "ESTA ES LA DESCRIPCION OCULTA DEL MODULO :: words[html_head_description]",		
		);

		##############################################################################	
		##  METODOS	
		##############################################################################
		
   
		public function __SESSION()
		{  
			$redireccionar= "<script>window.location=\"../webHome/\";</script>";
			if(is_array($_SESSION))
			{
				if(array_key_exists("user",$_SESSION))
				{
					if(is_array($_SESSION["user"]))
					{
						if(array_key_exists("name",$_SESSION["user"]))
							$redireccionar= "";					
					}					
				}			
			}
			if($redireccionar!="")
			{
				$_SESSION=array();
				$_SESSION["user"]="Invitado";
				echo $redireccionar;
				exit();
			}
			
    	}    	
		public function __SAVE_ALERT($option)
		{  

		}    	
		public function __FIND_FIELD_ID()
		{  
			# BUSCA EL CAMPO y VALOR PRIMARY KEY
			# DEL MODELO DECLARADO
			if(isset($this->sys_fields) AND is_array($this->sys_fields))
			{
				foreach($this->sys_fields as $campo=>$valor)
				{        			
					if(@$valor["type"]=="primary key")
					{    				
						if(@$this->sys_vpath==$this->sys_name."/")
						{
					    	if(isset($this->request["sys_id"]))     $this->sys_primary_id       =$this->request["sys_id"];
						    else                                    $this->sys_primary_id       =$valor["value"];
						}   
						$this->sys_primary_field                =$campo; 
					}	
				}	
			}	
    	}  
    	/*
    	public function __FIND_FIELDS($id=NULL)
    	{
    	
    	}
    	*/
		public function __FIND_FIELDS($id=NULL)
		{
		 	# ASIGNA EL ROW CON EL $id enviado
		 	# DE LAS VARIABLES DECLARADAS EN EL MODELO 
			# $this->sys_fields
			if(isset($this->sys_fields) AND is_array($this->sys_fields))
			{
		    	foreach($this->sys_fields as $field =>$value)
		    	{

		    		if(isset($value["relation"]) AND $value["relation"]=="one2many")
		    		{
		    			$eval="$"."this->$field"."_obj			=new {$value["class_name"]}();";

						if(@eval($eval)===false)	
							echo ""; #$eval; ---------------------------								        			
		    		}			        		
		    	}
			}

			
		    if(isset($id) and $id>0)
		    {
		    		
		        #if(@$this->request["sys_action"]!="__SAVE")
		        {
					$option_conf=array();
					
					$option_conf["open"]	=1;
					$option_conf["close"]	=1;

		            $sql    	="SELECT * FROM {$this->sys_table} WHERE {$this->sys_primary_field}='{$id}'";
			        $datas   	= $this->__EXECUTE("$sql",$option_conf);
			        
			        if(@is_array($datas[0]))
			        {
			        	foreach($this->sys_fields as $field =>$value)
			        	{			        	
			        		if(isset($value["type"]) AND $value["type"]!="class")	
			        		{
					    		if(isset($value["relation"]) AND $value["relation"]=="one2many")
					    		{
					    			$class_echo="";
					    			if(isset($value["class_echo"]))   $class_echo="
										if(in_array($"."_SERVER[\"SERVER_NAME\"],$"."this->serv_error))
											$"."option[\"echo\"]=\"CLASS {$value["class_name"]}\";
										
					    			";
					    		
					    			if(isset($value["class_field_m"]))
					    			{
					    			
										$eval="
											$"."option=array();
											$class_echo
											$"."option[\"where\"]=array(\"{$value["class_field_m"]}='{$datas[0][$value["class_field_o"]]}'\");
											$"."$field=$"."this->$field"."_obj->__BROWSE($"."option);
											$"."this->sys_fields[\"$field\"][\"values\"]=\"\";
											$"."this->sys_fields[\"$field\"][\"values\"]=$"."$field"."[\"data\"];
										";
										#$this->__PRINT_R($eval);
										if(@eval(@$eval)===false)	
											$this->__PRINT_R($eval);
									}		
					    		}
					    	}	
			        	}
			        	
					    foreach($datas[0] as $field =>$value)
					    {
					    	$value		=str_replace('"', '\"', $value);  
					    	#$value	=htmlentities($value);
					    	
					    	
					    
					        $eval	="$"."this->sys_fields[\"$field\"]"."[\"value\"]=\"$value\";";
					        #$this->__PRINT_R($eval);
							if(@eval($eval)===false)	
								echo ""; #$eval; ---------------------------					
					    }
			        }
			    }    
			}	
    	}
		##############################################################################	
		##  METODOS	
		##############################################################################
		public function __TABLE_MAIL($option)
		{


		}
		public function __VIEW($template)
		{ 
			#/*
			if (isset($_COOKIE)) 
			{
				#$this->__PRINT_R($_COOKIE);
			}			
			#*/
			
			$words["system_message"]				="";
			$words["system_js"]						="";
			$words["sys_date"]						=$this->sys_date;

			#$this->__PRINT_R($this->__SAVE_JS);
			
			#if(@$this->sys_vpath==$this->sys_name."/" AND @$this->request["sys_action"]=="__SAVE" AND ($this->request["sys_section"]=="create" OR $this->request["sys_section"]=="write"))
			if(@$this->sys_vpath==$this->sys_name."/" AND @$this->sys_action=="__SAVE" AND ($this->sys_section=="create" OR $this->sys_section=="write"))				
			{
		        $words["system_message"]    		=@$this->__SAVE_MESSAGE;
		        $words["system_js"]     			=@$this->__SAVE_JS;		        
		        #$this->__PRINT_R(@$this->__SAVE_JS);
			}
			
			if(array_key_exists("user",$_SESSION))
			{ 				
			    if(@$_SESSION["user"]!="Invitado" AND count($_SESSION["user"])>1)
			    {			    			    			    
				    $words							=$this->__MENU($words);
				    
				    $words["system_logo"]           ="";
				    
				    if(isset($_SESSION["company"]["razonSocial"]))
				    {
					    $words["system_company"]        =$_SESSION["company"]["razonSocial"];
					    $words["system_user"]           =$_SESSION["user"]["name"];
					    #$words["system_logo"]           =@$_SESSION["company"]["img_files_id_med"];
					    $words["system_img"]           	=$this->__HTML_USER();
					    $words["sys_page"]           	=@$this->request["sys_page"];
					    $words["companys"]           	=@$this->__COMPANYS();
					}
			    }
			    else
			    {
			    	$_SESSION["company"]			=array("razonSocial");
			    }	
            }
			if(!isset($words["system_submenu2"]))  	$words["system_submenu2"]		="";
			if(!isset($words["html_head_css"]))  	$words["html_head_css"]			="";
				
			$words=array_merge($this->words,$words);
			
			$template                   			=$this->__REPLACE($template,$words); 			
			
			if(@$this->request["sys_action"]=="print_pdf")
		    {
		    	
		    	$_SESSION["pdf"]	=array(		    					
					"title"		=>$this->words["module_title"],
					"subject"	=>$this->words["html_head_title"],				
					"template"	=>$template,
		    	);
				#$_SESSION["html"]	="<table><tr><td>Eduardo Vizcaino</td></tr></table><table><tr><td>granados</td></tr></table>";
				$url 				= 'nucleo/tcpdf/crear_pdf.php';				
				$path				.="../$url";
				
				header('Location:'.$path);		
				exit;
			}
			#else	
			echo $template;	
		    
    	}
    	 
        ##############################################################################
		public function __REPORT_TITLES($sys_order,$sys_torder,$font,$name)
		{  

			$iorder									="";			
			$title									=@$this->sys_fields[$font]["title"];
			
			#$this->__PRINT_R($this->sys_fields_l18n);
						
        	if(isset($this->sys_fields_l18n) AND is_array($this->sys_fields_l18n) AND isset($this->sys_fields_l18n["$font"]))	
        	{			        	
        		$title								=$this->sys_fields_l18n["$font"];
        	}
						
			if($sys_order==@$this->request["sys_order_$name"])
			{
			     if($sys_torder=="ASC") 			$iorder 						="<font class=\"ui-icon ui-icon-carat-1-n\"></font>";
			     else                   			$iorder 						="<font class=\"ui-icon ui-icon-carat-1-s\"></font>";
			}

			$base="";

		    $sys_action     						=@$this->request["sys_action"];		   

			if(@$this->request["sys_action"]=="print_excel")
		    {
				return "
					<div name=\"title_$name\" style=\"height:25px;\">
							<b><font class=\"sys_order\" name=\"$name\" sys_order=\"$sys_order\" sys_torder=\"$sys_torder\">$title</font><b>
					</div>
				";
			}
			if(@$this->request["sys_action"]=="print_pdf")
		    {
				return "
					<div name=\"title_$name\" style=\"width:10px;\">
						<font class=\"sys_order\" name=\"$name\" sys_order=\"$sys_order\" sys_torder=\"$sys_torder\">$title</font>
					</div>
				";
			}			
			else
			{
				return "
					<div name=\"title_$name\" style=\"position:static; overflow:hidden; height:40px;\">
						<div class=\"\" style=\"position:absolute; top:0px; left:0px; width:250px; height:40px; overflow:hidden;\">	
						<table width=\"100%\">
							<tr>
								<td height=\"40\"><b><font class=\"sys_order\" name=\"$name\" sys_order=\"$sys_order\" sys_torder=\"$sys_torder\">$title</font><b></td> 
								<td>$iorder</td>
							</tr>
							<tr>
								<td colspan=\"2\"> 
									<input id=\"sys_filter_$name\" class=\"formulario\"> 
								</td>
							</tr>
							
						</table>
						</div>
					</div>
				";
			
			}

		}	
		public function __MENU($words)
		{  			
			$option_conf=array();

			$option_conf["open"]	=1;
			$option_conf["close"]	=1;			

			if(@$_SESSION["company"] AND @$_SESSION["company"]["id"])
			{
				$comando_sql        ="
		            select
		            	distinct(m.id) as id_m, 
			            m.*,
			            count(a.menu_id) as c_menu_id
		            from 
			            users u join 
			            user_group ug on u.id=ug.user_id join
			            groups g on g.id=ug.active and g.name!='No activar' join
			            menu m on m.id=g.menu_id
			            left join alert a on m.id=a.menu_id AND a.company_id={$_SESSION["company"]["id"]} AND a.status !=0
		            WHERE  1=1
			            AND ug.active!=0
			            AND u.id={$_SESSION["user"]["id"]}
			        GROUP BY  m.id    
				";
				$datas_menu =$this->__EXECUTE($comando_sql, $option_conf);			
			
				$menu_html								="";
				foreach($datas_menu as $data_menu)
				{
					$link								=$data_menu["link"]."&sys_menu=".$data_menu["id"];				
					$alertas="";
					if($data_menu["c_menu_id"]>0)
						$alertas="
							<div style=\"color:white; float:left; margin-left:5px; background-color:red; border-radius: 15px; width:15px; align:center; padding:0px 2px 0px 2px;\">
								<center>{$data_menu["c_menu_id"]}</center>	
							</div>					
						";				
					$menu_html.="				
						<a href=\"{$link}\">	
						<div class = \"menuHorizontal\" style=\"margin-top:4px; float:left; padding:5px 10px 5px 10px;\">
							<div style=\"float:left;\">
							{$data_menu["name"]}
							</div>
							$alertas
						</div>
						</a>
					";	
				}
				$words["system_menu"]		    		=$menu_html;
						
				$sys_menu								=@$_SESSION["sys"]["menu"];			
				$comando_sql        ="
		            select 
		            	m.id as id_m, 
			            m.*,
			            count(a.submenu_id) as c_submenu_id
		            from 
			            users u join 
			            user_group ug on u.id=ug.user_id join
			            groups g on g.id=ug.active join
			            permiso p on p.usergroup_id=ug.active AND p.s=1 join
			            menu m on m.id=p.menu_id
			            left join alert a on m.id=a.submenu_id AND a.company_id={$_SESSION["company"]["id"]}  AND a.status !=0
		            WHERE  1=1
			            AND ug.active!=0
			            AND u.id={$_SESSION["user"]["id"]}
			            AND parent='$sys_menu'
			            AND m.type='submenu'
			        GROUP BY  m.id        
				";
				
				#echo $comando_sql;
				
				$datas_submenu =$this->__EXECUTE($comando_sql,$option_conf);
									
				$submenu_html							="";
			
				foreach($datas_submenu as $data_submenu)
				{
					$alertas="";
					if(@$data_submenu["c_submenu_id"]>0)
						$alertas="
							<div style=\"color:white; float:right; margin-right:10px; background-color:red; border-radius: 15px; width:15px; align:center; padding:0px 2px 0px 2px;\">
								<center>{$data_submenu["c_submenu_id"]}</center>	
							</div>					
						";				

					$submenu_html	="
						$submenu_html
						<div style=\"height:25px;\" class=\"submenu\" active=\"{$data_submenu["name"]}\">	
							<div style=\"float:left;\">
								<font style=\"padding-left:5px; color:SteelBlue; font-size:13; font-weight:bold;\">
									{$data_submenu["name"]}
								</font>
							</div>
							$alertas
						</div>
					";
				
					#$datas_opcion  						=$menu->opcion_sesion($data_submenu["id"]);
				
					$comando_sql        ="
				        select
				        	distinct(m.id) as id_m,  
					        m.*,
					        count(a.opcion_id) as c_opcion_id
				        from 
					        users u join 
					        user_group ug on u.id=ug.user_id join
					        groups g on g.id=ug.active join
					        permiso p on p.usergroup_id=ug.active join
					        menu m on m.id=p.menu_id 
					        left join alert a on m.id=a.opcion_id AND a.company_id={$_SESSION["company"]["id"]}  AND a.status !=0
				        where  1=1
					        AND ug.active!=0
					        AND u.id={$_SESSION["user"]["id"]}
					        AND parent={$data_submenu["id"]}
					        AND m.type='opcion'
					    GROUP BY  m.id            
					";
					$datas_opcion =$this->__EXECUTE($comando_sql,$option_conf);
				
					$option_html	="";
					foreach($datas_opcion as $data_opcion)
					{
						$alertas="";
						if(@$data_opcion["c_opcion_id"]>0)
							$alertas="
								<div style=\"color:white;float:right; margin-right:10px; background-color:red; border-radius: 15px; width:15px; align:center; padding:0px 2px 0px 2px;\">
									<center>{$data_opcion["c_opcion_id"]}</center>	
								</div>					
							";				


						$option_html	.="
							<a href=\"{$data_opcion["link"]}&sys_menu={$sys_menu}\">
								<div class=\"submenu2\">
									{$data_opcion["name"]}
									$alertas
								</div>
							</a>
						";
					}	
					$submenu_html	="
						$submenu_html
						<div class=\"option d_none\"  active=\"{$data_submenu["name"]}\">
							$option_html
						</div>
					";
				}
				$words["system_submenu"]	    		=$submenu_html;
			
				#$this->__PRINT_R($words);
			}			
			return $words;
		} 

		public function __COMPANYS()
		{ 
			$option_conf=array();

			$option_conf["open"]	=1;
			$option_conf["close"]	=1;
				
			$comando_sql = "
				SELECT 
					id, 
					razonSocial 
				FROM 
					company
				WHERE 
					razonSocial is not null"; 

		    $datas              =$this->__EXECUTE($comando_sql, $option_conf);
			
		    foreach($datas as $data)
		    {    
		    	$selected="";
		    	if($_SESSION["company"]["id"]==$data["id"])
		    		$selected="selected";
		    	$vOption = $vOption."<option value=\"".$data["id"]."\"  $selected >".$data["id"]." :: ".$data["razonSocial"]."</option>";		    	
		    }

			$vRespuesta = "	<select id = \"setting_company\" system=\"yes\" name = \"setting_company\">".$vOption."</select>";

			$permisos=$_SESSION["group"];
			$return="";
			foreach($permisos as $permiso)
			{
				if($permiso["menu_id"]==$this->request["sys_menu"] AND $permiso["nivel"]<=10)
				{
					$return=$vRespuesta;
				}
			}




			return $return;
		} 

        ##############################################################################

		public function __REQUEST()
		{  
			# ASIGNA TODAS LAS VARIABLES QUE CONTENGAN VALOR
			# AL ARRAY DECLARADO $this->sys_fields EN EL MODEDLO
			# O CREANDO UNA NUEVA PROPIEDAD 
			foreach($_REQUEST as $campo =>$valor)
			{
				if(!($valor=="" OR $valor=="undefined"))
				{					
					if(!is_array($valor)) $valor=htmlentities($valor);
					
					$this->request["$campo"]		=$valor;										
					if(is_array($valor))
					{						
						$eval="
							if(is_array(@$"."this->sys_fields[\"$campo\"]))	
							{
								$"."this->sys_fields[\"$campo\"]"."[\"value\"]=$"."valor;
							}									
						";					
					}
					else
					{		
						$eval="
							if(is_array(@$"."this->sys_fields[\"$campo\"]))	
							{
								$"."this->sys_fields[\"$campo\"]"."[\"value\"]=\"$valor\";
							}		
							else
							{
								$"."this->$campo=\"$valor\";
							}							
						";
					}	
					#$this->__PRINT_R($eval);
					#eval($eval);
				    if(@eval($eval)===false)	
				    	echo ""; #$eval; ---------------------------					
				}	
			}
			if(is_array(@$this->sys_fields))
			{
				foreach(@$this->sys_fields as $campo =>$valor)
				{
					if($this->sys_fields[$campo]["type"]=="checkbox" and $this->sys_fields[$campo]["value"]=="")
					{					
						$eval="
							$"."this->sys_fields[\"$campo\"][\"value\"]=\"0\";
							$"."this->$campo=\"0\";
							$"."this->request[\"$campo\"]=\"0\";
						";
						if(eval($eval)===false)	
							echo ""; #$eval; ---------------------------					
					}
				}
			}
			if(is_array($_FILES))
			{
				$this->request["files"]=array();				
				foreach($_FILES as $valor)
				{
					$this->request["files"]			=$valor;						
				}	
			}	
			
			if(isset($this->request["sys_menu"]))
			{
				$_SESSION["sys"]["menu"]			=$this->request["sys_menu"];
			}	
			
			if(!isset($this->request["sys_view"]))	$this->request["sys_view"]	="";	
		} 
		##############################################################################
		public function __VIEW_TEMPLATE($template,$words)
		{  
			# CON LA PLANTILLA BASE, 
			# CARGA LA PLANTILLA INDICADA
			# VERIFICANDO QUE LA SOLICITUD, NO SEA UNA, IMPRESION, EXCEL, O PDF
			
		    $view   								=$this->__TEMPLATE("sitio_web/html/index");		    
		    if(@$this->request["sys_action"]=="print_pdf")
		    {
				$view="{system_template}";
			}	
		    
		    $sys_action     						=@$this->request["sys_action"];
		    
		    if(@$this->request["sys_action"]=="print_excel")
		    {
				header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
				header("Content-Disposition: attachment;filename=\"{$words["module_title"]}.xlsx\"");
				header("Cache-Control: max-age=0");		    
		    	$sys_action							="print_report";
		    }
		    if(@$this->request["sys_action"]=="print_pdf")
		    {
		    	/*
				header("Content-Type: application/pdf");
				header("Content-Disposition: attachment;filename=\"filename.pdf\"");
				header("Cache-Control: max-age=0");		    
				*/
		    	$sys_action							="print_report";
		    }		    
		    $path           						="sitio_web/html/$sys_action";
		    
		    if(file_exists($path.".html"))			
		    {
		        $template="$sys_action";
		        #if(@$this->request["sys_action"]!="print_excel")
			        #$words["system_js"]				="window.print();";
		    }    		    
		    
		    $array  								=array("system_template"=> $this->__TEMPLATE("sitio_web/html/$template"));
		    $words									=array_merge($array,$words);
		    
            return $this->__REPLACE($view,$words);
    	} 
    	##############################################################################
		function __TEMPLATE($form=NULL)
		{
			# RETORNA UNA CADENA, QUE ES LA PLANTILLA
			# DE LA RUTA ENVIADA		
	    	if(!is_null($form))
	    	{
	    		$archivo = $form.'.html';
	    		if(@file_exists($archivo))			    			
		    		$return 						= file_get_contents($archivo);		    
	    		elseif(@file_exists("../".$archivo))			    			
		    		$return 						= file_get_contents("../".$archivo);		    		    		
	    		elseif(@file_exists("../../".$archivo))			    			
		    		$return 						= file_get_contents("../../".$archivo);		    		    		
	    		elseif(@file_exists("../../../".$archivo))			    			
		    		$return 						= file_get_contents("../../../".$archivo);		    		    		
	    		elseif(@file_exists("../../../../".$archivo))			    			
		    		$return 						= file_get_contents("../../../../".$archivo);		    		    				    		
		    	else	
		    		$return							="<br>NO EXISTE EL ARCHIVO: ".$archivo;
		    }	
		    else	$return							="";		    		
		    return $return;
		}		
		##############################################################################
		function send_mail($option)
		{
			if(!isset($option["title"]))	$option["title"]="SolesGPS :: Sistema";
			if(!isset($option["from"]))		$option["from"]	="contacto@solesgps.com";
			if(!isset($option["bbc"]))		$option["bbc"]	="evigra@gmail.com";
			
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			
			if(isset($option["from"]))		$headers .= "From: <{$option["from"]}>\r\n";
			if(isset($option["cc"]))		$headers .= "Cc: {$option["cc"]}\r\n";
			if(isset($option["bbc"]))		$headers .= "bbc: {$option["bbc"]}\r\n";
			#if(isset($option["reply"]))		$headers .= "Reply-To: {$option["reply"]}\r\n";
			
			
			$serv_propio=array("www.solesgps.com","solesgps.com","www.soluciones-satelitales.com","soluciones-satelitales.com");
			if(in_array($_SERVER["SERVER_NAME"],$serv_propio))	
				$boSend =  @mail($option["to"], $option["title"], $option["html"], $headers);

			/*
			if(!$boSend) 
			{
				throw new Exception('Email fail');
			} 
			*/			
		}		
		##############################################################################
		public function __REPLACE($str,$words)
		{  
			# REMPLAZA Y RETORNA LAS PALABRAS CLAVE
			# EN UNA CADENA, ESTA CADENA POR LO REGULAR ES UNA VISTA
			if(is_array($words))
			{
				$return								=$str;
				foreach($words as $word=>$replace)
				{
		        	if(isset($this->sys_view_l18n) AND is_array($this->sys_view_l18n) AND isset($this->sys_view_l18n["$word"]))	
		        		$replace					=$this->sys_view_l18n["$word"];
		        	if(is_array($replace))	$replace="";	
		        	
					$return							=str_replace("{".$word."}", $replace, $return);     	    	
				}
			}	
			else
				$return								="ERROR:: La funcion __REPLACE necesita un array para remplazar";
			return $return;
		} 		
		##############################################################################
		public function __PRE_SAVE()
    	{
			# ENVIA UN ARRAY AL METODO SAVE
			# DE LAS VARIABLES DECLARADAS EN EL MODELO 
			# $this->sys_fields

			$fields	=$this->__FIELDS();		
    					
			$opcion=array(
				"message"=>"DATOS GUARDADOS",
			);	
			$this->__SAVE($fields, $opcion);
    	}
		##############################################################################    
		public function __FIELDS()
    	{
			# RETORNA UN ARRAR DE LOS CAMPOS Y LOS VALORES 
			# DE LAS VARIABLES DECLARADAS EN EL MODELO 
			# $this->sys_fields
    	
			$this->__VARS();
			$datas		=$this->sys_fields;
			$return		=array();
    		foreach($datas as $campo=>$valor)
    		{
    			if(isset($valor["value"]) and $valor["value"]!="")
    			{
    				$return[$campo]=$valor["value"];
    			}
    		}    		
    		return $return;
    	}
    	##############################################################################    
		public function __VARS()
		{	
			# RECOGE LAS VARIABLES ENVIADAS DESDE EL FORM, 
			# ASIGNANDO UNICAMENTE LAS DECLARADAS EN EL MODELO 
			# $this->sys_fields
			
			foreach($this->sys_fields as $campo=>$valor)
			{
				if(!isset($this->request["$campo"]))		$this->request["$campo"]="";
				else $this->sys_fields["$campo"]["value"]	=$this->request["$campo"];
			}		
		}    

    	##############################################################################    
		public function __INPUT($words=NULL, $fields=NULL)
		{				    
		    if(!is_array($words))    $words=array();
		    if(is_array($fields))
		    {
			    foreach($fields as $campo=>$valor)
			    {		
			        if(!isset($valor["type"]))	        $valor["type"]			="input";
			        if(!isset($valor["showTitle"]))	    $valor["showTitle"]		="si";
			        if(!isset($valor["title"]))	    	$valor["title"]			="";
			        if(!isset($valor["value"]))	    	$valor["value"]			="";
			        if(!isset($valor["source"]))	   	$valor["source"]		="";
			        if(!isset($valor["holder"]))	   	$valor["holder"]		="";
			        if(!isset($valor["attr"]))	   		$valor["attr"]			="";
			        
			        if(!is_array($valor["value"]))
			        {
			        	if(!isset($valor["description"]))	$valor["description"]="";
			        	
			        	$description	=$valor["description"];
			        	
			        	$attr="";
			        	if(is_array($valor["attr"]))
			        	{	
			        		foreach($valor["attr"] as $attr_field => $attr_value)
			        		{
			        			$attr.=" $attr_field='$attr_value'";
			        		}			        	
			        	}			        				        	
					    if(in_array($valor["showTitle"],$this->sys_true))	
					    {			        
					    	if(is_array($this->sys_fields_l18n) AND isset($this->sys_fields_l18n["$campo"]))	
					    	{			        	
					    		$valor["title"]		=$this->sys_fields_l18n["$campo"];
					    	}	


							if($valor["type"]=="txt")	$titulo					="{$valor["title"]}";			        	
							else						$titulo					="<font id=\"$campo\" style=\"color:gray;\">{$valor["title"]}</font><br>";			        	
					    	
					    }	
					    else                                				$titulo					="";
					    
					    if($valor["type"]=="input")	
					    {			        	
					        #$words["$campo"]  ="$titulo<input id=\"$campo\"  type=\"text\" name=\"$campo\" value=\"{$valor["value"]}\" placeholder=\"{$valor["holder"]}\" class=\"formulario\" >";
					        $words["$campo"]  ="<input id=\"$campo\" title=\"$description\" type=\"text\" name=\"$campo\" $attr value=\"{$valor["value"]}\" class=\"formulario  {$this->sys_name}\"><br>$titulo";
					    } 
					    if($valor["type"]=="date")	
					    {
					        #$words["$campo"]  ="$titulo<input id=\"$campo\" type=\"text\" name=\"$campo\" value=\"{$valor["value"]}\" placeholder=\"{$valor["holder"]}\" class=\"formulario\" >";
					        $words["$campo"]  ="
					        	<input id=\"$campo\" type=\"text\" name=\"$campo\" title=\"$description\" $attr value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name}\"><br>$titulo
			        			<script>
									$(\"input#$campo\").datepicker({dateFormat:\"yy-mm-dd\"});
					        	</script>			            	
					        	";
					    } 
					    
					    if($valor["type"]=="checkbox")	
					    {
					        //$words["$campo"]  ="<input id=\"$campo\" type=\"checkbox\" name=\"$campo\" class=\"formulario\"><br>$titulo";
					        $checked="";
					        if($valor["value"]==1) $checked="checked";

					    	$words["$campo"]  = 
					        "<div class=\"checkbox-2\">
		    					<input type=\"checkbox\" id=\"$campo"."c\" $attr title=\"$description\" $checked value=\"1\" name=\"$campo\" />
		    				 <label for=\"$campo"."c\">".""."</label>
							</div>
							$titulo
							";


					    }      
					    if($valor["type"]=="file")	
					    {
					        $words["$campo"]  ="$titulo<input id=\"$campo\" name=\"$campo\" $attr type=\"file\" class=\"formulario\">";
					        $words["$campo"]  ="<input id=\"$campo\" title=\"$description\" name=\"$campo\" type=\"file\" class=\"formulario {$this->sys_name}\"  placeholder=\"{$valor["holder"]}\"><br>$titulo";
					    }    

					    if($valor["type"]=="font")	
					    {
					        $words["$campo"]  ="$titulo<div id=\"$campo\" $attr style=\"height:22px;\"> {$valor["value"]}</div><br>&nbsp;";
					    } 
					    if($valor["type"]=="txt")	
					    {	
					        $words["$campo"]  ="$titulo";
					    } 
					    
					    if($valor["type"]=="textarea")	
					    {
					        $words["$campo"]  ="<textarea id=\"$campo\" $attr title=\"$description\" name=\"$campo\" class=\"formulario {$this->sys_name}\" style=\"height:150px;\" placeholder=\"{$valor["holder"]}\">{$valor["value"]}</textarea><br>$titulo";
					    } 			           
					    if($valor["type"]=="password")	
					    {
					        $words["$campo"]  ="$titulo<input type=\"password\" $attr id=\"$campo\" name=\"$campo\" value=\"{$valor["value"]}\" class=\"formulario\">";
					        $words["$campo"]  ="<input type=\"password\" title=\"$description\" id=\"$campo\" name=\"$campo\" value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name}\"><br>$titulo";
					    }    
					    if($valor["type"]=="select")	
					    {
					        $options="";
					        
					        foreach($valor["source"] as $value =>$text)
					        {
					        	$selected="";
					        	if($valor["value"]==$value) $selected="selected";
					        	$options.="<option value=\"$value\" $selected>$text</option>";			            
					        }			            
						        $words["$campo"]  ="<select id=\"$campo\" $attr title=\"$description\" name=\"$campo\"  class=\"formulario {$this->sys_name}\">
					        		$options
					        	</select><br>$titulo
					        ";
					    }			        
					    if($valor["type"]=="autocomplete")	
					    {
					    	if(!isset($fields["auto_$campo"]["value"]))	$fields["auto_$campo"]["value"]="";
					    	
					    	
					    	
					    	$json=$this->__JSON_AUTOCOMPLETE($valor);
					    	
					    	if(isset($this->request["auto_$campo"]))	$fields["auto_$campo"]["value"]	=$this->request["auto_$campo"];
					    	else										$fields["auto_$campo"]["value"]	=@$json[0]->label;
					    	
					    	if(isset($this->request["$campo"]))			$fields["$campo"]["value"]		=$this->request["$campo"];
					    	else										$fields["$campo"]["value"]		=@$json[0]->clave;
					    	
					    	$label	=$fields["auto_$campo"]["value"];
					    	#$label	=$value["value"]["0"][  $value["class_field_l"]  ];

					    	
										    	
					    	if(isset($fields["$campo"]["class_field_l"]))
					    	{
					    		if(isset($fields["$campo"]["values"]) AND count($fields["$campo"]["values"])>0)
					    		{
					    			$label=$fields["$campo"]["values"][0][$fields["$campo"]["class_field_l"]];
					    		
					    		}
					    	}

					    	#$this->__PRINT_R($valor);
					        $words["$campo"]  ="					        	
					        	<input id=\"auto_$campo\" type=\"text\"  $attr name=\"auto_$campo\" title=\"$description\" value=\"$label\" class=\"formulario {$this->sys_name}\"  placeholder=\"{$valor["holder"]}\"><br>$titulo
					        	<input id=\"$campo\" name=\"$campo\" value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name}\" type=\"hidden\">
					        	<script type=\"\">
									$(\"input#auto_$campo\").autocomplete(
									{		
										source:\"{$valor["source"]}\",
										dataType: \"jsonp\",
										select: function( event, ui ) // CUANDO SE SELECCIONA LA OPCION REALIZA LO SIGUIENTE
										{	
											$(\"input#$campo\").val(ui.item.clave);					
											$(\"input#auto_$campo\").val(ui.item.label);										
										}				
									});				            	
					        	</script>
					        ";
					    }    
					    if($valor["type"]=="class")	
					    {					    
							if(isset($valor["relation"]) AND $valor["relation"]=="one2many")
							{
								$eval="";
								$eval.="
									$"."this->$campo"."_obj				=new {$valor["class_name"]}();									
									$"."this->$campo"."_obj->sys_module	=\"{$valor["class_name"]}\";
								";	
								if(isset($valor["template_title"]));
								{
									$eval.="
										$"."option[\"template_title\"]		=	\"". $valor["template_title"] ."\";
										$"."option[\"template_body\"]		=	\"". $valor["template_body"] ."\";
									";
								}
								if(array_key_exists("template_search",$valor) AND $valor["template_search"]!="")
								{																	
									$eval.="$"."option[\"template_search\"]		=	\"{$valor["template_search"]}\";";
								}
								if(array_key_exists("template_create",$valor) AND $valor["template_create"]!="")
								{									
									$eval.="$"."option[\"template_create\"]		=	\"". $valor["template_create"] ."\";";
								}	
								$eval.="
									$"."data			=	$"."this->$campo"."_obj->reporte($"."option);
								";
								if(@eval($eval)===false)	
									echo ""; #$eval; ---------------------------								        			
							}			        		
					    	$words["$campo"]  =$data["html"];
					    }					    
					    if($valor["type"]=="hidden")	
					    {
					        $words["$campo"]  ="<input type=\"hidden\" id=\"$campo\" name=\"$campo\" value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name}\">";
					    }    
					    if($valor["type"]=="img")	
					    {
					        $words["$campo"]  ="$titulo<img id=\"$campo\" name=\"$campo\" src=\"{$valor["value"]}\">";
					    }    
					}
			        
			    }
			}    
			else $words="ERROR :: No se asigno el array de campos $"."this->sys_fields";
			return $words;
		}   		
    	##############################################################################    
		public function __INPUT_TYPE($type=NULL, $fields=NULL)
		{
			if(is_null($fields))
			{
				foreach($this->sys_fields as $field=>$value)
					$this->sys_fields[$field]["type"]=$type;
			}				
			else
			{
				foreach($fields as $field)
					$this->sys_fields[$field]["type"]=$type;
			}
		}
    	##############################################################################    
		public function __VIEW_OPTION($data)
		{
			$view="";
			foreach($data as $row)			
			{
				if($row["type"]=="menu")	$view   .=$this->__TEMPLATE("sitio_web/html/menu_option");
				else						$view   .=$this->__TEMPLATE("sitio_web/html/menu_link");
				$view	=$this->__REPLACE($view,$row);				
			}		
			return $view;
		}    	

    	##############################################################################    
		public function __VIEW_CREATE($template)
		{
			$view   =$this->__TEMPLATE("$template");
			$view	=$this->__VIEW_INPUTSECTION($view);
			return $view;
		}    	
    	##############################################################################    
		public function __VIEW_WRITE($template)
		{
			$view   =$this->__TEMPLATE("$template");
			$view	=$this->__VIEW_INPUTSECTION($view);
			
			return $view;
		}    	
		public function __VIEW_INPUTSECTION($view)
		{								
			$sys_section	=@$this->request["sys_section_".$this->sys_name];
			$sys_action		="";
			$sys_id			=@$this->request["sys_id_".$this->sys_name];
		
			$view.="
				<input id=\"sys_section_{$this->sys_name}\" system=\"yes\"  name=\"sys_section_{$this->sys_name}\" value=\"{$sys_section}\" type=\"hidden\">
				<input id=\"sys_action_{$this->sys_name}\" system=\"yes\" name=\"sys_action_{$this->sys_name}\" value=\"{$sys_action}\" type=\"hidden\">
				<input id=\"sys_id_{$this->sys_name}\" system=\"yes\" name=\"sys_id_{$this->sys_name}\" value=\"{$sys_id}\" type=\"hidden\">
			";			
			return $view;
		}    	

    	##############################################################################    
		public function __VIEW_KANBAN($template,$data,$option=NULL)
		{
		    if(is_null($option))	$option=array();
		    if(!array_key_exists("name",$option))   $option["name"]=$this->sys_name;
		    
		    
		    #$this->__PRINT_R($data);		    
		    
		    $return=$this->__VIEW_KANBAN2($template,$data,$option);
		    $return="
                <div id=\"base_{$option["name"]}\" style=\"position:relative; height:100%; width:100%;\">
                    <div id=\"div_{$option["name"]}\" style=\"height:100px; overflow:hidden; width:100%; \">	
                        $return
                    </div>
                </div>
				<script>
					var alto_{$option["name"]}	    =$(\"#base_{$option["name"]}\").height() -20;
					$(\"div#div_{$option["name"]}\").attr({\"style\":\"height:\"+alto_{$option["name"]}+\"px; overflow:auto; width:100%;\"});													
				</script>                
            ";
		    
		    return $return;
        }
		public function __VIEW_KANBAN2($template,$data,$option=NULL)
		{			
			$view="";
			$class="even";

			if(is_null($option))	$option=array();	
			if(!array_key_exists("name",$option))   $option["name"]=$this->sys_name;
			
			if(is_array($data))
			{
			    foreach($data as $row)			
			    {
					foreach($row as $field=>$fieldvalue)			
					{								
						if($this->sys_primary_field==$field)
						{
							$this->__FIND_FIELDS($fieldvalue);												
						}									
						if(@$this->sys_fields[$field]["type"]=="select")
						{										
							$row[$field]=@$this->sys_fields[$field]["source"]["$fieldvalue"];
						}						
						if(@$this->sys_fields[$field]["type"]=="autocomplete")
						{					
							
					    	if(isset($this->sys_fields[$field]["class_field_l"]))
					    	{					    		
					    		if(isset($this->sys_fields[$field]["values"]) AND count($this->sys_fields[$field]["values"])>0)
					    		{
					    			$row[$field]=$this->sys_fields[$field]["values"][0][$this->sys_fields[$field]["class_field_l"]];
								}
								else $row[$field]="";
							}				
							else $row[$field]="";
			
							if(isset($this->sys_fields[$field]["values"][0]))
								$row[$field]	=$this->sys_fields[$field]["values"][0][$this->sys_fields[$field]["class_field_l"]];
							else $row[$field]="";
							
							
							/*
							$this->sys_fields[$field]["value"]=$fieldvalue;
							
							$json				=$this->__JSON_AUTOCOMPLETE($this->sys_fields[$field]);							
							
							$this->__PRINT_R($this->sys_fields[$field]);	
							if(@$json[0]->label!="Sin resultados para ")		$row["auto_$field"]	=@$json[0]->label;
							else												$row["auto_$field"]	="";
							*/
						}	
						
						
						
					}			    
                    if($class=="odd")   
                    {
                    	$class="even";
                    	$style="background-color:#D5D5D5; height:30px;";	
                    }	
                    else                
                    {
                    	$class="odd";
                    	$style="background-color:#E5E5E5; heigth:30px;";	
                    }	
                    
                    $actions				=array();
                    $colors					=array();
                    if(substr(@$this->request["sys_action"],0,5)!="print")	              
	                    $actions["sys_class"]		=$class;
	                else    
	                    $actions["style_tr"]	=$style;
                    
                    				
                    $show	="<font data=\"&sys_section_{$this->sys_name}=show&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\"  class=\"sys_report ui-icon ui-icon-contact\"></font>";
                    $write	="<font data=\"&sys_section_{$this->sys_name}=write&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\"  class=\"sys_report ui-icon ui-icon-pencil\"></font>";
                    $delete	="<font data=\"&sys_section_{$this->sys_name}=delete&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\"  class=\"sys_report ui-icon ui-icon-trash\"></font>";
                    $check	="<input type=\"checkbox\" id=\"{$option["name"]}\" name=\"{$option["name"]}[]\" value=\"{id}\">";
                    
                    if(!is_null($option))
                    {
                    	if(!isset($option["actions"]))				$option["actions"]=array();	
                    	if(!isset($option["actions"]["show"]))		$option["actions"]["show"]	="1==1";
                    	if(!isset($option["actions"]["write"]))		$option["actions"]["write"]	="1==1";
                    	if(!isset($option["actions"]["delete"]))	$option["actions"]["delete"]="1==1";
                    	if(!isset($option["actions"]["check"]))		$option["actions"]["check"]	="1==1";
                    	$eval="
                    		if({$option["actions"]["show"]}) 	$"."show='$show';
                    		else								$"."show='';
                    		if({$option["actions"]["write"]}) 	$"."write='$write';
                    		else								$"."write='';
                    		if({$option["actions"]["delete"]}) 	$"."delete='$delete';
                    		else								$"."delete='';                    		
                    		if({$option["actions"]["check"]}) 	$"."check='$check';
                    		else								$"."check='';                    		
                    	";
                    	$eval_color="";
                    	if(!isset($option["color"]))				$option["color"]=array();
                    	
                    	if(!isset($option["color"]["black"]))		$option["color"]["black"]="1==1";
                    	
                    	foreach($option["color"] as $color => $filter)
                    	{
                    		if($eval_color=="")	$eval_color="if({$option["color"]["$color"]}) 			$"."colors[\"style_td\"]='color:$color;';";
                    		else 				$eval_color.="else if({$option["color"]["$color"]}) 	$"."colors[\"style_td\"]='color:$color;';";
                    	}
                    	
                    	$eval.=$eval_color;
                    	#echo "$eval";
                    	if(@eval($eval)===false)	
				    	echo ""; #$eval; ---------------------------					
				    	
				    	

                    }
                    if(substr(@$this->request["sys_action"],0,5)!="print")
                    {
						$actions["actions"]	="
							<table class=\"cBotones cBodyReport\">
								<tr>
									<td class=\"cAction\" align=\"center\" width=\"22\" style=\"border-radius:10px 10px 10px 10px;\" title =\"{actions_selected}\">	
										$check
									</td>								
									<td class=\"cAction\" align=\"center\" width=\"22\"  style=\"border-radius:10px 10px 10px 10px;\"  title =\"{actions_show}\">	
										$show			
									</td>
									<td class=\"cAction\" align=\"center\" width=\"22\" style=\"border-radius:10px 10px 10px 10px;\" title =\"{actions_write}\">	
										$write
									</td>
									<td class=\"cAction\" align=\"center\" width=\"22\" style=\"border-radius:10px 10px 10px 10px;\" title =\"{actions_delete}\">	
										$delete
									</td>					    		
								</tr>
							</table>
						";
						$actions["actionsv"]	="
							<table class=\"cBotones actionsv\" style=\"display:none;\">
								<tr><td align=\"center\" class=\"cAction\" width=\"22\" style=\"border-radius:10px 10px 10px 10px;\" title =\"{actions_selected}\">$check</td></tr>
								<tr><td align=\"center\" class=\"cAction\" width=\"22\" style=\"border-radius:10px 10px 10px 10px;\" title =\"{actions_show}\">$show</td></tr>
								<tr><td align=\"center\" class=\"cAction\" width=\"22\" style=\"border-radius:10px 10px 10px 10px;\" title =\"{actions_write}\">$write</td></tr>
								<tr><td align=\"center\" class=\"cAction\" width=\"22\" style=\"border-radius:10px 10px 10px 10px;\" title =\"{actions_delete}\">$delete</td></tr>
							</table>
						";
					}
					else
					{
						$actions["actionsv"]	="";
						$actions["actions"]		="";
					}                   
                    
                    $row = array_merge($actions, $row);
                    $row = array_merge($colors, $row);
                    #$this->__PRINT_R($this->sys_fields_l18n);
                    
				    if(@$html_template=="")  
				    {
				    	$html_template  =$this->__TEMPLATE("$template");
				    	$html_template	=str_replace("<td>", "<td style=\"{style_td}\" >", $html_template);				    	
				    }	

				    $view   .=$html_template;
				    $view	=$this->__REPLACE($view,$row);				
			    }		

	        	if(isset($this->sys_view_l18n) AND is_array($this->sys_view_l18n))	
	        	{
	        		#$actions_lang["actions_selected"]	=$this->sys_view_l18n["actions_selected"];
	        		$actions_lang["actions_show"]		=$this->sys_view_l18n["actions_show"];
	        		$actions_lang["actions_write"]		=$this->sys_view_l18n["actions_write"];
	        		$actions_lang["actions_delete"]		=$this->sys_view_l18n["actions_delete"];
	        				        		
	        		#$row 	= array_merge($actions_lang, $row);
					$view	=$this->__REPLACE($view,$actions_lang);
	        	}                                        			    
			}    
			$view =$this->__VIEW_INPUTSECTION($view);
			return $view;
		}    	
    	##############################################################################    
		public function __VIEW_SHOW($template)
		{
			$this->__INPUT_TYPE("font");
			$view   =$this->__TEMPLATE("$template");
			$view	=$this->__VIEW_INPUTSECTION($view);
			return $view;
		} 		
    	##############################################################################        
		public function __VIEW_REPORT($option)
		{
			$return=array();
		    $view_title="";
		    if(is_array($option))
		    {
				if(isset($option["total"]))		$return["total"]	=$option["total"];
				if(isset($option["inicio"]))	$inicio				=$option["inicio"];
				if(isset($option["fin"]))		$fin				=$option["fin"];
		    	
		        $sys_order="";
		        $sys_torder="";
		    	if(!isset($option["name"]))    	$name	=@$this->sys_name;
		    	else							$name	=$option["name"];
		    	
		    	if(isset($this->request["sys_page_$name"]))		$sys_page	=$this->request["sys_page_$name"];
		    	else											$sys_page	=1;

		    	if(isset($this->request["sys_order_$name"]))	$sys_order	=$this->request["sys_order_$name"];
		    	
		    	if(isset($this->request["sys_torder_$name"]))	$sys_torder	=$this->request["sys_torder_$name"];
		    	
		    	if(isset($this->request["sys_row_$name"]))	    $sys_row	=$this->request["sys_row_$name"];
		    	else                                            $sys_row	=50;

		    	$option["sys_page_$name"]           =$sys_page;		        		        				
				$option["name"]                 =$name;
				
		    	if(isset($option["data"]))          
		    	{
		    		$return["data"] =$option["data"];	
		    	}	
		    	else
		    	{			    		
		    	    #$option["name"]                 =$name;
		    		$browse 						=$this->__BROWSE($option);		    			    		

		    		$return["data"]					= $browse["data"];
		    		$option["title"]				= @$browse["title"];
		    		
		    		if(isset($browse["total"]))		
		    		{
						$return["total"]				= $browse["total"];	
						
						$inicio				            = $browse["inicio"] + 1;
						$aux_fin                        = $inicio + $sys_row -1;
						
						if($aux_fin<$return["total"])   $fin    =$aux_fin;
						else                            $fin    =$return["total"];
					}			    		
		    	}	

				#$this->__PRINT_R($return["data"]);    
				$view_title="";
		    	if(isset($option["template_title"]))    
		    	{
		    	    $view_title     =$this->__TEMPLATE($option["template_title"]);		    	    
		    	    $view_title		=str_replace("<td>", "<td class=\"title\">", $view_title);
		    	    
		    	    if(isset($option["title"]))
		    	    {
		    	    	#$this->__PRINT_R($option["title"]);
			    	    $view_title	    =$this->__REPLACE($view_title,$option["title"]);
			    	}    		    	    
		    	}    
		    	$view_create	="";
		    	$button_create	="";
		    	if(isset($option["template_create"]) AND $option["template_create"] !="")
		    	{
					$this->words               	=	$this->__INPUT($this->words,$this->sys_fields);
		    
		    		$view_create		=	$this->__REPLACE($this->__VIEW_CREATE($option["template_create"]),$this->words);
					$view_create="
            			<div id=\"create_$name\" title=\"Crear Resgistro\" class=\"report_search d_none\" style=\"width:100%; background-color:#373737;\">
	            			$view_create
	            			<script>
	            				$(\"font#create_$name\").click(function()
	            				{
	            					$(\"div#create_$name\").dialog({
	            						open: function(event, ui){
											var dialog = $(this).closest('.ui-dialog');
											if(dialog.length > 0)
											{
												$('.ui-autocomplete.ui-front').zIndex(dialog.zIndex()+1);
											}
										},
	            						width:\"700px\"
	            					});
	            				});
	            			</script>
            			</div>
					";		    	    
					$button_create="
						<td width=\"15\" align=\"center\">
							<font id=\"create_$name\" active=\"$name\" class=\"show_form ui-icon ui-icon-document\"></font>
						</td>	
					";					
		    	}    

		    	$view_search="";
		    	$button_search="";
		    	if(isset($option["template_search"]) AND $option["template_search"] !="")    
		    	{		    		
		    		$this->words["module_body"]     =$this->__VIEW_CREATE($option["template_search"]);
		    		$this->words					=$this->__INPUT($this->words,$this->sys_fields); 

					#$this->__PRINT_R($this->words);

					$view_search					=$this->words["module_body"];
		    		$this->words["module_body"]		="";
		    		
		    	    $view_search     				=$this->__TEMPLATE($option["template_search"]);		    	    
		    	    $view_search					=str_replace("<td>", "<td class=\"title\">", $view_search);
		    	    		    	    
					$view_search="
            			<div id=\"search_$name\" title=\"Filtrar Resgistro\" class=\"report_search d_none\" style=\"width:100%; background-color:#373737;\">
	            			$view_search
	            			<script>
	            				$(\"font#search_$name\").click(function()
	            				{
	            					$(\"div#search_$name\").dialog({
	            						open: function(event, ui){
											var dialog = $(this).closest('.ui-dialog');
											if(dialog.length > 0)
											{
												$('.ui-autocomplete.ui-front').zIndex(dialog.zIndex()+1);
											}
										},
	            						width:\"700px\"
	            					});
	            				});
	            			</script>	            			
            			</div>
					";		    	    
					$button_search="
						<td width=\"25\" align=\"center\">
							<font id=\"search_$name\" active=\"$name\" class=\"show_form ui-icon ui-icon-search\"></font>
						</td>	
					";		    	    
		    	}    
                $view_body="";
		    	if(isset($option["template_body"]))
		    	{    
		    	    $template       =$option["template_body"];
		    	    $option_kanban	=array();
		    	    if(isset($option["actions"]))	$option_kanban["actions"]	=$option["actions"];
		    	    if(isset($option["color"]))		$option_kanban["color"]		=$option["color"];
		    	    if(isset($option["name"]))		$option_kanban["name"]		=$name;

		    	    $view_body=$this->__VIEW_KANBAN2($template,$return["data"],$option_kanban);
		    	}    
                if(isset($inicio) AND $return["total"]>0)
                {                	
                	if(@$this->request["sys_action"]=="print")	$view_head="";                	                
                	else
                	{	
                		$html_filter="";
                		if(isset($option["section_filter"]) )
                		{ 
                			$html_filter="
											<input style=\"paddin:8px; height:23px;\" name=\"sys_filter_$name\" system=\"yes\" id=\"sys_filter_$name\" class=\"formulario $name\" type=\"text\"  placeholder=\"Filtrar reporte\">													
										</td>
										<td width=\"30\">
											<font id=\"sys_search_$name\" class=\"sys_seach\"> </font>                		
                			";
                		}
                		if(!isset($this->request["sys_filter_$name"]))	$this->request["sys_filter_$name"]="";
                		
                		$view_head="
							<div id=\"report_$name\" style=\"height:35px; width:100%;\" class=\"ui-widget-header\">
								<table width=\"100%\" height=\"100%\">
									<tr>
										<td width=\"10\"></td>
										$button_search
										$button_create
										<td width=\"1\">
											<table>
												<tr id=\"filter_fields_$name\">
												</tr>
											</table>
										</td>
										<td>											
										$html_filter
										</td>
										
										<td align=\"right\">
											<b> $inicio - $fin / {$return["total"]}</b>
										</td>								
										<td width=\"50\" style=\"padding-left:8px; padding-right:8px;\">
						";
						if(@$this->request["sys_action"]!="print_pdf")	
						{
							if(@!$this->request["sys_row_$name"]) $this->request["sys_row_$name"]=50; 	
							$array				=array(1,20,50,100,200,500);
							$option_select		="";
							foreach($array as $index)
							{
								$selected		="";	
								if($index==$this->request["sys_row_$name"]) 	$selected="selected";
								$option_select	.="<option value=\"$index\" $selected>$index</option>";
							}							
							
							$view_head.="
											<select type=\"report\" name=\"sys_rows_$name\" id=\"sys_rows_$name\">
												$option_select		
											</select>
							";
						}				
						$view_head.="	
						
										<td  width=\"30\" align=\"center\" >
											<font action=\"-\" name=\"$name\" class=\"page\"> Anterior </font>
										</td>						
										<td width=\"30\" align=\"center\" style=\" padding-right:8px;\">
											<font action=\"+\" name=\"$name\" class=\"page\"> Siguiente </font>
										</td>								
									</tr>
								</table>		
								
							</div>                
                		";
                	}
                	#<div id=\"base_$name\" style=\" width:100%; height:-moz-calc(100% - 300px);\">
					$view="
						<div id=\"base_$name\" class=\"base_report\" style=\"height:100%; width:100%; \">
							$view_head
							<div id=\"div_$name\" class=\"div_report\" style=\"width:100%; overflow-y:auto; overflow-x:hidden;\">
								<table width=\"100%\"  style=\"background-color:#fff;\">
								$view_title
								$view_body							
								</table>
					";
					if(@$this->request["sys_action"]!="print_pdf")	
					{
						$view.="
								<input name=\"sys_order_$name\" id=\"sys_order_$name\" type=\"hidden\" value=\"$sys_order\">		
								<input name=\"sys_torder_$name\" id=\"sys_torder_$name\" type=\"hidden\" value=\"$sys_torder\">
								<input name=\"sys_page_$name\" id=\"sys_page_$name\" type=\"hidden\" value=\"$sys_page\">
								<input name=\"sys_row_$name\" id=\"sys_row_$name\" type=\"hidden\" value=\"$sys_row\">
						";
					}				
					$view.="
							</div>
						</div>		
					";
					$filter_autocomplete="";

					if(isset($option["section_filter"]) AND is_array($option["section_filter"]))
					{
						foreach($this->sys_filter[$option["filter"]] as $campo=>$valor)
						{        				
							if(is_int($campo))	$campo=$valor;
										
							if(@$this->request["sys_filter_{$this->sys_name}_{$campo}"])
							{	
								$filter_autocomplete.="
									var filter=filter_html(\"$campo\",\"$valor\",\"{$this->request["sys_filter_{$this->sys_name}_{$campo}"]}\",\"$name\");											
									$(\"#filter_fields_$name\").append(filter);
								";
							}							
						}	
					}					
					
					if(@$this->request["sys_action"]!="print_pdf")	
					{				
						$section_filter=@$option["section_filter"];
					
					
						$view.="
							$view_search
							$view_create
							<script>		
								if($(\"#sys_filter_$name\").length>0)        
								{
									$filter_autocomplete							
									$( function() 
									{
										function split( val ) {
											return val.split( /,\s*/ );
										}
										function extractLast( term ) 
										{
											return split( term ).pop();
										}
										$(\"#sys_filter_$name\" )								
										.on( \"keydown\", function( event ) 
										{
											if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( \"instance\" ).menu.active ) 
											{												
												event.preventDefault();
											}
										})
										.autocomplete(
										{
											source: function( request, response ) 
											{
												$.getJSON( \"../sitio_web/ajax/filter_autocomplete.php?section_filter=$section_filter&class={$this->sys_object}\", {
												term: extractLast( request.term )
												}, response );
											},
											search: function() 
											{
												// custom minLength
												var term = extractLast( this.value );
												if ( term.length < 2 ) 
												{
													return false;
												}
											},
											focus: function() 
											{
												return false;
											},
											select: function( event, ui ) 
											{
												var filter=filter_html(ui.item.field,ui.item.title,ui.item.term,\"$name\");											
												$(\"#filter_fields_$name\").append(filter);
																								
												this.value = \"\";
												return false;
											}
										})
										.autocomplete( \"instance\" )._renderItem = function( ul, item ) 
										{
											return $( \"<li>\" )
											.append( \"<div> Buscar <b>\" + item.term + \"</b> en la columna <b><font size=\\\"1\\\"> \" + item.title + \" </font></b></div>\" )
											.appendTo( ul );
										}									
									 });
								}
								
								
								
								
								$(\"#sys_search_$name\")
									.button({
										icons: {	primary: \"ui-icon-search\" },
										text: true
									})
									.click(function(){
										$(\"#sys_action_$name\").val(\"seach\");
										$(\"#sys_page_$name\").val(1);	
										$(\"form\").submit();
									}
								);
							
							
							
								$(\"#sys_rows_$name\").change(function(){
									$(\"#sys_row_$name\").val(    $(this).val()   );
									$(\"#sys_page_$name\").val(1);
									$(\"form\").submit(); 
								});
								$(\"font.page[action='-']\").button({
									icons: {	primary: \"ui-icon-triangle-1-w\" },
									text: false
								});								
								$(\"font.page[action='+']\").button({
									icons: {	primary: \"ui-icon-triangle-1-e\" },
									text: false
								});								
								
								$(\".page[name='$name']\").click(function(){
									var action      	=$(this).attr(\"action\");						    
									var sys_page    	=$(\"#sys_page_$name\").val();
									
									if(action==\"-\")   
									{
										if($inicio > $(\"#sys_rows_$name\").val() )
											sys_page--;
									}	
									else                
									{
										if({$return["total"]} > $fin)
											sys_page++;
									}	
						
									$(\"#sys_page_$name\").val(sys_page);
									$(\"form\").submit(); 
								});				
								$(\".title\").resizable({
									handles: \"e\"
								});
							</script>							
						";
					}
					$return["html"]	=$view;
				}	
				else
				{
					$view="
							<div id=\"report_$name\" style=\"height:35px; width:100%; \" class=\"ui-widget-header\">
								<table width=\"100%\" height=\"100%\">
									<tr>
										<td align=\"center\">
											<b>No se encontraron registros</b>
										</td>								
									</tr>
								</table>		
								
							</div>                					
					";				
					$view	=$this->__VIEW_INPUTSECTION($view);
					$return["html"]	=$view;
				}
		    }	
		    else $return["html"]="Es necesario un array para generar el reporte";
		    
		    #$return["html"]	=$this->__VIEW_INPUTSECTION($return["html"]);
		    
		    return $return;
		}   
    	##############################################################################        
		public function __MESSAGE($message,$option=NULL)
		{
			if(is_null($option))	$option=array();
			
			if(isset($option["template"]))		$template 	=$option["template"];
			else 								$template 	="message";
		    
		    if(isset($option["message"]))  		$message    =$option["message"];
		    else                           		$message    ="No se ha indicado un mensaje";
		    
		    if(isset($option["image"]))    		$image      =$option["image"];
		    else                           		$image      ="sitio_web/alerta_azul.png";
		    
			$html_template  =$this->__TEMPLATE("sitio_web/html/".$template);
			$html_template  ="";
		    
		    #echo $html_template;
		    
		    $datas          =array("message"=>$message,"image"=>$image);
	        $view	        =$this->__REPLACE($html_template,$datas);	
		    
		    $jquery="
		    	$(\"#message\").dialog({
					show: {
						effect: \"shake\",
						duration: 750
					},		    			    	
		    		width:\"350\",
		    		modal: true,
		    	});
				setTimeout(function() 
				{
					$(\"#message\").dialog(\"close\")
				}, 2500 );
						    ";
		    
		    $return=array(
		    	"html"		=>$view,
		    	"message"	=>$message,
		    	"js"		=>$jquery		    	
		    );
		    
			
			return $return;
		}    
		function pointInPolygon($point, $polygon, $pointOnVertex = true) 
		{
			#echo "<br> DENTRO pointInPolygon";
			#$point="70 40";
			#$polygon = array("-50 30","50 70","100 50","80 10","110 -10","110 -30","-20 -50","-30 -40","10 -10","-10 10","-30 -20","-50 30");
			
			#$this->__PRINT_R($point);
			#$this->__PRINT_R($polygon);
			
			$this->pointOnVertex = $pointOnVertex;

			// Transformar la cadena de coordenadas en matrices con valores "x" e "y"
			#echo "<br>PUNTO";
			$point = $this->pointStringToCoordinates($point);
			$vertices = array();
			foreach ($polygon as $vertex) 
			{
				#echo "<br>POLIGONO";
				$vertices[] = $this->pointStringToCoordinates($vertex);
			}

			// Checar si el punto se encuentra exactamente en un vértice
			if ($this->pointOnVertex == true and $this->pointOnVertex($point, $vertices) == true) 
			{
				return "vertice";
			}

			// Checar si el punto está adentro del poligono o en el borde
			$intersections = 0;
			$vertices_count = count($vertices);

			for ($i=1; $i < $vertices_count; $i++) 
			{
				$vertex1 = $vertices[$i-1];
				$vertex2 = $vertices[$i];
				if ($vertex1['y'] == $vertex2['y'] and $vertex1['y'] == $point['y'] and $point['x'] > min($vertex1['x'], $vertex2['x']) and $point['x'] < max($vertex1['x'], $vertex2['x'])) 
				{ // Checar si el punto está en un segmento horizontal
					return "BORDE";
				}
				if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) 
				{
					$xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
					if ($xinters == $point['x']) 
					{ // Checar si el punto está en un segmento (otro que horizontal)
						return "BORDE";
					}
					if ($vertex1['x'] == $vertex2['x'] || $point['x'] <= $xinters) 
					{
						$intersections++;
					}
				}
			}
			// Si el número de intersecciones es impar, el punto está dentro del poligono.
			if ($intersections % 2 != 0) 
			{
				return "DENTRO";
			} 
			else 
			{
				return "AFUERA";
			}
		}
		##############################################################################
		function pointOnVertex($point, $vertices) 
		{
			foreach($vertices as $vertex) 
			{
				if ($point == $vertex) 
				{
					return true;
				}
			}

		}
		##############################################################################
		function pointStringToCoordinates($pointString) 
		{
			$pointString=trim($pointString);
			#$this->__PRINT_R($pointString);
			$coordinates = explode(" ", $pointString);
			#$this->__PRINT_R($coordinates);
			return array("x" => $coordinates[0], "y" => $coordinates[1]);
		}		
	}  	
?>
