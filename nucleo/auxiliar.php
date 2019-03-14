<?php
	#include('basededatos.php');
	#require_once('class.phpmailer.php');
	#require_once('class.smtp.php');
	
	class auxiliar extends basededatos 
	{   
		##############################################################################	
		##  PROPIEDADES
		##############################################################################
		var $request			=array();	# este arrat recibe las variables del POST		
		var $sys_import			=array(
									"type"		=>"replace",
									"fields"	=>",",
									"enclosed"	=>"\"",
									"lines"		=>"\\n",
									"ignore"	=>"1",
								);
		var $sys_false		    =array(0,"0","false", "no", false, null);
		var $sys_true			=array(1,"1","true", "si", true);

		var $sys_modules	    =array(
									"historico","menu","user_group","tareas", 
									"group","modulos","permiso","sesion","cron",
									"cron_history","position","positions","crons_history"
								);
		var $sys_print	    	=array("print_report","print_excel","print_pdf");
		var $sys_section	    ="";
		var $sys_action		    ="";
		var $html				="";
		var $sitio_web			="";		
		var	$jquery				="";
		var	$jquery_aux			="";	
		var $sys_html           ="sitio_web/html/";
		
		var $sys_server_true	=array("www.solesgps.com","solesgps.com","www.soluciones-satelitales.com","soluciones-satelitales.com");
		var $sys_server_error	=array("localhost","developer.solesgps.com");

		
		var $sys_date; 
		var $sys_object; 
		var $sys_name; 
		var $sys_table; 
		var $sys_memory			=""; 
		
		
		var $__PRINT			="";
		var $__PRINT_OPTION		=array();
		var $__PRINT_JS			="";
		
		var $sys_historico;
			
		
		var $words              =array(
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
		public function __MENU_SEGUIMIENTO()
		{  
				$view			=$this->__TEMPLATE("sitio_web/html/menu_seguimiento");				
				$words["a"]		=$_SESSION["seguimiento_md5"];
				return	$this->__REPLACE($view,$words);
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
					    	if(isset($this->request["sys_id"]))     $this->sys_primary_id       =@$this->request["sys_id"];
						    else                                    $this->sys_primary_id       =@$valor["value"];
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
						if(isset($value["relation"]))
						{														
							if($value["relation"]=="one2many")
							{
								/*
								$eval="
									$"."option=array(\"name\"=>\"$field"."_obj\");
									$"."this->$field"."_obj			=new {$value["class_name"]}($"."option);
								";
								if(@eval($eval)===false)	
									echo "$eval"; #$eval; ---------------------------								        			
								*/	
							}		
							if($value["relation"]=="many2one")
							{						
								if(@$this->request["sys_action_" . $this->sys_object ]=="__clean_session")
									unset($_SESSION["SAVE"][$this->sys_object]);			
								#if(@$this->request["sys_action_" . $this->sys_object ]=="__SAVE")
								#	unset($_SESSION["SAVE"][$this->sys_object][$field]);			
								
								if($this->sys_section!="write")
								{
								}															
							}			        									
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
									if(isset($value["relation"]) AND $value["relation"]=="one2many" AND isset($value["class_field_m"]))
									{
										$eval="
											$"."option=array();
											#$"."option[\"echo\"]		=array(\"CLASS {$value["class_name"]}\");
											$"."option[\"where\"]		=array(\"{$value["class_field_m"]}='{$datas[0][$value["class_field_o"]]}'\");
											
											
											$"."$field=					$"."this->obj_$field"."->__BROWSE($"."option);
											$"."this->sys_fields[\"$field\"][\"values\"]		=\"\";
											$"."this->sys_fields[\"$field\"][\"values\"]		=$"."$field"."[\"data\"];
										";										
										if(@eval($eval)===false)	
											$this->__PRINT_R("$eval"); #$eval; ---------------------------								        			
									}
								}	
							}
							// AQUI SI FUNCIONA!!!-------------------
							foreach($datas[0] as $field =>$value)
							{
								$this->sys_fields["$field"]["value"]=$value;				        			
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
		public function __curl($option)
		{
			$ch = curl_init();

			curl_setopt($ch,CURLOPT_URL,$option["url"]);			
			if(isset($option["post"]))
			{
				curl_setopt($ch,CURLOPT_POST, 1);                //0 for a get request
				curl_setopt($ch,CURLOPT_POSTFIELDS,$option["post"]);
			}	
			
			if(isset($option["user"]))
			{
				curl_setopt($ch, CURLOPT_USERPWD, $option["user"].":".$option["pass"]);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			}
						
			if(isset($option["ssl"]))				curl_setopt($ch,CURLOPT_SSL_FALSESTART, $option["ssl"]);		# true or false
			if(isset($option["location"]))			curl_setopt($ch,CURLOPT_FOLLOWLOCATION, $option["location"]);	# true or false
			if(isset($option["referer"]))			curl_setopt($ch,CURLOPT_REFERER, $option["referer"]);			# true or false
			if(isset($option["service"]))			curl_setopt($ch,CURLOPT_SERVICE_NAME, $option["service"]);		# true or false
			
			
			curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
			#curl_setopt($ch,CURLOPT_CONNECTTIMEOUT ,3);
			#curl_setopt($ch,CURLOPT_TIMEOUT, 20);
	
			$resultado 	=curl_exec($ch);			
			$info 		=curl_getinfo($ch);	

			$error		="";
			if(curl_errno($ch)) 					$error = curl_error($ch);

			$return=array(				
				"info"		=>$info,
				"error"		=>$error,
				"return"	=>$resultado,				
			);
			
			
			curl_close ($ch);
			
			return $return;
		}
		public function __WA($data)
    	{    		    		    	
			$sesion 			=array("apikey"=>"AO7K3A1BOEO8O0PX4KK4");

			$url 				="https://panel.apiwha.com/send_message.php";
			$vars 				=$sesion;				
			$vars["number"]		=$data["telefono"];
			$vars["text"]		=$data["mensaje"];

			$option				=array("url"=>$url,"post"=>$vars);
			
			$respuesta			=$this->__curl($option);			
    	}			
		public function WS_TAECEL($data)
    	{    		    		    	
			$sesion 			=array("key"=>"6dce34dbc6cc3d6bd8de48fd011d0595", "nip"=>"7fbb2c3531d73ab26044fac7dfe1a503");
			#$sesion 			=array("key"=>"25d55ad283aa400af464c76d713c07ad", "nip"=>"25d55ad283aa400af464");
			$url 				="https://taecel.com/app/api/RequestTXN";
			$vars 				=$sesion;				
			$vars["producto"]	=$data["producto"];
			$vars["referencia"]	=$data["referencia"];				
			if(isset($data["monto"]))
				$vars["monto"]=$data["monto"];				

			$option				=array("url"=>$url,"post"=>$vars);
			
			$respuesta			=$this->__curl($option);			
			$respuesta1			=json_decode($respuesta["return"]);
			
			
			$url 				="https://taecel.com/app/api/StatusTXN";
			$vars 				=$sesion;
			$vars["transID"]	=$respuesta1->data->transID;
					
			$option				=array("url"=>$url,"post"=>$vars);

			$respuesta			=$this->__curl($option);			
			$respuesta2			=json_decode($respuesta["return"]);
			
			return array(
				"producto"	=>$data["producto"],
				"referencia"=>$data["referencia"],
				"mensaje1"	=>$respuesta1->message,
				"transID"	=>$respuesta1->data->transID,
				"folio"		=>$respuesta2->data->Folio,
				"mensaje2"	=>$respuesta2->message,
				"status"	=>$respuesta2->data->Status,
			);
    	}			

		public function __SHOW_FILE($id)
		{			
			$return="";
			$this->sys_sql		="SELECT * FROM files WHERE id='$id'";
    		$datas 	            = $this->__EXECUTE($this->sys_sql);
    		
    		if(count($datas)>0)
    		{
				$data				=$datas[0];			
				$return ="<img width=\"200\" src=\"http://solesgps.com/modulos/files/file/$id.{$data['extension']}\">";
			}
			return 	$return;
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

			if(@$this->__MESSAGE_OPTION["text"]!="")
			{				
				
				$this->__SYSTEM_MESSAGE="
					<div class=\"echo message\"  title=\"{$this->__MESSAGE_OPTION["title"]}\">
						{$this->__MESSAGE_OPTION["text"]}				
					</div>		    		
				";	
				if(@$this->__MESSAGE_OPTION["time"]>0)
					@$this->__SAVE_JS.="				
						setTimeout(function()
						{  	
							$(\".echo\").dialog(\"close\");							
						},{$this->__MESSAGE_OPTION["time"]});					
					";				
			}						

			if(@$this->sys_vpath==$this->sys_name."/" AND @$this->sys_action=="__SAVE" AND ($this->sys_section=="create" OR $this->sys_section=="write"))				
			{
		        $words["system_message"]    		=@$this->__SYSTEM_MESSAGE;		        
		        $words["system_js"]     			=@$this->__SAVE_JS;		        
			}
			
			if(array_key_exists("user",$_SESSION))
			{ 				
			    if(@$_SESSION["user"]!="Invitado" AND count($_SESSION["user"])>1)
			    {			    			    			    
				    $words							=$this->__MENU($words);
				    
				    $words["system_logo"]           ="";
						    
				    if(isset($_SESSION["company"]["razonSocial"]) AND isset($_SESSION["user"]["name"]))
				    {
					    $words["system_company"]        =$_SESSION["company"]["nombre"];
					    $words["system_user"]           =$_SESSION["user"]["name"];
					    $words["system_logo"]           =$this->__SHOW_FILE($_SESSION["company"]["files_id"]);
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
		    	if(!isset($_SESSION["pdf"]))							$_SESSION["pdf"]					=array();		    					
				if(!isset($_SESSION["pdf"]["template"]))				$_SESSION["pdf"]["template"]		="sitio_web/html/PDF_FORMATO";
				#if(!isset($_SESSION["pdf"]["sys_title"]))				
				
				$_SESSION["pdf"]["sys_title"]		=$this->words["module_title"];
				
				$view	=$this->__TEMPLATE($_SESSION["pdf"]["template"]);
				
				$this->words["sys_empresa"]		=$_SESSION["company"]["nombre"];
				$this->words["system_logo"]		=$words["system_logo"];
				$this->words["sys_title"]		=$_SESSION["pdf"]["sys_title"];
				$this->words["sys_subtitle"]	=$_SESSION["pdf"]["sys_subtitle"];
				$this->words["system_domicilio"]=strtoupper($_SESSION["company"]["domicilio_fiscal"]);
				$this->words["system_rfc"]		=strtoupper($_SESSION["company"]["RFC"]);
				$this->words["system_email"]	=strtoupper($_SESSION["company"]["email"]);
				$this->words["system_telefono"]	=$_SESSION["company"]["telefono"];
				$this->words["system_rs"]		=strtoupper($_SESSION["company"]["razonSocial"]);
				$this->words["sys_modulo"]		=$template;
				
				$_SESSION["pdf"]["template"]	=$this->__REPLACE($view,$this->words);
				$_SESSION["pdf"]["sys_action"]	=$this->request["sys_action"];
				
				$url 				= 'nucleo/tcpdf/crear_pdf.php';				
				$path				.="../$url";
		
				header('Location:'.$path);		
				exit;
			}
			#$_SESSION["pdf"]["template"]				=$template;
			#else	
			echo $template;	
		    
    	}
    	 
        ##############################################################################
		public function __REPORT_TITLES($option)
		{  
			
			$sys_order	=$option["sys_order"];
			$sys_torder	=$option["sys_torder"];
			$font		=$option["font"];
			$name		=$option["name"];
			
			$iorder									="";			
			$title									=@$this->sys_fields[$font]["title"];
						
        	if(isset($this->sys_fields_l18n) AND is_array($this->sys_fields_l18n) AND isset($this->sys_fields_l18n["$font"]))	
        	{			        	
        		$title								=$this->sys_fields_l18n["$font"];
        	}
						
			if($sys_order==@$this->request["sys_order_$name"])
			{
			     if($sys_torder=="ASC") 			$iorder 						="<font class=\"ui-icon ui-icon-caret-1-n\"></font>";
			     else                   			$iorder 						="<font class=\"ui-icon ui-icon-caret-1-s\"></font>";
			}

			$base="";

		    $sys_action     						=@$this->request["sys_action"];		   
		    
			$return=array();

			$return["excel"]="
				<div name=\"title_$name\" style=\"height:25px;\">
					<b><font class=\"sys_order\" name=\"$name\" sys_order=\"$sys_order\" sys_torder=\"$sys_torder\">$title</font><b>
				</div>
			";
			$return["pdf"]="					
				<font class=\"sys_order\" name=\"$name\" sys_order=\"$sys_order\" sys_torder=\"$sys_torder\">$title</font>					
			";
			$return["html"]="
				<div name=\"title_$name\">
					<div class=\"report_title_action\">
						<table width=\"100%\" class=\"sys_order\" name=\"$name\" sys_order=\"$sys_order\" sys_torder=\"$sys_torder\">
							<tr>
								<td height=\"40\"><b><font>$title</font></b></td> 
								<td>$iorder</td>
							</tr>
						</table>
					</div>
				</div>
			";
			return $return;		
		}	
		public function __MENU($words)
		{  			
			$option_conf=array();

			$option_conf["open"]	=1;
			$option_conf["close"]	=1;			

			if(@$_SESSION["company"] AND @$_SESSION["company"]["id"] AND @$_SESSION["user"]["id"])
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
					$link								=$data_menu["link"]."&sys_menu=".$data_menu["id"] . $data_menu["variables"];				
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

						$link			=$data_opcion["link"]."&sys_menu={$sys_menu}" . $data_opcion["variables"];
						$option_html	.="
							<a href=\"{$link}\">
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
					nombre 
				FROM 
					company
				WHERE 1=1
					AND nombre is not null
					AND estatus=1
					AND tipo_company='GPS'
			"; 

		    $datas              =$this->__EXECUTE($comando_sql, $option_conf);
			
		    foreach($datas as $data)
		    {    
		    	$selected="";
		    	if($_SESSION["company"]["id"]==$data["id"])
		    		$selected="selected";
		    	$vOption = $vOption."<option value=\"".$data["id"]."\"  $selected >".$data["id"]." :: ".$data["nombre"]."</option>";		    	
		    }

			$vRespuesta = "	<select id = \"setting_company\" system=\"yes\" name = \"setting_company\">".$vOption."</select>";

			$permisos=$_SESSION["group"];
			$return="";

			foreach($permisos as $permiso)
			{
				if($permiso["menu_id"]==$_SESSION["sys"]["menu"] AND $permiso["nivel"]<=10)
				{
					$return=$vRespuesta;
				}
			}

			return $return;
		} 

        ##############################################################################
		public function __REQUEST_AUX($campo,$valor)
		{  
		
			#if(!is_array($valor)) 			
			#	$valor	=htmlentities($valor);
			
			#if(!isset($this->sys_fields["$campo"]["htmlentities"]))	
			#	$this->sys_fields["$campo"]["htmlentities"]="true";
						
			#if(!is_array($valor) AND in_array($this->sys_fields["$campo"]["htmlentities"], $this->sys_true))
			
			if(isset($this->sys_fields["$campo"]["htmlentities"]) AND in_array($this->sys_fields["$campo"]["htmlentities"], $this->sys_true))								
					$valor	=htmlentities($valor);
		
		
			
			
			
			$this->request["$campo"]		=$valor;
			$_SESSION["request"]["$campo"]	=$valor;									
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

			#eval($eval);
		    if(@eval($eval)===false)	
		    	echo ""; #$eval; ---------------------------					


		}
		public function __REQUEST()
		{  
			# ASIGNA TODAS LAS VARIABLES QUE CONTENGAN VALOR
			# AL ARRAY DECLARADO $this->sys_fields EN EL MODEDLO
			# O CREANDO UNA NUEVA PROPIEDAD 
			
			#if(count($_REQUEST)>6)
			if(is_array(@$this->sys_fields))
			{
				foreach($this->sys_fields as $campo =>$valor)
				{
					if(isset($valor["class_name"]))
					{				
						$eval="
							$"."option"."_obj_$campo	=array(
								\"name\"			=>\"$campo"."_obj\",		
								\"memory\"			=>\"$campo\",
								\"class_one\"		=>\"{$this->sys_name}\",
							);													
							$"."this->obj_$campo   	=new {$valor["class_name"]}($"."option"."_obj_$campo);
						";		
						eval($eval);					
					}
				
					$request_campo		="{$this->sys_name}_$campo";
					if(isset($_REQUEST[$request_campo]))
					{
						#$valor					=strtoupper($_REQUEST[$request_campo]);
						$valor					=$_REQUEST[$request_campo];
						if(!is_array($valor)) $valor=htmlentities($valor);						
						$this->__REQUEST_AUX($campo,$valor);						
						unset($_REQUEST["$request_campo"]);
					}
					if(@$this->sys_fields[$campo]["type"]=="checkbox" and (@$this->sys_fields[$campo]["value"]=="" OR @$this->sys_fields[$campo]["value"]==0))
					{											
						$eval="
							$"."this->sys_fields[\"$campo\"][\"value\"]		=\"0\";
							$"."this->$campo								=\"0\";
							$"."this->request[\"$campo\"]					=\"0\";
						";
						if(eval($eval)===false)	
							echo ""; #$eval; ---------------------------					
					}			
				}
			}	
			foreach($_REQUEST as $campo =>$valor)
			{
				$this->__REQUEST_AUX($campo,$valor);
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
			
			if(!isset($words["module_title"]))	$words["module_title"]="";
			if(!isset($words["module_left"]))	$words["module_left"]="";
			if(!isset($words["module_center"]))	$words["module_center"]="";
			if(!isset($words["module_right"]))	$words["module_right"]="";
			
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
	    		$return="";
	    		
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

	    		if(@$this->request["sys_action"]=="print_pdf")
	    		{
	    			$archivo = $form.'_pdf.html';
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
	    		}
				if($return=="")	    		
		    	
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
					
					if(isset($words["auto_".$word]))
						$replace=$words["auto_".$word];
					
					
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
    			#if(isset($valor["value"]) and $valor["value"]!="")
				if(isset($valor["relation"]) AND $valor["relation"]=="many2one")
				{	
					$return[$campo]=$_SESSION["SAVE"][$this->sys_object][$campo]["data"];

				}
				else				
				{					
					if(isset($valor["request"]))
					{
						$return[$campo]=$valor["request"];
					}					
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
				else
				{	
					$this->sys_fields["$campo"]["value"]	=$this->request["$campo"];
					$this->sys_fields["$campo"]["request"]	=$this->request["$campo"];
				}	
			}		
		}    
		public function __VALOR($valor=NULL)
		{				    
			$style="";
			if(is_array($valor["style"]))
			{
				foreach($valor["style"] as $attr => $val_attr)
				{
					if(@is_array($val_attr))
					{						
						$eval_attr="";	
						foreach($val_attr as $field_attr => $eval_field)
						{		
								
							#if($attr=="background-color")	$eval_attr.="if({$eval_field})	$"."style.=\"background-color:$field_attr;\";";
							if($attr=="border")				$eval_attr.="if({$eval_field})	$"."style.=\"border: 1px solid $field_attr; \";";
							#elseif($attr=="font-size")		$eval_attr.="if({$eval_field})	$"."style.=\"font-size: $field_attr; \";";
							else							$eval_attr.="if({$eval_field})	$"."style.=\"$attr: $field_attr; \";";
							

						}
					}
				}	
				
				eval($eval_attr);
			}
			if($this->sys_section=="create" AND is_array(@$valor["create"]))	$style	.=$this->__VALOR($valor["create"]);
			if($this->sys_section=="write" AND is_array(@$valor["write"]))		$style	.=$this->__VALOR($valor["write"]);

			return $style;		
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
			        if(!isset($valor["attr"]))	   		$valor["attr"]			="";
					if(!isset($valor["style"]))	   		$valor["style"]			="";

					$class="$campo ";
					$style="style=\"" . $this->__VALOR($valor) . "\""; 				
								        
			        if(!is_array($valor["value"]))
			        {
			        	$attr="";
			        	if(is_array($valor["attr"]))
			        	{	

			        		foreach($valor["attr"] as $attr_field => $attr_value)
			        		{
								if($attr_value=="required")		$class.=" required ";
								else	
									$attr.=" $attr_field='$attr_value'";
			        		}			        	
			        	}			        				        	
						$titulo					="&nbsp;";		
					    if(in_array($valor["showTitle"],$this->sys_true))	
					    {			        
					    	if(is_array($this->sys_fields_l18n) AND isset($this->sys_fields_l18n["$campo"]))	
					    	{			        	
					    		$valor["title"]		=$this->sys_fields_l18n["$campo"];
					    	}	

							if($valor["type"]=="txt")	$titulo					="{$valor["title"]}";			        	
							else						$titulo					="<font id=\"$campo\" style=\"color:gray;\">{$valor["title"]} </font>";					    	
					    }	
					    
					    if($valor["type"]=="input")	
					    {			        						        
					        if(!in_array(@$this->request["sys_action"],$this->sys_print))					        
					        {
								if(@$this->request["sys_section_".$this->sys_name]=="show")
									$words["$campo"]  ="{$valor["value"]}<br>$titulo";
								else					        
									$words["$campo"]  ="<input id=\"$campo\" $style autocomplete=\"off\" type=\"text\" $attr name=\"{$this->sys_name}_$campo\" value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name} {$this->sys_object} $class\"><br>$titulo";							}					        	
					        else	$words["$campo"]  ="{$valor["value"]}<br>$titulo";						        
					    } 
					    if($valor["type"]=="date")	
					    {
					    	$js_auto="";
					        if(!in_array(@$this->request["sys_action"],$this->sys_print))					        
					        {
								if(@$this->request["sys_section_".$this->sys_name]=="show")
									$words["$campo"]  ="{$valor["value"]}<br>$titulo";
								else					        
									$words["$campo"]  ="
										<input id=\"$campo\" $style type=\"text\" name=\"{$this->sys_name}_$campo\" $attr value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name} $class\"><br>$titulo
										<script>
											$(\"input#$campo".".{$this->sys_name}\").datepicker({
												dateFormat:\"yy-mm-dd\",
												dayNamesMin: [\"Do\", \"Lu\", \"Ma\", \"Mi\", \"Ju\", \"Vi\", \"Sa\"],
												monthNames: [\"Enero\", \"Febrero\", \"Marzo\", \"Abril\", \"Mayo\", \"Junio\", \"Julio\", \"Agosto\", \"Septiembre\", \"Octubre\", \"Noviembre\", \"Diciembre\"],
												monthNamesShort: [\"Ene\", \"Feb\", \"Mar\", \"Abr\", \"May\", \"Jun\", \"Jul\", \"Ago\", \"Sep\", \"Oct\", \"Nov\", \"Dic\"]
												$js_auto
											});
										</script>			            	
							    	";
							}					        	
					        else	$words["$campo"]  ="{$valor["value"]}<br>$titulo";	
					    } 
					    if($valor["type"]=="datetime")	
					    {
					    	$js_auto="";
					        if(!in_array(@$this->request["sys_action"],$this->sys_print))					        
					        {
								if(@$this->request["sys_section_".$this->sys_name]=="show")
									$words["$campo"]  ="{$valor["value"]}<br>$titulo";
								else					        
							    $words["$campo"]  ="
							    	<input id=\"$campo\" $style type=\"text\" name=\"{$this->sys_name}_$campo\" $attr value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name} $class\"><br>$titulo
					    			<script>
										$(\"input#$campo".".{$this->sys_name}\").datetimepicker({
											dateFormat: 	\"yy-mm-dd\",
											timeFormat: 	\"HH:mm:ss\",
											showSecond: 	false,
											showMilisecond: false,
											showMicrosecond: false,
											minuteText: 	\"Minutos\",
											hourText: 		\"Horas\",
											currentText: 	\"Ahora\",
											closeText: 		\"Listo\",
											dayNamesMin: 	[\"Do\", \"Lu\", \"Ma\", \"Mi\", \"Ju\", \"Vi\", \"Sa\"],
											monthNames: 	[\"Enero\", \"Febrero\", \"Marzo\", \"Abril\", \"Mayo\", \"Junio\", \"Julio\", \"Agosto\", \"Septiembre\", \"Octubre\", \"Noviembre\", \"Diciembre\"],
											monthNamesShort:[\"Ene\", \"Feb\", \"Mar\", \"Abr\", \"May\", \"Jun\", \"Jul\", \"Ago\", \"Sep\", \"Oct\", \"Nov\", \"Dic\"]
										});	
							    	</script>			            	
					        	";
							}					        	
					        else	$words["$campo"]  ="{$valor["value"]}<br>$titulo";	
					    } 

					    if($valor["type"]=="multidate")	
					    {
					        #$words["$campo"]  ="$titulo<input id=\"$campo\" type=\"text\" name=\"$campo\" value=\"{$valor["value"]}\" placeholder=\"{$valor["holder"]}\" class=\"formulario\" >";
					        $js_multidate="";
							if(@$this->request["sys_section_".$this->sys_name]=="write")
							{
								$valores_multidate=explode(",",$valor["value"]);
								$days_value="";
								foreach($valores_multidate as $day)
								{
									$day=trim($day);
									if($days_value=="")	$days_value="'$day'";
									else				$days_value.=", '$day'";
								}
								
								$js_multidate="addDates: [$days_value]";
					        }
   							if(!in_array(@$this->request["sys_action"],$this->sys_print))
							{					        
								if(@$this->request["sys_section_".$this->sys_name]=="show")
									$words["$campo"]  ="{$valor["value"]}<br>$titulo";
								else							
							    $words["$campo"]  ="
							    	<input id=\"$campo\" $style type=\"text\" name=\"{$this->sys_name}_$campo\"  $attr class=\"formulario {$this->sys_name} $class\"><br>$titulo
					    			<script>
										$(\"input#$campo".".{$this->sys_name}\").multiDatesPicker(
										{
											dateFormat: \"yy-mm-dd\",
											$js_multidate
										});
							    	</script>			            	
						    	";
						    }
						    else	$words["$campo"]  ="{$valor["value"]}<br>$titulo";
					    } 
					    
					    if($valor["type"]=="checkbox")	
					    {
					        //$words["$campo"]  ="<input id=\"$campo\" type=\"checkbox\" name=\"$campo\" class=\"formulario\"><br>$titulo";
					        $checked="";
					        if($valor["value"]==1) $checked="checked";
							
					    	$words["$campo"]  = 
					        "<div class=\"checkbox-2\">
		    					<input type=\"checkbox\" id=\"{$this->sys_name}_$campo\"  $checked value=\"1\" name=\"{$this->sys_name}_$campo\" />
		    					<label for=\"{$this->sys_name}_$campo\">".""."</label>
							</div>$titulo
							<br>
							";
					    }      
					    if($valor["type"]=="file")	
					    {
					        $words["$campo"]  ="$titulo<input id=\"$campo\" name=\"$campo\" type=\"file\" class=\"formulario\">";
					        $words["$campo"]  ="<input id=\"$campo\" $attr name=\"{$this->sys_name}_$campo\" type=\"file\" class=\"formulario {$this->sys_name} $class\" ><br>$titulo";
					    }    
					    if($valor["type"]=="show_file")	
					    {
					    	
					        $words["$campo"]  =$valor["value"];
					    }    




					    if($valor["type"]=="font")	
					    {
					        $words["$campo"]  ="$titulo<div id=\"$campo\" class=\"{$this->sys_name}\" $attr style=\"height:22px;\"> {$valor["value"]}</div><br>&nbsp;";
					    } 
					    if($valor["type"]=="title")	
					    {
					        $words["$campo"]  ="$titulo";
					    } 
					    if($valor["type"]=="txt")	
					    {
					        $words["$campo"]  ="$titulo";
					    } 

					    if($valor["type"]=="value")	
					    {
					        $words["$campo"]  ="{$valor["value"]}";
					    } 
					    
					    if($valor["type"]=="textarea")	
					    {
							if($attr=="")	$attr="style=\"height:150px;\"";
					    	if(@$this->request["sys_section_".$this->sys_name]=="show")
					    		$words["$campo"]  ="{$valor["value"]}<br>$titulo";
					    	else							
						        $words["$campo"]  ="<textarea id=\"$campo\" name=\"{$this->sys_name}_$campo\" $attr class=\"formulario {$this->sys_name} $class\">{$valor["value"]}</textarea><br>$titulo";
					    } 			           
					    if($valor["type"]=="html")	
					    {
					        $words["$campo"]  ="{$valor["value"]}";
					    } 			           

					    if($valor["type"]=="password")	
					    {					        
					    	if(@$this->request["sys_section_".$this->sys_name]=="show")
					    		$words["$campo"]  ="*********<br>$titulo";
					    	else					    
					        $words["$campo"]  ="<input type=\"password\" $style id=\"$campo\" $attr name=\"{$this->sys_name}_$campo\" value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name} $class\"><br>$titulo";
					    }    
					    if($valor["type"]=="select")	
					    {
					        $options="";
							if(!in_array(@$this->request["sys_action"],$this->sys_print))
							{					        
							    foreach($valor["source"] as $value =>$text)
							    {
							    	$selected="";
							    	if($valor["value"]==$value) 
							    	
							    		$selected="selected";
							    	$options.="<option value=\"$value\" $selected>$text</option>";			            
							    }
								if(@$this->request["sys_section_".$this->sys_name]=="show")
									$words["$campo"]  ="{$valor["value"]}<br>$titulo";
								else							    			            
									$words["$campo"]  ="<select id=\"$campo\" $style name=\"{$this->sys_name}_$campo\"  $attr class=\"formulario {$this->sys_name} $class\"\">
											$options
										</select><br>$titulo
									";
							}					        
							else	$words["$campo"]  =@$text."<br>$titulo";
							
					    }			        
					    if($valor["type"]=="autocomplete")	
					    {
					    	$words["$campo"]  ="";
					    	if(!isset($fields["auto_$campo"]["value"]))	$fields["auto_$campo"]["value"]="";

							$eval="
								$"."view_auto						=$"."this->obj_$campo"."->__VIEW_WRITE($"."this->obj_$campo"."->sys_module.\"html/create\");	
								$"."this->obj_$campo"."->words  	=$"."this->obj_$campo"."->__INPUT($"."this->obj_$campo"."->words,$"."this->obj_$campo"."->sys_fields);
								
								$"."words[\"create_auto_$campo\"]  	=$"."this->__REPLACE($"."view_auto,$"."this->obj_$campo"."->words);

							";	
							#$"."this->obj_$campo
							
							if(@eval($eval)===false)	

							if(isset($this->request["auto_$campo"]))	
							{
								$fields["auto_$campo"]["value"]	=$this->request["auto_$campo"];
								$fields["$campo"]["value"]		=$this->request["$campo"];
							}									
							if(isset($valor["source"]))
							{						    	
								$json=$this->__JSON_AUTOCOMPLETE($valor);
								
								if(!isset($this->request["auto_$campo"]))	
								{
									$fields["auto_$campo"]["value"]	=@$json[0]->label;
									$fields["$campo"]["value"]		=@$json[0]->clave;
								}
							}
							else if(isset($valor["procedure"]))
							{
								$eval="
									$"."json							=$"."this->obj_$campo"."->{$valor["procedure"]}();
								";	
								if(@eval($eval)===false)	
									echo ""; #$eval; ---------------------------								        			

								$fields["auto_$campo"]["value"]		=@$json[0][$valor["class_field_l"]];
								$fields["$campo"]["value"]			=@$json[0][$valor["class_field_m"]];
							}	
					    	
					    	$label	=$fields["auto_$campo"]["value"];
							
					    	if(isset($this->sys_fields["$campo"]["class_field_l"]))
					    	{
					    		if(isset($this->sys_fields["$campo"]["values"]) AND count($this->sys_fields["$campo"]["values"])>0)
					    			$label=$this->sys_fields["$campo"]["values"][0][$this->sys_fields["$campo"]["class_field_l"]];
					    	}
					    	$js_auto="";
					    	if(isset($this->sys_memory) AND $this->sys_memory!="")
					    		$js_auto="appendTo: \"div#create_{$this->sys_name}\",";
							
							if(isset($valor["vars"]))	$vars	=$valor["vars"];
							else						$vars	="";
					    
							if(!in_array(@$this->request["sys_action"],$this->sys_print))
							{							
								$js="
											$(\"div#auto_$campo\").hide();
											$(\"input#auto_$campo".".{$this->sys_name}\").autocomplete(
											{		
												source:		\"../sitio_web/ajax/autocomplete.php?class_name={$valor["class_name"]}&procedure={$valor["procedure"]}&class_field_l={$valor["class_field_l"]}&class_field_m={$valor["class_field_m"]}$vars&date=".date("YmdHis")."\",
												dataType: 	\"jsonp\",
												$js_auto
												change: function( event, ui ) // CUANDO SE SELECCIONA LA OPCION REALIZA LO SIGUIENTE
												{
													if($(\"input#auto_$campo".".{$this->sys_name}\").val()==\"\")
													$(\"input#$campo".".{$this->sys_name}\").val(\"\")
												},
												select: function( event, ui ) // CUANDO SE SELECCIONA LA OPCION REALIZA LO SIGUIENTE
												{												
													if(typeof auto_$campo === 'function') 								
													{														
														auto_$campo(ui);
													}									
													else
													{	
														if(ui.item.clave==\"create\")
														{																													
															$(\"div#auto_$campo div\").removeClass(\"mainTable\");													
															$(\"div#auto_$campo\").dialog({
																buttons: {
																	\"Registrar\": function() {													
																		$( this ).dialog(\"close\");
																	},
																	\"Cerrar\": function() {
																		$( this ).dialog(\"close\");
																	}
																},										
																width:\"700px\"
															});
														}
														else
														{
															$(\"input#$campo".".{$this->sys_name}\").val(ui.item.clave);					
															$(\"input#auto_$campo".".{$this->sys_name}\").val(ui.item.label);
														}
													}
													if($(\"input#auto_$campo".".{$this->sys_name}\").val()==\"\")
													$(\"input#$campo".".{$this->sys_name}\").val(\"\")
												}				
											});				            	
								
								";


								if(!isset($valor["procedure"]))	$valor["procedure"]="";
								
								if(@$this->request["sys_section_".$this->sys_name]=="show")
									$words["$campo"]  ="{$label}<br>$titulo";
								else								
									$words["$campo"]  ="
										<input id=\"auto_$campo\"  name=\"{$this->sys_name}_auto_$campo\" $style type=\"text\"   $attr value=\"$label\" class=\"formulario {$this->sys_name} $class\"><br>$titulo
										<input id=\"$campo\" 	   name=\"{$this->sys_name}_$campo\" value=\"{$valor["value"]}\"  class=\"formulario {$this->sys_name}\" type=\"hidden\">
										<div id=\"auto_$campo\" title=\"Crear Registro\">{create_auto_$campo}</div>
									" . $this->__JS_SET($js);
							}					    
							else
							{
								$words["$campo"]  ="$label<br>$titulo";
							}
					    }  
						#/*
					    if($valor["type"]=="form")	
					    {					    
							if(isset($valor["relation"]) AND $valor["relation"]=="many2one")
							{								
								if(!isset($valor["class_template"]))		$valor["class_template"]="many2one_standar";					
								
								$campo_many					=@$valor["class_field_o"];
								$value_many					=@$this->sys_fields["$campo_many"]["value"];								
								
								if($this->sys_section=="create" AND $this->request["sys_action_".$this->sys_object] == "__SAVE")
									$value_many=0;	
								
								$option=array(
									"class_one"				=>$this->sys_name,
									"class_one_id"			=>$value_many,
								
									"class_field"			=>$campo,
									"class_field_id"		=>"",
									"class_field_value"		=>$valor,
									"words"					=>$words,
									"view"					=>"html",			
								);								

								$words						=$this->__MANY2ONE($option);
							}
							if(isset($valor["relation"]) AND $valor["relation"]=="many2many")
							{								
								if(!isset($valor["class_template"]))		$valor["class_template"]="many2one_standar";					
								
								$campo_many					=$valor["class_field_o"];
								$value_many					=@$this->sys_fields["$campo_many"]["value"];								
								
								if($this->sys_section=="create" AND $this->request["sys_action_".$this->sys_object] == "__SAVE")
									$value_many=0;	
								
								$option=array(
									"class_one"				=>$this->sys_name,
									"class_one_id"			=>$value_many,
								
									"class_field"			=>$campo,
									"class_field_id"		=>"",
									"class_field_value"		=>$valor,
									"words"					=>$words,
									"view"					=>"html",									
								);								

								$words						=$this->__MANY2MANY($option);
							}
							
						}	
						#*/
					    if($valor["type"]=="class")	
					    {					    
							if(isset($valor["relation"]) AND $valor["relation"]=="one2many")
							{
								/*
								$eval="";
								$eval="
									$"."option							=array(\"name\"=>\"$campo"."_obj\");								
									$"."this->obj_$campo"."				=new {$valor["class_name"]}($"."option);
								";	
								
								if(@eval($eval)===false)	
									echo ""; #$eval; ---------------------------								        			
									*/
							}			        		
					    	#$words["$campo"]  =$data["html"];
					    }					    
					    if($valor["type"]=="hidden")	
					    {
					        if(!in_array(@$this->request["sys_action"],$this->sys_print))					        
					        {
								if(@$this->request["sys_section_".$this->sys_name]=="show")
									$words["$campo"]  ="";
								else					        
									$words["$campo"]  ="<input type=\"hidden\" id=\"$campo\" name=\"{$this->sys_name}_$campo\" $attr value=\"{$valor["value"]}\" class=\"formulario {$this->sys_name}\">";
							}					        	
					        else	$words["$campo"]  ="";						           
					    }    
					    if($valor["type"]=="img")	
					    {
					        $words["$campo"]  ="$titulo<img id=\"$campo\" name=\"$campo\" $attr src=\"{$valor["value"]}\">";
					    }    
					}
			        
			    }
			}    
			else $words="ERROR :: No se asigno el array de campos $"."this->sys_fields";

			
			return $words;
		}   		
    	##############################################################################    
		public function __MANY2ONE($option)		
		{
			$class_id			=@$option["class_id"];
			$class_one			=@$option["class_one"];
			$class_one_id		=@$option["class_one_id"];
			
			$campo				=@$option["class_field"];
			$class_field_id		=@$option["class_field_id"];
			$valor				=@$option["class_field_value"];
			
			$words				=@$option["words"];                                                                                                                                                                                                                                                          
			$index				=@$option["view"];
																		
			if(isset($option["json"]))
			{
				$json	=$option["json"];										
			}
						
			$eval="
				##if(!isset($"."this->sys_memory))
				{
					if(isset($"."json))
					{								
						$"."sys_primary_field								=$"."this->obj_$campo"."->sys_primary_field;
				
						if(isset($"."class_id) AND $"."class_id>0)
							$"."json[\"row\"][\"$"."sys_primary_field\"]	=$"."class_id;
						
						$"."this->obj_$campo"."->__SAVE($"."json);
					}
					
					$"."view   												=$"."this->__TEMPLATE(\"sitio_web/html/" . $valor["class_template"]. "\");									
					
					$"."this->obj_$campo"."->words[\"many2one_form\"]		=$"."this->obj_$campo"."->__VIEW_CREATE($"."this->obj_$campo"."->sys_module . \"html/create\");	
					$"."this->obj_$campo"."->words							=$"."this->obj_$campo"."->__INPUT($"."this->obj_$campo"."->words,$"."this->obj_$campo"."->sys_fields);    
													
					$"."this->obj_$campo"."->words[\"many2one_report_id\"]	=$"."campo;
									
					if(isset($"."words[\"html_head_js\"]))								
						$"."words[\"html_head_js\"] 						.= $"."this->obj_$campo"."->words[\"html_head_js\"];
									
					$"."option_report										=array();				
					
					$"."option_report[\"where\"]							=array(
						\"{$valor["class_field_m"]}='$class_one_id'\"
					);
					
					$"."option_report[\"template_title\"]	                = $"."this->obj_$campo"."->sys_module . \"html/report_title\";
					$"."option_report[\"template_body\"]	                = $"."this->obj_$campo"."->sys_module . \"html/report_body\";
					$"."option_report[\"template_create\"]	                = $"."this->obj_$campo"."->sys_module . \"html/create\";
					$"."option_report[\"template_option\"]	                = $"."option;
					
					$"."option_report[\"name\"]	                			= '$campo';
					
					$"."this->obj_$campo"."->__VIEW_REPORT					=$"."this->obj_$campo"."->__VIEW_REPORT($"."option_report);

					$"."this->obj_$campo"."->words[\"many2one_report\"]		=$"."this->obj_$campo"."->__VIEW_REPORT[$"."index];				
					$"."words[\"$campo\"]  									=$"."this->__REPLACE($"."view,$"."this->obj_$campo"."->words);									
				}	
			";							
			eval($eval);	
			
			return $words;
		}

    	##############################################################################    
		public function __MANY2MANY($option)		
		{
			$class_id			=@$option["class_id"];
			$class_one			=$option["class_one"];
			$class_one_id		=$option["class_one_id"];
			
			$campo				=$option["class_field"];
			$class_field_id		=$option["class_field_id"];
			$valor				=$option["class_field_value"];
			
			$words				=$option["words"];                                                                                                                                                                                                                                                          
			$index				=$option["view"];
									
			if(isset($option["json"]))
			{
				$json	=$option["json"];										
			}
						
			$eval="		
				if(isset($"."json))
				{								
					$"."sys_primary_field								=$"."this->obj_$campo"."->sys_primary_field;
			
					if(isset($"."class_id) AND $"."class_id>0)
						$"."json[\"row\"][\"$"."sys_primary_field\"]	=$"."class_id;
					
					$"."this->obj_$campo"."->__SAVE($"."json);
				}
				
				$"."view   												=$"."this->__TEMPLATE(\"sitio_web/html/" . $valor["class_template"]. "\");													
				
				$"."this->obj_$campo"."->words[\"many2one_form\"]		=$"."this->obj_$campo"."->__VIEW_CREATE($"."this->obj_$campo"."->sys_module . \"html/create\");	
				$"."this->obj_$campo"."->words							=$"."this->obj_$campo"."->__INPUT($"."this->obj_$campo"."->words,$"."this->obj_$campo"."->sys_fields);    
												
				$"."this->obj_$campo"."->words[\"many2one_report_id\"]	=$"."campo;
								
				if(isset($"."words[\"html_head_js\"]) AND isset($"."this->obj_$campo"."->words[\"html_head_js\"]))								
					$"."words[\"html_head_js\"] 						.= $"."this->obj_$campo"."->words[\"html_head_js\"];
								
				$"."option_report										=array();				
												
				$"."option_report[\"template_title\"]	                = $"."this->obj_$campo"."->sys_module . \"html/report_title\";
				$"."option_report[\"template_body\"]	                = $"."this->obj_$campo"."->sys_module . \"html/report_body\";
				$"."option_report[\"template_create\"]	                = $"."this->obj_$campo"."->sys_module . \"html/create\";
				$"."option_report[\"template_option\"]	                = $"."option;
				
				$"."option_report[\"name\"]	                			= '$campo';
				
				$"."report_procedure									=$"."this->obj_$campo"."->__VIEW_REPORT($"."option_report);
				$"."this->obj_$campo"."->words[\"many2one_report\"]		=$"."report_procedure[$"."index];				

				$"."words[\"$campo\"]  									=$"."this->__REPLACE($"."view,$"."this->obj_$campo"."->words);									
			";				
			eval($eval);	
			
			return $words;
		}

		public function __REPORT_MANY2ONE_JS($data)
		{
			$js="";	
			foreach($data as $row)
			{
				$js.="var row=new Array();";
				foreach($row as $field=>$value)
				{
					$js.="
						row[\"$field\"]	=\"$value\";
					";
				}
			}
			
			$js="
				var object=\"". $this->sys_name ."\";
				if(many2one_data[object]==undefined)	many2one_data[object]=new Array();			
				$js
				many2one_data[object].push(row);	
			";
			return $js;
		}
    	##############################################################################    
		public function __INPUT_TYPE($type=NULL, $fields=NULL)
		{
			if(is_null($fields))
			{
				foreach($this->sys_fields as $field=>$value)
				{					
					if(!in_array(@$this->sys_fields[$field]["type"],array("hidden","textarea","","primary key")))											
					{	
						$this->sys_fields[$field]["type"]="input";			    						
						$this->sys_fields[$field]["attr"]=array("readonly"=>"readonly");			    					
					}
				}
			}				
			else
			{
				foreach($fields as $field)
					$this->sys_fields[$field]["attr"]=array("readonly"=>"readonly");			    
			}
		}
		public function __SYS_HISTORY()
		{  
	  		if(@$this->sys_primary_id!="")	
	  		{
	  			$option						=array();	
	  			$option["name"]				="historico";
	  			
	  			$this->sys_historico		=new historico();
	  			$option						=array();	
	  			$option["template_body"]	=$this->sys_historico->sys_module . "html/report_historico_body";
	  			$option["order"]			="id DESC";
	  			#$option["echo"]			="SYS_HISTORY";
	  			$option["where"]			=array();	
	  			$option["where"][]			="clave=$this->sys_primary_id";
	  			$option["where"][]			="objeto='$this->sys_object'";
	  			$option["where"][]			="tabla='$this->sys_table'";				
	  			
	  			$reporte					=$this->sys_historico->__VIEW_REPORT($option);
	  			
	  			$this->words["sys_historico"]="
	  										${reporte["html"]}	
	  			";
	  		}
	
		}    			
    	##############################################################################    
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
			$this->__SYS_HISTORY();
			$view   =$this->__TEMPLATE("$template");
			$view	=$this->__VIEW_INPUTSECTION($view);
			return $view;
		}    	
    	##############################################################################    
		public function __VIEW_WRITE($template)
		{
			$this->__SYS_HISTORY();
			$view   =$this->__TEMPLATE("$template");
			$view	=$this->__VIEW_INPUTSECTION($view);
			
			return $view;
		}    	
    	##############################################################################    
		public function __VIEW_SHOW($template)
		{
			#$this->__INPUT_TYPE("font");
			$this->__SYS_HISTORY();
			$view   =$this->__TEMPLATE("$template");
			$view	=$this->__VIEW_INPUTSECTION($view);
			return $view;
		} 		

		public function __VIEW_INPUTSECTION($view, $option=array())
		{								
			$sys_section	=@$this->request["sys_section_".$this->sys_name];
			$sys_action		="";
			$sys_id			=@$this->request["sys_id_".$this->sys_name];
		
			$view2="";
			if(!in_array(@$this->request["sys_action"],$this->sys_print))	
			{
				$view2="
					<input id=\"sys_section_{$this->sys_name}\" system=\"yes\"  name=\"sys_section_{$this->sys_name}\" value=\"{$sys_section}\" type=\"hidden\">
					<input id=\"sys_action_{$this->sys_name}\" system=\"yes\" name=\"sys_action_{$this->sys_name}\" value=\"{$sys_action}\" type=\"hidden\">
					<input id=\"sys_id_{$this->sys_name}\" system=\"yes\" name=\"sys_id_{$this->sys_name}\" value=\"{$sys_id}\" type=\"hidden\">
				";
				if(!isset($option["input"]))	$option["input"]="true";
			}
			$view.=$view2;
			
			if(isset($this->sys_memory) AND $this->sys_memory!="")
			{				
				$js="
						$(\"font#{$this->sys_name}\")
							.button()
							.click(function(){						
								var options={
									\"object\":\"{$this->sys_name}\",
									\"class_one\":\"{$this->sys_object}\",
								}
								many2one_post(options);
						});										
				";
				
				$this->words["many2one_button"]="
					<font id=\"{$this->sys_name}\">ACEPTAR</font>				
					<font id=\"{$this->sys_name}\">CANCELAR</font>	<br>			<br>
				" . $this->__JS_SET($js);		
			}			
			return $view;
		}    	

    	##############################################################################    
		public function __VIEW_KANBAN($template,$data,$option=NULL)
		{
		    if(is_null($option))	$option=array();
		    if(!array_key_exists("name",$option))   $option["name"]=$this->sys_name;
	    
		    
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
			    foreach($data as $row_id=>$row)			
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
							
							if($row[$field]=="" AND isset($row["auto_".$field]))
							{
								#$aux					=$row[$field];
								#$row[$field]			=$row["auto_".$field];
								#$row["auto_".$field]	=$aux;
							}
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
                                        				
                    if(isset($this->sys_memory) AND $this->sys_memory!="")
					{
						$show	="<font class_field=\"{$this->sys_memory}\" class_field_id=\"$row_id\" id=\"{id}\" class_one=\"{$this->class_one}\" data=\"&sys_section_{$this->sys_name}=show&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\" class=\"sys_report_memory ui-icon ui-icon-contact\"></font>";	
						$write	="<font class_field=\"{$this->sys_memory}\" class_field_id=\"$row_id\" id=\"{id}\" class_one=\"{$this->class_one}\" data=\"&sys_section_{$this->sys_name}=write&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\" class=\"sys_report_memory ui-icon ui-icon-pencil\"></font>";
						$delete	="<font class_field=\"{$this->sys_memory}\" class_field_id=\"$row_id\" id=\"{id}\" class_one=\"{$this->class_one}\" data=\"&sys_section_{$this->sys_name}=delete&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\" class=\"sys_report_memory ui-icon ui-icon-trash\"></font>";
						$check	="<input class=\"view_report\" class_field=\"{$this->sys_memory}\" class_field_id=\"$row_id\" id=\"{id}\" class_one=\"{$this->class_one}\" type=\"checkbox\" id=\"{$option["name"]}\" name=\"{$option["name"]}[{id}]\" value=\"{id}\">";
					}				
					else	
					{			
						$show	="<font data=\"&sys_section_{$this->sys_name}=show&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\"  class=\"sys_report ui-icon ui-icon-contact\"></font>";
						$write	="<font data=\"&sys_section_{$this->sys_name}=write&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\"  class=\"sys_report ui-icon ui-icon-pencil\"></font>";
						$delete	="<font data=\"&sys_section_{$this->sys_name}=delete&sys_action_{$this->sys_name}=&sys_id_{$this->sys_name}={id}\"  class=\"sys_report ui-icon ui-icon-trash\"></font>";
						$check	="<input class=\"view_report\" type=\"checkbox\" id=\"{$option["name"]}\" name=\"{$option["name"]}[{id}]\" value=\"{id}\">";
					}	
                    
                    if(!is_null($option))
                    {
                    	if(!isset($option["actions"]))				$option["actions"]=array();	
                    	
                    	if($option["actions"]=="false")
                    	{
                    		$option["actions"]			=array();		
                       		$option["actions"]["show"]	="1==0";
	                		$option["actions"]["write"]	="1==0";
	                		$option["actions"]["delete"]="1==0";
	                		$option["actions"]["check"]	="1==0";	
                    	}
                    	else
                    	{
		                	if(!isset($option["actions"]["show"]))		$option["actions"]["show"]	="1==1";
		                	if(!isset($option["actions"]["write"]))		$option["actions"]["write"]	="1==1";
		                	if(!isset($option["actions"]["delete"]))	$option["actions"]["delete"]="1==1";
		                	if(!isset($option["actions"]["check"]))		$option["actions"]["check"]	="1==1";
                    	}           	

	                	if($option["actions"]["show"]=="true")			$option["actions"]["show"]	="1==1";
	                	elseif($option["actions"]["show"]=="false")		$option["actions"]["show"]	="1==0";
	                	if($option["actions"]["write"]=="true")			$option["actions"]["write"]	="1==1";
	                	elseif($option["actions"]["write"]=="false")	$option["actions"]["write"]	="1==0";
	                	if($option["actions"]["delete"]=="true")		$option["actions"]["delete"]="1==1";
	                	elseif($option["actions"]["delete"]=="false")	$option["actions"]["delete"]="1==0";
	                	if($option["actions"]["check"]=="true")			$option["actions"]["check"]	="1==1";
	                	elseif($option["actions"]["check"]=="false")	$option["actions"]["check"]	="1==0";
                    	         	
                    	$eval="
                    		if({$option["actions"]["show"]}) 						$"."show='$show';
                    		else													$"."show='';
                    		
                    		if({$option["actions"]["write"]}) 						$"."write='$write';
                    		else													$"."write='';
                    		
                    		if({$option["actions"]["delete"]}) 						$"."delete='$delete';
                    		else													$"."delete='';
                    		                    		
                    		if({$option["actions"]["check"]}) 						$"."check='$check';
                    		else													$"."check='';                    		
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
                    	if(@eval($eval)===false)	
				    		echo "";#$eval; ---------------------------";					
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
			$view =$this->__VIEW_INPUTSECTION($view, $option);
			return $view;
		}    	
    	##############################################################################        
    	public function __FOLIOS($option)
    	{								
			if(!isset($option["variable"]))		$option["variable"]		="";
			if(!isset($option["subvariable"]))	$option["subvariable"]	="";
			if(!isset($option["tipo"]))			$option["tipo"]			="";
			if(!isset($option["subtipo"]))		$option["subtipo"]		="";
			if(!isset($option["objeto"]))		$option["objeto"]		="";
			if(!isset($option["company_id"]))	$option["company_id"]	=$_SESSION["company"]["id"];
			
			$sql    	="
				SELECT * FROM configuracion 
				WHERE 1=1 
					AND company_id='{$option["company_id"]}' 
					AND variable='{$option["variable"]}' 
					AND subvariable='{$option["subvariable"]}' 
					AND tipo='{$option["tipo"]}' 
					AND subtipo='{$option["subtipo"]}' 
					AND objeto='{$option["objeto"]}' 
			";
			$datas   	= $this->__EXECUTE("$sql");
			
			if(count($datas)>0)
				$sql    	="
					UPDATE configuracion SET valor=LPAD(valor+1,6,'0')						
					WHERE 1=1 
						AND company_id='{$option["company_id"]}' 
						AND variable='{$option["variable"]}' 
						AND subvariable='{$option["subvariable"]}' 
						AND tipo='{$option["tipo"]}' 
						AND subtipo='{$option["subtipo"]}' 
						AND objeto='{$option["objeto"]}' 
				";
			else	
				$sql    	="
					INSERT INTO configuracion SET 
						valor=LPAD(1,6,'0'),					 
						company_id='{$option["company_id"]}',
						variable='{$option["variable"]}', 
						subvariable='{$option["subvariable"]}' ,
						tipo='{$option["tipo"]}' ,
						subtipo='{$option["subtipo"]}' ,
						objeto='{$option["objeto"]}' 
				";
				
			$datas   	= $this->__EXECUTE("$sql");

			$sql    	="
				SELECT * FROM configuracion 
				WHERE 1=1 
					AND company_id='{$option["company_id"]}' 
					AND variable='{$option["variable"]}' 
					AND subvariable='{$option["subvariable"]}' 
					AND tipo='{$option["tipo"]}' 
					AND subtipo='{$option["subtipo"]}' 
					AND objeto='{$option["objeto"]}' 
			";
			$datas   	= $this->__EXECUTE("$sql");
			
			return $datas[0]["valor"];		    	
    	}
		###################################    	
		public function __VIEW_REPORT($option)
		{
			if(isset($option["template_option"]))	$template_option		=$option["template_option"];
			
			$return						=array();
		    $view_title					="";
			if(isset($this->sys_memory) AND isset($template_option["class_field"]))
			{	
				$campo					=$template_option["class_field"];
				
				if(isset($this->class_one) AND isset($_SESSION["SAVE"][$this->class_one]["$campo"]) AND count($_SESSION["SAVE"][$this->class_one]["$campo"])>0)
				{						
					$campo				=$template_option["class_field"];
					$option["data"]		=@$_SESSION["SAVE"][$this->class_one]["$campo"]["data"];
					$option["total"]	=count(@$_SESSION["SAVE"][$this->class_one]["$campo"]["data"]);				
					$option["inicio"]	=@$_SESSION["SAVE"][$this->class_one]["$campo"]["inicio"];		
					$option["title"]	=@$_SESSION["SAVE"][$this->class_one]["$campo"]["title"];				
				}
			}
		    if(is_array($option))
		    {
				$inicio=0;	
				if(isset($option["total"]) AND $option["total"]>=0)		$return["total"]	=$option["total"];
				else													$return["total"]	=0;
				if(isset($option["inicio"]) AND $option["inicio"]>0)	$inicio				=$option["inicio"];
				else													$inicio				=0;
				if(isset($option["fin"]) AND $option["fin"]>0)			$fin				=$option["fin"];
				else													$fin				=0;
		    	
		        $sys_order				="";
		        $sys_torder				="";
		    	if(!isset($option["name"]))    					$name		=@$this->sys_name;
		    	else											$name		=$option["name"];
				
				$this->sys_name			=$name;		
		    	
		    	if(isset($this->request["sys_page_$name"]))		$sys_page	=$this->request["sys_page_$name"];
		    	else											$sys_page	=1;

		    	if(isset($this->request["sys_order_$name"]))	$sys_order	=$this->request["sys_order_$name"];
		    	
		    	if(isset($this->request["sys_torder_$name"]))	$sys_torder	=$this->request["sys_torder_$name"];
		    	
		    	if(isset($this->request["sys_row_$name"]))	    $sys_row	=$this->request["sys_row_$name"];
		    	else                                            $sys_row	=50;
				
				if($sys_row=="")								$sys_row	=50;

		    	$option["sys_page_$name"]           			=$sys_page;		        		        
		
				#/*		
		    	if(isset($option["data"]))          			$return["data"] =$option["data"];	
		    	else  	#*/
		    	{			    		
		    	
		    	    $option["name"]                 			=$name;
		    	   
		    		$browse 									=$this->__BROWSE($option);		 
					if(isset($this->class_one) AND isset($this->sys_memory) AND isset($template_option["class_field"]))															
						$_SESSION["SAVE"][$this->class_one]["$campo"]=$browse;;												
					if(count($browse["data"])<=0)				$browse["data"]		=array();					
					
					##################################
					
		    		$return["data"]								= $browse["data"];
		    		
		    		$option["title"]							= @$this->sys_title;
					$option["title_pdf"]						= @$this->sys_title_pdf;
																					
		    		if(isset($browse["total"]))		
		    		{
						$return["total"]						= $browse["total"];	
						$inicio				 					= @$browse["inicio"] + 1;
						$aux_fin                    		    = @$inicio + @$sys_row -1;
						
						if($aux_fin<$return["total"])   		$fin    =$aux_fin;
						else                            		$fin    =$return["total"];
					}			    		
		    	}
		    	if(!isset($browse))			$browse			=array("");	
		    	if(!isset($browse["js"]))	$browse["js"]	="";	
		    	
		    	$this->__PRINT_R($browse);
		    			    	
				#######################											
				#/*	
				$view_title_data		=$this->__VIEW_TEMPLATE_TITLE($option);		

				$view_title				=$view_title_data["view_title"];
				$view_title_pdf			=$view_title_data["view_title_pdf"];
				#*/
								
		    	$view_create			="";
		    	$button_create			="";
				###########################
		    	if(isset($option["template_create"]) AND $option["template_create"] !="")
		    	{
					$this->words		=	$this->__INPUT($this->words,$this->sys_fields);
		    
					$eval="
						if(isset($"."this->sys_id_{$this->sys_name}))
							$"."clave_id	=$"."this->sys_id_{$this->sys_name};
					";
					
					eval($eval);
			
		    		$view_create		=	$this->__REPLACE($this->__VIEW_CREATE($option["template_create"]),$this->words);
					$view_create="
            			<div id=\"create_$name\" title=\"Crear Resgistro\" class=\"report_search d_none\" style=\"width:100%; background-color:#373737;\">
	            			$view_create
            			</div>
					";		    	    
					$button_create="
						<td width=\"15\" align=\"center\">
							<font id=\"create_$name\" active=\"$name\" class=\"ui-button show_form\">Formulario</font>
						</td>	
					";					
		    	}    

		    	$view_search="";
		    	$button_search="";
				#######################
		    	if(isset($option["template_search"]) AND $option["template_search"] !="")    
		    	{		    		
		    		$this->words["module_body"]     =$this->__VIEW_CREATE($option["template_search"]);
		    		$this->words					=$this->__INPUT($this->words,$this->sys_fields); 

					$view_search					=$this->words["module_body"];
		    		$this->words["module_body"]		="";
		    		
		    	    $view_search     				=$this->__TEMPLATE($option["template_search"]);		    	    
		    	    $view_search					=str_replace("<td>", "<td class=\"title\">", $view_search);
		    	    
		    	    if(!in_array(@$this->request["sys_action"],$this->sys_print))			    	    
					{
						$view_search="
		        			<div id=\"search_$name\" title=\"Filtrar Resgistro\" class=\"report_search d_none\" style=\"width:100%; background-color:#373737; padding:0px; margin:0px;\">
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
		    	}    
                $view_body="";
				##############################
		    	if(isset($option["template_body"]))
		    	{    
		    	    $template       				=$option["template_body"];
		    	    $option_kanban					=array();
		    	    if(isset($option["actions"]))	$option_kanban["actions"]	=$option["actions"];
		    	    if(isset($option["color"]))		$option_kanban["color"]		=$option["color"];
		    	    if(isset($option["name"]))		$option_kanban["name"]		=$name;
		    	    if(!isset($option["input"]))	$option_kanban["input"]		="true";
		    	    if(isset($option["input"]))		$option_kanban["input"]		=$option["input"];
		    	    
					if(isset($return["data_0"]))
					{
						$view_body					=$this->__VIEW_KANBAN2($template,$return["data_0"],$option_kanban);
						$view_body_pdf				=$this->__VIEW_KANBAN2($template."_pdf",$return["data_0"],$option_kanban);
						unset($return["data_0"]);
					}	
					else
					{	
						$view_body					=$this->__VIEW_KANBAN2($template,$return["data"],$option_kanban);
						$view_body_pdf				=$this->__VIEW_KANBAN2($template."_pdf",$return["data"],$option_kanban);
					}

					if($view_body_pdf=="")	$view_body_pdf=$view_body;
					
					$return["pdf"]	="
						<table width=\"100%\" border=\"0\" style=\"background-color:#fff;  color:#000; padding:3px; margin:0px;\">								
							$view_title_pdf
							$view_body_pdf
						</table>					
					";
		    	}    
                #if(isset($inicio) AND $return["total"]>0)
                {                	
                	if(@$this->request["sys_action"]=="print")	$view_head="";                	                
                	
                	elseif(!in_array(@$this->request["sys_action"],$this->sys_print))	
                	{	
						if(!isset($this->request["sys_filter_$name"]))	$this->request["sys_filter_$name"]="";
				
                		$view_head="
							<div id=\"report_$name\" style=\"height:35px; width:100%;  padding:0px; margin:0px;\" class=\"ui-widget-header\">
								<table width=\"100%\" height=\"100%\" style=\"padding:0px; margin:0px;\">
									<tr>
										<td width=\"10\"></td>
						";
						if(!in_array(@$this->request["sys_action"],$this->sys_print))	
						{
							$view_head.="						
										$button_search
										$button_create
										<td width=\"1\">
											<table>
												<tr id=\"filter_fields_$name\">
												</tr>
											</table>
										</td>
										<td>											
											<input style=\"paddin:8px; height:29px;\" name=\"sys_filter_$name\" system=\"yes\" id=\"sys_filter_$name\" class=\"formulario $name\" type=\"text\" value=\"{$this->request["sys_filter_$name"]}\" placeholder=\"Filtrar reporte\">													
										</td>
										<td width=\"30\">
											<font id=\"sys_search_$name\" class=\"sys_seach ui-button\">Filtrar</font>
										</td>
							";
						}
						$view_head.="						
										
										<td align=\"right\">
											<b> $inicio - $fin / {$return["total"]}</b>
										</td>								
										<td width=\"50\" style=\"padding-left:8px; padding-right:8px;\">
						";
						if(!in_array(@$this->request["sys_action"],$this->sys_print))	
						{
							if(@!$this->request["sys_row_$name"]) $this->request["sys_row_$name"]=50; 	
							$array=array(1,20,50,100,200,500);
							$option_select="";
							foreach($array as $index)
							{
								$selected		="";	
								if($index==$this->request["sys_row_$name"]) 	$selected="selected";
								$option_select.="<option value=\"$index\" $selected>$index</option>";
							}							
							
							$view_head.="
											<select type=\"report\" name=\"sys_rows_$name\" id=\"sys_rows_$name\">
												$option_select		
											</select>
							";
						}					
						$view_head.="	
										</td>
										<td  width=\"20\" align=\"center\" >
											<font action=\"-\" name=\"$name\" class=\"page ui-button\">Anterior</font>
										</td>										
										<td width=\"20\" align=\"center\" >
											<font action=\"+\" name=\"$name\" class=\"page ui-button\">Siguiente</font>
										</td>
									</tr>
								</table>		
								
							</div>                
                		";
                	}
					#
										
					if(!isset($option["header"]))	
						$option["header"]		="true";					
										
					if(@$option["header"]!="true")		$view_head="";
										
					$return["title"]=$view_title;

					if(!isset($option["height"]))					$option["height"]="100%";
					
					$height_render="height:{$option["height"]};";
					$min_height		="min-height: 140px;";
					if(in_array(@$option["height"],$this->sys_false))
					{
						$height_render	="";
						$min_height		="";
					}						

					$button_create_js="";
					
					if(isset($template_option) AND !in_array(@$this->request["sys_action"],$this->sys_print))
					{						
						$button_create_js="
							if($(\"font#create_$name\").length>0)
							{	
								$(\"font.show_form\").button({
									icons: 	{primary:	\"ui-icon-extlink\"},
									text: 	false								
								});

								var options={};
								options[\"class_one\"]			=\"{$template_option["class_one"]}\";
								options[\"class_field\"]		=\"{$template_option["class_field"]}\";												
								options[\"class_many\"]			=\"{$template_option["class_field_value"]["class_name"]}\";
								options[\"object\"]				=\"{$template_option["class_field_value"]["class_name"]}\";

	            				$(\"font#create_$name\").click(function()
	            				{
	            					$(\"div#create_$name\")
	            						.dialog({
			        						open: function(event, ui){
												var dialog = $(this).closest('.ui-dialog');
											},
											buttons: {
												\"Registrar\": function() {													
													many2one_post(options);
												},
												\"Registrar y Cerrar\": function() {													
													many2one_post(options);
													$( this ).dialog(\"close\");
												},

												\"Cerrar\": function() {
													$( this ).dialog(\"close\");
												}
											},										
			        						width:\"700px\"
			        					});
	            				});
							}						
						";
						
					}		
							

					#template_option
					$report_class="";
					if(!isset($option["template_option"]))	$report_class="report_class";

					if(!in_array(@$this->request["sys_action"],$this->sys_print))					
					{
						@$return["js"].="			
								$button_create_js
								sys_report_memory();
												
								$(\"#sys_search_$name\")
									.button({
										icons: {	primary: \"ui-icon-search\" },
										text: false
									})
									.click(function(){
										$(\"#sys_action_$name\").val(\"seach\");
										$(\"#sys_page_$name\").val(1);	
										$(\"form\").submit();
									}
								);							
								$(\"#sys_rows_$name\").change(function(){
								
									$(\"#sys_row_$name\").val(  $(\"#sys_rows_$name\").val()      );
									$(\"#sys_page_$name\").val(1);
									$(\"form\").submit(); 									
								});								
								$(\".page[action='-'][name='$name']\").button({
									icons: {	primary: \"ui-icon-triangle-1-w\" },
									text: false
								});
								$(\".page[action='+'][name='$name']\").button({
									icons: {	primary: \"ui-icon-triangle-1-e\" },
									text: false
								});
							
								$(\".page\").click(function(){
									var action      	=$(this).attr(\"action\");						    
									var sys_page    	=$(\"#sys_page_$name\").val();
									var sys_page2		=sys_page;
									if(action==\"-\")
									{	
										if($inicio > $(\"#sys_row_$name\").val())		sys_page--;
									}	
									else
									{				
										if($fin < {$return["total"]})					sys_page++;
									}			
									if(sys_page!=sys_page2)
									{	
										$(\"#sys_page_$name\").val(sys_page);
										$(\"form\").submit(); 
									}	
								});	
						";						


						$return["report"]="
							$view_head														
							<div id=\"div_$name\" class=\"$report_class view_report_d1\" obj=\"$name\" style=\"height: 100%;\">
								<div id=\"div2_$name\" class=\"view_report_d2\" style=\"width:100%; overflow-y:auto; overflow-x:hidden; padding:0px; margin:0px;\">
									<table width=\"100%\" class=\"view_report_t1\" style=\"background-color:#fff; color:#000;  padding:0px; margin:0px;\">
										$view_title
										$view_body
									</table>
								</div>
							</div>
							<script>
								{$return["js"]}
							</script>
						";
						
					}
					
					#<div id=\"base_$name\" class=\"render_h_origen\" diferencia_h=\"-40\" style=\"$height_render width:100%; overflow-y:auto; overflow-x:hidden; border: 	1px solid #ccc; padding:0px; margin:0px;\">
					if(!in_array(@$this->request["sys_action"],$this->sys_print))					
						$view="
						<div id=\"base_$name\" class=\"render_h_origen\" diferencia_h=\"-20\" style=\"$height_render width:100%; overflow-y:auto; overflow-x:hidden; border: 	1px solid #ccc; padding:0px; margin:0px;\">
					";		

					if(!in_array(@$this->request["sys_action"],$this->sys_print))					
						@$view.="{$return["report"]}";
					else	
						@$view.="{$return["pdf"]}";

					if(!in_array(@$this->request["sys_action"],$this->sys_print))					
						$view.="						
						</div>		
					";

					if(!in_array(@$this->request["sys_action"],$this->sys_print))
					{
						$view.="
							<input name=\"sys_order_$name\" id=\"sys_order_$name\" class=\"$name\" type=\"hidden\" value=\"$sys_order\">		
							<input name=\"sys_torder_$name\" id=\"sys_torder_$name\" class=\"$name\" type=\"hidden\" value=\"$sys_torder\">
							<input name=\"sys_page_$name\" id=\"sys_page_$name\" class=\"$name\" type=\"hidden\" value=\"$sys_page\">
							<input name=\"sys_row_$name\" id=\"sys_row_$name\" class=\"$name\" type=\"hidden\" value=\"$sys_row\">
						";
					}				
					$filter_autocomplete="";
					if(isset($this->sys_fields) AND is_array($this->sys_fields))
					{
						foreach($this->sys_fields as $campo=>$valor)
						{        								
							if(@$this->request["sys_filter_{$this->sys_name}_{$campo}"])
							{	
								if(!isset($this->request["sys_where_{$this->sys_name}_{$campo}"]))
									$this->request["sys_where_{$this->sys_name}_{$campo}"] = "LIKE";
									
								$sys_filter=$this->request["sys_where_{$this->sys_name}_{$campo}"];	
								$filter_autocomplete.="
									var filter=filter_html(\"$campo\",\"{$valor["title_filter"]}\",\"{$this->request["sys_filter_{$this->sys_name}_{$campo}"]}\",\"$name\",\"$sys_filter\");											
									$(\"#filter_fields_$name\").append(filter);
								";
							}							
						}	
					}									
					if(!in_array(@$this->request["sys_action"],$this->sys_print))
					{				
						$view.="
							$view_search
							$view_create
							<script>					
								if($(\"#sys_filter_$name\").length>0)        
								{
									$filter_autocomplete
								
									$( function() 
									{
										function split( val ) 			{	return val.split( /,\s*/ );	}
										function extractLast( term ) 	{	return split( term ).pop();	}

										$(\"#sys_filter_$name\" )								
										.on( \"keydown\", function( event ) 
										{
											if( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( \"instance\" ).menu.active ) 
											{												
												event.preventDefault();
											}
										})
										.autocomplete(
										{
											source: function( request, response ) 
											{
												$.getJSON( \"../sitio_web/ajax/filter_autocomplete.php?class={$this->sys_object}\", {
												term: extractLast( request.term )
												}, response );
											},
											
											focus: function() 
											{
												// prevent value inserted on focus
												return false;
											},
											select: function( event, ui ) 
											{
												var filter=filter_html(ui.item.field,ui.item.title,ui.item.term,\"$name\");											
												$(\"#filter_fields_$name\").append(filter);
												
												this.value = \"\";
												////$(\"form\").submit(); 
												return false;
											}											
										})
										.autocomplete( \"instance\" )._renderItem = function( ul, item ) 
										{
											return $( \"<li>\" )
											.append( \"<div> Buscar <b>\" + item.term + \"</b> en la columna <b><font size=\\\"1\\\"> \" + item.title + \" </font></b></div>\" )
											.appendTo( ul );
										}									
									} );
								}
								$(\".title\").resizable({
									handles: \"e\"
								});
								
								alert(\"aaaaa\");
								
								{$browse["js"]}
							</script>							
						";
					}
					$return["html"]	=$view;
				}	
		    }	
		    else $return["html"]="Es necesario un array para generar el reporte";
		    
		    return $return;
		}   
		public function __VIEW_TEMPLATE_TITLE($option)
		{
			$return=array("view_title"=>"","view_title_pdf"=>"");	

			if(isset($option["template_title"]) AND $option["template_title"] != "")
			{
				$view_title     				=$this->__TEMPLATE($option["template_title"]);					//  HTML DEL REPORTE
				$view_title						=str_replace("<td>", "<td class=\"title\">", $view_title);      // AGREGA la clase titulo

				$view_title_pdf 				=$this->__TEMPLATE($option["template_title"]."_pdf");					//  HTML DEL REPORTE
				$view_title_pdf					=str_replace("<td>", "<td class=\"title\">", $view_title_pdf);      // AGREGA la clase titulo
								
				if(isset($this->sys_title))
				{
					$return["view_title"]	    =$this->__REPLACE($view_title,$this->sys_title);					
					$return["view_title_pdf"]   =$this->__REPLACE($view_title_pdf,$this->sys_title);
				}    		    	    				
			} 
			return $return;
		} 			
		
    	##############################################################################        
		public function __MESSAGE($message,$option=NULL)
		{
			/*
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
			*/
		}    
		function pointInPolygon($point, $polygon, $pointOnVertex = true) 
		{
			
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
				#return "vertice";
				return "DENTRO";
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
					#return "BORDE";
					return "DENTRO";
				}
				if ($point['y'] > min($vertex1['y'], $vertex2['y']) and $point['y'] <= max($vertex1['y'], $vertex2['y']) and $point['x'] <= max($vertex1['x'], $vertex2['x']) and $vertex1['y'] != $vertex2['y']) 
				{
					$xinters = ($point['y'] - $vertex1['y']) * ($vertex2['x'] - $vertex1['x']) / ($vertex2['y'] - $vertex1['y']) + $vertex1['x'];
					if ($xinters == $point['x']) 
					{ // Checar si el punto está en un segmento (otro que horizontal)
						#return "BORDE";
						return "DENTRO";
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
			$coordinates = explode(" ", $pointString);
			return array("x" => $coordinates[0], "y" => $coordinates[1]);
		}	
		##############################################################################
		function __SMS($sDestination, $sMessage, $debug, $sSenderId){
			$sData ='cmd=sendsms&';
			$sData .='domainId=solesgps&';
			$sData .='login=e.vizcaino@solesgps.com&';
			$sData .='passwd=Vz4sPioUm7&';


			#$sData .='domainId=test&';
			#$sData .='login=e.vizcaino&';
			#$sData .='passwd=r94uf43n&';
			
			//No es posible utilizar el remitente en América pero sí en España y Europa
			$sData .='senderId='.$sSenderId.'&';
			$sData .='dest='.str_replace(',','&dest=',$sDestination).'&';
			$sData .='msg='.urlencode(substr($sMessage,0,160));
			#$sData .='msg='.urlencode(utf8_encode(substr($sMessage,0,160)));

			//Tiempo máximo de espera para conectar con el servidor = 5 seg
			$timeOut = 5; 
			$fp = fsockopen('www.altiria.net', 80, $errno, $errstr, $timeOut);
			if (!$fp) 
			{
				//Error de conexion o tiempo maximo de conexion rebasado
				$output = "ERROR de conexion: $errno - $errstr<br />\n";
				$output .= "Compruebe que ha configurado correctamente la direccion/url ";
				$output .= "suministrada por altiria<br>";
				return $output;
			} 
			else 
			{
				$buf = "POST /api/http HTTP/1.0\r\n";
				$buf .= "Host: www.altiria.net\r\n";
				$buf .= "Content-type: application/x-www-form-urlencoded; charset=UTF-8\r\n";
				$buf .= "Content-length: ".strlen($sData)."\r\n";
				$buf .= "\r\n";
				$buf .= $sData;
				fputs($fp, $buf);
				$buf = "";

				//Tiempo máximo de espera de respuesta del servidor = 60 seg
				$responseTimeOut = 60;
				stream_set_timeout($fp,$responseTimeOut);
				stream_set_blocking ($fp, true);
				if (!feof($fp))
				{
					if (($buf=fgets($fp,128))===false)
					{
						// TimeOut?
						$info = stream_get_meta_data($fp);
						if ($info['timed_out'])
						{
							$output = 'ERROR Tiempo de respuesta agotado';
							return $output;
						} 
						else 
						{
							$output = 'ERROR de respuesta';
							return $output;
						}
					} 
					else
					{
						while(!feof($fp))
						{
							$buf.=fgets($fp,128);
						}
					}
				} 
				else 
				{
					$output = 'ERROR de respuesta';
					return $output;
				}

				fclose($fp);

				//Si la llamada se hace con debug, se muestra la respuesta completa del servidor
				if ($debug)
				{
					print "Respuesta del servidor: <br>".$buf."<br>";
				}

				//Se comprueba que se ha conectado realmente con el servidor
				//y que se obtenga un codigo HTTP OK 200 
				if (strpos($buf,"HTTP/1.1 200 OK") === false)
				{
					$output = "ERROR. Codigo error HTTP: ".substr($buf,9,3)."<br />\n";
					$output .= "Compruebe que ha configurado correctamente la direccion/url ";
					$output .= "suministrada por Altiria<br>";
					return $output;
				}
				//Se comprueba la respuesta de Altiria
				if (strstr($buf,"ERROR"))
				{
					$output = $buf."<br />\n";
					$output .= " Ha ocurrido algun error. Compruebe la especificacion<br>";
					return $output;
				} 
				else 
				{
					$output = $buf."<br />\n";
					$output .= " Exito<br>";
					return $output; 
				}     
			}
		}					
	}  	
?>
