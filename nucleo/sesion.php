<?php	
	if(!isset($_SESSION))
	{
		$usuarios_sesion						="PHPSESSID";
		session_name($usuarios_sesion);
		@session_start();
		session_cache_limiter('nocache,private');			
		/*
		if(count($_COOKIE) > 0 AND isset($_COOKIE["solesgps"])) 
			$_SESSION=$_COOKIE["solesgps"];
		*/		
	}
	if(!isset($_SESSION))		$_SESSION=array();
	
	if(isset($_SESSION))
	{
		if(!isset($_SESSION["var"]))			$_SESSION["var"]					=array();
		if(!isset($_SESSION["var"]["menu"]))	$_SESSION["var"]["menu"]			="";
		if(isset($_REQUEST["sys_menu"]))		$_SESSION["var"]["menu"]			=$_REQUEST["sys_menu"];
		if(isset($_REQUEST["sys_vpath"]))		$_SESSION["var"]["vpath"]			=@$_REQUEST["sys_vpath"];
						
		$_SESSION["var"]["false"]			=array(0,"0","false", "no");
		$_SESSION["var"]["true"]			=array(1,"1","true", "yes","si");
		$_SESSION["var"]["server_true"]		=array("www.solesgps.com","solesgps.com","www.soluciones-satelitales.com","soluciones-satelitales.com");
		$_SESSION["var"]["server_error"]	=array("localhost","developer.solesgps.com");		
		$_SESSION["var"]["print"]			=array("print_report","print_excel","print_pdf");		
		$_SESSION["var"]["datetime"]		=date("Y-m-d H:i:s" , strtotime ("-7 hour", strtotime(date("Y-m-d H:i:s"))));
		$_SESSION["var"]["date"]			=date("Y-m-d" , strtotime ("-7 hour", strtotime(date("Y-m-d H:i:s"))));		
		$_SESSION["var"]["modulo"]			=substr($_SESSION["var"]["vpath"],0, strpos($_SESSION["var"]["vpath"], "/"));
		$_SESSION["var"]["modulo_path"] 	="modulos/". $_SESSION["var"]["modulo"] ."/index.php";
		$_SESSION["var"]["folders"] 		=substr_count($_SESSION["var"]["vpath"], "/");
		$_SESSION["var"]["import"]			=array(
												"type"		=>"replace",
												"fields"	=>",",
												"enclosed"	=>"\"",
												"lines"		=>"\\n",
												"ignore"	=>"1",
		);
		$_SESSION["var"]["modules"]			=array(
												"historico","menu","user_group","tareas", 
												"group","modulos","permiso","sesion","cron",
												"cron_history","position","positions","crons_history"
		);
		$_SESSION["var"]["server"]			=array_merge($_SESSION["var"]["server_true"], $_SESSION["var"]["server_error"]);


		if(@$_GET["sys_action"]=="cerrar_sesion")
		{
			session_destroy();
			$destino= "../sesion/";	
			Header ("Location: $destino");			
		}	
	}
	$pre_path="";
	
	for($a=0; $a<10; $a++)
	{
		$path_instalacion="modulos/instalacion/";

		#/*

		if(@file_exists($path_instalacion . "index.php"))
		{
			require_once($pre_path	."nucleo/basededatos.php");
			require_once($pre_path	."nucleo/auxiliar.php");
			require_once($pre_path	."nucleo/general.php");		

			require_once($pre_path	.$path_instalacion . "modelo.php");	
			break;
			exit;
		}
		else
		#*/ 
		
		if(@file_exists($pre_path	."nucleo/general.php"))
		{
			require_once($pre_path	."nucleo/basededatos.php");
			require_once($pre_path	."nucleo/auxiliar.php");
			require_once($pre_path	."nucleo/general.php");		


							
			$objeto					=new general();         

			$comando_sql			="SELECT * FROM modulos ";		
			$modulos 				=$objeto->__EXECUTE($comando_sql);    
	
			foreach($modulos as $modulo)
			{
				if(file_exists($pre_path	."modulos/{$modulo["clase"]}/modelo.php")) 				
					require_once($pre_path	."modulos/{$modulo["clase"]}/modelo.php");	
			}
			if(@$_REQUEST["setting_company"]>0)
			{
				$comando_sql="
					SELECT 
						admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,0,0) as img_files_id,
						admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,180,0) as img_files_id_med, c.*		
					FROM company c WHERE id={$_REQUEST["setting_company"]}
				";		
				$modulos 		=$objeto->__EXECUTE($comando_sql);    
				$objeto=null;					
				foreach($modulos as $modulo)
					$_SESSION["company"]					=$modulo;
			}
			break;
		}				
		$pre_path.="../";
	}
?>	
