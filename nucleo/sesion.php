<?php	

	if(!isset($_SESSION))
	{
		#ini_set('display_errors', 0);
		$usuarios_sesion						="PHPSESSID";
		session_name($usuarios_sesion);
		@session_start();
		session_cache_limiter('nocache,private');	
		
		/*
		if(count($_COOKIE) > 0 AND isset($_COOKIE["solesgps"])) 
		{
			$_SESSION=$_COOKIE["solesgps"];
		} 
		*/		
	}
	if(isset($_SESSION))
	{
		if(@$_GET["sys_action"]=="cerrar_sesion")
		{
			session_destroy();
			$destino= "../sesion/";	
			Header ("Location: $destino");			
		}	
	}
	$path											=$_GET["sys_vpath"];
	$vpath2											="modulos/$path"."index.php";
	
	$_SESSION["module"]								=array(
		"name"=>"$path"
	);				   	    			
	
	#$aux_REQUEST["sys_vpath"]						=@substr($_REQUEST["sys_vpath"],0, strpos($_REQUEST["sys_vpath"], "/"+1));
	$sys_class										=@substr($_REQUEST["sys_vpath"],0, strpos($_REQUEST["sys_vpath"], "/"));


	$pre_path="";

	for($a=0; $a<10; $a++)
	{
		if(!class_exists("general") AND @file_exists($pre_path	."nucleo/general.php"))
		{
			require_once($pre_path	."nucleo/basededatos.php");
			require_once($pre_path	."nucleo/auxiliar.php");
			require_once($pre_path	."nucleo/general.php");													
			require_once($pre_path	."modulos/company/modelo.php");
			require_once($pre_path	."modulos/historico/modelo.php");
		}
		if(!class_exists($sys_class) AND @file_exists($pre_path	."modulos/{$sys_class}/modelo.php"))		
		{
			require_once($pre_path	."modulos/{$sys_class}/modelo.php");
		}				
		$pre_path.="../";
	}
	
	
	
	/*
	for($a=0; $a<10; $a++)
	{
		if(@file_exists($pre_path	."nucleo/general.php"))
		{
			require_once($pre_path	."nucleo/basededatos.php");
			require_once($pre_path	."nucleo/auxiliar.php");
			require_once($pre_path	."nucleo/general.php");		
					

			$objeto	=new general();         
			$comando_sql="SELECT * FROM modulos ";		
			$modulos 		=$objeto->__EXECUTE($comando_sql);    
			
			foreach($modulos as $modulo)
			{
				if(file_exists($pre_path	."modulos/{$modulo["clase"]}/modelo.php")) 				
					require_once($pre_path	."modulos/{$modulo["clase"]}/modelo.php");
			}
			break;
		}				
		$pre_path.="../";
	}
	*/
	
?>	
