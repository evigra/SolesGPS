<?php
	class movimiento extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_menu			=array();
		var $sys_enviroments	="DEVELOPER";
		var $sys_fields		=array( 
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			    "default"           => "",
			    "value"             => "",			    
			),
			"company_id"	    =>array(
			    "title"             => "Empresa",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",			    
			),			

			"empresa_id"	=>array(
			    "title"             => "Empresa",
			    "title_filter"      => "Empresa",	
			    "description"       => "Encargado de supervisar distintos dispositivos",
			    "showTitle"         => "si",
			    "type"              => "autocomplete",
			    "source"           	=> "../modulos/empresa/ajax/autocomplete.php",
			    "value"             => "",			    
			    
			    "relation"          => "one2many",			    
			    "class_name"       	=> "cliente",
			    "class_field_l"    	=> "nombre",				# Label
			    "class_field_o"    	=> "empresa_id",
			    "class_field_m"    	=> "id",			    
			),			

			"movimientos_ids"	    =>array(
			    "title"             => "Horario",
			    "showTitle"         => "si",
			    "type"              => "form",
			    "default"           => "",
			    "value"             => "",
			    "relation"          => "many2one",			    
			    "class_name"       	=> "movimientos",			    
				#"class_template"  	=> "many2one_lateral",			    
				#"class_report" 		=> "kanban",			    
			    "class_field_o"    	=> "id",
			    "class_field_m"    	=> "movimiento_id",				
				#"class_field_l"    	=> "horario",	
			),
			"tipo"	    =>array(
			    "title"             => "Tipo",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"compra"	    =>array(
			    "title"             => "Lista de compra",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),			
			"venta"	    =>array(
			    "title"             => "Lista de venta",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),			
			"movimiento_id"	    =>array(
			    "title"             => "Relacion",
			    "showTitle"         => "si",
			    "type"              => "hidden",
			    "default"           => "",
			    "value"             => "",
			),			
			"registro"	    =>array(
			    "title"             => "Registrado",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			
			"fecha"	    =>array(
			    "title"             => "Fecha",
			    "title_filter"      => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "date",
			    "default"           => "",
			    "value"             => "",
			),			

			"folio"	    =>array(
			    "title"             => "Folio",
			    "title_filter"      => "Folio",
			    "showTitle"         => "si",
			    "type"              => "input",
			    "default"           => "",
			    "value"             => "",
			),			

			
				
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################
        
		public function __CONSTRUCT()
		{	
			parent::__CONSTRUCT();		
			#$this->__PRINT_R($_SESSION["SAVE"]);
			
		}
		#/*
   		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		
    		## GUARDAR USUARIO
    		#$datas["total"]		=count(explode(",",$datas["dias"]));
			$datas["registro"]			=$this->sys_date;
			$datas["company_id"]		=$_SESSION["company"]["id"];
			
			
			if(!isset($datas["folio"]) OR $datas["folio"]=="")
			{
				$option_folios=array();
				$option_folios["variable"]		=date("Y");
				$option_folios["subvariable"]	=date("Y");
				$option_folios["tipo"]			="folio";
				$option_folios["subtipo"]		="folio";
				$option_folios["objeto"]		="folio";
				
				
				$datas["folio"]				=$this->__FOLIOS($option_folios);
			}	
			
			#movimiento_id
			
			if($this->request["sys_action_movimiento"]=="__SAVE_pagar")
			{
				#$this->__PRINT_R($this->request);
								
				$datas["movimiento_id"]						=$this->sys_primary_id;
				$datas["tipo"]								="PAG";
				
				$this->request["sys_id"]					="";
				$this->request["sys_id_movimiento"]			="";
				$this->request["sys_section_movimiento"]	="create";
				
				$this->sys_primary_id	="";
			}
			#$option["echo"]=$datas["total"];
    		
    	    $return= parent::__SAVE($datas,$option);
    	    #$this->__PRINT_R($this->sys_sql);
    	    #$this->__PRINT_R($datas);
    	    return $return;
    	    
    	    
		}
		#*/		
   		public function __GENERAR_PDF()
    	{
			$_SESSION["pdf"]	=array();	
			
			$_SESSION["pdf"]["title"]				="INSTITUTO MEXICANO DEL SEGURO SOCIAL";
			$_SESSION["pdf"]["subject"]				="";
			$_SESSION["pdf"]["save_name"]			="";
			$_SESSION["pdf"]["PDF_MARGIN_TOP"]		=10;
			
			$_SESSION["pdf"]["template"]			=$this->__FORMATO($this->sys_primary_id);
		}		
   		public function __FORMATO($option)
    	{
			$template="";	
			$datos										=$this->__BROWSE($option);
			
			if(@$datos["data"])							$datos=$datos["data"];			
						
			foreach($datos as $dato)
			{
				$conceptos_ids_options=array(					
					"where"=>array(
						"calculo_id={$dato["id"]}"
					)
				);
				if($dato["che_pago"]==1) 		$dato["che_pago"]="X";
				else							$dato["che_pago"]="";
				if($dato["che_descuento"]==1) 	$dato["che_descuento"]="X";
				else							$dato["che_descuento"]="";
				if($dato["che_reintegro"]==1) 	$dato["che_reintegro"]="X";
				else							$dato["che_reintegro"]="";
				if($dato["che_exclusion"]==1) 	$dato["che_exclusion"]="X";
				else							$dato["che_exclusion"]="";
				if($dato["che_ajuste"]==1) 		$dato["che_ajuste"]="X";
				else							$dato["che_ajuste"]="";

				$words									=$dato;				
				$hoja2=0;
				if(is_array($words) AND count($words)>0)
				{	
					$template								.=$this->__TEMPLATE("sitio_web/html/PDF_FORMATO_IMSS");							
					
					$words									=array_merge(array("sys_modulo" => $this->__TEMPLATE($this->sys_module . "html/PDF_FORMATO")),$words);
					
					$words["sys_titulo"]					="COORDINACION DE GESTION DE RECURSOS HUMANOS";		
					$words["sys_subtitulo"]					="DEPARTAMENTO DELEGACIONAL DE PERSONAL";					
				
					if(@$dato["trabajador_departamento_id"])
						$words["lugar"]						=$this->lugar(substr($dato["trabajador_departamento_id"],0,6));		
					$words["fecha"]							=$this->sys_date;		
					
					#####################################
					$datas_conceptos=$this->conceptos_ids_obj->__BROWSE($conceptos_ids_options);		
					if($datas_conceptos["total"]>0)
					{						
						$a=0;
						foreach($datas_conceptos["data"] as $data_conceptos)
						{
							$a++;	
							if(!isset($words["CP1V_matricula$a"]))
							{
								if($a==2 AND $hoja2==0)	
								{	
									$hoja2=1;
									$template					.="<br><br>".$this->__TEMPLATE($this->sys_module . "html/PDF_FORMATO2");						
								}	
								$words["CP1V_matricula$a"]	=$datos[0]["trabajador_clave"];
								$words["CP1V_con$a"]			=$data_conceptos["con"];
								$words["CP1V_imp$a"]			=$data_conceptos["imp"];
								$words["CP1V_uni$a"]			=$data_conceptos["uni"];
								$words["CP1V_dia$a"]			=$data_conceptos["dia"];
								$words["CP1V_jor$a"]			=$data_conceptos["jor"];
								$words["CP1V_fac$a"]			=$data_conceptos["fac"];
								$words["CP1V_bas$a"]			=$data_conceptos["bas"];
								$words["CP1V_mar$a"]			=$data_conceptos["mar"];
								$words["CP1V_des$a"]			=$data_conceptos["des"];
								$words["CP1V_cif$a"]			=$data_conceptos["cif"];								
								$words["CP1V_ini$a"]			=$data_conceptos["ini"];								
								$words["CP1V_fin$a"]			=$data_conceptos["fin"];								
							}
						}
					}				
					#####################################
					$datas_fijos=$this->fijos_ids_obj->__BROWSE($conceptos_ids_options);					
					if($datas_fijos["total"]>0)
					{								
						$a=0;
						foreach($datas_fijos["data"] as $data_conceptos)
						{
							$a++;	
							if(!isset($words["CPF1_matricula$a"]))
							{								
								if($a==2 AND $hoja2==0)	
								{	
									$hoja2=1;
									$template					.="<br><br>".$this->__TEMPLATE($this->sys_module . "html/PDF_FORMATO2");						
								}	
								$words["CPF1_matricula$a"]		=$datos[0]["trabajador_clave"];
								$words["CPF1_con$a"]			=@$data_conceptos["con"];
								$words["CPF1_imp$a"]			=@$data_conceptos["imp"];
								$words["CPF1_uni$a"]			=@$data_conceptos["uni"];																																
								$words["CPF1_cif$a"]			=@$data_conceptos["cif"];								
								$words["CPF1_ini$a"]			=@$data_conceptos["ini"];								
								$words["CPF1_fin$a"]			=@$data_conceptos["fin"];								
								$words["CPF1_noc$a"]			=@$data_conceptos["noc"];								
								$words["CPF1_des$a"]			=@$data_conceptos["des"];								
							}

						}
					}						
					#####################################
					$datas_fijos=$this->historicos_ids_obj->__BROWSE($conceptos_ids_options);					
					if($datas_fijos["total"]>0)
					{								
						$a=0;
						foreach($datas_fijos["data"] as $data_conceptos)
						{
							$a++;	
							if(!isset($words["H1_matricula$a"]))
							{								
								if($a==2 AND $hoja2==0)	
								{	
									$hoja2=1;
									$template					.="<br><br>".$this->__TEMPLATE($this->sys_module . "html/PDF_FORMATO2");						
								}	
								$words["H1_matricula$a"]		=$datos[0]["trabajador_clave"];
								$words["H1_con$a"]				=@$data_conceptos["con"];
								$words["H1_imp_s$a"]			=@$data_conceptos["imp_s"];
								$words["H1_imp_r$a"]			=@$data_conceptos["imp_r"];
								$words["H1_uni_s$a"]			=@$data_conceptos["uni_s"];			
								$words["H1_uni_r$a"]			=@$data_conceptos["uni_r"];			
								$words["H1_des$a"]				=@$data_conceptos["des"];								
								$words["H1_dic$a"]				=@$data_conceptos["dic"];								
								$words["H1_deb$a"]				=@$data_conceptos["deb"];								
								$words["H1_mes$a"]				=@$data_conceptos["mes"];								
							}
						}
					}						
					
					for($a=1; $a<7;$a++)
					{	
						if(!isset($words["CPF1_matricula$a"]))
						{
							$words["CPF1_matricula$a"]	="";
							$words["CPF1_con$a"]		="";
							$words["CPF1_imp$a"]		="";
							$words["CPF1_uni$a"]		="";
							$words["CPF1_cif$a"]		="";
							$words["CPF1_ini$a"]		="";
							$words["CPF1_fin$a"]		="";						
							$words["CPF1_noc$a"]		="";						
							$words["CPF1_des$a"]		="";						
							
						}						
						if(!isset($words["H1_matricula$a"]))
						{
							$words["H1_matricula$a"]		="";
							$words["H1_con$a"]				="";
							$words["H1_imp_s$a"]			="";
							$words["H1_imp_r$a"]			="";
							$words["H1_uni_s$a"]			="";
							$words["H1_uni_r$a"]			="";
							$words["H1_des$a"]				="";
							$words["H1_dic$a"]				="";
							$words["H1_deb$a"]				="";
							$words["H1_mes$a"]				="";
							
						}							
						if(!isset($words["CP1V_matricula$a"]))
						{
							$words["CP1V_matricula$a"]	="";
							$words["CP1V_con$a"]		="";
							$words["CP1V_imp$a"]		="";
							$words["CP1V_uni$a"]		="";
							$words["CP1V_dia$a"]		="";
							$words["CP1V_jor$a"]		="";
							$words["CP1V_fac$a"]		="";
							$words["CP1V_bas$a"]		="";
							$words["CP1V_mar$a"]		="";
							$words["CP1V_cif$a"]		="";
							$words["CP1V_des$a"]		="";
							$words["CP1V_ini$a"]		="";
							$words["CP1V_fin$a"]		="";							
						}						
						
					}						
					$template								=$this->__REPLACE($template,$words);
					
					#$this->__PRINT_R($datas_conceptos);	
					
					
					/*
					if($datos[0]["concepto_2"]>0)
					{			
						$template							.=$this->__TEMPLATE($this->sys_module . "html/PDF_FORMATO2");						
						$words["matricula3_2"]				=$datos[0]["trabajador_clave"];
						
						$template							=$this->__REPLACE($template,$words);				
					}
					*/
				}	
			}	

			return                  					$template;
		}	
   		public function __REPORT_PENDIENTE()
    	{
			$option=array();			
			$option["template_title"]	                = $this->sys_module . "html/report_title";
			$option["template_body"]	                = $this->sys_module . "html/report_body";
			
			$option["actions"]							= array();
			
			$option["actions"]["write"]					="true";
			$option["actions"]["show"]					="tre";
			$option["actions"]["check"]					="false";
			$option["actions"]["delete"]				="false";
			
			$option["order"]="id desc";
			$option["where"]=array("estatus =''");
			
			/*
			if($this->__NIVEL_SESION(">=10")==true)	 // NIVEL SUPER ADMINISTRADOR 			
			if($this->__NIVEL_SESION(">=20")==true)	 // NIVEL ADMINISTRADOR 			
			{					
				$option["where"][]="left(trabajador_departamento,6)=left('{$_SESSION["user"]["departamento_id"]}',6)";				
			}
			#$option["echo"]="PENDIENTE";
			#*/
			
			return $this->__VIEW_REPORT($option);
		}				
   		public function __REPORT_APROVADO()
    	{
			$option=array();			
			$option["template_title"]	                = $this->sys_module . "html/report_title";
			$option["template_body"]	                = $this->sys_module . "html/report_body";
			
			$option["where"]=array("estatus = 'APROVADO'");

			$option["actions"]							= array();
			#$option["actions"]["write"]					="$"."row[\"estatus\"]==''  OR $"."this->__NIVEL_SESION(\"<=20\")==true";
			$option["actions"]["show"]					="$"."row[\"estatus\"]!='CANCELADO'";			
			$option["actions"]["check"]					="false";
			$option["actions"]["delete"]				="false";

			$option["order"]="id desc";
			
			return $this->__VIEW_REPORT($option);
		}				
   		public function __REPORT_CANCELADOS()
    	{
			$option=array();			
			$option["template_title"]	                = $this->sys_module . "html/report_title";
			$option["template_body"]	                = $this->sys_module . "html/report_body";
			
			$option["where"]=array("estatus = 'CANCELADO'");

			$option["actions"]							="false";

			return $this->__VIEW_REPORT($option);
		}				
   		public function __REPORT_SUSTITUTO($option="")
    	{
			
			if($option=="")	$option=array();			
			$option["template_title"]	                = $this->sys_module . "html/report_sustituto_title";
			$option["template_body"]	                = $this->sys_module . "html/report_sustituto_body";
			
			
			if(!isset($option["actions"]))	
			{	
				$option["actions"]							= array();
				#$option["actions"]["write"]					="$"."row[\"estatus\"]==''  OR $this->__NIVEL_SESION(\">=20\")==true";
				$option["actions"]["show"]					="$"."row[\"estatus\"]!='CANCELADO'";			
				$option["actions"]["check"]					="false";
				$option["actions"]["delete"]				="false";
			}	
			
			
			$option["order"]="id desc";
			
			return $this->__VIEW_REPORT($option);
		}
   		public function __REPORTE($option="")
    	{			
			if($option=="")	$option=array();			
			#$option["template_title"]	                = $this->sys_module . "html/report_title";
			$option["template_body"]	                = $this->sys_module . "html/report_body";
	
			
			if(!isset($option["actions"]))	
			{	
				$option["actions"]							= array();
				#$option["actions"]["write"]					="$"."row[\"estatus\"]==''  OR $"."this->__NIVEL_SESION(\"<=20\")==true";
				$option["actions"]["show"]					="$"."row[\"estatus\"]!='CANCELADO'";			
				$option["actions"]["check"]					="false";
				$option["actions"]["delete"]				="false";
			}	
			
			
			$option["order"]="id desc";
			
			return $this->__VIEW_REPORT($option);
		}						

   		public function __REPORT_ESPECIFICO()
    	{
			$this->sys_fields["departamento_id"]	=array("title"             => "Departamento");
			$this->sys_fields["puesto_id"]			=array("title"             => "Categoria");
			$this->sys_fields["jornada"]			=array("title"             => "Jornada");

				## GUARDAR USUARIO
			$option=array();			
			$option["template_title"]	                = $this->sys_module . "html/report_especifico_title";
			$option["template_body"]	                = $this->sys_module . "html/report_especifico_body";
			
			$option["select"]=array(				
				"trabajador_clave",
				"left(departamento_id,6)"	=>"departamento_id",
				"right(puesto_id,2)"		=>"jornada",
				"puesto_id",				
				"sum(total)"				=>"total",
			);				
			$option["where"]=array(
				"dias LIKE '%/". date("n")."/%'",	
				"estatus = 'APROVADO'"
			);
			
			
			$option["from"]="personal_txt join plazas on trabajador_clave=matricula";
			$option["group"]="trabajador_clave";
			
			$option["actions"]							="false";
			
			#$option["echo"]="REPORT1";
			
			/*
			99062212    1ra de junio    Ma sara marquez preciado			
			*/						
			return $this->__VIEW_REPORT($option);
		}				

   		public function __REPORT_GENERAL()
    	{
			$this->sys_fields["unidad"]=array("title"             => "Unidad");
			$this->sys_fields["Ene"]=array("title"             => "Ene");
			$this->sys_fields["Feb"]=array("title"             => "Feb");
			$this->sys_fields["Mar"]=array("title"             => "Mar");
			$this->sys_fields["Abr"]=array("title"             => "Abr");
			$this->sys_fields["May"]=array("title"             => "May");
			$this->sys_fields["Jun"]=array("title"             => "Jun");
			$this->sys_fields["Jul"]=array("title"             => "Jul");
			$this->sys_fields["Ago"]=array("title"             => "Ago");
			$this->sys_fields["Sep"]=array("title"             => "Sep");
			$this->sys_fields["Oct"]=array("title"             => "Oct");
			$this->sys_fields["Nov"]=array("title"             => "Nov");
			$this->sys_fields["Dic"]=array("title"             => "Dic");
			
				## GUARDAR USUARIO
			$option=array();			
			$option["template_title"]	                = $this->sys_module . "html/report_general_title";
			$option["template_body"]	                = $this->sys_module . "html/report_general_body";
			
			$option["select"]=array(
				"trabajador_puesto",
				#"IF(LOCATE('/1/',dias)>0,SUM(total),0)"=>"Ene",
				"IF(locate('/1/',group_concat(dias))>0,sum(total),0)"=>"Ene",
				"IF(locate('/2/',group_concat(dias))>0,sum(total),0)"=>"Feb",
				"IF(locate('/3/',group_concat(dias))>0,sum(total),0)"=>"Mar",
				"IF(locate('/4/',group_concat(dias))>0,sum(total),0)"=>"Abr",
				"IF(locate('/5/',group_concat(dias))>0,sum(total),0)"=>"May",
				"IF(locate('/6/',group_concat(dias))>0,sum(total),0)"=>"Jun",
				"IF(locate('/7/',group_concat(dias))>0,sum(total),0)"=>"Jul",
				"IF(locate('/8/',group_concat(dias))>0,sum(total),0)"=>"Ago",
				"IF(locate('/9/',group_concat(dias))>0,sum(total),0)"=>"Sep",
				"IF(locate('/10/',group_concat(dias))>0,sum(total),0)"=>"Oct",
				"IF(locate('/11/',group_concat(dias))>0,sum(total),0)"=>"Nov",
				"IF(locate('/12/',group_concat(dias))>0,sum(total),0)"=>"Dic",
			);				
			$option["from"]="personal_txt join plazas on trabajador_clave=matricula";
			$option["where"]=array(
				"dias LIKE '%/". date("n")."/%'",	
				"estatus = 'APROVADO'"
			);

			$option["group"]="trabajador_puesto";
			
			$option["actions"]							="false";
			
			/*
			99062212    1ra de junio    Ma sara marquez preciado
			*/						
			return $this->__VIEW_REPORT($option);
		}				
	}
?>

