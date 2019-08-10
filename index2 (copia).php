<?php

#/*
	ini_set('display_errors', 1);				
	
	include('nucleo/cer/Crypt/RSA.php');
	include('nucleo/cer/File/X509.php');
	
	$doc_firmar			="DOCUMENTO A FIRMAR";
	
	$data_cer 			= file_get_contents('VIGE850830GKA.cer');	
	$data_privatekey 	= file_get_contents('VIGE850830GKA.key');		

	$obj_x509 			= new File_X509();		
	$obj_rsa 			= new Crypt_RSA();
	
	$cert 				=$obj_x509->loadX509($data_cer);
	$llave_publica		=$obj_x509->getPublicKey();
 /*	
	$llave_publica		="MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAjVQAHX/OFEXUuqMhl1uf
o623SELSwKQnR1R/i/lD6iaPlzKRwQZdytpGbMNFH5Q5hCp1ScOs83Vk5MvhyTNH
ocDF84ysUQOn23J9QpTG1wuHu80yOTM2y3Q309DHI1euAw0ZvsK2tQRWFXCX96GE
4B28mm9927XGpkgQhzk6r4LqxUKbCx/O/Xrzlax26GXaR/gy3i0UkR6NKrhSpCzj
HVraxa8uqLKVxx3q8xuwgxwcS/ZM1oCLof3ITwDFl0Hg9NgHbQbMT7iXFe2RVVUm
SSWNO1POdD/Xkrw41a4e3MpWGggbutuK/cgylFJSFL2LytOiBq156ef3J8yl9Avc
cwIDAQAB";
#*/	
	$obj_rsa->setPassword("EvG30JiC");
	$obj_rsa->loadKey($data_privatekey);
	$firma 				=$obj_rsa->sign($doc_firmar);

	$obj_rsa->loadKey($llave_publica);
	echo $obj_rsa->verify($doc_firmar, $firma) ? '-#verified#-' : '-#unverified#-';
	
	echo "<pre>";
	echo "FIRMA############<br>";
	print_R($firma);
	echo $firma;

	echo "<br>PUBLICA############<br>";
	echo $llave_publica;
	#print_R($llave_publica);


	
	echo "<br>PRIVADA############<br>";

	print_R($obj_rsa);	

	###print_r($objeto->getDNProp('CN'));
	###print_r($objeto->getDN());
	#print_r($objeto->getDN(true));
	#print_r($objeto->getIssuerDNProp('CN'));
	#print_r($objeto->getIssuerDN());
	#print_r($objeto->getDNProp(true));
	#print_r($objeto->getIssuerDN(true));
	echo "</pre>";			
?>
