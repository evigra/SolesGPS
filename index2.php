<?php
#/*
	ini_set('display_errors', 1);				
	
	include('nucleo/cer/Crypt/RSA.php');
	include('nucleo/cer/File/X509.php');
	

	$data_file = file_get_contents('VIGE850830GKA.cer');	
	
	$objeto = new File_X509();	
	$cert = $objeto->loadX509($data_file);
	
	
	echo "<pre>";
	#print_R($cert);	

	#print_r($objeto->getDNProp('CN'));
	#print_r($objeto->getDN());
	print_r($objeto->getDN(true));
	#print_r($objeto->getIssuerDNProp('CN'));
	#print_r($objeto->getIssuerDN());
	print_r($objeto->getDNProp(true));
	print_r($objeto->getIssuerDN(true));
	

	





	echo "</pre>";
	
	echo $objeto->getPublicKey();




	$data_file = file_get_contents('VIGE850830GKA.key');	
	
	$objeto = new Crypt_RSA();	
	$cert = $objeto->loadKey($data_file);

	

	#/*
	echo "<pre>";
	#print_R($data_file);	
	#print_R($objeto);
	#print_R($cert);
	echo "</pre>";
	#*/

?>
