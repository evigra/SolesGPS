<?php
	include("nucleo/sesion.php");
	$path										=$_GET["sys_vpath"];
	$vpath2										="modulos/$path"."index.php";
	
	if(isset($objeto->request["setting_company"]))
	{	
		$comando_sql="
			SELECT 
				FN_ImgFile('../modulos/user/img/user.png',files_id,0,0) as img_files_id,	 
				FN_ImgFile('../modulos/user/img/user.png',files_id,180,0) as img_files_id_med,
				c.*				
			FROM company c
			WHERE 
				id={$objeto->request["setting_company"]}
		";		
		$company_data 							=$objeto->__EXECUTE($comando_sql);    
		$_SESSION["company"]					=$company_data[0];				   	    			
	} 
	
	$_SESSION["module"]							=array(
		"name"=>"$path"
	);				   	    			
		
	$aux_REQUEST["sys_vpath"]					=@substr($_REQUEST["sys_vpath"],0, strpos($_REQUEST["sys_vpath"], "/"+1));
	
	
	$words["index_modulo"]						="";
	$words["index_menulateral_inf"]				="";
	
	$words["modulo_opcion"]						="";
	$words["modulo_titulo"]						="AQUI VA EL TITULO DEL MODULO";
	$words["modulo_contenido"]					="";
	$words["modulo_mensaje"]					="";
	$words["modulo_js"]							="";
	
	#echo "{$_SERVER["REQUEST_URI"]},{$_REQUEST["sys_vpath"]}";
		
	if(array_key_exists("sys_vpath",$_REQUEST) AND $_REQUEST["sys_vpath"]!="")
	{
		$strpos										=strpos($_SERVER["REQUEST_URI"], $_REQUEST["sys_vpath"]);
		$strlen										=strlen($_REQUEST["sys_vpath"]);
		$substr										=substr($_SERVER["REQUEST_URI"], $strpos + $strlen);		
		$folders									=substr_count($substr, "/");
	}	
	#$folders									=substr_count(substr($_SERVER["REQUEST_URI"], strpos($_SERVER["REQUEST_URI"], $_REQUEST["sys_vpath"]) + strlen($_REQUEST["sys_vpath"])), "/");		
	
	
	#echo "<br>folders=$folders";
	
	#/*
	
	
	if($_SERVER["QUERY_STRING"]=="sys_vpath=")
	{	
		#$objeto->__PRINT_R($_SERVER);
		$serv_propio=array("www.solesgps.com","solesgps.com","localhost","www.soluciones-satelitales.com","soluciones-satelitales.com");
		
		if(in_array($_SERVER["SERVER_NAME"],$serv_propio))	$destino="Location:webHome/";							
		else												$destino="Location:sesion/";
		
		header($destino);
		exit;
	}	
	elseif($folders>0)
	{	
		$path="";
		for($a=1;$a<$folders;$a++)
		{
			$path.="../";
		}
		$path.="../../errores/";
		header('Location:'.$path);		
		exit;	
	}
	
	if(file_exists($path))			include($path);
	else if(file_exists($vpath2))	include($vpath2);
	else 
	{
		$folders=substr_count($path, "/");
		$path="";
		if($folders>0)
		{
			for($a=1;$a<$folders;$a++)
			{
				$path.="../";
			}
		}
		$path.="../errores/";
		header('Location:'.$path);		
	}

?>
