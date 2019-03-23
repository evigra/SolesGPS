<?php
	class sesion extends general
	{   
		##############################################################################	
		##  Propiedades	
		##############################################################################
		var $mod_mensaje="";
		var $sys_fields	=array(
			"id"	    =>array(
			    "title"             => "id",
			    "showTitle"         => "si",
			    "type"              => "primary key",
			),
			"user"	    =>array(
			    "title"             => "Usuario",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"pass"	    =>array(
			    "title"             => "Password",
			    "showTitle"         => "si",		
			    "type"              => "password",
			),
			
			"user_id"	    =>array(
			    "title"             => "Nombre",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"server_addr"	    =>array(
			    "title"             => "Servidor",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"date"	    =>array(
			    "title"             => "Fecha",
			    "showTitle"         => "si",
			    "type"              => "password",
			),
			"remote_addr"	    =>array(
			    "title"             => "Servidor",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
			"http_user_agent"	    =>array(
			    "title"             => "Agente",
			    "showTitle"         => "si",
			    "type"              => "input",
			),
		);				
		##############################################################################	
		##  Metodos	
		##############################################################################

        


		public function __CONSTRUCT()
		{
			parent::__CONSTRUCT();			
		}        
		public function huso_horario($option)
		{
			$return=-5;
			foreach(timezone_abbreviations_list() as $timezone)
			{
				foreach($timezone as $val)
				{
				    if(isset($val['timezone_id']) AND $val['timezone_id']==$option)
				    {
				    	$return=$val['offset']/60/60;
				    	exit();						    	
				    }
				}
			}
			
			return $return;
		}        
		
		public function sesion($option=NULL)		
    	{	
    		if(is_null($option))	$option=array();
    		
			$option["select"]	=array(				
				"s.*",
				"u.*",
				"c.*",
			);
			$option["from"]		="
				sesion s join
				users u on s.user_id=u.id join
				company c on c.id=u.company_id
			";
			$option["order"]		="date desc";
			
			if(!isset($option["where"]))
				$option["where"]=" and u.company_id={$_SESSION["company"]["id"]} or u.id={$_SESSION["user"]["id"]}";
			#$option["echo"]="";
			$return =$this->__VIEW_REPORT($option);    				
			return $return;
		}				

		public function __SAVE($datas=NULL,$option=NULL)
    	{
    		$this->obj_user   		=new users();
    		$this->obj_company   	=new company_gps();
    		
    	    
    		$this->words["mensaje_sesion"]	= 	"
    			<div id=\"messajeSesion\" class=\"messajeSesion borderRed\">
					<table>
						<tr>
							<td>
								<img src=\"../modulos/sesion/img/noCheck.png\" alt=\"\" />
							</td>
							<td style = \"padding-left: 10px;\">
								Error de Sesion. Verifique Sus Datos.
							</td>    														 
						</tr>    													
					</table>    												
				</div>
			";
    		
    		if(array_key_exists("user",$datas) AND array_key_exists("pass",$datas))
    		{
				$user       								=$this->obj_user->session($datas["user"],$datas["pass"]);
					
				if(count($user)>0)
				{	
					if($user["email"]==$datas["user"])
					{
						if($user["password"]==md5($datas["pass"]))						
						{
							$comando_sql="
								SELECT * 
								FROM 
									groups g join 
									user_group ug on ug.active=g.id 
								WHERE 1=1
									AND user_id={$user["id"]}
									AND active>0
							";		

							$option_conf=array();

							$option_conf["open"]	=1;
							$option_conf["close"]	=1;
						
							$data_usergroup 				=$this->__EXECUTE($comando_sql,$option_conf);						
							
							$option_company					=array("where"=>array("company.id={$user["company_id"]}"));
							$data_company					=$this->obj_company->__BROWSE($option_company);
					
							$data_sesion					=array();
							$data_sesion["user_id"]			=$user["id"];
							$data_sesion["date"]			=$this->sys_date;
							$data_sesion["server_addr"]		=$_SERVER["SERVER_ADDR"];
							$data_sesion["remote_addr"]		=$_SERVER["REMOTE_ADDR"];
							$data_sesion["http_user_agent"]	=$_SERVER["HTTP_USER_AGENT"];
						
							$option=array("message"=>"");
							parent::__SAVE($data_sesion,$option);
						    $_SESSION["user"]       		=$user;		
						    $_SESSION["session"]    		=@$data_sesion;
						    $_SESSION["company"]			=@$data_company["data"][0];
						    
						    
						    #$huso_horario					=$_SESSION["company"]["huso_horario"];
						    #$_SESSION["user"]["huso_h"]		=$this->huso_horario($huso_horario);
						    #$_SESSION["user"]["huso_h"]		=5;
						    #$_SESSION["user"]["huso_h"]		=6;
						    
						    $_SESSION["group"]				=@$data_usergroup;
						    
						    if($_SESSION["user"]["sesion_start"]!="")	$sesion_start	=$_SESSION["user"]["sesion_start"];
						    else										$sesion_start	="";
						    
						    if($user["sesion_start"]!="")   $locacion	=$user["sesion_start"];
						    else							$locacion	="../map_online/&sys_menu=2";
						    
						    setcookie("solesgps", $user["id"]);
						    
						    $this->__SAVE_JS        		=" window.location =\"$locacion\";  ";
						    $this->__SAVE_MESSAGE   		="";
						    
						    $this->words["mensaje_sesion"]	=	"
						    	<div id=\"messajeSesion\" class=\"messajeSesion borderGreen\">
									<table>
										<tr>
											<td>
												<img src=\"../modulos/sesion/img/Check.png\" alt=\"\" />
											</td>
											<td style = \"padding-left: 10px;\">
												Datos Correctos. Iniciando Sesion...
											</td>				    														   														
											<td style = \"padding-left: 10px;\">
												<img src=\"../modulos/sesion/img/gps.gif\" alt=\"\" />
											</td>
										</tr>    													
									</table>    												
								</div>
							";
						}
					}
				}						
			}	
		}			
	}
?>
