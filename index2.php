<?php


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
