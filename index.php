<?php
	require_once("nucleo/sesion.php");
    
    if(@$_REQUEST["setting_company"]>0)
    {
		$comando_sql="
			SELECT 
				admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,0,0) as img_files_id,
				admin_soles37.FN_ImgFile('../modulos/user/img/user.png',files_id,180,0) as img_files_id_med, c.*		
			FROM company c WHERE id={$_REQUEST["setting_company"]}
		";		
		$modulos 									=$objeto->__EXECUTE($comando_sql);    
		$objeto										=null;					
		foreach($modulos as $modulo)
		{
			$_SESSION["company"]					=$modulo;
		}
	}	
	$path											=$_GET["sys_vpath"];
	$vpath2											="modulos/$path"."index.php";
	
	$_SESSION["module"]								=array(
		"name"=>"$path"
	);				   	    			
	
	#$aux_REQUEST["sys_vpath"]						=@substr($_REQUEST["sys_vpath"],0, strpos($_REQUEST["sys_vpath"], "/"+1));
	$sys_class										=@substr($_REQUEST["sys_vpath"],0, strpos($_REQUEST["sys_vpath"], "/"+1));
		
	if(array_key_exists("sys_vpath",$_REQUEST) AND $_REQUEST["sys_vpath"]!="")
	{
		$strpos										=strpos($_SERVER["REQUEST_URI"], $_REQUEST["sys_vpath"]);
		$strlen										=strlen($_REQUEST["sys_vpath"]);
		$substr										=substr($_SERVER["REQUEST_URI"], $strpos + $strlen);		
		$folders									=substr_count($substr, "/");
	}	
	if($_SERVER["QUERY_STRING"]=="sys_vpath=")
	{	
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
	
	if(file_exists($path))			require_once($path);
	else if(file_exists($vpath2))	require_once($vpath2);
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
