<?php
	ini_set('display_errors', 1);				
	
	include('nucleo/cer/Crypt/RSA.php');
	include('nucleo/cer/File/X509.php');

	$doc_firmar="TEXTO O DOCUMENTO";

	$obj_x509 			=new File_X509();		
	$obj_rsa 			=new Crypt_RSA();

#/*	
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
		
	#$firma 				=$obj_rsa->sign($doc_firmar);
#*/
	#$firma=base64_encode($firma);

	$firma="MMBYfdBU8+nQSmGAeWRPg8GGRF4ANLtCEOZ8cSyOuOKiXdsha05t/AJJD83Nm2zERfPBFGFUUQqW/iN2rxCYCRic+gp4DYh0YAzymHHUtPL1v/yV1Egu3T/xE/e6Drn894GAMgEJ6wV3WHtnU/tjQGrLyO2q6I0jDnqUIqEx9eg=";

	#echo "#$firma#";	
	$firma=base64_decode($firma);
	
	#$doc_firmar.="a";   ##### VERIFIACION DE DOCUMENTO

	$keys["publickey"]="-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8MggZqKWp+K8i5habZDj7mPop
XRCmn5VsN2uoqF6TrVB77zFSyJxpNJfBRbOniugnmANZNkiqlqnqNXIdGszOymLZ
AruJIXgF46ks7SN1cpmxX4sm4ghVLeaZ7NFFdBRxjD/sthPNLgjb5GJAaLre76t+
qwHs3RnTGbC/H0i/+wIDAQAB
-----END PUBLIC KEY-----";

	$obj_rsa->loadKey($keys["publickey"]);
	echo $obj_rsa->verify($doc_firmar, $firma) ? '-#verified#-' : '-#unverified#-';
				
	#*/
?>
