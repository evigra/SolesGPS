<?php
	include('nucleo/sesion.php');
	
	$objeto											=new orden_venta();		
	#$objeto->__SESSION();
		
	$option=array();

	$vars["RFC"]					="VIGE850830GKA";
	$vars["privateKeyPassword"]		="EvG30JiC";			
	$vars["txtCertificate"]			="@VIGE850830GKA.cer";
	$vars["txtPrivateKey"]			="@VIGE850830GKA.key";


	$vars["tokenuuid"]					="YjIzMTAxYTUtZjA5Ni00M2Q2LTg3MDUtMzdhMzc2Y2YyNGE3";
	$vars["token"]					="";
	$vars["credentialsRequired"]					="CERT";
	$vars["guid"]					="YjIzMTAxYTUtZjA5Ni00M2Q2LTg3MDUtMzdhMzc2Y2YyNGE3";
	$vars["ks"]					="null";
	$vars["seeder"]					="";
	$vars["arc"]					="";
	$vars["tan"]					="";
	$vars["placer"]					="";
	$vars["secuence"]					="";
	$vars["urlApplet"]					="https://cfdiau.sat.gob.mx/nidp/app/login?id=SATx509Custom";
	$vars["fert"]					="";

	$url="https://cfdiau.sat.gob.mx/nidp/app/login?id=SATx509Custom&sid=0&option=credential&sid=0";
	$option		=array("url"=>$url,"post"=>$vars);			

	$objeto->__PRINT_R($objeto->__CURL($option))



/*
	ini_set('display_errors', 1);				
	
	include('nucleo/cer/Crypt/RSA.php');
	include('nucleo/cer/File/X509.php');
	

	$data_file = file_get_contents('VIGE850830GKA.cer');	

	echo str_replace(array('\n', '\r'), '', base64_encode($data_file));
	
	$objeto = new File_X509();	
	$cert = $objeto->loadX509($data_file);
	
	
	echo "<pre>";
	###print_R($cert);	

	###print_r($objeto->getDNProp('CN'));
	###print_r($objeto->getDN());
	#print_r($objeto->getDN(true));
	#print_r($objeto->getIssuerDNProp('CN'));
	#print_r($objeto->getIssuerDN());
	#print_r($objeto->getDNProp(true));
	#print_r($objeto->getIssuerDN(true));
	echo "</pre>";	
	#echo $objeto->getPublicKey();

#*/
/*
	$privatekey = file_get_contents('VIGE850830GKA.key');		
	$privKey = new Crypt_RSA();
	#extract($privKey->createKey());
	$privKey->loadKey($privatekey);

	#$x509 = new File_X509();
	$objeto->setPrivateKey($privKey);
	#$x509->setDNProp('id-at-organizationName', 'phpseclib demo cert');

	#$csr = $x509->signCSR();

	#echo $x509->saveCSR($csr);
	
	
	echo "<pre>";
	
	#print_R($privatekey);	
	#print_R($cert);	

	#print_r($privKey);
	#print_r($objeto);
	#print_r($objeto->getIssuerDN(true));
	echo "</pre>";	
#*/	
?>
