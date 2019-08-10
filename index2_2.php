<?php
	ini_set('display_errors', 1);				
	
	include('nucleo/cer/Crypt/RSA.php');
	include('nucleo/cer/File/X509.php');

	$doc_firmar="TEXTO O DOCUMENTO";

	$obj_x509 			=new File_X509();		
	$obj_rsa 			=new Crypt_RSA();
	
	$keys				=$obj_rsa->createKey();

$keys["privatekey"]="-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQC8MggZqKWp+K8i5habZDj7mPopXRCmn5VsN2uoqF6TrVB77zFS
yJxpNJfBRbOniugnmANZNkiqlqnqNXIdGszOymLZAruJIXgF46ks7SN1cpmxX4sm
4ghVLeaZ7NFFdBRxjD/sthPNLgjb5GJAaLre76t+qwHs3RnTGbC/H0i/+wIDAQAB
AoGAdCoZz+TGpV0olc0apT4+4iZyO/gDICafMBYhcRDEmDlB1c42Ttgfm9zn01f3
5fIbDN2LK5UTU6D+LuBgmNCDHA5vXzcJklypiTCEzo4pafLXtHFu8DzAhOijX6JW
mnY5EglL7EChVP6QJZ2afR44BZF/0DQ7IE/FpXWqk/dpnHECQQDoPehCoSas3CYN
cU7FJE/ZxhFucWetS7ppXYirJsuWsmKrGJC37IBxA7J2Q62QCc8bppTW+MC52yR0
mdubuVqZAkEAz3KcOgNt4GzhkGdzNsYFM1xCCogfFQoncg516RL4gIsFD9tqd/BF
XdQY3thoJqsgkDcMXjZ+E9rIHUu7jPD/swJAAVF4pAguJAUL4j+mZtAR8/Z/2tSh
9gXcBQUW5YHO3ggdL0NwbtrUz89pj+pKbergVhPX/HBlB6kKx+6npHak4QJAPqu6
RNB6Zl2ee3i1VuvV8GFD1livQzTxG8UAnCxOBM969QJtlNRysFj+NnycYmo6iTcI
NoIx7p+e6zLQ81BvfwJAUrXW67JC9iiPJa1ZYq23W3z1pDg/Pj+uGl7H17TS3i0Y
T/0XTg9U7orCi8K64h0M8GsPgh/l+xDS23f2yEYUqA==
-----END RSA PRIVATE KEY-----";

	
	$obj_rsa->loadKey($keys["privatekey"]);
	$obj_x509->setPrivateKey($obj_rsa);
	
	$obj_x509->setDNProp('id-at-organizationName', 			'SolesGPS');
	$obj_x509->setDNProp('id-at-organizationalUnitName', 	'Administración de Seguridad de la Información');
	$obj_x509->setDNProp('pkcs-9-at-emailAddress', 			'e.vizcaino@solesgps.com');
	$obj_x509->setDNProp('id-at-streetAddress', 			'Priv. Bugambilias #144, Col. Jardines de Bugambilias');
	$obj_x509->setDNProp('id-at-postalCode', 				'28978');
	$obj_x509->setDNProp('id-at-countryName', 				'MX');
	$obj_x509->setDNProp('id-at-stateOrProvinceName', 		'Colima');
	$obj_x509->setDNProp('id-at-localityName', 				'Villa de Alvarez');
	$obj_x509->setDNProp('id-at-uniqueIdentifier', 			'VIGE850830GKA');
	#$obj_x509->setDNProp('id-at-uniqueIdentifier', 			'VIGE850830GKA');
	
	$cer_array 			= $obj_x509->signCSR();
	$cer				= $obj_x509->saveCSR($cer_array);

	$firma 				=$obj_rsa->sign($doc_firmar);

	$keys["publickey"]="-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8MggZqKWp+K8i5habZDj7mPop
XRCmn5VsN2uoqF6TrVB77zFSyJxpNJfBRbOniugnmANZNkiqlqnqNXIdGszOymLZ
AruJIXgF46ks7SN1cpmxX4sm4ghVLeaZ7NFFdBRxjD/sthPNLgjb5GJAaLre76t+
qwHs3RnTGbC/H0i/+wIDAQAB
-----END PUBLIC KEY-----";

	$obj_rsa->loadKey($keys["publickey"]);
	echo $obj_rsa->verify($doc_firmar, $firma) ? '-#verified#-' : '-#unverified#-';


/*	
	$doc_firmar			="DOCUMENTO A FIRMAR";
	
	$data_cer 			= file_get_contents('VIGE850830GKA.cer');	
	$data_privatekey 	= file_get_contents('VIGE850830GKA.key');		

	$obj_x509 			= new File_X509();		
	$obj_rsa 			= new Crypt_RSA();

	#$obj_rsa->setPassword("EvG30JiC");
	$obj_rsa->loadKey($data_privatekey);

	#$privatekey 		= $obj_rsa->getPrivateKey(); // could do CRYPT_RSA_PRIVATE_FORMAT_PKCS1 too

	$cert 				=$obj_x509->loadX509($data_cer);
	$llave_publica		=$obj_x509->getPublicKey();
	#$firma 				=$obj_rsa->sign($doc_firmar);

	#$obj_rsa->loadKey($llave_publica);
	#echo $obj_rsa->verify($doc_firmar, $firma) ? '-#verified#-' : '-#unverified#-';
#*/
#/*


	echo "<pre>";
	echo "<br>CERTIFICADO###############################################################################<br>";	
	echo $cer;
	echo "<br>PRIVADA###############################################################################<br>";	
	echo $keys["privatekey"];
	echo "<br>PUBLICA###############################################################################<br>";	
	echo $keys["publickey"];
	
	echo "<br>FIRMA###############################################################################<br>";	
	echo $firma;
	
				
	#*/
?>
